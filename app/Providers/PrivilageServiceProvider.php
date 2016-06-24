<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PrivilageServiceProvider extends ServiceProvider
{
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

    public static function check_role($required_role , $user_roles=null)
    {
        return true ;
    }

    public static function check_domain($required_domain, $user_domains = null)
    {
        return true ;
    }
}
