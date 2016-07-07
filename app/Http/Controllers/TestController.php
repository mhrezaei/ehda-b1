<?php

namespace App\Http\Controllers;

use App\Models\Domain;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $states = [
             'آذربایجان شرقی',
             'آذربایجان غربی',
             'اردبیل',
             'ایلام',
             'اصفهان',
             'البرز',
             'بوشهر',
             'تهران',
             'چهار محال و بختیاری',
             'خراسان جنوبی',
             'خراسان رضوی',
             'خراسان شمالی',
             'خوزستان',
             'زنجان',
             'سمنان',
             'سیستان و بلوچستان',
             'فارس',
             'قزوین',
             'قم',
             'کرمانشاه',
             'کرمان',
             'کردستان',
             'کهگیلویه و بویراحمد',
             'گلستان',
             'گیلان',
             'لرستان',
             'مازندران',
             'مرکزی',
             'هرمزگان',
             'همدان',
             'یزد',
        ];

        foreach($states as $idx => $state) {
            $model = new Domain() ;
            $model->title = $state;
            $model->save();
        }
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
