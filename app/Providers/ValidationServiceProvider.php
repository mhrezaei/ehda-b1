<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\SecKeyServiceProvider;


class ValidationServiceProvider extends ServiceProvider
{
    private $input   ;
    private $rules  ;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extend('captcha', function ($attribute, $value, $parameters)
        {
            return SecKeyServiceProvider::checkAnswer($value,$parameters[0]);
        });
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

    public static function purifier($input, $rules)
    {
        $ME = new ValidationServiceProvider(app());
        $result = $ME->fire($input,$rules);
        return $result;
    }

    public function fire($input,$rules)
    {
        $this->input    = $input    ;
        $this->rules    = $rules    ;

        foreach($input as $varName => $data ){
            $this->process($varName);
        }

        return $this->input;
    }

    private function process($key)
    {
        //Interlock...
        if(!isset($this->rules[$key])) return ;

        //Process...
        $rules  = explode('|',$this->rules[$key]);
        foreach($rules as $rule) {
            $this->applyFilter($key,$rule);
        }

    }


    private function applyFilter($key, $rule)
    {
        $data   = $this->input[$key] ;
        switch($rule) {
            case "url":
                $data   = urldecode($data);
                break;

            case "pd":
                $data=str_replace("1","۱",$data);
                $data=str_replace("2","۲",$data);
                $data=str_replace("3","۳",$data);
                $data=str_replace("4","۴",$data);
                $data=str_replace("5","۵",$data);
                $data=str_replace("6","۶",$data);
                $data=str_replace("7","۷",$data);
                $data=str_replace("8","۸",$data);
                $data=str_replace("9","۹",$data);
                $data=str_replace("0","۰",$data);

                $data=str_replace("ي","ی",$data);
                $data=str_replace("ك","ک",$data);
                $data=str_replace("ك","ک",$data);
                $data=str_replace("٤","۴",$data);
                $data=str_replace("٦","۶",$data);
                $data=str_replace("٥","۵",$data);
                break;

            case "ed":
                $data=str_replace("۱","1",$data);
                $data=str_replace("۲","2",$data);
                $data=str_replace("۳","3",$data);
                $data=str_replace("۴","4",$data);
                $data=str_replace("۵","5",$data);
                $data=str_replace("۶","6",$data);
                $data=str_replace("۷","7",$data);
                $data=str_replace("۸","8",$data);
                $data=str_replace("۹","9",$data);
                $data=str_replace("۰","0",$data);

                $data=str_replace("٤","4",$data);
                $data=str_replace("٦","6",$data);
                $data=str_replace("٥","5",$data);
                break;

            case "upper":
                $data   = strtoupper($data);
                break;

            case "lower":
                $data   = strtolower($data);
                break;

            case "number":
                $data   = $data+0   ;
                break;

            case "bool":
                if($data)
                    $data = true;
                else
                    $data = false;
                break;
        }

        $this->input[$key] = $data ;
    }
}
