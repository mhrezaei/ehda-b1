<?php

namespace App\Http\Controllers\Manage;

use App\Events\SendEmail;
use App\Events\SendSms;
use App\Events\UserAccountPublished;
use App\Events\UserPasswordManualReset;
use App\Http\Requests\Manage\CardSearchRequest;
use App\Models\Domain;
use App\Models\Post;
use App\Models\Printer;
use App\Models\Printing;
use App\Models\State;
use App\Models\User;
use App\Providers\AppServiceProvider;
use App\Providers\SmsServiceProvider;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;


class CardsController extends Controller
{
	use TahaControllerTrait;

	public function __construct()
	{
		$this->middleware('Can:cards');

		$this->page[0] = ['cards' , trans('manage.modules.cards')];
	}

	public function search(CardSearchRequest $request)
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["search" , trans("people.cards.manage.search") , "search"] ;
		$db = User::first() ;

		//IF SEARCHED...
		$keyword = $request->keyword ;
		if(isset($request->searched)) {
			$model_data = User::where('card_status' , '!=' , '0') ;

			if(is_numeric($request->keyword) and strlen($request->keyword)==10) {
				$model_data = $model_data->where('code_melli' , $request->keyword)->paginate(50) ;
			}
			elseif(is_numeric($request->keyword)) {
				$model_data = $model_data->where('card_no' , $request->keyword)->paginate(50) ;
			}
			else {
//				$model_data = $model_data->whereRaw(User::searchRawQuery($keyword,User::$cards_search_fields))->orderBy('card_registered_at' , 'desc')->paginate(50);
				$model_data = User::selector('cards' , "search:$keyword")->orderBy('card_registered_at' , 'desc')->paginate(50);
			}

			return view('manage.cards.browse' , compact('page' , 'model_data' , 'db' , 'keyword'));
		}

		//IF JUST FORM...
		return view("manage.cards.search" , compact('page' , 'db'));

	}

	public function stats()
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["stats/" , trans("people.cards.manage.stats") , 'stats' ] ;

		//Model...
