<?php

namespace App\Http\Requests\phoneRepairs;

use Illuminate\Foundation\Http\FormRequest;

class StorePhoneRepairRequest extends FormRequest
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
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'phone_name' => 'required',
			'repair_part_id' => 'required',
		];
	}
}
