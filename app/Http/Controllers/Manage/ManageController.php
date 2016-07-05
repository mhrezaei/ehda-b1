<?php

namespace App\Http\Controllers\Manage;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class ManageController extends Controller
{
	private $page = array() ;

	public function __construct()
	{
		$this->page[0] = ['index'] ;
	}


	public function index()
	{
		//Preparetions...
		$page = $this->page ;

		return view('manage.index.0',compact('page'));
	}




}
