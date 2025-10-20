<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('path'); // ruta/URL de la imagen
            $table->boolean('is_main')->default(false);
            $table->string('alt')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_images');
    }
};
