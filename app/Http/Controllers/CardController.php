<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public function index()
    {
        return view('site.card_info.0');
    }

    public function register()
    {
        return view('site.card_register.0');
    }
}
