<?php
namespace App\Traits;

use App\Models\Domain;
use Illuminate\Support\Facades\Crypt;

trait PermitsTrait
{

	/*
	|--------------------------------------------------------------------------
	| Set
	|--------------------------------------------------------------------------
	|
	*/

	public function setPermits($roles , $domain)
	{
		$this->domain = $domain ;
		$this->roles = Crypt::encrypt(json_encode($roles)) ;
		return $this->update() ;
	}

	/*
	|--------------------------------------------------------------------------
	| Get
	|--------------------------------------------------------------------------
	| 
	*/

	public function getRoles()
	{
		if(!$this->roles)
			return null;
		else
			return Crypt::decrypt($this->roles) ;

	}

	public function getDomain()
	{
		if($this->isDeveloper())
			return 'global' ;
		else
			return $this->domain ;
	}

	public function getDomainName()
	{
		if($this->getDomain() == 'global')
			return trans('posts.manage.global') ;

		$domain = Domain::selectBySlug($this->getDomain()) ;
		if($domain)
			return $domain->title ;
		else
			return false ;
	}


	/*
	|--------------------------------------------------------------------------
	| Seek for Permissions / Domains
	|--------------------------------------------------------------------------
	|
	*/


	public function can($requested_role = NULL, $requested_domain = NULL)
	{
		if($this->isDeveloper())
			return true ;

		if($this->volunteer_status<8)
			return false ;

		return $this->canDomain($requested_domain) AND $this->canRole($requested_role);
	}

	private function canDomain($requested_domain)
	{
		//Obvious Conditions...
		if($this->domain == 'global')
			return true ;

		if(!$requested_domain)
			return true ;

		if(in_array($requested_domain , config('permit.wildcards')))
			return true ;

		//Check...
		if($this->domain == $requested_domain)
			return true ;
		else
			return false ;
	}

	private function canRole($requested_role)
	{
		//Obvious Conditions...
		if(in_array($requested_role, config('permit.wildcards')))
			return true;

		if(!$requested_role)
			return true ;

		//Special Roles...
		if($requested_role == 'manage')
			return $this->canRole('settings') and $this->canRole('volunteers.permit');


		//Module Check...
		$requested_role = str_replace('posts-' , null , $requested_role) ;
		$requested_role = str_replace('.*' , null , $requested_role) ;
		return str_contains($this->getRoles() , $requested_role);

	}

}