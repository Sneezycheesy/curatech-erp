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
        Schema::table('curatech_products', function (Blueprint $table) {
            $table->integer('stock');
            $table->integer('stock_desired');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('curatech_products', function (Blueprint $table) {
            $table->dropColumn(['stock', 'stock_desired']);
        });
    }
};
