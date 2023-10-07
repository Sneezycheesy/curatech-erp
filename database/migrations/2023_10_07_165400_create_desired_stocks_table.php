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
        Schema::create('desired_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curatech_product_id');
            $table->unsignedInteger('amount_initial');
            $table->unsignedInteger('amount_made');
            $table->unsignedInteger('amount_to_make');
            $table->date('start_date')->default(now());
            $table->date('expiration_date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desired_stocks');
    }
};
