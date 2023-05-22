<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\FeatureAttribute;
use App\Models\Feature;


class FeatureRule implements Rule
{
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
		 $this->messagepass = '';
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		//
		$specification = $value;
		$explode = explode(',', $specification);
		foreach($explode as $valuefeature){
		 $explode_type = explode(':',$valuefeature);
         $feature_id =  Feature::where('name',$explode_type[0])->first();
         if(isset($feature_id) && $feature_id['feature_type'] == 'select'){
         		  $feature_attibut_id = FeatureAttribute::where('name', $explode_type[1])->pluck('id')->first();
         		  if($feature_attibut_id){
         		  	return true;
         		  }else{
         		  	$this->messagepass = $explode_type[0]."This Feature Attribute Does not exist";
         		  	return false;
         		  }
         }else{
         	$this->messagepass = $explode_type[0]."This Feature Does not exist";
        	return false;
         }
		}
		// $brand = FeatureAttribute::where('name',$value)->first();

	  //  if($brand)
		// return true;
		// else
		// return false;
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return $this->messagepass ;
	}
}
