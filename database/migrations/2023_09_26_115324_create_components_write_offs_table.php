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
        Schema::create('components_write_offs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('component_id');
            $table->unsignedBigInteger('write_off_id');
            $table->unsignedBigInteger('new_stock');
            $table->timestamps();
        });

        Schema::table('write_offs', function (Blueprint $table) {
            $table->dropColumn('component_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components_write_offs');

        Schema::table('write_offs', function(Blueprint $table) {
            $table->unsignedBigInteger('component_id');
        });
    }
};
