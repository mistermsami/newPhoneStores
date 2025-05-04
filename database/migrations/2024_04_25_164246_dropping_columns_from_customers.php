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
		Schema::table('customers', function (Blueprint $table) {
			$table->dropColumn('account_holder');
			$table->dropColumn('account_number');
			$table->dropColumn('bank_name');
			$table->string('store_address')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('customers', function (Blueprint $table) {
			$table->string('account_holder')->nullable();
			$table->string('account_number')->nullable();
			$table->string('bank_name')->nullable();
			$table->dropColumn('store_address');
		});
	}
};
