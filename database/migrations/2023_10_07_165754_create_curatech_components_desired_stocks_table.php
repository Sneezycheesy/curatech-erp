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
        Schema::create('curatech_components_desired_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curatech_component_id');
            $table->unsignedBigInteger('desired_stock_id');
            $table->unsignedInteger('amount_initial');
            $table->unsignedInteger('amount_made');
            $table->unsignedInteger('amount_to_make');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curatech_components_desired_stocks');
    }
};
