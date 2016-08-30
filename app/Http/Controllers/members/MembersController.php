<?php

namespace App\Http\Controllers\members;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MembersController extends Controller
{
    public function index()
    {
        return view('site.members.my_card.0');
    }
}
