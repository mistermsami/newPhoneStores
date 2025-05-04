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
		Schema::create("repair_parts", function (Blueprint $table) {
			$table->increments("id");
			$table->foreignId("user_id")->constrained()->onDelete('cascade');
			$table->string("name");
			$table->timestamps();
		});

		Schema::create("phone_repairs", function (Blueprint $table) {
			$table->increments("id");
			$table->foreignId("user_id")->constrained()->onDelete('cascade');
			$table->unsignedInteger('repair_part_id');
			$table->foreign('repair_part_id')->references('id')->on('repair_parts')->onDelete('cascade');
			$table->string("phone_name");
			$table->string("description")->nullable();
			$table->string("status")->default("pending");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists("repair_parts");
		Schema::dropIfExists("phone_repairs");
	}
};
