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
        Schema::table('restocks', function (Blueprint $table) {
            $table->unsignedInteger('amount');
            $table->string('invoice')->nullable();
            $table->unsignedBigInteger('component_id');
            $table->foreign('component_id')->references('id')->on('components');
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restocks', function (Blueprint $table) {
            $table->dropColumn('amount');
            $table->dropColumn('invoice');
            $table->dropColumn('component_id');
            $table->dropColumn('vendor_id');
        });
    }
};
