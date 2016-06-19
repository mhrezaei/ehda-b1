<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AuthController extends Controller
{
	//

	public function login(Requests\AuthLoginRequest $request)
	{
		//Fail Safety Loop...
		$loginTries = $request->session()->get('loginTried',0)+1;
		if($loginTries>3) {
			$request->session()->set('loginTried',0);
			$refresh = true ;
		}
		else {
			$request->session()->set('loginTried',$loginTries);
			$refresh = false ;
		}

		//Attempts...
		$logged = Auth::attempt([
				'email' => $request['username'] ,
				'password' => $request['password'],

		] , $request['remember']);

		if(!$logged) {
			return json_encode(['message'=>trans('authentications.login-invalid'),'refresh'=>$refresh]);
		}

		//Killing Safety Loop...
		$request->session()->forget('loginTried');
		return json_encode(['ok'=>$logged , 'message'=>trans('authentications.login-success') , 'refresh'=>1]);

	}
}
