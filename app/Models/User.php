<?php

namespace App\Models;

//use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Providers\AppServiceProvider;
use App\Traits\PermitsTrait;
use App\Traits\TahaMetaTrait;
use App\Traits\TahaModelTrait;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Morilog\Jalali\jDate;
use Illuminate\Support\Facades\Hash;


//@TODO: print process, advanced search, reports

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;
	use PermitsTrait;
	use TahaModelTrait ;
	use TahaMetaTrait ;

	protected $guarded = ['id' , 'deleted_at' , 'roles' , 'domains' , 'unverified_changes' , 'unverified_flag' , 'settings'] ;
	protected static $cards_mandatory_fields = ['code_melli' , 'code_id' , 'name_first' , 'name_last' , 'name_father' , 'birth_date' , 'birth_city' , 'gender' , 'home_province' , 'home_city' , 'organs'  ] ; //@TODO hadi check for data
	protected static $cards_optional_fields = ['email' , 'marital' , 'tel_mobile' , 'home_address' , 'home_tel' , 'home_postal_code' , 'work_address' , 'work_province' , 'work_city' , 'work_tel' , 'work_postal_code' , 'edu_level', 'edu_city' , 'edu_field' , 'job' , 'newsletter' , 'print_status' ] ;
	public static $donatable_organs = ['heart','lung','liver','kidney','pancreas','tissues'] ;
	public static $cards_search_fields = ['name_first' , 'name_last' , 'email' ] ;
	public static $volunteers_search_fields = ['name_first' , 'name_last' , 'code_melli' , 'email'] ;



	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/

	public function printer()
	{
		return $this->hasOne('App\Models\Printer') ;
	}
	public function logins()
	{
		return $this->hasMany('App\Models\Login') ;
	}

	public function activities()
	{
		return $this->hasMany('App\Models\Activity') ;
	}

	public function setting($key)
	{
		//reserved for volunteer settings. It could be a better idea to use Meta instead of this crab!
	}
	/*
	|--------------------------------------------------------------------------
	| Stators
	|--------------------------------------------------------------------------
	|
	*/

	public static function searchRawQuery($keyword, $fields = null)
	{
		if(!$fields)
			$fields = self::$cards_search_fields ;

		$concat_string = " " ;
		foreach($fields as $field) {
			$concat_string .= " , `$field` " ;
		}

		return " LOCATE('$keyword' , CONCAT_WS(' ' $concat_string)) " ;
	}


	public function isCardIncomplete()
	{
		foreach(self::$cards_mandatory_fields as $field) {
			if(!$this->$field or $this->$field == '0')
				return true ;
		}

		return false ;
	}

	public function trashed($type='volunteer')
	{
		switch($type) {
			case 'volunteer' :
				if($this->volunteer_status < 0)
					return true ;
				else
					return false ;

			case 'card':
				if($this->card_status < 0)
					return true ;
				else
					return false ;

			default :
				return false ;

		}


	}


	public function cardStatus($key='text')
	{
		if($this->card_status < 0) {
			$return['text'] = trans('people.cards.status.deleted') ;
			$return['color'] = 'danger';
		}
		elseif($this->isCardIncomplete()) {
			$return['text'] = trans('people.cards.manage.incomplete') ;
			$return['color'] = 'danger';
		}
		else {
			$return['text'] = trans('people.cards.manage.active') ;
			$return['color'] = 'success';
		}

		//Return...
		if($key=='array')
			return $return ;
		else
			return $return[$key] ;

	}
	/**
	 * @param string $key
	 * @return mixed
	 */
	public function volunteerStatus($key = 'text')
	{

		//Discover...
		if($this->volunteer_status < 0) {
			$return['text'] = trans('people.volunteers.status.blocked') ;
			$return['color'] = 'danger';
		}
		elseif($this->volunteer_status == 1) {
			$return['text'] = trans('people.volunteers.status.examining') ;
			$return['color'] = 'info' ;
		}
		elseif($this->volunteer_status == 2) {
			$return['text'] = trans('people.volunteers.status.documentation') ;
			$return['color'] = 'info' ;
		}
		elseif($this->volunteer_status == 3) {
			$return['text'] = trans('people.volunteers.status.pending') ;
			$return['color'] = 'warning' ;
		}
		elseif($this->volunteer_status>=8) {
			if($this->unverified_flag > 0) {
				$return['text'] = trans('people.volunteers.status.care') ;
				$return['color'] = 'warning' ;
			} else {
				$return['text'] = trans('people.volunteers.status.active') ;
				$return['color'] = 'success' ;
			}
		}
		else
			$return = null ;

		//Return...
		if($key=='array')
			return $return ;
		else
			return $return[$key] ;
	}


	/**
	 * @return bool
	 */
	public function isDeveloper()
	{
		return in_array($this->code_melli , ['0074715623' , '0012071110' ]) ;
	}

	public function isActiveVolunteer()
	{
		if($this->volunteer_status >= 8)
			return true ;
		else
			return false ;
	}

	/**
	 * @return bool
	 */
	public function isVolunteer()
	{
		if($this->volunteer_status != 0)
			return true ;
		else
			return false ;
	}

	/**
	 * @return bool
	 */
	public function isCard()
	{
		if($this->card_status != 0)
			return true ;
		else
			return false ;
	}

	/**
	 * @param string $type
	 * @return bool
	 */
	public function isActive($type='volunteer')
	{
		$field = $type."_status" ;
		if($this->$field >= 8)
			return true ;
		else
			return false ;
	}

	public function title()
	{
		if($this->gender==1)
			$title = trans('people.mr');
		else
			$title = trans('people.mrs');

		if($this->edu_level >= 6)
			$title .= ' '.trans('people.dr');

		return $title ;
	}

	public function fullName($with_title = false)
	{
		if(!$this) return false ;
		$return = $this->name_first . " " . $this->name_last ;
		if($with_title)
			$return = $this->title() . " " . $return ;

		return $return ;
	}


	public function occupation()
	{
		$return = null ;

		if($this->job)
			$return .= $this->job. " / " ;

		$return .= $this->say('edu_level'); // trans('people.edu_level.'.$this->edu_level) ;

		if($this->edu_field)
			$return .= " / ".$this->edu_field ;

		return $return ;
	}


	public function say($property, $default='-')
	{
		switch($property) {
			case 'created_at' :
			case 'updated_at' :
			case 'published_at' :
			case 'deleted_at' :
			case 'exam_passed_at' :
			case 'card_registered_at' :
			case 'volunteer_registered_at' :
				if($this->$property) {
					return AppServiceProvider::pd(jDate::forge($this->$property)->format('j F Y [H:m]'));
				}
				else
					return $default ;

			case 'created_by' :
			case 'updated_by' :
			case 'published_by' :
			case 'deleted_by' :
				$model = self::find($this->$property);
				if($model)
					return $model->fullName() ;
				else
					return trans('forms.general.deleted');

			case 'code_meli' :
				return $this->say('code_melli' , $default) ;

			case 'encrypted_code_melli' :
				return Crypt::encrypt($this->code_melli) ;

			case 'code_melli' :
			case 'card_no' :
			case 'code_id' :
			case 'tel_mobile' :
			case 'tel_emergency' :
			case 'home_address' :
			case 'home_tel' :
			case 'home_postal_code' :
			case 'work_address' :
			case 'work_tel' :
			case 'work_postal_code' :
			case 'edu_field' :
			case 'job' :
			case 'exam_result' :
			case 'motivation' :
			case 'alloc_time' :
				return AppServiceProvider::pd($this->$property);

			case 'organs' :
				return $this->organs; //TODO: Do something here.

			case 'name' :
				return $this->name_first . " " . $this->name_last ;

			case 'fullName' :
				return $this->title().' '. $this->name_first . " " . $this->name_last ;

			case 'birth_date' :
				if(!$this->$property and $this->$property!='0000-00-00')
					return AppServiceProvider::pd(jDate::forge($this->$property)->format('j F Y'));
				else
					return $default ;

			case 'birth_date_on_card' :
				return AppServiceProvider::pd(jDate::forge($this->birth_date)->format('Y/m/d'));

			case 'register_date_on_card' :
				return AppServiceProvider::pd(jDate::forge($this->card_registered_at)->format('Y/m/d'));

			case 'gender' :
			case 'marital':
			case 'edu_level' :
			case 'familization' :
				if(!$this->$property)
					return '-' ;
				else
					return trans("people.$property.".$this->$property) ;

			case 'education' :
				return trans("people.education.".$this->edu_level+0);

			case 'birth_city' :
			case 'edu_city' :
			case 'home_city' :
			case 'work_city' :
			case 'home_province' :
			case 'work_province' :
				$state = State::find($this->$property);
				if($state)
					return $state->fullName();
				else
					return $default;

			case 'from_domain' :
				$domain = Domain::selectBySlug($this->$property) ;
				if($domain)
					return $domain->title;
				else
					return $default;
			case 'activities' :
				$act = '';
				if ($this->activities)
				{
					$activities = explode(',', $this->activities);
					for ($i = 0; $i < count($activities); $i++)
					{
						if (strlen($activities[$i]))
						{
							$a = Activity::findBySlug($activities[$i]);
							if ($a)
							{
								$act[] = $a->title;
							}
						}
					}
				}
				else
					return [] ;
			return $act;

			default:
				return $this->$property ;
		}

	}

	/*
	|--------------------------------------------------------------------------
	| Password Activities
	|--------------------------------------------------------------------------
	|
	*/
	/**
	 * @return mixed
	 */
	public function makeForgotPasswordToken()
	{
		$token['reset_token'] = rand(100000, 999999);
		$token['expire_token'] = Carbon::now()->addMinutes(5);

		$this->reset_token = json_encode($token);
		$this->save();

		return $token['reset_token'];
	}

	/**
	 * @param $password
	 * @return bool
	 */
	public function oldPasswordChange($password)
	{
		$this->password = Hash::make($password);
		$this->password_force_change = 0;
		return $this->save();
	}

	/**
	 * @param int $password_force_change
	 * @return bool
	 */
	public function updateUserForResetPassword($password_force_change = 1)
	{
		$this->reset_token = null;
		$this->password_force_change = $password_force_change;
		return $this->save();
	}

	/*
	|--------------------------------------------------------------------------
	| Selectors
	|--------------------------------------------------------------------------
	|
	*/

	public static function counter($type, $criteria , $domain='auto')
	{
		return self::selector($type,$criteria,$domain)->count();
	}
	public static function selector($type , $criteria , $domain='auto')
	{

		//Process Domain...
		if($domain=='auto')
			$domain =  Auth::user()->getDomain() ;

		if($domain=='global')
			$table = self::where('id' , '>' , 0) ;
		else
			$table = self::where('domain' , $domain) ;

		//Process Search...
		if(str_contains($criteria , 'search')) {
			$keyword = str_replace('search:' , null , $criteria) ;
			$criteria = 'search' ;
		}

		//Process Criteria...
		if($type=='volunteer' or $type=='volunteers') {
			if(!Auth::user()->isDeveloper())
				$table = $table->where('code_melli' , '<>' , '0074715623' );

			switch($criteria) {
				case 'examining':
					return $table->where('volunteer_status' , '=' , '1') ;
				case 'documentation' :
					return $table->where('volunteer_status' , '=' , '2') ;
				case 'pending' :
					return $table->where('volunteer_status' , '=' , '3') ;
				case 'active':
					return $table->where('volunteer_status' , '>=' , '8') ;
				case 'care' :
					return $table->where('volunteer_status' , '>' , '0')->where('unverified_flag' , '1');
				case 'bin' :
					return $table->where('volunteer_status' , '<' , '0');
				case 'search' :
					return $table->where('volunteer_status' , '!=' , '0')->whereRaw(self::searchRawQuery($keyword,self::$volunteers_search_fields)) ;
			}
		}
		elseif($type=='card' or $type=='cards') {
			switch($criteria) {
				case 'active':
				case 'all' :
					return $table->where('card_status' , '>=' , '8') ;
				case 'bin' :
					return $table->where('card_status' , '<' , '0');
				case 'complete' :
					return $table->where('card_status' , '>=' , '8')->whereRaw( " NOT ".self::incompleteRawQuery()) ; //@TODO
				case 'incomplete' :
					return $table->where('card_status' , '>=' , '8')->whereRaw(self::incompleteRawQuery()) ; //@TODO
				case 'print_request' :
					return $table->where('card_status' , '>=' , '8')->where('card_print_status' , 1);
				case 'print_control' :
					return $table->where('card_status' , '>=' , '8')->where('card_print_status' , 3);
				case 'under_print' :
					return $table->where('card_status' , '>=' , '8')->whereBetween('card_print_status' , [1,8]);
				case 'newsletter_member' :
					return $table->where('card_status' , '>=' , '8')->where('newsletter' , 1)->whereNotNull('email');
				case 'search' :
					return $table->where('card_status' , '!=' , '0')->whereRaw(self::searchRawQuery($keyword,self::$cards_search_fields)) ;
			}
		}

		return $table->whereNull('id');

	}

	private static function incompleteRawQuery()
	{
		$query = " false " ;
		foreach(self::$cards_mandatory_fields as $field) {
			$query .= " or `$field` = null or `$field` = '0' " ;
		}

		return " ( $query ) " ;
	}

	public static function virtualPrintTable()
	{
		return [
				['n', trans('people.card_print_status.0')],
				[1, trans('people.card_print_status.1')],
				[2, trans('people.card_print_status.2')],
				[3, trans('people.card_print_status.3')],
				[4, trans('people.card_print_status.4')],
				[9, trans('people.card_print_status.9')],
		];
	}

	/**
	 * Determines if the logged user can modify the premissions of this user
	 */
	public function canBePermitted()
	{
		$logged_user = Auth::user() ;

		if(!$this->isActive())
			return false ;

		if($this->isDeveloper())
			return false ;

		if($logged_user->id == $this->id)
			return false ;

		if($this->can('manage') and !$logged_user->isAdmin())
			return false ;

		return $logged_user->can('volunteers.permit',$this->domain);
	}

	/*
	|--------------------------------------------------------------------------
	| Actions
	|--------------------------------------------------------------------------
	|
	*/

	public static function findVolunteer($code_melli , $min_status=-9 , $max_status=9)
	{
		return self::where('code_melli' , $code_melli)->whereBetween('volunteer_status' , [$min_status , $max_status])->where('volunteer_status' , '<>' , 0)->first() ;
	}


	public static function findCard($code_melli , $min_status=-9 , $max_status=9)
	{
		return self::where('code_melli' , $code_melli)->whereBetween('card_status' , [$min_status , $max_status])->where('card_status' , '<>' , 0)->first() ;
	}


	public static function generateCardNo()
	{
		$record = self::orderBy('card_no', 'desc')->first() ;
		if(!$record)
			return 1500 ;
		else
			return $record->card_no + 1 ;
	}

	public function cardDelete()
	{
		if($this->isVolunteer()) {
			$this->card_status = 0 ;
			$this->card_registered_at = null ;
			//			$this->card_no = null ;
			$this->organs = null ;
			return $this->save() ;
		}
		else {
			return parent::delete() ;
		}
	}

	public function volunteerDelete()
	{
		$this->volunteer_status = -$this->volunteer_status ;
		if(Auth::check()) {
			$this->deleted_at = Carbon::now()->toDateTimeString() ;
			$this->deleted_by = Auth::user()->id ;
		}
		return $this->save() ;
	}

	public function volunteerUndelete()
	{
		$this->volunteer_status = -$this->volunteer_status ;
		$this->deleted_at = null ;
		$this->deleted_by = null ;
		return $this->save() ;

	}

	public function volunteerHardDelete()
	{
		if($this->card_status) {
			$this->volunteer_status = 0 ;
			$this->volunteer_registered_at = null ;
			$this->roles = null ;
			//			$this->domains = null ;
			return $this->save() ;
		}
		else {
			return parent::delete() ;
		}
	}

}

