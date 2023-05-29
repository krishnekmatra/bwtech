<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateVendorRequest extends FormRequest
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
		        $user_id = request()->id;

	   return [

			'email' => "required|email|string|max:255|unique:users,email,$user_id",
			'name' => "required|string|max:255",
			'phone' => "required|digits:10|numeric|unique:users,phone,$user_id",
			//'company_name' => "required|string|max:255|unique:users,company_name,$user_id",
		];

	}
}
