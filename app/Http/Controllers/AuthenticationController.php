<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    public function index()
    {

    }

    public function login()
    {
        return view('admin.login.login');
    }
}
