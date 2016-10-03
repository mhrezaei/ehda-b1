<?php

namespace App\Http\Controllers\Manage;

use App\models\Branch;
use App\Models\Domain;
use App\Models\Post_cat;
use App\Models\Setting;
use App\Models\State;
use App\Traits\TahaControllerTrait;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hamcrest\Core\Set;
use Illuminate\Support\Facades\View;

class SettingsController extends Controller
{
	use TahaControllerTrait ;
	private $page = array();

	public function __construct()
	{
		$this->page[0] = ['devSettings' , trans('manage.modules.devSettings')];
	}

	public function index($request_tab = 'socials')
	{
		//Preparetions...
		$page[0] = ['settings' , trans('manage.modules.settings')];
		$page[1] = [$request_tab , trans("manage.devSettings.downstream.category.$request_tab")];

		//Model...
		$model_data = Setting::where('category' , $request_tab)->orderBy('title')->get();

		//View...
		return view("manage.settings.settings", compact('page', 'model_data' , 'request_tab'));

	}


	public function add($request_tab)
	{
		//Preparetion...
		$page = $this->page;
		$page[1] = [$request_tab];
		$page[2] = ['add'];
		$view = "manage.settings." . $request_tab . "_add";

		//Model...
		switch($request_tab) {
			case 'branches' :
				$model = new Branch() ;
				break;
		}

		//View...
		if(!View::exists($view))
			return view('errors.404');

		return view($view, compact('page' , 'model'));
	}

	public function editor($request_tab , $item_id , $parent_id=0)
	{
		//Appears in modal and doesn't need $this->page stuff
		

		switch($request_tab) {
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

			default:
				return view('errors.404');
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
			case 'branches' :
				if($item_id)
					$model_data = Branch::find($item_id);
				else
					$model_data = new Branch();
				$view .= "branches_edit" ;
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
		return view($view, compact('page', 'model_data'));

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
		$data['parent_id'] = $data['province_id'] ;
		unset($data['province_id']);

		return $this->jsonAjaxSaveFeedback(State::store($data) ,[
				'success_refresh' => 1,
		]);

	}

}
