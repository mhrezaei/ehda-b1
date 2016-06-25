<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;

class PrivilegeServiceProvider extends ServiceProvider
{
	public static function check_role($required_role, $user_roles = null)
	{
		//Preparetions...
		$logged_volunteer = Auth::user();
		if(!$user_roles)
			$user_roles = json_decode(Crypt::decrypt($logged_volunteer->roles));

		if(!is_array($user_roles))
			return false;

		//Check public things
		if(in_array($required_role, ['index', 'settings', 'settings_profile', 'logout']))
			return true;

		//Check super powers...
//		if($logged_volunteer->id == 1)
//			return true;

		//check super admins...
		if($logged_volunteer == 'super') {
			if($required_role == 'devSettings')
				return false;
			else
				return true;
		}

		//safety...
		if(!is_array($user_roles))
			return false;

		//Check normal privileges...
		if(in_array($required_role, $user_roles))
			return true;

		return false;
	}

	public static function check_domain($required_domain, $user_domains = null)
	{
		return true;
	}

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
