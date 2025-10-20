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
        Schema::table('products', function (Blueprint $table) {
            // Eliminar campos relacionados con licencias
            // Las armas de airsoft y compresión NO requieren licencia
            $table->dropColumn(['is_restricted', 'requires_license']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_restricted')->default(false);
            $table->boolean('requires_license')->default(false);
        });
    }
};
