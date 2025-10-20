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
        // Eliminar tabla de verificación de licencias
        // No es necesaria para armas de airsoft y compresión
        Schema::dropIfExists('license_checks');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('license_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->enum('status', ['pending','approved','rejected'])->default('pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['status']);
        });
    }
};
