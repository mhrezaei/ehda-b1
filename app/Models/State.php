<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TahaModelTrait ;

class State extends Model
{
	use SoftDeletes;
	use TahaModelTrait ;

	protected $guarded = ['id'];


	public static function get_provinces($mood='get')
	{
		return self::stacker(Self::where('parent_id' , '0'),$mood);
	}

	public static function get_cities($given_province=0, $mood = 'get')
	{
		if(is_numeric($given_province))
			if($given_province==0)
				$stack = self::where('parent_id','>','0') ;
			else
				$stack = self::where('parent_id' , $given_province) ;
		else {
			$province = self::where([
				'title' => $given_province ,
				'parent_id' => '0'
			])->first() ;
			if(!$province)
				$stack = self::where('parent_id' , 0) ; //safely returns nothing!
			else
				$stack = self::where('parent_id' , $province->id) ;
		}

		return self::stacker($stack , $mood) ;
	}

	public function cities($mood='get')
	{
		$stack = self::where('parent_id' , $this->id) ;
		return self::stacker($stack,$mood) ;
	}

	public static function setCapital($province_name, $city_name)
	{
		if(!$city_name) $city_name = $province_name ;
		$province = self::where([
				'title'=>$province_name,
				'parent_id'=>'0',
		])->first() ;
		$city = self::where([
				['title',$city_name],
				['parent_id','!=','0'],
		])->first() ;

		$province->capital_id = $city->id ;
		$province->save() ;
	}

	public function isProvince()
	{
		return !$this->parent_id ;
	}

	public function capital()
	{
		if($this->isProvince())
			return self::find($this->capital_id) ;
		else
			return $this->province()->capital() ;
	}

	public function province()
	{
		if($this->isProvince())
			return $this ;
		else {
			return self::find($this->parent_id) ;
		}
	}

}


