<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
		Schema::table('products', function (Blueprint $table) {
			$table->dropForeign(['category_id']);
			$table->dropForeign(['device_id']);
			$table->dropForeign(['sub_category']);
			$table->dropColumn(['category_id', 'sub_category', 'product_description', 'price', 'quantity', 'slug', 'device_id']);

			$table->float('cost_price', 8, 2);
			$table->float('whole_sale_price', 8, 2);
			$table->float('sale_price', 8, 2);
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
