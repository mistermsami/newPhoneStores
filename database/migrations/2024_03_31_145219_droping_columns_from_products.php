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
			$table->dropForeign(['unit_id']);
		});


		Schema::table('products', function (Blueprint $table) {
			$table->dropColumn(['code', 'buying_price', 'selling_price', 'quantity_alert', 'tax', 'tax_type', 'notes', 'unit_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('products', function (Blueprint $table) {
			$table->string('code')->after('id');
			$table->decimal('buying_price')->after('code');
			$table->decimal('selling_price')->after('buying_price');
			$table->integer('quantity_alert')->after('selling_price');
			$table->decimal('tax')->after('quantity_alert');
			$table->string('tax_type')->after('tax');
			$table->string('notes')->after('tax_type');
		});

		Schema::table('products', function (Blueprint $table) {
			$table->foreignId('unit_id')->after('notes')->constrained('units');
		});
	}
};
