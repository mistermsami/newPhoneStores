<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
			// 'sku' => 'required|string',
			'item_type' => 'required|string',
			'bar_code' => 'required|string',
			'cost_price' => 'required|numeric',
			'whole_sale_price' => 'required|numeric',
			'sale_price' => 'required|numeric',
			'quantity' => 'required|numeric',
			// 'category' => 'required|string',
			// 'sub_category' => 'required|string',
			// 'description' => 'required|string',
			// 'price' => 'required|numeric',
			// 'quantity' => 'required|integer',
			// 'manufacturer' => 'required|string',
			// 'device' => 'required|string',
			// 'sku' => 'required|string',
			// 'upc_code' => '',
			// 'bar_code' => 'required|string',
			// 'valuation_method' => 'required|string',
			// 'new_stock_adjustment' => 'required|string',
			// 'new_inventory_item_cost' => 'required|numeric',
			// 'tax_class' => 'required|string',
			// 'tax_inclusive' => 'required|string',
			// 'retail_price' => 'required|string',
			// 'cost_price' => 'required|numeric',
			// 'sale_price' => 'required|numeric',
			// 'minimum_price' => 'required|numeric',
			// 'on_hand_quantity' => 'required|numeric',
			// 'stock_warning' => 'required|numeric',
			// 'reorder_level' => 'required|numeric',
			// 'manage_serialized' => 'required|string',
			// 'condition' => 'required|string',
			// 'supplier' => 'required|string',
			// 'physical_location' => 'required|numeric',
			// 'warranty' => 'required|numeric',
			// 'device' => 'integer',
			// 'warranty_time_frame' => 'required|string',
			// 'imei' => 'required|numeric',
			// 'display_pos' => 'required|string',
			// 'display_widget' => 'required|string',
			// 'comission_percentage' => 'nullable|numeric',
			// 'comission_amount' => 'nullable|numeric'
		];
	}

	// protected function prepareForValidation(): void
	// {
	//     $this->merge([
	//         'slug' => Str::slug($this->name, '-'),
	//         'code' =>
	//     ]);
	// }
}
