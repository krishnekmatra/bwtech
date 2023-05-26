<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FeatureAttribute;
use Illuminate\Support\Str;

class Feature extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'feature_type',
        'slug',
        'search_type'

    ];
    public function setNameAttribute($value){
     $trimmed = trim($value); // Trims both ends

        $res =  str_replace('', '_', $trimmed);
      $this->attributes['name'] = $value;
      $this->attributes['slug'] = Str::slug($res);
    }

    //save feature
    public static function saveFeature($request) {
        
        if(isset($request['id'])){
            $id = $request['id'];
        }else{
            $id = 0;
        }
        $feature = Feature::create([
            'name' => $request['name'],
            'feature_type' => $request['feature_type'],
            'search_type' => $request['search_type']
        ]);
        if($request['feature_value']){
            foreach($request['feature_value'] as $key=>$value){
                $decode = json_decode($value,true);
                $array = (array)$decode;
                foreach($array as $array_value){
                    FeatureAttribute::create([
                        'name' => $array_value['value'],
                        'feature_id' => $feature->id
                    ]);
                }
                
            }
        }
        return $feature;
    }

    //get features
    public static function getFeatures() {

         $feature = Feature::orderBy('created_at','desc')->get();
         return $feature;
    }

    public function FeatureAttributes(){
          return $this->hasMany('App\Models\FeatureAttribute');
    }
}
