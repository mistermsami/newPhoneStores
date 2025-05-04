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
        Schema::create('rota', function (Blueprint $table) {
            $table->id('rota_id');
            $table->integer('user_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->string('date_assigned')->nullable();
            $table->string('rotavisit_image')->nullable();
            $table->string('rota_status')->default('not visited');
            // $table->string('rota_visit');
            // $table->string('rota_status');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city_id')->references('city_id')->on('cities')->onDelete('cascade');
            $table->foreign('region_id')->references('region_id')->on('regions')->onDelete('cascade');
            $table->foreign('address_id')->references('address_id')->on('addresses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rotas');
    }
};
