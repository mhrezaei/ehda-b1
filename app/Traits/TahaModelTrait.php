<?php
namespace App\Traits;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait TahaModelTrait
{

	/*
	|--------------------------------------------------------------------------
	| General Select Methods
	|--------------------------------------------------------------------------
	|
	*/
	public static function selectBySlug($slug , $field='slug')
	{
		if(!$slug) return false ;
		return self::where($field , $slug)->first() ;
	}

	/*
	|--------------------------------------------------------------------------
	| General Save Methods
	|--------------------------------------------------------------------------
	|
	*/
	

	public static function store($request , $unset_things = [])
	{
		//Convert to Array...
		if(is_array($request))
			$data = $request ;
		else
			$data = $request->toArray();

		//Unset Unnecessary things...
		if(isset($data['_token']))
			unset($data['_token']);
		if(isset($data['_modal_id']))
			unset($data['_modal_id']);
		if(isset($data['key']))
			unset($data['key']);
		if(isset($data['security']))
			unset($data['security']);

		foreach($unset_things as $unset_thing) {
			if(isset($data[$unset_thing]))
				unset($data[$unset_thing]);
		}

		//Action...
		if(isset($data['id'])) {
			$affected = Self::where('id', $data['id'])->update($data);
			if(!isset($data['updated_by'])) {
				if( Auth::check())
					$data['updated_by'] = Auth::user()->id ;
				else
					$data['updated_by'] = 0 ;
			}
			if($affected) $affected = $data['id'] ;
		}
		else {
			if(!isset($data['created_by'])) {
				if( Auth::check())
					$data['created_by'] = Auth::user()->id ;
				else
					$data['created_by'] = 0 ;
			}
			$model = Self::create($data);
			if($model)
				$affected = $model->id;
			else
				$affected = 0;
		}

		//feedback...
		return $affected;

	}

	public function unpublish()
	{
		$this->published_at = null ;
		$this->published_by = null ;
		return $this->save() ;
	}

	public function delete()
	{
//		if($this->id == Auth::user()->id)
//			return 0 ;

		$this->deleted_at = Carbon::now()->toDateTimeString();
		$this->deleted_by = Auth::user()->id ;
		return $this->save();
	}

	public static function bulkDelete($ids , $exception)
	{
		if(!is_array($ids))
			$ids = explode(',',$ids);

		return Self::whereIn('id',$ids)->where('id','<>',$exception)->update([
				'deleted_at' => Carbon::now()->toDateTimeString() ,
				'deleted_by' => Auth::user()->id ,
		]);

	}

	public static function bulkPublish($ids)
	{
		if(!is_array($ids))
			$ids = explode(',',$ids);

		return Self::whereIn('id',$ids)->whereNull('deleted_at')->whereNull('published_at')->update([
				'published_at' => Carbon::now()->toDateTimeString() ,
				'published_by' => Auth::user()->id ,
		]);

	}

}