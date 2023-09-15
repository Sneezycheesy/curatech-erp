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
        Schema::create('curatech_products_components', function (Blueprint $table) {
            $table->id();
            $table->string('curatech_product_id', 10);
            $table->foreign('curatech_product_id')->references('curatech_product_id')->on('curatech_products');
            $table->string('component_id', 8);
            $table->foreign('component_id')->references('component_id')->on('components');
            $table->string('curatech_product_component_position', 10); // Defines which component on the PCB it maps to (i.e. R54, C104)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curatech_products_components');
    }
};
