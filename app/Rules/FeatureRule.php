<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\FeatureAttribute;

class FeatureRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $brand = FeatureAttribute::where('name',$value)->first();

       if($brand)
        return true;
        else
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Brand name not exists in records..';
    }
}
