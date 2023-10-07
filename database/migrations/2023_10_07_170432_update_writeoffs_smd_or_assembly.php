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
            $table->enum('production_step', ['SMD', 'ASSEMBLY']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('write_offs', function (Blueprint $table) {
            //
            $table->dropColumn('production_step');
        });
    }
};
