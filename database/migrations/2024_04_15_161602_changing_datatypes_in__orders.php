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
		Schema::table('orders', function (Blueprint $table) {
			$table->float('sub_total')->change();
			$table->float('vat')->change();
			$table->float('due')->change();
			$table->float('total')->change();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('orders', function (Blueprint $table) {
			$table->integer('sub_total')->change();
			$table->integer('vat')->change();
			$table->integer('due')->change();
			$table->integer('total')->change();
		});
	}
};
