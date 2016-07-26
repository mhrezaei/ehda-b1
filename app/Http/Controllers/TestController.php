<?php

namespace App\Http\Controllers;

use App\Mhr_state;
use App\Models\Domain;
use App\Models\State;
use App\Models\Volunteer;
use App\Temp\Mhr_safiran_data;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\jDate;
use App\Events\SendSms;
use Illuminate\Support\Facades\Event;


class TestController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
//		$this->convertVolunteers() ;
		$return = Event::fire(new SendSms(['123132123'] , 'sdfsdfsdf'));

		return view('templates.say' , ['array'=>$return]);
		
	}

	/*
	|--------------------------------------------------------------------------
	| Table Conversion Methods
	|--------------------------------------------------------------------------
	|
	*/
	

	private function convertVolunteers()
	{
		$safiran = Mhr_safiran_data::all() ;

		foreach($safiran as $safir) {
			$exam = json_decode($safir->examResult,1);

			$volunteer = new Volunteer() ;
			$volunteer->created_at = Carbon::createFromTimestamp($safir->registerTime) ;
			if($safir->password) {
				$volunteer->published_at = Carbon::createFromTimestamp($safir->registerTime) ;
			}
			$volunteer->password = $safir->password ;
			$volunteer->password_force_change = 2 ;
			$volunteer->name_first = $safir->firstName ;
			$volunteer->name_last = $safir->lastName ;
			$volunteer->code_meli = $safir->nationalcode ;
			$volunteer->email = $safir->email ;
			$volunteer->gender = $safir->sex ;
			if($safir->dateOfBirth)
				$volunteer->birth_date = Carbon::createFromTimestamp($safir->dateOfBirth) ;
			$volunteer->marital_status = $safir->maried ;
			$volunteer->edu_city = State::findByName($safir->educationCity);
			$volunteer->edu_field = $safir->education ;
			$volunteer->job = $safir->job ;
			$volunteer->tel_mobile = $safir->mobile ;
			$volunteer->tel_emergency = $safir->emergencyTel ;
			$volunteer->home_address = $safir->homeAddress ;
			$volunteer->home_tel = $safir->homeTel ;
			$volunteer->work_address = $safir->jobAddress ;
			$volunteer->work_tel = $safir->jobTel ;
			$volunteer->exam_passed_at = Carbon::createFromTimestamp($safir->lastExamTime) ;
			$volunteer->exam_sheet = json_encode($exam['examResult'])  ;
			if($exam['total'])
				$volunteer->exam_result = round (100 * $exam['trueAnswer'] / ($exam['total'])) ;
			$volunteer->familization = $safir->introduction ;
			$volunteer->motivation = $safir->motivation ;
			$volunteer->alloc_time = $safir->numberOfMonth ;
			$volunteer->activities = $safir->activity ;

			$volunteer->save();
		}


//		echo view('templates.say' , ['array'=>$old_records]);

	}

}
