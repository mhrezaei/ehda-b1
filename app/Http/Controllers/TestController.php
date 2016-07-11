<?php

namespace App\Http\Controllers;

use App\Mhr_state;
use App\Models\Domain;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $default = [
             'ok' => 0 ,
             'message' => trans('validation.invalid') ,
             'redirect' => '' ,
             'callback' => '' ,
             'refresh' => 0 ,
             'modalClose' => 0 ,
             'updater' => '' ,
        ];

        foreach($default as $item => $value) {
            echo "$item => $value <br>" ;
        }


        return ;
        //in...
        $user = Auth::user() ;
        $output = $user ;

//        here...
//        $user->detachDomains(['fars','tehran']) ;
//        $user->attachDomains('all');
        $output = $user->can('*', 'alborzd' ) ;

        //out...
        return view('templates.say')->with(['array' => $output]) ;

        echo Carbon::now();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo 'create' ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo 'store' ;
        return view('templates.say' , ['array' => $request])  ;
    }

    public function show($id)
    {
        $city = State::find(245) ;
        $domain = Domain::find(14) ;

        return view('templates.say' , ['array'=>$domain->states()->count()]);

    }

    public function set_domain_ids()
    {
        $provinces = State::get_provinces();
        $affected = 0 ;

        foreach($provinces as $province) {
            $domain = Domain::where('title',$province->title)->first();

            $cities = $province->cities() ;
            foreach($cities as $city) {
                $city->domain_id = $domain->id ;
                $affected += $city->save() ;
            }
        }
        
        return view('templates.say' , ['array'=>$affected]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "edit: $id" ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        echo 'store '.$id ;
        return view('templates.say' , ['array' => $request])  ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo "destroy: $id" ;
    }
}
