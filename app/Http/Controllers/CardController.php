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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Mockery\CountValidator\Exception;
use Morilog\Jalali\Facades\jDate;

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
        $can_login = $user and $user->isActive('volunteer') and $user->isActive('card') ;
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
        if (! $user or ! $user->isActive('volunteer') or ! $user->isActive('card'))
        {
            return $this->jsonFeedback(trans('site.global.register_check_data_step_second'),[
                'ok' => 1,
                'callback' => 'register_step_second()'
            ]);
        }
        else
        {
            return $this->jsonFeedback(null, [
                'redirect' => url('relogin'),
            ]);
        }
    }
    public function register_third_step(Requests\CardRegisterSecondStepRequest $request)
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
            $input['code_melli'] = Session::pull('register_first_step');
            $input['code_melli'] = $input['code_melli']['code_melli'];
            $input['card_no'] = User::generateCardNo();
            $input['card_status'] = 8;
            $input['card_registered_at'] = Carbon::now()->toDateTimeString();
            $input['password'] = Hash::make($input['password']);
            $input['birth_date'] = Carbon::createFromFormat('m/d/Y-H:i:s', $input['birth_date'] . '-00:00:00')->toDateTimeString();
            $input['home_province'] = State::find($input['home_city']);
            $input['home_province'] = $input['home_province']->province()->id;
            $input['password_force_change'] = 1;
            
            $user_id = User::store($input, array(
                'password2',
                'chRegisterAll',
                'chRegisterHeart',
                'chRegisterLung',
                'chRegisterLiver',
                'chRegisterKidney',
                'chRegisterPancreas',
                'chRegisterTissues',
            ));

            if ($user_id)
            {
                Auth::loginUsingId( $user_id );
                return $this->jsonFeedback(null, [
                    'redirect' => url('members/my_card'),
                    'ok' => 1,
                    'message' => trans('site.global.register_success'),
                    'redirectTime' => 2000,
                ]);
            }
            else
            {
                return $this->jsonFeedback(null, [
                    'redirect' => url('organ_donation_card'),
                    'ok' => 0,
                    'message' => trans('site.global.register_not_complete'),
                    'redirectTime' => 2000,
                ]);
            }
            
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
        header('Content-Disposition: filename=' . 'کارت_اهدای_عضو_' . $user['card_no'] . '.png');

        // orginal image
        $img = imagecreatefrompng(public_path('assets' . DIRECTORY_SEPARATOR . 'site' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'cardMini.png'));

        // data
        $name_first = FaGDServiceProvider::fagd($user['name_first'] . ' ' . $user['name_last'], 'fa', 'nastaligh');
        $name_father = FaGDServiceProvider::fagd($user['name_father'], 'fa', 'nastaligh');
        $birth_date = jDate::forge($user['birth_date'])->format('Y/m/d');
        $register_date = jDate::forge($user['card_registered_at'])->format('Y/m/d');

        // font size
        $font_size = 25;

        // position
        $name_position = imagettfbbox($font_size, 0, $font, $name_first);
        $name_position = $name_position[2] - $name_position[0];

        $name_father_position = imagettfbbox($font_size, 0, $font, $name_father);
        $name_father_position = $name_father_position[2] - $name_father_position[0];

        $card_no_position = imagettfbbox($font_size, 0, $font, $user['card_no']);
        $card_no_position = $card_no_position[2] - $card_no_position[0];

        $national_position = imagettfbbox($font_size, 0, $font, $user['code_melli']);
        $national_position = $national_position[2] - $national_position[0];

        $birth_date_position = imagettfbbox($font_size, 0, $font, $birth_date);
        $birth_date_position = $birth_date_position[2] - $birth_date_position[0];

        $register_date_position = imagettfbbox($font_size, 0, $font, $register_date);
        $register_date_position = $register_date_position[2] - $register_date_position[0];

        // Create some colors
        $black = imagecolorallocate($img, 0, 0, 0);

        // Add the text
        imagettftext($img, $font_size, 0, (500 - $card_no_position), 173, $black, $font, $user['card_no']);
        imagettftext($img, $font_size, 0, (500 - $name_position), 212, $black, $font, $name_first);
        imagettftext($img, $font_size, 0, (500 - $name_father_position), 254, $black, $font, $name_father);
        imagettftext($img, $font_size, 0, (500 - $national_position), 300, $black, $font, $user['code_melli']);
        imagettftext($img, $font_size, 0, (500 - $birth_date_position), 341, $black, $font, $birth_date);
        imagettftext($img, $font_size, 0, (500 - $register_date_position), 382, $black, $font, $register_date);

        // Using imagepng() results in clearer text compared with imagejpeg()
        imagepng($img);
        imagedestroy($img);
    }

    public function card_full($national_hash, $mode = 'print')
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
        if($mode == 'print')
        {
            header('Content-Disposition: filename=' . 'کارت_اهدای_عضو_' . $user['card_no'] . '.png');
        }
        elseif($mode == 'download')
        {
            header('Content-Description: File Transfer');
            header('Content-Disposition: filename=' . 'کارت_اهدای_عضو_' . $user['card_no'] . '.png');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
        }
        else
        {
            header('Content-Disposition: filename=' . 'کارت_اهدای_عضو_' . $user['card_no'] . '.png');
        }

        // orginal image
        $img = imagecreatefrompng(public_path('assets' . DIRECTORY_SEPARATOR . 'site' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'finalCart.png'));

        // data
        $name_first = FaGDServiceProvider::fagd($user['name_first'] . ' ' . $user['name_last'], 'fa', 'nastaligh');
        $name_father = FaGDServiceProvider::fagd($user['name_father'], 'fa', 'nastaligh');
        $birth_date = jDate::forge($user['birth_date'])->format('Y/m/d');
        $register_date = jDate::forge($user['card_registered_at'])->format('Y/m/d');

        // font size
        $font_size = 30;

        // position
        $name_position = imagettfbbox($font_size, 0, $font, $name_first);
        $name_position = $name_position[2] - $name_position[0];

        $name_father_position = imagettfbbox($font_size, 0, $font, $name_father);
        $name_father_position = $name_father_position[2] - $name_father_position[0];

        $card_no_position = imagettfbbox($font_size, 0, $font, $user['card_no']);
        $card_no_position = $card_no_position[2] - $card_no_position[0];

        $national_position = imagettfbbox($font_size, 0, $font, $user['code_melli']);
        $national_position = $national_position[2] - $national_position[0];

        $birth_date_position = imagettfbbox($font_size, 0, $font, $birth_date);
        $birth_date_position = $birth_date_position[2] - $birth_date_position[0];

        $register_date_position = imagettfbbox($font_size, 0, $font, $register_date);
        $register_date_position = $register_date_position[2] - $register_date_position[0];

        $email_position = imagettfbbox(40, 0, $font, $user['email']);
        $email_position = $email_position[2] - $email_position[0];

        $mobile_position = imagettfbbox(40, 0, $enFont, $user['tel_mobile']);
        $mobile_position = $mobile_position[2] - $mobile_position[0];

        // Create some colors
        $black = imagecolorallocate($img, 0, 0, 0);

        // Add the text
        imagettftext($img, $font_size, 0, (850 - $card_no_position), 567, $black, $font, $user['card_no']);
        imagettftext($img, $font_size, 0, (850 - $name_position), 620, $black, $font, $name_first);
        imagettftext($img, $font_size, 0, (850 - $name_father_position), 665, $black, $font, $name_father);
        imagettftext($img, $font_size, 0, (850 - $national_position), 720, $black, $font, $user['code_melli']);
        imagettftext($img, $font_size, 0, (850 - $birth_date_position), 772, $black, $font, $birth_date);
        imagettftext($img, $font_size, 0, (850 - $register_date_position), 822, $black, $font, $register_date);
        imagettftext($img, 40, 0, (1850 - $mobile_position), 2115, $black, $font, $user['tel_mobile']);
        imagettftext($img, 40, 0, (1850 - $email_position), 2190, $black, $enFont, $user['email']);

        // Using imagepng() results in clearer text compared with imagejpeg()
        imagepng($img);
        imagedestroy($img);
    }
}
