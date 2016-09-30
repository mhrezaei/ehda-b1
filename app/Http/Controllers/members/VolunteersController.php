<?php

namespace App\Http\Controllers\members;

use App\Models\Post;
use App\Providers\SecKeyServiceProvider;
use App\Traits\TahaControllerTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VolunteersController extends Controller
{
    use TahaControllerTrait;

    public function index()
    {
        $captcha = SecKeyServiceProvider::getQuestion('fa');
        $volunteer = Post::findBySlug('volunteers_detail');
        if (! $volunteer)
            return view('errors.404');

        return view('site.volunteers.volunteers_info.0', compact('volunteer', 'captcha'));
    }

    public function register_first_step(Requests\site\volunteer\VolunteerFirstStepRequest $request)
    {
        $input = $request->toArray();

        print_r($input);
    }
}
