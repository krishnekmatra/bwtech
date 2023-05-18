<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_link',
        'image',
        'type',
        'sorting'
    ];

    public static function getBanners() {

         $banner = Banner::orderBy('created_at','desc')->get();
         return $banner;
    }

    //save banner
    public static function saveBanner($request){
         if(isset($request['id'])){
            $id = $request['id'];
        }else{
            $id = 0;
        }
        $matchThese = ['id'=>$id];
       
        $banner = Banner::updateOrCreate($matchThese,$request);
        return $banner;
    }
}
