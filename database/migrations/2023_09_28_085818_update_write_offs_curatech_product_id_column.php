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
        Schema::table('write_offs', function (Blueprint $table) {
            $table->unsignedBigInteger('curatech_product_id')->nullable()->change();
            $table->dropColumn('new_stock');
            $table->unsignedBigInteger('component_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('write_offs', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('curatech_product_id')->nullable(false)->change();
            $table->dropColumn('component_id');
        });
    }
};
