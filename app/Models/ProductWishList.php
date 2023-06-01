<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWishList extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'client_id',
        'wishlist_id',
        'price',
        'margin_price'
    ];
     public function getProduct(){
         return $this->belongsTo('App\Models\Product', 'product_id','id');
    }
     public function productFeatures() {
        return $this->hasMany('App\Models\ProductFeture','product_id','product_id');
    }
}
