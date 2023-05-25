<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureAttribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'feature_id'
    ];
     public function featuresName(){
        return $this->belongsTo('App\Models\Feature', 'feature_id','id');
    }

}
