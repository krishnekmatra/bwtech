<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRfqRequest extends FormRequest
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

            'enquiry' => "required|string|max:255",
            'min' => "required|numeric",
            'max' => "required|numeric",
            'quantity' => "required",
        ];

    }

    public function messages() {

        return [
             'enquiry.required' => 'Please Enter Your Enquiry',
             'min.required' => 'Please Enter minimum value',
             'max.required' => 'Please Enter maximum value',
             'quantity.required' => 'Please Enter Your Quantity',
        ];
    }
}
