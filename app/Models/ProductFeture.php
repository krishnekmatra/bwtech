<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeture extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'category_id',
        'sub_category_id',
        'features_id',
        'feature_attribute_id',
        'value'
    ];
}
