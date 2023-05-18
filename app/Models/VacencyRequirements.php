<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacencyRequirements extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'description',
        'number',
        'email'
    ];

     public static function saveResume($request){
        
        $vacency = VacencyRequirements::create($request);
        return $vacency;
    }
}
