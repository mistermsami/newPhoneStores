<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'photo' => 'image|file|max:1024',
			'name' => 'required|string|max:50',
			'store_address' => 'required|string|max:50',
			'email' => 'required|email|max:50',
			'phone' => ['required', 'regex:/^(\+44)\d{10}$/'],
			// 'phone' => ['required', 'regex:/^(\+44|0)\d{10}$/'],
			'address' => 'required|string|max:100',
		];
	}
	public function messages(): array
	{
		return [
			'phone.regex' => 'The phone number must be a valid UK phone number.(start with +44 followed by 10 digits (+4479432xxxxx))',
		];
	}
}
