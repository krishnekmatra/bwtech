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
    /* get all faq */
     public static function getFaq() {

         $feature = Faq::orderBy('created_at','desc');
         return $feature;
    }

    /* save faq
        * crete if id not avilable
        * if id avilable then update 
    */
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
