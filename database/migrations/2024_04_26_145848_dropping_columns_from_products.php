<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::table('products', function (Blueprint $table) {
			$table->dropColumn([
				'manufacturer',
				'device',
				'sku',
				'upc_code',
				'is_barcode',
				'valuation_method',
				'new_stock_adjustment',
				'new_inventory_item_cost',
				'tax_class',
				'tax_inclusive',
				'retail_price',
				'cost_price',
				'sale_price',
				'minimum_price',
				'on_hand_quantity',
				'stock_warning',
				're_order_level',
				'manage_serialized',
				'condition',
				'supplier',
				'physical_location',
				'warranty',
				'warranty_time_frame',
				'imei',
				'display_on_point_of_sale',
				'display_on_widget',
				'comission_percentage',
				'comission_amount'
			]);
			$table->float('price')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('products', function (Blueprint $table) {
			$table->string('manufacturer')->nullable();
			$table->string('device')->nullable();
			$table->string('sku')->nullable();
			$table->string('upc_code')->nullable();
			$table->string('is_barcode')->nullable();
			$table->string('valuation_method')->nullable();
			$table->string('new_stock_adjustment')->nullable();
			$table->string('new_inventory_item_cost')->nullable();
			$table->string('tax_class')->nullable();
			$table->string('tax_inclusive')->nullable();
			$table->string('retail_price')->nullable();
			$table->string('cost_price')->nullable();
			$table->string('sale_price')->nullable();
			$table->string('minimum_price')->nullable();
			$table->string('on_hand_quantity')->nullable();
			$table->string('stock_warning')->nullable();
			$table->string('re_order_level')->nullable();
			$table->string('manage_serialized')->nullable();
			$table->string('condition')->nullable();
			$table->string('supplier')->nullable();
			$table->string('physical_location')->nullable();
			$table->string('warranty')->nullable();
			$table->string('warranty_time_frame')->nullable();
			$table->string('imei')->nullable();
			$table->string('display_on_point_of_sale')->nullable();
			$table->string('display_on_widget')->nullable();
			$table->string('commission_percentage')->nullable();
			$table->string('commision_amount')->nullable();
			$table->dropColumn('price');
		});
	}
};
