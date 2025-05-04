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

		Schema::create('expense_categories', function (Blueprint $table) {
			$table->id();
			$table->foreignId("user_id")->constrained()->onDelete('cascade');
			$table->string('expenses_category_name')->nullable();
			$table->string('slug')->nullable();
			$table->timestamps();
		});

		Schema::create('expenses', function (Blueprint $table) {
			$table->id();
			$table->foreignId("user_id")->constrained()->onDelete('cascade');
			$table->unsignedBigInteger('expenses_category_id');
			$table->foreign('expenses_category_id')->references('id')->on('expense_categories')->onDelete('cascade');
			$table->string('expenses_name')->nullable();
			$table->string('expenses_date')->nullable();
			$table->integer('expenses_amount')->nullable();
			$table->string('expenses_notes')->nullable();
			$table->string('slug')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('expenses');
		Schema::dropIfExists('expense_categories');
	}
};
