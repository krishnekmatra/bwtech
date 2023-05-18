<?php

namespace App\Http\Requests\admin\vendor;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;


class VendorStoreRequest extends FormRequest
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
            'email' => 'required|email|string|unique:users|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10|numeric|unique:users,phone',
            'company_name' => 'required|string|unique:users,company_name|max:255',
        ];
    }
}
