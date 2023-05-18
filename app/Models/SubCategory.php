<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


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
		return $subcat;  
	}
    
    
	

	public function category(){
	  return $this->belongsTo('App\Models\Category', 'category_id','id');
   }

	
}
