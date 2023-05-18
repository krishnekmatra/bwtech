<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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
			'email' => ['required', 'string', 'email','admin_email_valid'],
			'password' => ['required', 'string'],
		];
	}
	public function messages() {

		return [
			 'email.admin_email_valid' => 'The email is not valid for this account.',
		];
	}
}
