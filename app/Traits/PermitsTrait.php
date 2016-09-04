<?php
namespace App\Traits;

use App\Models\Domain;
use Illuminate\Support\Facades\Crypt;

trait PermitsTrait
{

	/*
	|--------------------------------------------------------------------------
	| Permission set System
	|--------------------------------------------------------------------------
	| Works with 'module.permit' pattern and accepts arrays or strings
	*/



	public function getPermits()
	{
		if(!$this->roles)
			return null;
		else
			return json_decode(Crypt::decrypt($this->roles), true);
	}

	private function permitCommandCompiler($permit_command)
	{
		$array = explode('.', $permit_command);
		$module = $array[0];
		$permit = $array[1];

		$available_modules = config('permit.available_modules');

		if(!array_key_exists($module, $available_modules))
			return false; //avoids unplanned permits

		if($permit == '*') {
			$new_permit = '';
			foreach($available_modules[$module] as $available_permit) {
				$new_permit .= $available_permit . ",";
			}
		}
		else {
			$permit = explode(',', $permit);
			$new_permit = '';
			foreach($permit as $item) {
				if(!in_array($item, $available_modules[$module]))
					continue; //avoids unplanned permits
				$new_permit .= $item . ',';
			}
		}

		return array($module, explode(',', rtrim($new_permit, ",")));

	}

	private function savePermits($permits_array)
	{
		$this->roles = Crypt::encrypt(json_encode($permits_array));
		return $this->save();
	}

	public function setPermits($command)
	{
		return $this->attachPermits($command, true);
	}

	public function attachPermits($command, $forget_stored = false)
	{
		if($forget_stored)
			$stored_permits = array();
		else
			$stored_permits = $this->getPermits();

		if(is_array($command)) {
			$permit_commands = $command;
		}
		else {
			$permit_commands[0] = $command;
		}

		foreach($permit_commands as $permit_command) {
			if(!$permit_array = $this->permitCommandCompiler($permit_command))
				continue;
			$module = $permit_array[0];
			$permits = $permit_array[1];

			if(!isset($stored_permits[$module]))
				$stored_permits[$module] = [];

			foreach($permits as $permit) {
				if(!in_array($permit, $stored_permits[$module]))
					array_push($stored_permits[$module], $permit);
			}
		}

		return $this->savePermits($stored_permits);
	}

	public function detachPermits($command)
	{
		$stored_permits = $this->getPermits();

		if(is_array($command)) {
			$permit_commands = $command;
		}
		else {
			$permit_commands[0] = $command;
		}

		foreach($permit_commands as $permit_command) {
			if(!$permit_array = $this->permitCommandCompiler($permit_command))
				continue;
			$module = $permit_array[0];
			$permits = $permit_array[1];

			if(!isset($stored_permits[$module]))
				continue;

			foreach($permits as $permit) {

				if(($key = array_search($permit, $stored_permits[$module])) !== false) {
					unset($stored_permits[$module][$key]);
				}
			}

			if(!count($stored_permits[$module])) {
				unset($stored_permits[$module]);
			}
		}

		return $this->savePermits($stored_permits);
	}


	/*
	|--------------------------------------------------------------------------
	| Domain set and unset system
	|--------------------------------------------------------------------------
	|
	*/

	public function saveDomains($domains_string)
	{
//		$this->domains = Crypt::encrypt($domains_string));
		$this->domains = $domains_string;
		return $this->save();
	}

	private function getDomains()
	{
//		return Crypt::decrypt($this->domains);
		$return = $this->domains;

		return $return ;
	}

	public static function domainsStringToArray($string)
	{
		return array_values(array_filter(explode('|',$string)));
	}

	/**
	 * @return an eloquent instance of `domains` table, where a user is permitted to act on.
	 */
	public function domains()
	{
		$domains_array = $this->domainsStringToArray($this->getDomains());

		return Domain::whereIn('slug', $domains_array);
	}

	public function attachDomains($domains , $forget_stored=false)
	{
		if($domains=='all') return $this->attachAllDomains() ;
		if($forget_stored)
			$stored_domains = '';
		else
			$stored_domains = $this->getDomains();

		if(!is_array($domains))
			$domains = $this->domainsStringToArray($domains);

		foreach( $domains as $domain) {
			if(!str_contains($stored_domains,$domain))
				if(Domain::selectBySlug($domain)->count())
					$stored_domains .= "|$domain|" ;
		}

		return $this->saveDomains($stored_domains);

	}

	public function setDomains($domains_commands)
	{
		return $this->attachDomains($domains_commands,true);
	}

	public function detachDomains($domains)
	{
		if($domains=='all') return $this->detachAllDomains() ;
		$stored_domains = $this->getDomains() ;

		if(!is_array($domains))
			$domains = $this->domainsStringToArray($domains);

		foreach($domains as $domain) {
			if(str_contains($stored_domains,"|$domain|"))
				$stored_domains = str_replace("|$domain|",'|');
		}

		return $this->saveDomains($stored_domains) ;
	}

	public function attachAllDomains()
	{
		return $this->saveDomains($this->getAllAvailableDomains());
	}

	public function detachAllDomains()
	{
		$this->saveDomains('');
	}

	private function getAllAvailableDomains()
	{
		$domains = Domain::all() ;
		$string = '|' ;

		foreach($domains as $domain) {
			$string .= $domain->slug."|" ;
		}

		return $string ;
	}
	/*
	|--------------------------------------------------------------------------
	| Seek for Permissions / Domains
	|--------------------------------------------------------------------------
	|
	*/


	public function can($permit = NULL, $domain = NULL)
	{
		if($this->isDeveloper())
			return true ;

		if($this->volunteer_status<8)
			return false ;

		return $this->can_domain($domain) AND $this->can_permit($permit);
	}

	private function can_domain($request)
	{
		//Bypass...
		if(in_array($request, config('permit.wildcards')))
			return true;

		if(!$request)
			return true ;

		if(str_contains($request , 'global'))
			$request = $this->getAllAvailableDomains() ;

		//change into array...
		if(str_contains($request , '|'))
			$domains = $this->domainsStringToArray($request) ;
		else
			$domains = [$request] ;

		//Check...
		foreach($domains as $domain) {
			if(!str_contains($this->getDomains(),"|$domain|"))
				return false ;
		}

		return true ;
	}

	private function can_permit($request)
	{
		//Bypass...
		if(in_array($request, config('permit.wildcards')))
			return true;

		//safety...
		if(!str_contains($request, '.'))
			$request .= '.';

		//Module Check...
		$stored_permits = $this->getPermits();
		$request = explode('.', $request);
		$request_module = $request[0];
		$request_permit = $request[1];

		if(in_array($request_module, config('permit.public_modules')))
			return true;
		if(!isset($stored_permits[$request_module]))
			return false;

		//Permit Check...
		if(in_array($request_permit, config('permit.wildcards')))
			return true;

		if((array_search($request_permit, $stored_permits[$request_module])) === false)
			return false;

		//Return true...
		return true;


	}

}