<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeAreHiring extends Model
{
	use HasFactory;
	protected $fillable = [
		'title',
		'description'
	];

	public static function getWeAreHiringList() {
		$wearehiring = WeAreHiring::orderBy('created_at','desc');
		return $wearehiring;
	}

	 public static function saveWeAreHiring($request){
		 if(isset($request['id'])){
			$id = $request['id'];
		}else{
			$id = 0;
		}
		$matchThese = ['id'=>$id];
	   
		$we_are_hiring = WeAreHiring::updateOrCreate($matchThese,$request);
		return $we_are_hiring;
	}
}
