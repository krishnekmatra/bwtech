<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryFeature extends Model
{
		use HasFactory;
		 protected $table = 'sub_category_features';
		 protected $fillable = [
				'id',
				'category_id',
				'sub_category_id',
				'feature_id'
		];

	 public function featureName(){
			return $this->belongsTo('App\Models\Feature', 'feature_id','id');
	 }

	 public function subCategory(){
			return $this->belongsTo('App\Models\SubCategory', 'sub_category_id','id');
	 }
	  public function featuresAttribute(){
			return $this->hasMany('App\Models\FeatureAttribute');
	 }
	
}
