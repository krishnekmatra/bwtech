<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Occasions extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug'
    ];
    /* slag will be geanrated autonatic */

    public function setNameAttribute($value){
      $res = str_replace( array( '\'', '"',
      ',' , ';', '<', '>','/'), '-', $value);
      $this->attributes['name'] = $value;
      $this->attributes['slug'] = Str::slug($res);
    }
    /* save occassions */
    
     public static function saveOccasion($request) {
        
        if(isset($request['id'])){
            $id = $request['id'];
        }else{
            $id = 0;
        }
        $matchThese = ['id'=>$id];
        $deal = Occasions::updateOrCreate($matchThese,
            ['name' => $request['name']]
        );
        
        return $deal;
    }
    /*
        use mmany to many relationship

    */
     public function productOccasions(){
        return $this->hasMany('App\Models\ProductOccasion','occasion_id','id');
    }
}
