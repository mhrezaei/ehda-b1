<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    private $username = 'm.rezaei@4472';
    private $password = 'xTi!95jdHYt7@@';
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

    function SendREST($username,$password, $Source, $Destination, $MsgBody, $Encoding)
    {

        $URL = "http://panel.asanak.ir/webservice/v1rest/sendsms";
        $msg = urlencode(trim($MsgBody));
        $url = $URL.'?username='.$username.'&password='.$password.'&source='.$Source.'&destination='.$Destination.'&message='. $msg;
        $headers[] = 'Accept: text/html';
        $headers[] = 'Connection: Keep-Alive';
        $headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($process, CURLOPT_HEADER, 0);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        try
        {
            if(($return = curl_exec($process)))
            {
                return $return;
            }
        } catch (Exception $ex)
        {
            return $ex->errorMessage();
        }
    }
}
