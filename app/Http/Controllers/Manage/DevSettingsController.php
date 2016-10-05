<?php

namespace App\Http\Controllers\Manage;

use App\models\Branch;
use App\Models\Category;
use App\Models\Domain;
use App\Models\Post_cat;
use App\Models\Setting;
use App\Models\State;
use App\Models\User;
use App\Providers\AppServiceProvider;
use App\Traits\TahaControllerTrait;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

//@TODO: Delete Buttons for all of these items

class DevSettingsController extends Controller
{
	use TahaControllerTrait ;
	private $page = array();

	public function __construct()
	{
		$this->page[0] = ['devSettings' , trans('manage.modules.devSettings')];
	}

	public function index($request_tab = 'branches')
	{
		//Preparetions...
		$page = $this->page;
		$page[1] = [$request_tab];

		//Model...
		switch($request_tab) {
			case 'downstream' :
				$model_data = Setting::orderBy('title')->paginate(100) ;
				break;

			case 'states' :
				$model_data = State::get_provinces()->orderBy('title')->get();
				break;

			case 'categories' :
				$model_data = State::get_provinces()->orderBy('title')->get();
				break;

			case 'domains':
				$model_data = Domain::orderBy('title')->get();
				break;

			case 'branches' :
				$model_data = Branch::orderBy('plural_title')->get();
				break ;

			default :
				return view('errors.404');
		}

		//View...
		return view("manage.settings.$request_tab", compact('page', 'model_data'));

	}



	public function editor($request_tab , $item_id , $parent_id=0)
	{
		//Appears in modal and doesn't need $this->page stuff

		switch($request_tab) {
			case 'downstream' :
				if($item_id>0) {
					$model = Setting::find($item_id);
					if(!$model)
						return trans('validation.invalid');
				}
				else {
					$model = new Setting() ;
				}
			return view('manage.settings.downstream-edit' , compact('model'));

			case 'states' :
				if($item_id>0) {
					$model = State::find($item_id) ;
					if(!$model) return trans('validation.invalid') ;
					if($model->isProvince()) {
//						return view('templates.say' , ['array'=>$model->cities()->orderBy('title')->get()->toArray()]);

						return view('manage.settings.states-modalEditor', compact('model'));
					}
					else {
						$provinces = State::get_provinces()->orderBy('title')->get() ;
						$domains = Domain::orderBy('title')->get() ;
						return view('manage.settings.states-cityEditor', compact('model' , 'provinces' , 'domains'));
					}
				}
				else {
					if($parent_id) {
						$provinces = State::get_provinces()->orderBy('title')->get() ;
						$domains = Domain::orderBy('title')->get() ;
						$guess_domain = State::where('parent_id',$parent_id)->first()->domain->id ;

						return view('manage.settings.states-cityEditor', compact('model' , 'provinces' , 'domains' , 'parent_id' , 'guess_domain'));
					}
					else {
						$cities = State::get_cities();
						return view('manage.settings.states-modalEditor', compact('model', 'cities'));
					}
				}

			case 'branches' :
				if($item_id>0)
					$model_data = Branch::find($item_id);
				else
					$model_data = new Branch() ;
				return view('manage.settings.branches_edit', compact('model_data'));
			
			case 'categories' :
				if($item_id>0) {
					$model = Category::find($item_id);
					if(!$model)
						return view('errors.m410');
				}
				else {
					$model = new Category() ;
					$model->branch_id = $parent_id ;
				}
				$branches = Branch::selector('category') ;
				return view('manage.settings.categories_edit' , compact('model' , 'branches'));
				

			default:
				return view('errors.m404');
		}

	}

	public function item($request_tab, $item_id)
	{

		//Preparation...
		$page = $this->page;
		$page[1] = [$request_tab];
		$page[2] = ['edit',null,''];
		$view = "manage.settings." ;
		
		switch($request_tab) {
			case 'downstream' :
				$model = Setting::find($item_id) ;
				if(!$model)
					return view('errors.m410');

				return view('manage.settings.downstream-value' , compact('model'));
				break;

			case 'branches' :
				$branch = Branch::find($item_id) ;
				if(!$branch)
					return view('errors.410');
				$model_data = $branch->categories()->get() ;
				$page[2] = ['categories' , $branch->title() , $item_id];
				return view('manage.settings.categories', compact('page', 'model_data','branch'));
				break;

			case 'states':
				$model_data = State::get_cities($item_id)->orderBy('title')->get();
				$view .= "states-cities";
				$page[2][1] = trans('manage.devSettings.states.province' , ['province'=>$model_data->first()->province()->title]) ;
				break;

			case 'domains' :
				$domain = Domain::find($item_id) ;
				$model_data = $domain->states()->orderBy('title')->get();
				$view .= "states-cities";
				$page[2][1] = trans('manage.devSettings.domains.cities-of') .' '. $domain->title ;
				break;

			default:
				return view('templates.say' , ['array'=>"What the hell is $request_tab?"]); //@TODO: REMOVE THIS

		}


		if(!View::exists($view))
			return view('templates.say' , ['array'=>"View '$view' is not found."]); //@TODO: REMOVE THIS



		if(!isset($model_data) or !$model_data or !View::exists($view))
			return view('errors.m404');

		//View...
		return view($view, compact('page', 'model_data'));

	}

