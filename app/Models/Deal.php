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

    /* save deal into deals table */
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

    /*
        * fetch all deals
    */
    public static function getDeals(){
        return Deal::orderBy('created_at','desc')->get();
    }

    /*
        * use manay relationship
        * get product based on deal id
    */
    public function productDeals(){
        return $this->hasMany('App\Models\ProductDeal');
    }
   
}
