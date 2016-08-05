<?php

namespace App\Models;

use App\Providers\AppServiceProvider;
use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Morilog\Jalali\jDate;


class Post extends Model
{
	use TahaModelTrait ;
	use SoftDeletes ;

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	| All standard laravel-based realtions and custom ones are grouped here.
	*/


	public function post_cat()
	{
		return $this->belongsTo('App\Models\Post_cat');
	}

	public function post_comments()
	{
		return $this->hasMany('App\Models\Post_comment');
	}

	public function post_medias()
	{
		return $this->hasMany('App\Models\Post_media');
	}

	public function branch()
	{
		return Post_cat::selectBySlug($this->branch) ;
	}

	public function domains()
	{
		$domains_array = json_decode($this->domains, true);
		if(!($domains_array)) $domains_array = array() ;


		//@TODO: COMPLETE THIS
	}

	/*
	|--------------------------------------------------------------------------
	| Selectors
	|--------------------------------------------------------------------------
	|
	*/
	public static function selector($branch , $criteria)
	{
		switch($criteria) {
			case 'published':
				return self::where('branch',$branch)->where('published_at','>','0') ;
			case 'pending':
				return self::where('branch',$branch)->whereNull('published_at') ;
			case 'bin' :
				return self::where('branch',$branch)->onlyTrashed();
			default:
				return null ;
		}
	}


	/*
	|--------------------------------------------------------------------------
	| Stators
	|--------------------------------------------------------------------------
	|
	*/
	public function say($property , $default='-')
	{
		switch($property) {
			case 'created' :
			case 'updated' :
			case 'published' :
			case 'deleted' :
				$at = $property."_at" ;
				if($this->$at)
					return $this->say($property."_by").": ".$this->say($property."_at") ;
				else
					return $default ;

			case 'created_at' :
			case 'updated_at' :
			case 'published_at' :
			case 'deleted_at' :
				if($this->$property) {
					return AppServiceProvider::pd(jDate::forge($this->$property)->format('j F Y _ H:m'));
				}
				else
					return $default ;

			case 'created_by' :
			case 'updated_by' :
			case 'published_by' :
			case 'deleted_by' :
				$volunteer = Volunteer::find($this->$property);
				if($volunteer)
					return $volunteer->fullName() ;
				else
					return trans('forms.general.deleted');

			case 'domains' :
				return $this->domains() ;

			default :
				return $this->$property ;
		}

	}
}
