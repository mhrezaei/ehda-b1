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



	private function getPermits()
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

	private function saveDomains($domains_array)
	{
//		$this->domains = Crypt::encrypt(json_encode($domains_array));
		$this->domains = json_encode($domains_array);
		return $this->save();
	}

	private function getDomains()
	{
//		return json_decode(Crypt::decrypt($this->domains), true);
		$return = json_decode($this->domains, true);

		if(!($return)) $return = array() ;

		return $return ;
	}


	public function attachDomains($domains , $forget_stored=false)
	{
		if($domains=='all') return $this->attachAllDomains() ;
		if($forget_stored)
			$stored_domains = array();
		else
			$stored_domains = $this->getDomains();

		foreach($domains as $domain) {
			if(!in_array($domain , $stored_domains)) {
				if(Domain::where('id',$domain)->count())
					array_push($stored_domains , $domain) ;
			}
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

		foreach($domains as $domain) {
			if(($key = array_search($domain, $stored_domains)) !== false) {
				unset($stored_domains[$key]);
			}
		}

		return $this->saveDomains($stored_domains) ;
	}

	public function attachAllDomains()
	{
		$domains = Domain::all() ;
		$array = array() ;

		foreach($domains as $domain) {
			array_push($array,$domain->id) ;
		}

		return $this->saveDomains($array);
	}

	public function detachAllDomains()
	{
		$this->saveDomains(array());
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

		return $this->can_domain($domain) AND $this->can_permit($permit);
	}

	private function can_domain($domain)
	{
		if(!$domain) return true ;

		$stored_domains = $this->getDomains() ;
		
		return in_array($domain , $stored_domains) ;

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