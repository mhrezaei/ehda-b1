<?php

namespace App\Http\Controllers;

use App\Models\Api_token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function __construct()
    {
        Api_token::delete_expired();
    }

    // incoming parameter (POST method):
    // 1) code_melli
    // 2) token
    //---------------------
    // result (json):
    //  {status} =>
    //      0 => code_melli or token not send
    //      -1 => wrong token
    //      -2 => token expired
    //      -3 => request ip and client ip not match
    //      -4 => code_melli not valid
    //       1 => generate token success
    public function ehda_card_search(Request $request)
    {
        $data = $request->toArray();
        $result = array();

        if (! isset($data['token']) or ! isset($data['code_melli']))
            // code_melli or token not send
            $result['status'] = 0;

        // token check
        $token = Api_token::find_token($data['token']);
        if ($token)
        {
            if ($token->expired_at <= Carbon::now()->toDateTimeString())
            {
                // token expired
                $result['status'] = -2;
            }
            else
            {
                if ($token->user->email == $request->ip())
                {
                    // token is valid
                    $result['status'] = 1;
                }
                else
                {
                    // request ip not match
                    $result['status'] = -3;
                }
            }
        }
        else
        {
            // wrong token
            $result['status'] = -1;
        }

        // code_melli check
        if (self::validateCodeMelli($data['code_melli']))
        {
            $user = User::findBySlug($data['code_melli'], 'code_melli');
        }
        else
        {
            // code_melli not valid
            $result['status'] = -4;
        }


        return json_encode($result);
    }

    // incoming parameter (POST method):
    // 1) username
    // 2) password
    //---------------------
    // result (json):
    //  {status} =>
    //      0 => username or password not send
    //      -1 => wrong username
    //      -2 => wrong password
    //      -3 => request ip and client ip not match
    //      -4 => api can't create token
    //       1 => generate token success
    //  {token} => if status == 1 return token(string)
    public function get_token(Request $request)
    {
        $data = $request->toArray();
        $data['ip'] = $request->ip();
        $result = array();
        $client = false;

        // check submit data
        if (! isset($data['username']) or ! isset($data['password']))
        {
            // username and password not send to api
            $result['status'] = 0;
        }
        else
        {
            // find client by username
            $client = User::findBySlug($data['username'], 'code_melli');

            if ($client)
            {
                if (Hash::check($data['password'], $client['password']))
                {
                    // password is true
                    // check request ip address
                    if ($data['ip'] == $client['email'])
                    {
                        // request ip and client ip is match
                        $result['status'] = 1;
                    }
                    else
                    {
                        // request ip and client ip not match
                        $result['status'] = -3;
                    }
                }
                else
                {
                    // password wrong
                    $result['status'] = -2;
                }
            }
            else
            {
                // username wrong
                $result['status'] = -1;
            }


        }

        // get token process
        if ($result['status'] > 0)
        {
            $result['token'] = str_random(100);

            // check token for duplicate
            $check_db_token = Api_token::findBySlug($result['token'], 'api_token');
            if ($check_db_token)
            {
                $result['token'] = str_random(100);
            }

            $insert = [
                'user_id' => $client['id'],
                'api_token' => $result['token'],
                'expired_at' => Carbon::now()->addHour()->toDateTimeString(),
            ];

            if (Api_token::store($insert))
            {
                $result['token'] = encrypt($result['token']);
            }
            else
            {
                // token insert to database failed
                $result['status'] = -4;
            }

        }

        return json_encode($result);
    }

    // code_melli_validation
    private static function validateCodeMelli($code_melli)
    {
        if(!preg_match("/^\d{10}$/", $code_melli)) {
            return false;
        }

        $check = (int)$code_melli[9];
        $sum = array_sum(array_map(function ($x) use ($code_melli) {
                return ((int)$code_melli[$x]) * (10 - $x);
            }, range(0, 8))) % 11;

        return ($sum < 2 && $check == $sum) || ($sum >= 2 && $check + $sum == 11);
    }
}