//		$model_data = $model_data->orderBy('created_at' , 'desc')->paginate(50);
		$data = [] ;
		$db = new User();

		$now = Carbon::now() ;

		for($i=0 ; $i<=60 ; $i++) {
			$today = Carbon::today()->subDays($i) ;
			$yesterday = Carbon::today()->subDays($i-1) ;
			$count = User::where('card_registered_at' , '>' , $today )->where('card_registered_at' , '<' , $yesterday )->count();
			$bot_count = User::where('card_registered_at' , '>' , $today )
                ->where('card_registered_at' , '<' , $yesterday )
                ->where('created_by', '303958')
                ->count();
            $event_count = User::where('card_registered_at' , '>' , $today )
                ->where('card_registered_at' , '<' , $yesterday )
                ->where('event_id', '>', '0')
                ->count();
			array_push($data , [$today , $count, $bot_count, $event_count]) ;
		}


		//View...
		return view("manage.cards.stats" , compact('page', 'db' , 'volunteer' , 'volunteer_id' , 'data'));

	}


	public function browse($request_tab = 'active' , $volunteer_id = 0)
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["browse/$request_tab/$volunteer_id" , trans("people.cards.manage.$request_tab") , $request_tab] ;

		//Permission...
		switch($request_tab) {
			case 'all' :
			case 'active' :
				$permission = 'cards.browse' ;
				break;

			case 'incomplete' :
				$permission = 'cards.edit' ;
				break ;

			case 'under_print' :
			case 'print_request' :
			case 'print_control' :
				$permission = 'cards.print' ;
				break;

			case 'newsletter_member' :
				$permission = 'cards.send' ;
				break;

			case 'bin':
				$permission = 'cards.bin' ;
				break;
			default :
				$permission = 'somethingImpossible' ;
		}
		if(!Auth::user()->can($permission))
			return view('errors.403');


		//Model...
		$model_data = User::selector('card',$request_tab) ;

		if($volunteer_id>0) {
			$model_data = $model_data->where('created_by' , $volunteer_id) ;
			$volunteer = User::find($volunteer_id);
			if(!$volunteer or !$volunteer->isVolunteer())
				return view('errors.410');

		}

		$model_data = $model_data->orderBy('created_at' , 'desc')->paginate(50);
		$db = User::first() ;

		//View...
		return view("manage.cards.browse" , compact('page','model_data' , 'db' , 'volunteer' , 'volunteer_id'));

	}

	public function modalActions($card_id , $view_file)
	{

		//@TODO: Do something for checking the permission, despite the fact that everything will be checked at the save method.
		//@TODO: Reject if accessed without valid AJAX request
		if($card_id==0)
			return $this->modalBulkAction($view_file);

		$model = User::find($card_id) ;
		$view = "manage.cards.$view_file" ;
		$opt = [] ;

		//Particular Actions...
		switch($view_file) {
			case 'print' :
				$opt['print'] = User::virtualPrintTable() ;
				$all_events = Post::selector('event' , 'auto')->orderBy('published_at' , 'desc')->get() ;
				$events = [] ;
				foreach($all_events as $event) {
					if($event->meta('can_register_card')) {
						array_push($events , $event);
					}
				}
				$model->event_id = Session::get('user_favourite_event',0);
				break;
		}

		if(!$model) return view('errors.m410');
		if(!View::exists($view)) return view('errors.m404');

		return view($view , compact('model' , 'opt' , 'events')) ;
	}

	private function modalBulkAction($view_file)
	{
		$view = "manage.cards.$view_file-bulk" ;

		if(!View::exists($view)) return view('templates.say' , ['array'=>$view]); //@TODO: REMOVE THIS LINE
		if(!View::exists($view)) return view('errors.m404');

		if($view_file == 'print') {
			$all_events = Post::selector('event', 'auto')->orderBy('published_at', 'desc')->get();
			$events = [];
			foreach($all_events as $event) {
				if($event->meta('can_register_card')) {
					array_push($events, $event);
				}
			}
			$preferred_event_id = Session::get('user_favourite_event', 0);
		}


		return view($view , compact('events' , 'preferred_event_id')) ;
	}

	private function editorForVolunteers($id , $page)
	{
		$model = User::find($id);
		if(!$model->isVolunteer())
			return view('errors.410');

		if(!$model->isCard()) {
			foreach(User::$donatable_organs as $donatable_organ) {
				$model->organs .= ' ' . trans("people.organs.$donatable_organ");
			}
		}

		return view('manage.cards.editor-volunteer' , compact('model','page'));

	}

	public function create($volunteer_id = 0)
	{
		//Permission...
		if(!Auth::user()->can('cards.create'))
			return view('errors.403');

		//Preparetions...
		$page = $this->page ;
		$page[1] = ["cards/create" , trans('people.cards.manage.create') , ''];

		//If for Volunteer...
		if($volunteer_id)
			return $this->editorForVolunteers($volunteer_id , $page) ;

		//Model...
		$model = new User() ;
		$states = State::get_combo() ;

		foreach(User::$donatable_organs as $donatable_organ) {
			$model->organs .= ' '.trans("people.organs.$donatable_organ");
		}
		$model->newsletter = 1 ;


		$all_events = Post::selector('event' , 'auto')->orderBy('published_at' , 'desc')->get() ;
		$events = [] ;
		foreach($all_events as $event) {
			if($event->meta('can_register_card')) {
				array_push($events , $event);
			}
		}
		$model->event_id = Session::get('user_favourite_event',0);

		//View..
		return view('manage.cards.editor' , compact('page','model','states','events'));

	}

	public function editor($model_id=0)
	{

		//Permission...
		if(!Auth::user()->can('cards.edit'))
			return view('errors.410');

		//Preparetions...
		$page = $this->page ;

		//Model...
		$states = State::get_combo() ;
		$model = User::find($model_id) ;
		if(!$model)
			return view('errors.410');

		$all_events = Post::selector('event' , 'auto')->orderBy('published_at' , 'desc')->get() ;
		$events = [] ;
		foreach($all_events as $event) {
			if($event->meta('can_register_card')) {
				array_push($events , $event);
			}
		}


		//Page..
		if($model->isCard()) {
			$page[1] = ["cards/$model_id/edit", trans('people.cards.manage.edit'), ''];
		}
		else {
			$page[1] = ["cards/$model_id/edit", trans('people.cards.manage.create'), ''];
		}


		if($model->isActiveVolunteer() and !Auth::user()->can('volunteers.edit'))
			return $this->editorForVolunteers($model->id , $page);

		$all_events = Post::selector('event' , 'auto')->orderBy('published_at' , 'desc')->get() ;
		$events = [] ;
		foreach($all_events as $event) {
			if($event->meta('can_register_card')) {
				array_push($events , $event);
			}
		}
		$model->event_id = Session::get('user_favourite_event',0);



		//View...
		return view('manage.cards.editor' , compact('page' , 'events', 'model' , 'states'));

	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function inquiry(Requests\Manage\CardInquiryRequest $request)
	{
		$user = User::findBySlug($request->code_melli , 'code_melli') ;

		if(!$user)
			return $this->jsonFeedback(1,[
					'ok' => 1 ,
					'message' => trans('people.cards.manage.inquiry_success') ,
					'callback' => 'cardEditor(1)' ,
					'redirectTime' => 1 ,
			]);

		if($user->isCard())
			return $this->jsonFeedback(1,[
					'ok' => 0 ,
					'message' => trans('people.cards.manage.inquiry_has_card') ,
					'callback' => 'cardEditor(2 , "'. $user->say('encrypted_code_melli') .'")'  ,
//					'redirect' => !Auth::user()->can('cards.edit')? url("manage/cards/$user->id/edit") : '' ,
					'redirectTime' => 1 ,
			]);

		if(abs($user->volunteer_status) >= 7)
			return $this->jsonFeedback(1,[
					'ok' => 1 ,
					'message' => trans('people.cards.manage.inquiry_is_volunteer') ,
					'redirect' => url("manage/cards/create/$user->id") ,
					'redirectTime' => 1 ,
			]);

		if(1)
			return $this->jsonFeedback(1,[
					'ok' => 1 ,
					'message' => trans('people.cards.manage.inquiry_will_be_volunteer') ,
					'redirect' => Auth::user()->can('cards.edit') ? url("manage/cards/$user->id/edit") : '' ,
			]);

	}

	public function save(Requests\Manage\CardSaveRequest $request)
	{

		//Preparations...
		$data = $request->toArray() ;
		$user = Auth::user() ;

		if($data['id']) {
			unset($data['event_id']);
			$model = User::find($data['id']);
			if(!$model)
				return $this->jsonFeedback(trans('validation.http.Eror410'));
		}

		//Processing donatable organs...
//		$data['organs'] = null ;
//		foreach(User::$donatable_organs as $donatable_organ) {
//			if($data['_'.$donatable_organ])
//				$data['organs'] .= ' '.trans("people.organs.$donatable_organ").' ' ;
//		}
//		if(!trim($data['organs']))
//			return $this->jsonFeedback(trans('validation.javascript_validation.organs'));

		//Processing dates...
		$carbon = new Carbon($request->birth_date);
		$data['birth_date'] = $carbon->toDateString() ;

		//Processing passwords...
		if(!$data['id'] or $data['_password_set_to_mobile']) {
			$data['password'] = Hash::make($data['tel_mobile']);
			$data['password_force_change'] = 1;
		}

		//Processing print status...
//		if($data['_submit'] == 'print') {
//			if(!$data['id'])
//				$data['card_print_status'] = 1;
//			else {
//				$model = User::findBySlug($data['code_melli'], 'code_melli');
//				if($model and ($model->card_print_status == 0 or $model->card_print_status > 3))
//					$data['card_print_status'] = 1;
//			}
//		}

		//Processing Domain...
		$data['domain'] = Auth::user()->domain ;
		if(!$data['domain'] or $data['domain']=='global') {
			$state = State::find($user->home_city);
			if($state)
				$data['domain'] = $state->domain->slug ;
		}



		//Processing passwords and a few more things...
		if(!$data['id'] or (isset($model) and !$model->isCard())) {
			$data['card_registered_at'] = Carbon::now()->toDateTimeString() ;
			$data['card_status'] = 8 ;
			$data['card_no'] = User::generateCardNo() ;
		}
		else {
			if($model->isActiveVolunteer() and !Auth::user()->can('volunteers.edit'))
				return $this->jsonFeedback(trans('validation.http.Eror403'));
		}

		//Saving favourite event...
		$request->session()->put('user_favourite_event' , $request->event_id);


		//Save ....
		$saved = User::store($data);

		//if print requested...
		if($data['_submit'] == 'print') {
			$user = User::find($saved);

			//Validation...
			$already = Printing::where('user_id' , $user->id)->first();
			if($already and !$already->delivered_at) {
				// No need to do anything :)
			}
			else {
				$parameters = [
						'id' => null,
						'user_id' => $user->id,
						'event_id' => $request->event_id,
				];
				$ok = Printing::store($parameters);
			}

		}

		//return...

		return $this->jsonAjaxSaveFeedback($saved , [
			'success_refresh' => true ,
		]);

	}

	public function saveForVolunteers(Requests\Manage\CardForVolunteersRequest $request)
	{
		$data = $request->toArray() ;
		$data['card_status'] = 8 ;

		//Finding the model...
		$model = User::find($request->id) ;
		if(!$model or !$model->isVolunteer())
			return $this->jsonFeedback(trans('validation.http.Eror410'));

		//Redirect Page...
		if(!$model->isCard()) {
			$redirect = url('manage/cards/create');
			$refresh = false;
		}
		else {
			$redirect = null ;
			$refresh = true ;
		}

		//Processing donatable organs...
		$data['organs'] = null ;
		foreach(User::$donatable_organs as $donatable_organ) {
			if($data['_'.$donatable_organ])
				$data['organs'] .= ' '.trans("people.organs.$donatable_organ").' ' ;
		}
		if(!trim($data['organs']))
			return $this->jsonFeedback(trans('validation.javascript_validation.organs'));

		//Processing print status...
		if($data['_submit'] == 'print') {
			if($model->card_print_status == 0 or $model->card_print_status > 3)
				$data['card_print_status'] = 1;
		}

		//Save and Return...
		$saved = User::store($data);
		return $this->jsonAjaxSaveFeedback($saved , [
				'success_refresh' => $refresh ,
				'success_redirect' => $redirect
		]);

	}

	public function change_password(Requests\Manage\CardChangePasswordRequest $request)
	{
		$model = User::find($request->id) ;
		$model->password = Hash::make($request->password) ;
		$model->password_force_change = 1 ;
		$is_saved = $model->save();

		if($is_saved and $request->sms_notify)
			;//@TODO: Call the event
			//Event::fire(new CardPasswordManualReset($model , $request->password));

		return $this->jsonAjaxSaveFeedback($is_saved);

	}

	public function delete(Request $request)
	{
		if(!Auth::user()->can('cards.delete')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;
		if($request->id == Auth::user()->id) return $this->jsonFeedback();

		$model = User::find($request->id) ;
		$done = $model->cardDelete();

		return $this->jsonAjaxSaveFeedback($done , [
			'success_refresh' => true ,
		]);

	}

	public function bulk_delete(Request $request)
	{
		if(!Auth::user()->can('cards.delete')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$ids = explode(',',$request->ids);
		foreach($ids as $id) {
			$model = User::find($id) ;
			if($model and $id != Auth::user()->id)
				$done = $model->cardDelete() ;
		}

		return $this->jsonAjaxSaveFeedback($done , [
			'success_refresh' => true ,
		]);
	}

	public function sms(Requests\Manage\CardSendMessageRequest $request)
	{
		$card = User::find($request->id) ;
		if(!$card)
			return $this->jsonFeedback();

		$is_sent = 1; //Event::fire(new SendSms([$card->tel_mobile] , $request->message)); @TODO: Make it work!

		return $this->jsonAjaxSaveFeedback($is_sent) ;
	}

	public function bulk_sms(Requests\Manage\CardSendMessageRequest $request)
	{

		//Collecting Numbers...
		$id_array = explode(',',$request->ids);
		$numbers = [] ;

		foreach($id_array as $id) {
			$user = User::find($id) ;
			if(!$user or !$user->tel_mobile)
				continue;

				array_push($numbers , $user->tel_mobile) ;
		}


		//Sending....
		$ok = SmsServiceProvider::send($numbers , $request->message) ;
		if($ok)
			$count = count($numbers);
		else
			$count = 0 ;

		//Feedback...
		return $this->jsonAjaxSaveFeedback($count, [
			'success_message' => trans('people.form.message_sent_to' , [
				'count' => AppServiceProvider::pd($count),
			]),
			'danger_message' => trans('people.form.message_not_sent_to_anybody'),
		]) ;
	}

	public function email(Requests\Manage\CardSendMessageRequest $request)
	{
		$card = User::find($request->id) ;
		if(!$card)
			return $this->jsonFeedback();

		$is_sent = 1;//  Event::fire(new SendEmail([$card->email] , $request->title , $request->message)); @TODO: Make it work!

		return $this->jsonAjaxSaveFeedback($is_sent) ;
	}

	public function bulk_email(Requests\Manage\CardSendMessageRequest $request)
	{

		$done = true ; //@TODO: Write the event!

		return $this->jsonAjaxSaveFeedback($done) ;
	}

	public function single_print(Requests\Manage\CardPrintRequest $request)
	{

		//Preparations...
		$request->status += 0 ;
		$user = User::find($request->id);

		if(!$user or !$user->isCard())
			return $this->jsonFeedback('Error #1');

		//Validation...
		$already = Printing::selector([
			//'event_id' => $request->event_id,
			'user_id' => $user->id,
			'criteria' => "under_any_action",
		])->first();
		if($already) {
			$id = $already->id ;
			//return $this->jsonFeedback(trans('people.cards.manage.print_already_requested'));
		}
		else {
			$id = 0 ;
		}


		//Processing Printing table...
		$parameters = [
			'id' => $id,
			'user_id' => $user->id,
			'event_id' => $request->event_id,
		];
		$ok = Printing::store($parameters);

		//Saving favourite event...
		$request->session()->put('user_favourite_event' , $request->event_id);

		//Return...
		return $this->jsonAjaxSaveFeedback($ok , [
		]);

	}

	public function bulk_print(Requests\Manage\CardPrintRequest $request)
	{
		//Preparations...
		$request->status += 0 ;
		$processed = 0 ;

		//Processing Printing table...
		$id_array = explode(',',$request->ids);
		foreach($id_array as $id) {
			$user =  User::find($id) ;
			if(!$user or !$user->isCard())
				continue ;

			$already = Printing::selector([
				//'event_id' => $request->event_id,
				'user_id' => $user->id,
				'criteria' => "under_any_action",
			])->first();
			if($already) {
				$id = $already->id ;
				//return $this->jsonFeedback(trans('people.cards.manage.print_already_requested'));
			}
			else {
				$id = 0 ;
			}

			$parameters = [
					'id' => $id,
					'user_id' => $user->id,
					'event_id' => $request->event_id,
			];
			$ok = Printing::store($parameters);

			if($ok)
				$processed++ ;

		}

		//Saving favourite event...
		$request->session()->put('user_favourite_event' , $request->event_id);


		//Blind Return...
		return $this->jsonAjaxSaveFeedback($processed , [
			'success_refresh' => '0' ,
			'success_message' => trans('people.printings.users_added_to_print' , [
				'count' => AppServiceProvider::pd($processed),
			]),
			'danger_message' => trans('people.printings.nobody_added_to_print'),
		]);

	}

	public function add_to_print(Requests\Manage\CardAddToPrintRequest $request)
	{
		$user = User::findBySlug($request->code_melli , 'code_melli') ;

		if(!$user or !$user->isCard())
			return $this->jsonFeedback() ;

		if($request->_submit == 'edit') {
			return $this->jsonFeedback(1,[
					'ok' => 1 ,
					'message' => trans('people.cards.manage.edit').'... ' ,
					'redirect' => url("manage/cards/$user->id/edit") ,
					'redirectTime' => 1 ,
				]);
		}


		/*--------------------------------------------------------------------------
		| If Print Request ...
		*/



		//Validation...
		$already = Printing::where('user_id' , $user->id)->first();
		if($already and !$already->delivered_at)
			return $this->jsonFeedback(trans('people.cards.manage.print_already_requested'));


		//Processing Printing table...
		$parameters = [
				'id' => null,
				'user_id' => $user->id,
				'event_id' => $request->event_id,
		];
		$ok = Printing::store($parameters);

		//Saving favourite event...
		$request->session()->put('user_favourite_event' , $request->event_id);


		return $this->jsonSaveFeedback( $ok , [
			'success_refresh' => true ,
		]);



	}

}
