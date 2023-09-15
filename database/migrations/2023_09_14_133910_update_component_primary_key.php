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
        //
        Schema::dropIfExists('vendors_components');
        Schema::dropIfExists('manufacturers_components');
        Schema::dropIfExists('manufacturers');

        Schema::dropIfExists('curatech_products_components');
        Schema::dropIfExists('components');

        Schema::create('components', function(Blueprint $table) {
            $table->id();
            $table->string('component_id', 10)->unique();
            $table->text('description');
            $table->integer('courant');
            $table->double('unit_price');
            $table->integer('lt')->nullable();
            $table->integer('stock')->nullable();
            $table->timestamps();
        });

        
        Schema::create('curatech_products_components', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curatech_product_id');
            $table->foreign('curatech_product_id')->references('id')->on('curatech_products');
            $table->unsignedBigInteger('component_id');
            $table->foreign('component_id')->references('id')->on('components');
            $table->string('curatech_product_component_position', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('vendors_components');
        Schema::dropIfExists('manufacturers_components');
        Schema::dropIfExists('manufacturers');

        Schema::dropIfExists('curatech_products_components');
        Schema::dropIfExists('components');

        Schema::create('components', function(Blueprint $table) {
            $table->id();
            $table->string('component_id', 10)->unique();
            $table->text('description');
            $table->integer('courant');
            $table->double('unit_price');
            $table->integer('lt')->nullable();
            $table->integer('stock')->nullable();
        });

        
        Schema::create('curatech_products_components', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curatech_product_id');
            $table->foreign('curatech_product_id')->references('id')->on('curatech_products');
            $table->string('component_id', 10);
            $table->foreign('component_id')->references('component_id')->on('components');
            $table->string('curatech_product_component_position', 10)->nullable();
            $table->timestamps();
        });
    }
};
