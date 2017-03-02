<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
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
        // status: blocked < 0, examining = 1, documentation = 2, pending = 3, active = 8,9, all
        //act: fair, events, performing-arts, visual-arts, public-affairs, lecture, education, research, writing,
        // linguistics, informatics, executive, international, all
        $data = Session::get('export');
        $user = User::where('id', '>', '0');

        if ($data['act'] != 'all')
        {
            $user->where('activities', 'like', '%' . $data['act'] . '%');
        }

        if ($data['status'] == 'all')
        {
            $user->where('volunteer_status', '!=', 0);
        }
        elseif ($data['status'] == 'blocked')
        {
            $user->where('volunteer_status', '<', 0);
        }
        elseif ($data['status'] == 'examining')
        {
            $user->where('volunteer_status', 1);
        }
        elseif ($data['status'] == 'documentation')
        {
            $user->where('volunteer_status', 2);
        }
        elseif ($data['status'] == 'pending')
        {
            $user->where('volunteer_status',3);
        }
        elseif ($data['status'] == 'active')
        {
            $user->where('volunteer_status', '>=', 8);
        }

            $user = $user->orderBy('created_at', 'desc')
            ->orderBy('home_province', 'asc')
            ->get();

        return $user;
    }
}
