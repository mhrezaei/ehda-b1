<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
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

    public static function get_volunteer_data()
    {
//        $user = User::where('home_province', 8)->where('volunteer_status', '!=', 0)
        $user = User::where('volunteer_status', '>=', 8)->where('activities', 'like', '%lecture%')
//        $user = User::where('activities', 'like', '%international%')
            ->orderBy('created_at', 'desc')
            ->orderBy('home_province', 'asc')
            ->get();

        return $user;
    }
}