	public function search($request_tab , $key)
	{
		//Preparation...
		$page = $this->page;
		$page[1] = [$request_tab];
		$view = "manage.settings." ;

		switch($request_tab) {
			case 'downstream' :
				$model_data = Setting::where('title' , 'like' , "%$key%")->orWhere('slug' , 'like' , "%$key%")->orderBy('title')->paginate(100);
				$view .= 'downstream' ;
				$page[2] = ['search',trans('forms.button.search_for')." $key",''];
				break;

			case 'states' :
				$model_data = State::where([
					['title' , 'like' , '%'.$key.'%'] ,
					['parent_id' , '<>' , '0']
				])->orderBy('title')->get();
				$view .= "states-cities";
				$page[2] = ['search',trans('manage.devSettings.states.city-search')." $key",''];
				break;

			default:
				return view('templates.say' , ['array'=>"What the hell is $request_tab?"]); //@TODO: REMOVE THIS
				return view('errors.404');
		}

		//View...
		return view($view, compact('page', 'model_data' , 'key'));

	}


	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function save_branches(Requests\Manage\BranchesSaveRequest $request)
	{
		return $this->jsonAjaxSaveFeedback(Branch::store($request) , [
			'success_refresh' => true ,
		]);

	}


	public function save_domains(Requests\Manage\DomainSaveRequest $request)
	{
		return $this->jsonAjaxSaveFeedback(Domain::store($request) ,[
				'success_refresh' => 1,
		]);
	}

	public function save_states(Requests\Manage\StatesSaveRequest $request)
	{
		return $this->jsonAjaxSaveFeedback(State::store($request) ,[
			'success_refresh' => 1,
		]);

	}

	public function save_cities(Requests\Manage\CitiesSaveRequest $request)
	{
		$data = $request->toArray() ;

		//If Save...
		if($data['_submit'] == 'save') {
			$data['parent_id'] = $data['province_id'] ;
			unset($data['province_id']);

			return $this->jsonAjaxSaveFeedback(State::store($data) ,[
					'success_refresh' => 1,
			]);
		}


		if($data['_submit'] == 'delete') {
			return $this->jsonAjaxSaveFeedback(State::destroy($data['id']) ,[
					'success_refresh' => 1,
			]);
		}

	}

	public function save_category(Requests\Manage\CategorySaveRequest $request)
	{
		return $this->jsonAjaxSaveFeedback(Category::store($request) ,[
				'success_refresh' => 1,
		]);

	}

	public function save_downstream(Requests\Manage\DownstreamSaveRequest $request)
	{
		if($request->_submit == 'save') {
			return $this->jsonAjaxSaveFeedback(Setting::store($request) ,[
					'success_refresh' => 1,
			]);
		}
		else {
			return $this->jsonAjaxSaveFeedback(Setting::destroy($request->id) , [
					'success_refresh' => 1,
			]);
		}
	}

	public function set_downstream(Request $request)
	{
		//Preparations...
		$data = $request->toArray();
		$model = Setting::find($request->id);
		if(!$model)
			return $this->jsonFeedback(trans('validation.http.Eror410'));

		//Purification of the global value...
		switch ($request->data_type) {
			case 'bool' :
				$data['global_value'] += 0 ;
				break;

			case 'date' :
				$carbon = new Carbon($data['global_value']);
				$data['global_value'] = $carbon->toDateString();
				break;

			case 'photo' :
				$data['global_value'] = str_replace(url('') , null , $data['global_value']);
				break ;

		}

		//Processing Domains...
		$value = [] ;
		foreach($model->domains() as $domain) {
			//Bypass...
			if(in_array($data[$domain->slug] , Setting::$unset_signals))
				continue ;

			//Purification...
			switch ($request->data_type) {
				case 'bool' :
					$data[$domain->slug] += 0 ;
					break;

				case 'date' :
					$carbon = new Carbon($data[$domain->slug]);
					$data[$domain->slug] = $carbon->toDateString() ;
					break;

				case 'photo' :
					$data[$domain->slug] = str_replace(url('') , null , $data[$domain->slug]);
					break ;
			}

			//Set...
			$value[$domain->slug] = $data[$domain->slug] ;
		}

		//Save...
		$model->global_value = $data['global_value'] ;
		$model->domain_value = json_encode($value) ;

		return $this->jsonAjaxSaveFeedback($model->update() , [
				'success_refresh' => 1,
		]);

	}

	public function login_as(Request $request)
	{
		$user = User::find($request->id) ;
		if(!$user->isActive())
			return $this->jsonFeedback('user is not active');

		$ok = Auth::loginUsingId( $user->id );
		return $this->jsonAjaxSaveFeedback($ok , [
				'success_redirect' => url('/manage'),
		]);

	}

}
