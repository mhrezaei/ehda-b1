<?php

namespace App\Models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Printing extends Model
{
	use SoftDeletes, TahaModelTrait;

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function event()
	{
		return $this->belongsTo('App\Models\Post');
	}

	/*
	|--------------------------------------------------------------------------
	| Selectors
	|--------------------------------------------------------------------------
	|
	*/

	/**
	 * @param array $switches (accepts 'domain' , 'criteria' , 'user_id' , 'event_id' )
	 */
	public function selector($switches = [])
	{
		extract($switches) ;

		/*--------------------------------------------------------------------------
		| Process Domain ...
		*/

		if(!isset($domain))
			$domain = 'auto' ;

		if($domain=='auto')
			$domain =  Auth::user()->getDomain() ;

		if($domain=='global')
			$table = self::where('id' , '>' , 0) ;
		else
			$table = self::where('domain' , $domain) ;

		/*--------------------------------------------------------------------------
		| Process user_id ...
		*/
		if(isset($user_id)) {
			$table = $table->where('user_id' , $user_id) ;
		}

		/*--------------------------------------------------------------------------
		| Process event_id ...
		*/
		if(isset($event_id)){
			$table = $table->where('event_id' , $event_id) ;
		}



		/*--------------------------------------------------------------------------
		| Process Criteria ...
		*/

		if(!isset($criteria))
			$criteria = 'all' ;

		switch($criteria) {
			case 'all' :
				break;

			case 'all_with_trashed':
				$table = $table->withTrashed() ;
				break;

			case 'pending' :
				$table = $table->whereNull('queued_at') ;
				break;

			case 'under_print' :
				$table = $table->where('queued_at')->whereNull('printed_at') ;
				break;

			case 'under_verification' :
				$table = $table->where('printed_at')->whereNull('verified_at') ;
				break;

			case 'under_dispatch' :
				$table = $table->where('verified_at')->whereNull('dispatched_at') ;
				break;

			case 'under_delivery' :
				$table = $table->where('dispatched_at')->whereNull('delivered_at') ;
				break;

			case 'archive' :
				$table = $table->where('delivered_at') ;
				break;

			case 'bin' :
				$table = $table->onlyTrashed();
				break;
		}

		/*--------------------------------------------------------------------------
		| Return ...
		*/
		return $table ;

	}

	/*
	|--------------------------------------------------------------------------
	| Accessors & Mutators
	|--------------------------------------------------------------------------
	|
	*/
	public function getStatusAttribute()
	{

		if($this->delivered_at)
			return 'archive' ;
		if($this->dispatched_at and !$this->delivered_at)
			return 'under_delivery' ;
		if($this->verified_at and !$this->dispatched_at)
			return 'under_dispatch' ;
		if($this->printed_at and !$this->verified_at)
			return 'under_verification' ;
		if($this->queued_at and !$this->printed_at)
			return 'under_print' ;
		if(!$this->queued_at)
			return 'under_print' ;

	}

	public function getStatusColorAttribute()
	{
		switch($this->status) {
			case 'pending' :
				return 'danger' ;

			case 'under_print' :
				return 'warning' ;

			case 'under_verification' :
				return 'warning' ;

			case 'under_dispatch' :
				return 'warning' ;

			case 'under_delivery' :
				return 'primary' ;

			case 'archive' :
				return 'success';

		}
	}



}
