<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\User;
use App\Providers\SecKeyServiceProvider;
use App\Traits\TahaControllerTrait;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CardController extends Controller
{
    use TahaControllerTrait;
    public function index()
    {
        $captcha = SecKeyServiceProvider::getQuestion('fa');
        return view('site.card_info.0', compact('captcha'));
    }

    public function register()
    {
        $states = State::get_combo() ;
        $input = Session::get('register_first_step');
        if (!$input)
        {
            return redirect('/organ_donation_card');
        }
        return view('site.card_register.0', compact('input', 'states'));
    }

    public function register_process()
    {
        $data = array();
        $user = new User();
        $user->name_first = 'salam';
        $user->save();
        $id = $user->id;



    }

    public function register_first_step(Requests\CardRegisterFirstStepRequest $request)
    {
        $input = $request->toArray();
        unset($input['_token']);
        unset($input['security']);
        unset($input['key']);
        $user = User::selectBySlug($input['code_melli'], 'code_melli');
        $can_login = $user and $user->isActive() ;
        if(!$can_login)
        {
            Session::put('register_first_step', $input);
            return $this->jsonFeedback(null, [
                'redirect' => url('register'),
                'ok' => 1,
                'message' => trans('forms.feed.wait'),
            ]);
        }
        else
        {
            return $this->jsonFeedback(null, [
                'redirect' => url('relogin'),
            ]);
        }

    }

    public function register_second_step(Requests\CardRegisterSecondStepRequest $request)
    {
        $input = $request->toArray();
        print_r($input);
    }
}
