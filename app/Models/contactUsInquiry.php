<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactUsInquiry extends Model
{
    use HasFactory;
     protected $fillable = [
        'email',
        'namespace',
        'description'
    ];
     public static function saveInquiry($request){
         
        $ContactUs = contactUsInquiry::create($request);
        return $ContactUs;
    }
}
