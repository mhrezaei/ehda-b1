<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\SecKeyServiceProvider;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public function index()
    {
        $captcha = SecKeyServiceProvider::getQuestion('fa');
        return view('site.card_info.0', compact('captcha'));
    }

    public function register()
    {
        return view('site.card_register.0');
    }

    public function register_first_step(Requests\CardRegisterFirstStepRequest $request)
    {
        $user = User::selectBySlug();
        print_r($request->all());
    }
}
