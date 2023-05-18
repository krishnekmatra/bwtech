<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
     protected $fillable = [
        'email',
        'phone',
        'address',
        'description'
    ];

    public static function saveContact($request){
         if(isset($request['id'])){
            $id = $request['id'];
        }else{
            $id = 0;
        }
        $matchThese = ['id'=>$id];
        $ContactUs = ContactUs::updateOrCreate($matchThese,$request);
        return $ContactUs;
    }
}
