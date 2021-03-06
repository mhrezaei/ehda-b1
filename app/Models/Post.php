<?php

namespace App\Models;

use App\Providers\AppServiceProvider;
use App\Traits\TahaMetaTrait;
use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Morilog\Jalali\jDate;

/*
| Help for Hadi:
| To list records: Post::selector($branch_slug or 'all' , $domain_slug or 'global)
| To search a keyword: Post::selector(☝☝☝)->whereRaw(Post::searchRawQuery($keyword))
*/


class Post extends Model
{
	use TahaModelTrait ;
	use SoftDeletes ;
	use TahaMetaTrait ;

	protected $guarded = ['id' ];
	public $photos = [] ;
	public $photos_count = 0 ;
	public $is_global_reflect = false ;
	protected static $search_fields = ['title', 'keywords', 'abstract'] ;
	protected static $default_image ;
	public static $reserved_slugs = 'none,without' ;


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

	public function comments()
	{
		return $this->hasMany('App\Models\Comment');
	}

	public function post_medias()
	{
		return $this->hasMany('App\Models\Post_media');
	}

	public function branch()
	{
		return Branch::selectBySlug($this->branch);
	}

	public function cards()
	{
		return User::where('event_id' , $this->id);
	}

	public function printings()
	{
		return Printing::where('event_id' , $this->id) ;
	}

	public function loadPhotos()
	{
		$string = $this->meta('post_photos');

		if(!$string)
			return ;

		$this->photos = json_decode($string , true) ;
		$this->photos_count = sizeof($this->photos);
	}

	public function savePhotos($data)
	{
		$resultant_array = [] ;
		unset($data['_photo_src_NEW']);

		foreach($data as $field => $value) {
			if(str_contains($field,'_photo_src_')) {
				$label_field = str_replace('src' , 'label' , $field);
				$link_field = str_replace('src' , 'link' , $field);
				array_push($resultant_array , [
					'src' => str_replace(url('') , null , $value) ,
					'label' => $data[$label_field] ,
					'link' => $data[$link_field] ,
				]);
			}
		}

		if(sizeof($resultant_array))
			return $this->meta('post_photos' , json_encode($resultant_array)) ;
		else
			return true ;
	}

	/*
	|--------------------------------------------------------------------------
	| Selectors
	|--------------------------------------------------------------------------
	|
	*/

	public static function counter($branch , $domain='global' ,$criteria = 'published')
	{
		return self::selector($branch , $domain , $criteria)->count() ;
	}

	public static function searchRawQuery($keyword, $fields = null)
	{
		if(!$fields)
			$fields = self::$search_fields ;

		$concat_string = " " ;
		foreach($fields as $field) {
			$concat_string .= " , `$field` " ;
		}

		return " LOCATE('$keyword' , CONCAT_WS(' ' $concat_string)) " ;
	}

	public static function selector($branch='searchable' , $domain='all' , $criteria='published' , $category_id = 'all')
	{
		$now = Carbon::now()->toDateTimeString();

		//Process Domain...
		if($domain=='auto')
			if(Auth::user()->isGlobal() )
				$domain = 'all' ;
			else
				$domain = Auth::user()->getDomain() ;

		if(is_array($domain))
		{
			$table = self::whereIn('domains' , $domain);
		}
		else
		{
			if($domain == 'all')
			{
				$table = self::where('id' , '>' , '0');
			}
			elseif($domain == 'global')
			{
				$query = " `domains` = 'global' or `domains` = 'global*' or locate('*',`domains`)  or `domains` = 'free' " ;
				$table = self::whereRaw("($query)") ;
			}
			else
			{
				$query = " `domains` = '$domain' or `domains` = '$domain*' or `domains` = 'free' " ;
				$table = self::whereRaw("($query)") ;
			}
		}

		//Process Branches...
		if(is_array($branch)) {
			$table = $table->whereIn('branch', $branch) ;
		}
		elseif($branch=='all') {
			//nothing required here :)
		}
		if($branch == 'searchable' ) {
			$table = $table->whereRaw(" LOCATE(`branch` , '".Branch::branchesWithFeature('searchable')."' ) ") ;
		}
		else
			$table = $table->where('branch' , $branch) ;

		//Process Category...
		if($category_id != 'all')
			$table = $table->where('category_id' , $category_id) ;

		//Process Criteria...
		switch($criteria) {
			case 'all' :
				return $table ;
			case 'all_with_trashed' :
				return $table->withTrashed() ;
			case 'published':
				return $table->whereDate('published_at','<=',$now)->whereNotNull('published_by') ;
			case 'scheduled' :
				return $table->whereDate('published_at','>',$now)->whereNotNull('published_by') ;
			case 'pending':
				return $table->whereNull('published_by')->where('is_draft',false) ;
			case 'drafts' :
				return $table->where('is_draft',true)->whereNull('published_by');
			case 'my_posts' :
				return $table->where('created_by',Auth::user()->id)->where('is_draft',0);
			case 'my_drafts' :
				return $table->where('created_by',Auth::user()->id)->where('is_draft',true)->whereNull('published_by');
			case 'bin' :
				return $table->onlyTrashed();
			default:
				return $table->where('id' , '0') ;
		}


	}


