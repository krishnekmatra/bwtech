<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\SubCategory;

class SubCategoryRule implements Rule
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
        $SubCategory = SubCategory::where('name',$value)->first();

       if($SubCategory)
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
        return 'SubCategory name not exists in records..';
    }
}
