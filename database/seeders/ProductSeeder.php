<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $this->command->info('🚀 Iniciando importación de productos...');

        // Función para extraer precio del nombre del archivo
        $extractPrice = function($filename) {
            // Buscar patrones como $10mil, $10,000, $10000
            if (preg_match('/\$(\d+(?:[,.]?\d+)*)\s*(?:mil)?/i', $filename, $matches)) {
                $price = str_replace([',', '.'], '', $matches[1]);
                
                // Si tiene "mil" al final, multiplicar por 1000
                if (stripos($filename, 'mil') !== false) {
                    return (int)$price * 1000;
                }
                
                return (int)$price;
            }
            
            // Precio por defecto si no se encuentra
            return rand(15000, 80000);
        };

        // Función para limpiar nombre del producto
        $cleanProductName = function($filename) {
            // Remover extensión
            $name = preg_replace('/\.(jpg|jpeg|png|gif|webp)$/i', '', $filename);
            
            // Remover precio del nombre
            $name = preg_replace('/\$\d+(?:[,.]?\d+)*\s*(?:mil)?/i', '', $name);
            
            // Remover archivos temporales de Mac
            $name = preg_replace('/^\._/', '', $name);
            
            // Reemplazar guiones y guiones bajos por espacios
            $name = str_replace(['_', '-'], ' ', $name);
            
            // Limpiar espacios múltiples
            $name = preg_replace('/\s+/', ' ', $name);
            
            // Capitalizar primera letra de cada palabra
            $name = ucwords(strtolower(trim($name)));
            
            return $name;
        };

        // Función para generar descripción basada en el nombre y categoría
        $generateDescription = function($productName, $categoryName) {
            $descriptions = [
                'Airsoft' => "Réplica de airsoft de alta calidad. {$productName} ideal para juegos tácticos y simulación militar. Fabricado con materiales resistentes y acabados profesionales.",
                'Armamento Traumatico y Defensa' => "Arma traumática {$productName} para defensa personal. Cumple con todas las normativas vigentes. Ideal para seguridad personal y profesional.",
                'Caza' => "Equipamiento de caza {$productName}. Diseñado para cazadores exigentes que buscan calidad y durabilidad en sus actividades deportivas.",
                'Accesorios' => "Accesorio táctico {$productName}. Compatible con múltiples sistemas y plataformas. Fabricado con materiales de primera calidad.",
                'Camping Trekking' => "Equipo para camping y trekking {$productName}. Resistente y funcional para tus aventuras al aire libre.",
                'Guardias Seguridad' => "Equipamiento profesional {$productName} para guardias de seguridad. Cumple con estándares profesionales de la industria.",
                'Tenidas y Calzado' => "Indumentaria táctica {$productName}. Confeccionado con materiales de alta resistencia y comodidad para uso prolongado.",
            ];

            return $descriptions[$categoryName] ?? "Producto de alta calidad {$productName}. Ideal para uso profesional y recreativo.";
        };

        $totalProducts = 0;
        $categories = Category::all();

        foreach ($categories as $category) {
            $categoryPath = "tienda/{$category->name}";
            
            if (!Storage::disk('public')->exists($categoryPath)) {
                $this->command->warn("⚠️  Carpeta no encontrada: {$categoryPath}");
                continue;
            }

            $files = Storage::disk('public')->files($categoryPath);
            
            if (empty($files)) {
                $this->command->warn("⚠️  No hay archivos en: {$categoryPath}");
                continue;
            }

            $fileCount = count($files);
            $this->command->info("📁 Procesando categoría: {$category->name} ({$fileCount} archivos)");
            $productsInCategory = 0;

            foreach ($files as $file) {
                $filename = basename($file);
                
                // Saltar archivos del sistema y archivos temporales de Mac
                if (str_starts_with($filename, '.') || str_starts_with($filename, '._')) {
                    continue;
                }

                // Saltar archivos que no sean imágenes
                if (!preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $filename)) {
                    continue;
                }

                $productName = $cleanProductName($filename);
                
                // Saltar si el nombre está vacío después de limpiar
                if (empty($productName)) {
                    continue;
                }

                $price = $extractPrice($filename);
                $description = $generateDescription($productName, $category->name);

                // Generar SKU único
                $sku = 'ARM-' . strtoupper(substr($category->name, 0, 3)) . '-' . strtoupper(Str::random(6));

                try {
                    // Crear producto
                    $product = Product::create([
                        'category_id' => $category->id,
                        'name' => $productName,
                        'slug' => Str::slug($productName) . '-' . Str::random(4), // Agregar sufijo aleatorio para evitar duplicados
                        'description' => $description,
                        'price' => $price,
                        'stock' => rand(5, 50),
                        'status' => 'active',
                        'is_featured' => rand(1, 10) <= 3, // 30% de productos destacados
                        'sku' => $sku
                    ]);

                    // Crear imagen del producto
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $file,
                        'alt' => $productName,
                        'is_main' => true
                    ]);

                    $productsInCategory++;
                    $totalProducts++;

                } catch (\Exception $e) {
                    $this->command->error("❌ Error al crear producto {$productName}: " . $e->getMessage());
                }
            }

            $this->command->info("✅ {$productsInCategory} productos creados en {$category->name}");

            // Procesar subcategorías si existen
            $subcategories = Category::where('parent_id', $category->id)->get();
            foreach ($subcategories as $subcategory) {
                $subcategoryPath = "tienda/{$category->name}/{$subcategory->name}";

                if (!Storage::disk('public')->exists($subcategoryPath)) {
                    $this->command->warn("⚠️  Subcarpeta no encontrada: {$subcategoryPath}");
                    continue;
                }

                $subFiles = Storage::disk('public')->files($subcategoryPath);

                if (empty($subFiles)) {
                    $this->command->warn("⚠️  No hay archivos en subcategoría: {$subcategoryPath}");
                    continue;
                }

                $subFileCount = count($subFiles);
                $this->command->info("📁 Procesando subcategoría: {$subcategory->name} ({$subFileCount} archivos)");
                $productsInSubcategory = 0;

                foreach ($subFiles as $file) {
                    $filename = basename($file);

                    // Saltar archivos del sistema y archivos temporales de Mac
                    if (str_starts_with($filename, '.') || str_starts_with($filename, '._')) {
                        continue;
                    }

                    // Saltar archivos que no sean imágenes
                    if (!preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $filename)) {
                        continue;
                    }

                    $productName = $cleanProductName($filename);

                    // Saltar si el nombre está vacío después de limpiar
                    if (empty($productName)) {
                        continue;
                    }

                    $price = $extractPrice($filename);
                    $description = $generateDescription($productName, $subcategory->name);

                    // Generar SKU único
                    $sku = 'ARM-' . strtoupper(substr($subcategory->name, 0, 3)) . '-' . strtoupper(Str::random(6));

                    try {
                        // Crear producto en subcategoría
                        $product = Product::create([
                            'category_id' => $subcategory->id,
                            'name' => $productName,
                            'slug' => Str::slug($productName) . '-' . Str::random(4), // Agregar sufijo aleatorio para evitar duplicados
                            'description' => $description,
                            'price' => $price,
                            'stock' => rand(5, 50),
                            'status' => 'active',
                            'is_featured' => rand(1, 10) <= 3, // 30% de productos destacados
                            'sku' => $sku
                        ]);

                        // Crear imagen del producto
                        ProductImage::create([
                            'product_id' => $product->id,
                            'path' => $file,
                            'alt' => $productName,
                            'is_main' => true
                        ]);

                        $productsInSubcategory++;
                        $totalProducts++;

                    } catch (\Exception $e) {
                        $this->command->error("❌ Error al crear producto {$productName} en subcategoría: " . $e->getMessage());
                    }
                }

                $this->command->info("✅ {$productsInSubcategory} productos creados en subcategoría {$subcategory->name}");
            }
        }

        // Asegurar que haya suficientes productos destacados
        $featuredCount = Product::where('is_featured', true)->count();
        $minFeatured = 8;
        
        if ($featuredCount < $minFeatured) {
            $needed = $minFeatured - $featuredCount;
            $productsToFeature = Product::where('is_featured', false)
                ->inRandomOrder()
                ->limit($needed)
                ->get();
            
            foreach ($productsToFeature as $product) {
                $product->update(['is_featured' => true]);
            }
            
            $this->command->info("⭐ {$needed} productos adicionales marcados como destacados");
        }

        $this->command->info("🎉 ¡Importación completada! Total de productos creados: {$totalProducts}");
    }
}
