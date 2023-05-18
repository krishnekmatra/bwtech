<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
     protected $fillable = [
        'title',
        'description'

    ];
     public static function getFaq() {

         $feature = Faq::orderBy('created_at','desc');
         return $feature;
    }
     public static function saveFaq($request){
         if(isset($request['id'])){
            $id = $request['id'];
        }else{
            $id = 0;
        }
        $matchThese = ['id'=>$id];
       
        $banner = Faq::updateOrCreate($matchThese,$request);
        return $banner;
    }
}
