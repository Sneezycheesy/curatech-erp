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
        Schema::table('components', function (Blueprint $table) {
            //
            $table->renameColumn('lt', 'time_to_delivery');
            $table->unsignedInteger('package_size')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('components', function (Blueprint $table) {
            //
            $table->renameColumn('time_to_delivery', 'lt');
            $table->dropColumn('package_size');
        });
    }
};
