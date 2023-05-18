<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageRule implements Rule
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
        $explode_image = explode('product/',$value);
        if(isset($explode_image[1])){
           if (\File::exists(public_path('product/'.$explode_image[1]))) {
            return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Image name not exists in records..';
    }
}
