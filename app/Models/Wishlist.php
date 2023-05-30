<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'client_id',
        'margin_type',
        'margin_value',
    ];

    public function ProductWishList(){
        return $this->hasMany('App\Models\ProductWishList');
    }

}
