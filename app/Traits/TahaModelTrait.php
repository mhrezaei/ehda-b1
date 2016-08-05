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
	

	public static function store($request)
	{
		if(is_array($request))
			$data = $request ;
		else
			$data = $request->toArray();

		if(isset($data['_token']))
			unset($data['_token']);
		if(isset($data['_modal_id']))
			unset($data['_modal_id']);

		if($data['id'])
			$affected = Self::where('id', $data['id'])->update($data);
		else {
			$model = Self::create($data);
			if($model)
				$affected = 1;
			else
				$affected = 0;
		}

		return $affected;

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