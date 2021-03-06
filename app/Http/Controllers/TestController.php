<?php

namespace App\Http\Controllers;

use App\Mhr_state;
use App\Models\Domain;
use App\Models\Post;
use App\Models\Setting;
use App\Models\State;
use App\Models\User;
use App\Models\Volunteer;
use App\Providers\SettingServiceProvider;
use App\Temp\Mhr_exam_questions;
use App\Temp\Mhr_safiran_data;
use App\Temp\Mhr_user;
use App\Temp\Mhr_users_old;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
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
	public function index(Request $request)
	{
		dd(decrypt(Auth::user()->roles));
	}

	/*
	|--------------------------------------------------------------------------
	| Table Conversion Methods
	|--------------------------------------------------------------------------
	|
	*/

	private function upgradeDomains()
	{
		$users = User::whereNull('domain')->whereNotNull('home_city') ;
		return view('templates.say' , ['array'=>$users->count()]);

		$total = 0 ;

		foreach($users->get() as $user) {
			$state = State::find($user->home_city);
			echo $user->id."<br />";

			if(!$state)
				continue;

			$user->domain = $state->domain->slug ;
			$ok = $user->update() ;
			if($ok)
				$total++;

		}

		?>
<!--			<script>location.reload();</script>-->
		<?php
		return view('templates.say' , ['array'=>$total]);

	}

	private function convertExams()
	{
		$questions = Mhr_exam_questions::all() ;

		foreach($questions as $question) {
			$post = new Post() ;

			$post->title = '-' ;
			$post->text = $question->question ;
			$post->domains = 'free' ;
			$post->created_by = 1 ;
			$post->published_at = Carbon::now()->toDateTimeString() ;
			$post->published_by = 1 ;
			$post->branch = 'tests' ;
			$post->save() ;

			switch($question->answerTrue) {
				case 1 :
					$option_true = $question->answerA ;
					$option_wrong_1 = $question->answerB ;
					$option_wrong_2 = $question->answerC ;
					$option_wrong_3 = $question->answerD ;
					break;
				case 2 :
					$option_true = $question->answerB ;
					$option_wrong_1 = $question->answerA ;
					$option_wrong_2 = $question->answerC ;
					$option_wrong_3 = $question->answerD ;
					break;
				case 3 :
					$option_true = $question->answerC ;
					$option_wrong_1 = $question->answerB ;
					$option_wrong_2 = $question->answerA ;
					$option_wrong_3 = $question->answerD ;
					break;
				case 4 :
					$option_true = $question->answerD ;
					$option_wrong_1 = $question->answerB ;
					$option_wrong_2 = $question->answerC ;
					$option_wrong_3 = $question->answerA ;
					break;
				default:
					continue ;

			}

			$post->meta('option_true' , $option_true) ;
			$post->meta('option_wrong_1' , $option_wrong_1) ;
			$post->meta('option_wrong_2' , $option_wrong_2) ;
			$post->meta('option_wrong_3' , $option_wrong_3) ;
			$post->meta('additional_info' , $question->faq) ;

			echo view('templates.say' , ['array'=>$post]);

		}
	}

	public function makeDomainsFromHomeCities()
	{
		$users = User::where('card_status' , '!=' , '0')->orderBy('domain' , 'desc')->whereNull('domain')->limit(1000)->get() ;
		$count = 0 ;

		foreach($users as $user) {
			$city = State::find($user->home_city) ;
			if($city) {
				$user->domain = $city->domain->slug ;
				$ok = $user->update() ;
			}
			else {
				$ok = 0 ;
			}
			$count += $ok ;
		}

		if($count)
			echo '<script>document.addEventListener("DOMContentLoaded", function(event) { setTimeout("location.reload(true);", 1000); });</script>';

		dd($count) ;
	}

	private function help_me($input)
	{
		$input=str_replace("۱","1",$input);
		$input=str_replace("۲","2",$input);
		$input=str_replace("۳","3",$input);
		$input=str_replace("۴","4",$input);
		$input=str_replace("۵","5",$input);
		$input=str_replace("۶","6",$input);
		$input=str_replace("۷","7",$input);
		$input=str_replace("۸","8",$input);
		$input=str_replace("۹","9",$input);
		$input=str_replace("۰","0",$input);
		$input=str_replace("٤","4",$input);
		$input=str_replace("٦","6",$input);
		$input=str_replace("٥","5",$input);

		$input=str_replace("ي","ی",$input);
		$input=str_replace("ك","ک",$input);
		$input=str_replace("ك","ک",$input);
		$input = str_replace("¬","‏",$input) ;
		$input = trim($input);

		return $input;
	}

	protected function convertCardsFromMhr()
	{
//		$cards = Mhr_users_old::whereBetween('id' , ['15000' , '17000'])->whereNull('res1')->get() ;
		$cards = Mhr_user::where('convert_data', 1)->limit(200)->get();

		$numer = 0;
		foreach($cards as $card) {
			$user = new User() ;

			//Put away existance Code_mellis
			$v = User::findBySlug($card->nationalcode , 'code_melli') ;
			if($v)
				continue ;

			$birth_city = State::findByName($card->mhr_users_data->placeOfBirth) ;
			if($birth_city)
				$birth_city = $birth_city->id ;
			else
				$birth_city = 0  ;

			//Copying...
			$user->created_at = Carbon::createFromTimestamp($card->mhr_users_data->registerTime)->toDateTimeString() ;
			$user->updated_at = $user->created_at ;
			$user->deleted_at = null ;
			$user->published_at = null ;
			$user->created_by = 0 ;
			$user->updated_by = 0 ;
			$user->deleted_by = 0 ;
			$user->published_by = 0 ;
			$user->card_status = 8 ;
			$user->card_registered_at = $user->created_at ;
			$user->email = $this->help_me($card->email) ;
			$user->password = $card->password ;
			$user->code_melli = $this->help_me($card->nationalcode) ;
			$user->code_id = $this->help_me($card->mhr_users_data->identifier) ;
			$user->name_first = $this->help_me($card->mhr_users_data->firstName) ;
			$user->name_last = $this->help_me($card->mhr_users_data->lastName) ;
			$user->name_father = $this->help_me($card->mhr_users_data->fatherName) ;
			$user->birth_date = Carbon::createFromTimestamp($card->mhr_users_data->dateOfBirth)->toDateString() ;
			$user->birth_city = $birth_city;
			$user->gender = $card->mhr_users_data->sex ;
			$user->marital = 0 ;
			$user->tel_mobile = $this->help_me($card->mhr_users_data->mobile) ;
			$user->tel_emergency = null ;
			$user->home_address = $this->help_me($card->mhr_users_data->address) ;
			$user->home_province = $card->mhr_users_data->state ;
			$user->home_city = $card->mhr_users_data->city ;
			$user->home_tel = $this->help_me($card->mhr_users_data->phone) ;
			$user->home_postal_code = $this->help_me($card->mhr_users_data->postalCode) ;
			$user->work_province = null ;
			$user->work_city = null ;
			$user->work_tel = null ;
			$user->work_address = null ;
			$user->edu_level = $card->mhr_users_data->education ;
			$user->edu_city = null ;
			$user->edu_field = null ;
			$user->job = $card->mhr_users_data->job ;
			$user->password_force_change = 2 ;
			$user->card_no = $card->memberID;
			$user->from_domain = 'global';

			if ($card->mhr_users_data->organs == 'All')
			{
				$user->organs = 'Heart Lung Liver Kidney Pancreas Tissues';
			}
			else
			{
				$user->organs = str_replace(',', ' ', $card->mhr_users_data->organs);
			}

			$user->newsletter = 1 ;

			$ok = $user->save() ;
			if($ok)
			{
				$card->convert_data = 0 ;
				$card->update();
				$numer++;
			}
		}
		echo Carbon::now()->toDateTimeString() . ' --- ' . 'number of row inserted: ' . $numer;
		echo '<script>document.addEventListener("DOMContentLoaded", function(event) { setTimeout("location.reload(true);", 30000); });</script>';
	}

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

	public function convertVolunteers()
	{
		$safirs = Mhr_safiran_data::where('roles' , '!=' , 'converted')->limit(100)->get();

		$count = 0 ;
		foreach($safirs as $safir) {
			$user = [] ;
			if($safir->examResult) {
				$exam = json_decode($safir->examResult,1);
			}
			else {
				$exam['status'] = '' ;
				$exam['trueAnswer'] = 0 ;
				$exam['total'] = 1 ;
			}

			if($exam['status'] != 'success')
				$status = 1 ;
			elseif(!$safir->dateOfBirth)
				$status = 2 ;
			elseif(!$safir->password)
				$status = 3 ;
			else
				$status = 8 ;

			$user['volunteer_status'] = $status ;
			$user['volunteer_registered_at'] = Carbon::createFromTimestamp($safir->registerTime)->toDateTimeString() ;
			$user['email'] = $safir->email ;
			$user['password'] = $safir->password ;
			$user['code_melli'] = $safir->nationalcode ;
			$user['name_first'] = $safir->firstName ;
			$user['name_last'] = $safir->lastName ;
			$user['birth_date'] = Carbon::createFromTimestamp($safir->dateOfBirth)->toDateString();
			$user['gender'] = $safir->sex  ;
			$user['marital'] = $safir->maried ;
			$user['tel_mobile'] = $safir->mobile ;
			$user['tel_emergency'] = $safir->emergencyTel ;
			$user['home_address'] = $safir->homeAddress ;
			$user['home_tel'] = $safir->homeTel ;
			$user['work_address'] = $safir->jobAddress ;
			$user['work_tel'] = $safir->jobTel ;
			$user['edu_level'] = $safir->edu_level ;
			$user['edu_field'] = $safir->education ;
			$user['job'] = $safir->job ;
			$user['password_force_change'] = 2 ;
			$user['exam_passed_at'] = Carbon::createFromTimestamp($safir->lastExamTime)->toDateTimeString() ;
			$user['exam_result'] = $exam['total']? round (100 * $exam['trueAnswer'] / ($exam['total'])) : ''  ;
			$user['familization'] = $safir->introduction ;
			$user['motivation'] = $safir->motivation ;
			$user['alloc_time'] = $safir->numberOfMonth.' '.$safir->activityDetail ;
			$user['activities'] = $safir->activity ;

			$model = User::findBySlug($user['code_melli'] , 'code_melli') ;
			if($model) {
				$user['id'] = $model->id ;
				if($model->password) {
					unset($user['password'])  ;
					unset($user['password_force_change']);
				}
				$user['edu_level'] = max($user['edu_level'] , $model->edu_level ) ;
			}
			else {
				$user['id'] = 0 ;
			}

			$ok = User::store($user) ;
			if($ok) {
				$count++ ;
				$safir->roles = 'converted' ;
				$safir->update() ;
			}

		}

		if($count)
			echo '<script>document.addEventListener("DOMContentLoaded", function(event) { setTimeout("location.reload(true);", 1000); });</script>';

		dd($count) ;

	}

	public function removeDuplicates()
	{
		$array = DB::select('SELECT code_melli, id , COUNT( * ) c FROM users GROUP BY code_melli HAVING c >1 limit 50');

		$count = 0 ;
		foreach($array as $item) {
			$code_melli = $item->code_melli ;
			$id = $item->id ;
			$deleted = DB::delete("delete from `users` where `code_melli` = '$code_melli' and `id` != '$id' ");
			$count += $deleted ;
			echo $deleted.'<br>';
		}

		echo view('templates.say' , ['array'=>$count]);
		if($count)
			echo '<script>document.addEventListener("DOMContentLoaded", function(event) { setTimeout("location.reload(true);", 1000); });</script>';

	}

	public function hadi($status = 'all', $act = 'all')
	{
        $export['status'] = $status;
        $export['act'] = $act;
        Session::put('export', $export);

	    Excel::create('خروجی اطلاعات', function($excel) {

            $excel->sheet('New sheet', function($sheet) {

                $sheet->loadView('hadi.test');

            });

        })->download('xlsx');
	}

    public function hadi_ajax()
    {
        return view('hadi.ajax');
	}

    public function hadi_ajax_response(Request $request)
    {
        $input = $request->toArray();
        $data = array();

        if ($input['pid'] == 123)
        {
            $data['time'] = Carbon::now()->toDateTimeString();
        }
        else
        {
            $data['time'] = '0000/0/0 00:00';
        }

        return json_encode($data);
	}

	public function password_set_for_unverified_volunteers()
	{
		 $users = User::select('id','tel_mobile' , 'password' , 'password_force_change')->whereNull('password')->whereNotNull('tel_mobile')->limit(100)->get();
		 $count = 0 ;
		 $last_user = new User() ;

		 foreach($users as $user) {
		 	$user->password = Hash::make($user->tel_mobile) ;
		 	$user->password_force_change = 1 ;
		 	$count += boolval($user->save()) ;
		 	$last_user = $user ;
		 }

		 echo $count . ' updated; last one: '.$last_user->id ;
		 if($count>0) {
		    echo "<script>location.reload()</script>" ;
	    }
		 return ;
	}
}
