<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('gateway'); // flow | mercadopago | otro
            $table->string('gateway_id')->nullable(); // id devuelta por la pasarela
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending','approved','rejected','refunded'])->default('pending');
            $table->json('payload')->nullable();
            $table->timestamps();

            $table->index(['gateway','status']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('payments');
    }
};
