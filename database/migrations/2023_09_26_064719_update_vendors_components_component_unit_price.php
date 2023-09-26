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
        Schema::table('vendors_components', function (Blueprint $table) {
            $table->decimal('component_unit_price', 20, 4)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('vendors_components', function (Blueprint $table) {
            $table->double('component_unit_price')->change();
        });
    }
};
