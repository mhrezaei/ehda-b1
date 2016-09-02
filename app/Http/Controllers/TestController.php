<?php

namespace App\Http\Controllers;

use App\Mhr_state;
use App\Models\Domain;
use App\Models\State;
use App\Models\User;
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
//		$this->convertVolunteers2Users() ;
		return view('templates.say' , ['array'=>date('Y/m/d H:i:s' , 9993775497)]);
		
	}

	/*
	|--------------------------------------------------------------------------
	| Table Conversion Methods
	|--------------------------------------------------------------------------
	|
	*/

	private function convertVolunteers2Users()
	{
		$volunteers = Volunteer::withTrashed()->get() ;

		foreach($volunteers as $volunteer) {

			$user = new User() ;

			if(!$volunteer->exam_passed_at)
				$status = 1 ;
			elseif(!$volunteer->birth_date)
				$status = 2 ;
			elseif(!$volunteer->password)
				$status = 3 ;
			else
				$status = 8 ;

			if($volunteer->trashed())
				$status = 0 - $status ;

			$user->created_at = $volunteer->created_at ;
			$user->updated_at = $volunteer->updated_at ;
			$user->deleted_at = $volunteer->deleted_at ;
			$user->published_at = $volunteer->published_at ;
			$user->created_by = $volunteer->created_by ;
			$user->updated_by = $volunteer->updated_by ;
			$user->deleted_by = $volunteer->deleted_by ;
			$user->published_by = $volunteer->published_by ;
			$user->volunteer_status = $status ;
			$user->volunteer_registered_at = $volunteer->created_at ;
			$user->email = $volunteer->email ;
			$user->password = $volunteer->password ;
			$user->code_melli = $volunteer->code_meli ;
			$user->name_first = $volunteer->name_first ;
			$user->name_last = $volunteer->name_last ;
			$user->name_father = $volunteer->name_father ;
			$user->birth_date = $volunteer->birth_date ;
			$user->birth_city = $volunteer->birth_city ;
			$user->gender = $volunteer->gender ;
			$user->marital = $volunteer->marital_status ;
			$user->tel_mobile = $volunteer->tel_mobile ;
			$user->tel_emergency = $volunteer->tel_emergency ;
			$user->home_address = $volunteer->home_address ;
			$user->home_province = $volunteer->home_province ;
			$user->work_city = $volunteer->work_city ;
			$user->work_tel = $volunteer->work_tel ;
			$user->work_address = $volunteer->work_address ;
			$user->work_province = $volunteer->work_province ;
			$user->work_city = $volunteer->work_city ;
			$user->work_tel = $volunteer->work_tel ;
			$user->edu_level = $volunteer->edu_level ;
			$user->edu_city = $volunteer->edu_city ;
			$user->edu_field = $volunteer->edu_field ;
			$user->job = $volunteer->job ;
			$user->password_force_change = $volunteer->password_force_change ;
			$user->exam_passed_at = $volunteer->exam_passed_at ;
			$user->exam_result = $volunteer->exam_result ;
			$user->familization = $volunteer->familization ;
			$user->motivation = $volunteer->motivation ;
			$user->alloc_time = $volunteer->alloc_time ;
			$user->activities = $volunteer->activities ;
			$user->domains = $volunteer->domains ;
			$user->roles = $volunteer->roles ;

			$user->save() ;
//			echo $user->id." - ".$user->fullName();
		}
	}

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
