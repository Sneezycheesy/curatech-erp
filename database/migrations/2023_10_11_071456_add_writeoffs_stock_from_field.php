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
            //
            $table->enum('stock_from', ['STOCKROOM', 'MACHINE'])->default('STOCKROOM');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('write_offs', function (Blueprint $table) {
            //
            $table->dropColumn('stock_from');
        });
    }
};
