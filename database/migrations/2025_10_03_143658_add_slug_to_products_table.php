<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Agregar campo slug para URLs amigables
            $table->string('slug')->unique()->after('name');
        });

        // Generar slugs para productos existentes
        Product::chunk(100, function ($products) {
            foreach ($products as $product) {
                $slug = Str::slug($product->name);
                $count = 1;
                $originalSlug = $slug;
                
                // Asegurar que el slug sea único
                while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }
                
                $product->slug = $slug;
                $product->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
