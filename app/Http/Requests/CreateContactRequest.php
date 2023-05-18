<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\AdminLoginRequest;

class CreateContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => "required",
            'email' => "required|string|email",
            'description' => 'required'
        ];
    }
     public function messages() {

        return [
            'name.required' => 'Please enter your name.',
            'description.required' => 'Please enter your description.',
            'email.required' => 'Please enter your email.',
        ];
    }
    
}
