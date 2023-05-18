<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
     protected $fillable = [
        'email'
    ];

     public static function saveSubscribe($request){
        
        $Subscribe = Subscription::create($request);
        return $Subscribe;
    }
}
