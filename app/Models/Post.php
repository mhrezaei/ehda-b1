<?php

namespace App\Models;

use App\Providers\AppServiceProvider;
use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\jDate;


class Post extends Model
{
	use TahaModelTrait ;
	use SoftDeletes ;

	protected $guarded = ['id' , 'featured_image'];

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	| All standard laravel-based realtions and custom ones are grouped here.
	*/


	public function category()
	{
		return $this->belongsTo('App\Models\Category');
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
		return Branch::selectBySlug($this->branch);
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
		$now = Carbon::now();
		switch($criteria) {
			case 'all' :
				return self::where('branch' , $branch) ;
			case 'published':
				return self::where('branch',$branch)->where('published_at','<',$now)->where('published_by') ;
			case 'scheduled' :
				return self::where('branch',$branch)->where('published_at','>',$now)->where('published_by') ;
			case 'pending':
				return self::where('branch',$branch)->whereNull('published_at')->where('is_draft',false) ;
			case 'drafts' :
				return self::where('branch',$branch)->where('is_draft',true)->whereNull('published_by');
			case 'my_posts' :
				return self::where('branch',$branch)->where('created_by',Auth::user()->id)->where('is_draft',0);
			case 'my_drafts' :
				return self::where('branch',$branch)->where('created_by',Auth::user()->id)->where('is_draft',true)->whereNull('published_by');
			case 'bin' :
				return self::onlyTrashed()->where('branch',$branch);
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

	public function canPublish()
	{
		$online_user = Auth::user() ;

		if($this->published_at)
			return $online_user->can($this->branch.".edit") ;
		else
			return $online_user->can($this->branch.".publish") ;

	}

	public function canEdit()
	{
		$online_user = Auth::user() ;

		//Allowed by permission...
		if($online_user->can($this->branch.".edit" , $this->domains))
			return true ;

		//Own unpublished post...
		if($this->created_by == $online_user->id and $this->published_at == null)
			return true ;

		//Otherwise...
		return false ;
	}

	public function canDelete()
	{
		$online_user = Auth::user() ;

		//Not Even has an ID...
		if(!$this->id)
			return false ;

		//Allowed by Permission...
		if($online_user->can($this->branch.".delete" , $this->domains))
			return true ;

		//Own unpublished post...
		if($this->created_by == $online_user->id and $this->published_at == null and $this->is_draft)
			return true ;

		//Otherwise...
		return false ;
	}

	public function canBin()
	{
		$online_user = Auth::user() ;

		//Allowed by Permission...
		if($online_user->can($this->branch.".delete" , $this->domains))
			return true ;

		//Otherwise...
		return false ;

	}

	public function isScheduled()
	{
		if($this->published_at and $this->published_at > Carbon::now())
			return true ;
		else
			return false ;

	}

	public function isPublished()
	{
		if($this->published_at and $this->published_at <= Carbon::now() and !$this->copy_of)
			return true ;
		else
			return false ;

	}

	public function status($key = null)
	{

		//Discover...
		if(!$this->id) {
			$return['text'] = trans('posts.status.unsaved');
			$return['color'] = 'danger';
		}
		elseif($this->trashed()) {
			$return['text'] = trans('posts.status.trashed');
			$return['color'] = 'danger' ;
		}
		elseif($this->isPublished()) {
			$return['text'] = trans('posts.status.published');
			$return['color'] = 'success' ;
		}
		elseif($this->isScheduled()) {
			$return['text'] = trans('posts.status.scheduled');
			$return['color'] = 'info' ;
		}
		elseif($this->is_draft) {
			$return['text'] = trans('posts.status.draft');
			$return['color'] = 'warning' ;
		}
		elseif(!$this->published_at) {
			$return['text'] = trans('posts.status.under_review');
			$return['color'] = 'warning' ;
		}
		else {
			$return['text'] = '.';
			$return['color'] = 'danger' ;
		}

		//Return...
		if(!$key)
			return $return ;
		else
			return $return[$key] ;
	}


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

			case 'link' :
				return url("post/".$this->id."/".$this->title) ; //TODO: Correct this

			default :
				return $this->$property ;
		}

	}
}
