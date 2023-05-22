<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\SubCategoryFeature;

class SubCategory extends Model
{
	use HasFactory;
	protected $table = 'sub_categorys';
	protected $fillable = [
		'name',
		'category_id',
		'slug'
	];

	public function setNameAttribute($value){
      $res = str_replace( array( '\'', '"',
      ',' , ';', '<', '>','/'), '-', $value);
      $this->attributes['name'] = $value;
      $this->attributes['slug'] = Str::slug($res);
    }
	public static function saveSubcategory($request) {
	   
		if(isset($request['id'])){
            $id = $request['id'];
            
        }else{
            $id = 0;
            $request['catgeory_id'] = $request['category_id'];

        }
        $matchThese = ['id'=>$id];
        $subcat = SubCategory::updateOrCreate($matchThese,$request);
        if($request['feature_id']){
        	foreach($request['feature_id'] as $val){
        		$matchThese = [
        			'category_id'=> $request['category_id'],
        			'sub_category_id' => $subcat->id,
        			'feature_id' => $val
        		];
        		SubCategoryFeature::updateOrCreate($matchThese,[
        			'category_id'=> $request['category_id'],
        			'sub_category_id' => $subcat->id,
        			'feature_id' => $val
        		]);
        	}
        }

        if(isset($request['uncheck_feature_id'])){
        	$explode = explode(',',$request['uncheck_feature_id']);
        	foreach($explode as $val){
        		$matchThese = [
        			'category_id'=> $request['category_id'],
        			'sub_category_id' => $subcat->id,
        			'feature_id' => $val
        		];
        		SubCategoryFeature::where($matchThese)->delete();
        	}
        }
		return $subcat;  
	}
    
    
	

	public function category(){
	  return $this->belongsTo('App\Models\Category', 'category_id','id');
   }

   public function features(){
   	        return $this->hasMany('App\Models\SubCategoryFeature');
	}

	
}
