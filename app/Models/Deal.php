<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public static function saveDeal($request) {
        
        if(isset($request['id'])){
            $id = $request['id'];
        }else{
            $id = 0;
        }
        $matchThese = ['id'=>$id];
        $deal = Deal::updateOrCreate($matchThese,
            ['name' => $request['name']]
        );
        
        return $deal;
    }

    public static function getDeals(){
        return Deal::orderBy('created_at','desc')->get();
    }

    public function productDeals(){
        return $this->hasMany('App\Models\ProductDeal');
    }
   
}
