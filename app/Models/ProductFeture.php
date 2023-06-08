<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeture extends Model
{
	use HasFactory;
	protected $fillable = [
		'product_id',
		'category_id',
		'sub_category_id',
		'features_id',
		'feature_attribute_id',
		'value',
		'type'
	];
	/* 
		* one to one relationship
		* get feature name
	*/
	public function feature_name(){
		return $this->belongsTo('App\Models\Feature', 'features_id','id');
	}

	/*
		* get featureattribute 
	*/
	public function feature_attribute_name(){
		return $this->belongsTo('App\Models\FeatureAttribute', 'feature_attribute_id','id');
	}
}
