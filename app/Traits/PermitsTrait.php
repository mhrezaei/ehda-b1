<?php
namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait PermitsTrait
{

	/*
	|--------------------------------------------------------------------------
	| Permission set System
	|--------------------------------------------------------------------------
	| Works with 'module.permit' pattern and accepts arrays or strings
	*/

	public function setPermits($command)
	{
		$this->attachPermits($command, true);
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

		$this->savePermits($stored_permits);
	}

	public function getPermits()
	{
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
		$this->save();
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

		$this->savePermits($stored_permits);
	}


	/*
	|--------------------------------------------------------------------------
	| Domain set and unset system
	|--------------------------------------------------------------------------
	|
	*/

	public function setDomains($domains)
	{

	}

	public function getDomains($domains)
	{

	}


	public function attachDomain($domain)
	{

	}

	public function detachDomain($domain)
	{

	}

	/*
	|--------------------------------------------------------------------------
	| Seek for Permissions / Domains
	|--------------------------------------------------------------------------
	|
	*/


	public function can($permit = NULL, $domain = NULL)
	{
		//		if($this->isDeveloper())
		//			return true ;

		return $this->can_domain($domain) AND $this->can_permit($permit);
	}

	private function can_domain($domain)
	{
		if(in_array($domain, config('permit.wildcards')))
			return true;
	}

	private function can_permit($request)
	{
		//Bypass...
		if(in_array($request, config('permit.wildcards')))
			return true;
		if(in_array($request, config('permit.public_modules')))
			return true;

		//safety...
		if(!str_contains($request, '.'))
			$request .= '.';

		//Module Check...
		$stored_permits = $this->getPermits();
		$request = explode('.', $request);
		$request_module = $request[0];
		$request_permit = $request[1];

		echo view('templates.say')->with(['array' => $request]);

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