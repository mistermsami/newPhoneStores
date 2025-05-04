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
			$table->string('product_description')->nullable()->default('');
			$table->string('manufacturer')->default('');
			$table->string('device')->default('');
			$table->string('sku')->nullable()->default('');
			$table->string('upc_code')->nullable()->default('');
			$table->boolean('is_barcode')->default(false);
			$table->string('valuation_method')->default('');
			$table->string('new_stock_adjustment')->nullable()->default('');
			$table->decimal('new_inventory_item_cost', 10, 2)->nullable();
			$table->string('tax_class')->nullable()->default('');
			$table->boolean('tax_inclusive')->default(false);
			$table->decimal('retail_price', 10, 2)->default(0.00);
			$table->decimal('cost_price', 10, 2)->default(0.00);
			$table->decimal('sale_price', 10, 2)->default(0.00);
			$table->decimal('minimum_price', 10, 2)->default(0.00);
			$table->decimal('on_hand_quantity', 10, 2)->default(0.00);
			$table->decimal('stock_warning', 10, 2)->default(0.00);
			$table->decimal('re_order_level', 10, 2)->default(0.00);
			$table->string('manage_serialized')->nullable()->default('');
			$table->string('condition')->nullable()->default('');
			$table->string('supplier')->nullable()->default('');
			$table->string('physical_location')->nullable()->default('');
			$table->decimal('warranty', 10, 2)->default(0.00);
			$table->string('warranty_time_frame')->nullable()->default('');
			$table->string('imei')->nullable()->default('');
			$table->string('display_on_point_of_sale')->nullable()->default('');
			$table->string('display_on_widget')->nullable()->default('');
			$table->float('comission_percentage')->default(0.00);
			$table->decimal('comission_amount', 10, 2)->default(0.00);
		});

		Schema::create('sub_categories', function (Blueprint $table) {
			$table->id();
			$table->string('sub_category_name');
			$table->unsignedBigInteger('category_id');
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
			$table->timestamps();
		});



	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::table('products', function (Blueprint $table) {
			$table->dropColumn([
				'product_description',
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
				'commission_percentage',
				'commission_amount',
			]);
		});

		Schema::dropIfExists('sub_categories');
	}
};
