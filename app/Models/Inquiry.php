<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
     protected $fillable = [
        'product_id',
        'quantity',
        'client_id',
        'vendor_id',
        'enquiry',
        'min',
        'max',
        'delivery_date',
        'prefered_brand',
        'prefered_category',
        'type'
    ];

   public function product(){
     return $this->belongsTo('App\Models\Product', 'product_id','id');
   }

    public function customer(){
     return $this->belongsTo('App\Models\User', 'client_id','id');
   }
}
