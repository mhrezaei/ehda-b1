<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\User;
use App\Providers\FaGDServiceProvider;
use App\Providers\SecKeyServiceProvider;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Mockery\CountValidator\Exception;

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
        unset($input['_token']);
        $user = User::selectBySlug($input['code_melli'], 'code_melli');
        if (! $user)
        {
            if (isset($input['chRegisterAll']))
            {
                $input['organs'] = 'Heart Lung Liver Kidney Pancreas Tissues';
            }
            else
            {
                $input['organs'] = '';
                isset($input['chRegisterHeart']) ? $input['organs'] .= 'Heart ' : $input['organs'] .= '';
                isset($input['chRegisterLung']) ? $input['organs'] .= 'Lung ' : $input['organs'] .= '';
                isset($input['chRegisterLiver']) ? $input['organs'] .= 'Liver ' : $input['organs'] .= '';
                isset($input['chRegisterKidney']) ? $input['organs'] .= 'Kidney ' : $input['organs'] .= '';
                isset($input['chRegisterPancreas']) ? $input['organs'] .= 'Pancreas ' : $input['organs'] .= '';
                isset($input['chRegisterTissues']) ? $input['organs'] .= 'Tissues ' : $input['organs'] .= '';
            }
            
            // card extra detail
            $input['code_melli'] = Session::get('register_first_step');
            $input['code_melli'] = $input['code_melli']['code_melli'];
            $input['card_no'] = User::generateCardNo();
            $input['card_status'] = 8;
            $input['card_registered_at'] = Carbon::now()->toDateTimeString();
            $input['password'] = Hash::make($input['password']);
            $input['birth_date2'] = date('y/m/d', '645694982000');
            $input['birth_date'] = Carbon::createFromTimestamp($input['birth_date'])->toDateTimeString();
            $input['home_province'] = State::find($input['home_city']);
            $input['home_province'] = $input['home_province']->province()->id;
            $input['password_force_change'] = 0;

        }
        print_r($input);
    }

    public function card_mini($national_hash)
    {
        ini_set("error_reporting","E_ALL & ~E_NOTICE & ~E_STRICT");
        try {
            $national_hash = decrypt($national_hash);
        } catch (DecryptException $e) {
            return view('errors.404');
        }

        $user = User::selectBySlug($national_hash, 'code_melli');
        $user = $user->toArray();

        if ($user['card_status'] < 8)
        {
            return view('errors.403');
        }

        $font = public_path('assets' . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'BNazanin.ttf');
        $enFont = public_path('assets' . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'calibri.ttf');

        header("Content-type: image/png");
        header('Content-Disposition: filename=' . $user['card_no'] . '.png');

        // orginal image
        $img = imagecreatefrompng(url('') . 'assets/site/images/cardMini.png');

        $name_first = FaGDServiceProvider::fagd($user['name_first'] . ' ' . $user['name_last'], 'fa', 'nastaligh');
        $name_father = FaGDServiceProvider::fagd($user['name_father'], 'fa', 'nastaligh');

        // Create some colors
        $black = imagecolorallocate($img, 0, 0, 0);

        print_r($font);
        $hash1 = 'eyJpdiI6IjdEb0FLZUZVNXlsZTdnMlkwb0pKbVE9PSIsInZhbHVlIjoia1lxM01NNWh0M3ZOSmVpZUYrdjlOUHdwRkF2THlBR0o1V2g3bTlscGVhMD0iLCJtYWMiOiJiZjU4OTNmMmU4NTU2YzgyN2FkZDFkYjU0YmNiYjUyNzFiMTIwODdjNmNmMTc2NTQxMGE0Yzc1MTg2ZGVlMTdiIn0=';
        $hash2 = 'eyJpdiI6IkFJaWc4WWsrSHI1ZGFBSWV6TDFUN2c9PSIsInZhbHVlIjoiditMbEprV2p5bWVsYmVtUGZUV2dVVnE5REdVSGpMY0xRajFWVUl3SmJqST0iLCJtYWMiOiI1NWQ1OTllMzRlOWQzZTFiNWQwN2JkNDhhOWZjOGNhZTAxMmFiOTFkMzYxMWE3MjU3MjBkMjMwZGYyODExMWM3In0=';
    }
}