	/*
	|--------------------------------------------------------------------------
	| Stators
	|--------------------------------------------------------------------------
	|
	*/

	private static function loadDefaultImage()
	{
		if(!self::$default_image)
			self::$default_image = '/assets/site/images/default-post.png';

	}

	public function getKeywords()
	{
		if(trim($this->keywords))
			return explode(trans('site.global.comma'), $this->keywords);
		else
			return [] ;
	}

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
		if($this->published_by  and $this->published_at and $this->published_at > Carbon::now())
			return true ;
		else
			return false ;

	}

	public function isPublished()
	{
		if($this->published_by  and $this->published_at and $this->published_at <= Carbon::now() and !$this->copy_of)
			return true ;
		else
			return false ;

	}

	public function status($key = null)
	{
		//Discover...
		if(!$this->id) {
			$return['slug'] = 'unsaved';
			$return['text'] = trans('posts.status.unsaved');
			$return['color'] = 'danger';
		}
		elseif($this->trashed()) {
			$return['slug'] = 'trashed';
			$return['text'] = trans('posts.status.trashed');
			$return['color'] = 'danger' ;
		}
		elseif($this->isPublished()) {
			$return['slug'] = 'published';
			$return['text'] = trans('posts.status.published');
			$return['color'] = 'success' ;
		}
		elseif($this->isScheduled()) {
			$return['slug'] = 'scheduled';
			$return['text'] = trans('posts.status.scheduled');
			$return['color'] = 'info' ;
		}
		elseif($this->is_draft) {
			$return['slug'] = 'draft';
			$return['text'] = trans('posts.status.draft');
			$return['color'] = 'warning' ;
		}
		else  {
			$return['slug'] = 'under_review';
			$return['text'] = trans('posts.status.under_review');
			$return['color'] = 'warning' ;
		}
//		else {
//			$return['slug'] = '.';
//			$return['text'] = '.';
//			$return['color'] = 'danger' ;
//		}

		//Return...
		if(!$key)
			return $return ;
		else
			return $return[$key] ;
	}
	
	public function say($property , $default='-')
	{
		self::loadDefaultImage() ;

		switch($property) {
			case 'created' :
			case 'updated' :
			case 'published' :
			case 'deleted' :
				$at = $property."_at" ;
				if($this->$at)
					return $this->say($property."_by").' '.trans('forms.general.in').' '.$this->say($property."_at") ;
				else
					return $default ;

			case 'created_at' :
			case 'updated_at' :
			case 'published_at' :
			case 'deleted_at' :
				if($this->$property) {
					return AppServiceProvider::pd(jDate::forge($this->$property)->format('j F Y [H:m]'));
				}
				else
					return $default ;

			case 'created_by' :
			case 'updated_by' :
			case 'published_by' :
			case 'deleted_by' :

				$volunteer = User::find($this->$property);
				if($volunteer)
					return $volunteer->fullName() ;
				else
					return trans('forms.general.deleted');

			case 'title' :
				if($this->title == '-')
					return str_limit($this->text , 50);
				else
					return $this->title ;

			case 'title_limit' :
				if($this->title == '-')
					return str_limit($this->text , 45);
				else
					return str_limit($this->title , 45) ;


			case 'domains' :
				if($this->domains == 'free')
					return $default ;
				elseif($this->domains == 'global' or $this->domains=='global*')
					return trans('posts.manage.global');
				else {
					$slug = str_replace('*' , null , $this->domains) ;
					$domain = Domain::selectBySlug($slug) ;
					if($domain)
						return $domain->title ;
					else
						return $default ;
					}

			case 'link' :
				$link = str_replace(' ', '_', $this->title);
				$link = str_replace('/', '_', $link);

				return url("showPost/".$this->id."/".urlencode($link)) ;

			case 'gallery_link' :
				$link = str_replace(' ', '_', $this->title);
				$link = str_replace('/', '_', $link);

				return url("/gallery/show/".$this->id."/".urlencode($link)) ;

			case 'post_header' :
			case 'header' :
				if ($this->branch == 'statics')
					return $this->meta('header_title');
				else
					return $this->branch()->header_title;

			case 'category_name' :
				if ($this->category_id > 0)
					return Category::find($this->category_id)->title;
				else
					return $this->meta('category_title');

			case 'abstract' :
				if($this->abstract)
					return $this->abstract ;
				else
					return str_limit(strip_tags($this->text),200);

			case 'featured_image' :
				if(!$this->featured_image or !File::exists( public_path() .$this->featured_image))
					return url(self::$default_image) ;
				else
					return url($this->featured_image);

//				$file_headers = @get_headers($this->featured_image);
//				if($file_headers[0] == 'HTTP/1.0 404 Not Found' or ($file_headers[0] == 'HTTP/1.0 302 Found' && $file_headers[7] == 'HTTP/1.0 404 Not Found'))
//					return self::$default_image ;
//
//				return $this->featured_image ;

			default :
				return $this->$property ;

		}

	}

	public function checkDomain($domain)
	{
		if ($this->domains == 'free')
			return true;
		
		return str_contains($this->domains, "$domain");
	}
}
