<?php

namespace App\Http\Requests\Product;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
			'product_image' => 'image|file|max:2048',
			'name' => 'required|string',
			'cost_price' => 'required|numeric',
			'sale_price' => 'required|numeric',
			'whole_sale_price' => 'required|numeric',
			'quantity' => 'required|numeric',
			// 'sku' => 'required|string',
			'item_type' => 'required|string',
			'bar_code' => 'required|string',
			// 'category' => 'required|string',
			// 'sub_category' => 'required|string',
			// 'description' => 'required|string',
			// 'quantity' => 'required|integer',
		];

	}

}
