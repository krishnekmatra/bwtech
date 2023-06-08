<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOccasion extends Model
{
    use HasFactory;
     protected $fillable = [
        'product_id',
        'occasion_id'
    ];

    /* get product deatil */
     public function getProduct(){
         return $this->belongsTo('App\Models\Product', 'product_id','id');
    }
}
