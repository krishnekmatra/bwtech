<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDeal extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'deal_id'
    ];

     public function getProduct(){
         return $this->belongsTo('App\Models\Product', 'product_id','id');
    }
}
