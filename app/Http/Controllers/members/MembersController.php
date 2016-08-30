<?php

namespace App\Http\Controllers\members;

use App\Models\State;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MembersController extends Controller
{
    public function index()
    {
        return view('site.members.my_card.0');
    }

    public function print_my_card()
    {
        return view('site.members.print_my_card.0');
    }

    public function edit_my_card()
    {
        $states = State::get_combo() ;
        return view('site.members.edit_my_card.0', compact('states'));
    }
}
