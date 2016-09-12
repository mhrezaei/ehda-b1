<?php

namespace App\Http\Controllers\members;

use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function edit_card_process(Requests\MembersEditCardRequest $request)
    {
        $input = $request->toArray();
        $input['id'] = Auth::user()->id;

//        $input['birth_date'] = Carbon::createFromTimestamp($input['birth_date'])->toDateString() . '  00:00:00';
        $input['birth_date'] = date('Y-m-d', $input['birth_date']);
        $input['home_province'] = State::find($input['home_city']);
        $input['home_province'] = $input['home_province']->province()->id;

        if (isset($input['password']) and strlen($input['password']) <= 8)
        {
            $input['password'] = Hash::make($input['password']);
        }
        else
        {
            unset($input['password']);
            unset($input['password2']);
        }

        if (isset($input['chRegisterAll']))
        {
            $input['organs'] = 'Heart Lung Liver Kidney Pancreas Tissues';
            unset($input['chRegisterAll']);
            unset($input['chRegisterHeart']);
            unset($input['chRegisterLung']);
            unset($input['chRegisterLiver']);
            unset($input['chRegisterKidney']);
            unset($input['chRegisterPancreas']);
            unset($input['chRegisterTissues']);
        }
        else
        {
            $input['organs'] = '';
            if (isset($input['chRegisterHeart']))
            {
                $input['organs'] .= 'Heart ';
                unset($input['chRegisterHeart']);
            }
            if (isset($input['chRegisterLung']))
            {
                $input['organs'] .= 'Lung ';
                unset($input['chRegisterLung']);
            }
            if (isset($input['chRegisterLiver']))
            {
                $input['organs'] .= 'Liver ';
                unset($input['chRegisterLiver']);
            }
            if (isset($input['chRegisterKidney']))
            {
                $input['organs'] .= 'Kidney ';
                unset($input['chRegisterKidney']);
            }
            if (isset($input['chRegisterPancreas']))
            {
                $input['organs'] .= 'Pancreas ';
                unset($input['chRegisterPancreas']);
            }
            if (isset($input['chRegisterTissues']))
            {
                $input['organs'] .= 'Tissues ';
                unset($input['chRegisterTissues']);
            }
        }

        print_r($input);
    }
}
