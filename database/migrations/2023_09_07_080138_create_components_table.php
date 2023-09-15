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
        Schema::create('components', function (Blueprint $table) {
            $table->string('component_id', 8)->primary();
            $table->text('description');
            $table->integer('courant');
            $table->double('unit_price');
            $table->integer('lt');
            $table->integer('vpe')->nullable();
            $table->string('feed', 2)->nullable();
            $table->integer('c_number')->nullable();
            $table->integer('stock')->nullable();
            $table->string('component_type');
            $table->double('component_value');
            $table->string('component_unit', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
