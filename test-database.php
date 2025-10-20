<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "========================================\n";
echo "   TESTING COMPLETO - BASE DE DATOS\n";
echo "========================================\n\n";

// Test 1: Conteo de registros
echo "📊 TEST 1: Conteo de Registros\n";
echo "--------------------------------\n";
$productCount = App\Models\Product::count();
$categoryCount = App\Models\Category::count();
$featuredCount = App\Models\Product::where('is_featured', true)->count();
$imageCount = App\Models\ProductImage::count();

echo "✅ Total Productos: {$productCount}\n";
echo "✅ Total Categorías: {$categoryCount}\n";
echo "✅ Productos Destacados: {$featuredCount}\n";
echo "✅ Total Imágenes: {$imageCount}\n\n";

// Test 2: Verificar relaciones
echo "🔗 TEST 2: Relaciones entre Modelos\n";
echo "--------------------------------\n";
$product = App\Models\Product::with('category', 'images')->first();
if ($product) {
    echo "✅ Producto: {$product->name}\n";
    echo "✅ Categoría: {$product->category->name}\n";
    echo "✅ Precio: \${$product->price} CLP\n";
    echo "✅ Slug: {$product->slug}\n";
    echo "✅ Imágenes asociadas: {$product->images->count()}\n";
    echo "✅ Stock: {$product->stock}\n\n";
} else {
    echo "❌ No se encontraron productos\n\n";
}

// Test 3: Verificar categorías con productos
echo "📁 TEST 3: Categorías con Productos\n";
echo "--------------------------------\n";
$categories = App\Models\Category::withCount('products')->get();
foreach ($categories as $category) {
    $status = $category->products_count > 0 ? '✅' : '⚠️';
    echo "{$status} {$category->name}: {$category->products_count} productos\n";
}
echo "\n";

// Test 4: Verificar slugs únicos
echo "🔑 TEST 4: Verificar Slugs Únicos\n";
echo "--------------------------------\n";
$duplicateSlugs = App\Models\Product::select('slug')
    ->groupBy('slug')
    ->havingRaw('COUNT(*) > 1')
    ->pluck('slug');

if ($duplicateSlugs->isEmpty()) {
    echo "✅ Todos los slugs son únicos\n\n";
} else {
    echo "⚠️ Se encontraron {$duplicateSlugs->count()} slugs duplicados:\n";
    foreach ($duplicateSlugs as $slug) {
        echo "   - {$slug}\n";
    }
    echo "\n";
}

// Test 5: Verificar imágenes
echo "🖼️ TEST 5: Verificar Rutas de Imágenes\n";
echo "--------------------------------\n";
$sampleImages = App\Models\ProductImage::take(5)->get();
$validImages = 0;
$invalidImages = 0;

foreach ($sampleImages as $image) {
    $fullPath = storage_path('app/public/' . $image->path);
    if (file_exists($fullPath)) {
        $validImages++;
    } else {
        $invalidImages++;
        echo "⚠️ Imagen no encontrada: {$image->path}\n";
    }
}

echo "✅ Imágenes válidas (muestra): {$validImages}/5\n";
if ($invalidImages > 0) {
    echo "⚠️ Imágenes inválidas: {$invalidImages}/5\n";
}
echo "\n";

// Test 6: Verificar precios
echo "💰 TEST 6: Verificar Rangos de Precios\n";
echo "--------------------------------\n";
$minPrice = App\Models\Product::min('price');
$maxPrice = App\Models\Product::max('price');
$avgPrice = App\Models\Product::avg('price');

echo "✅ Precio mínimo: \$" . number_format($minPrice, 0, ',', '.') . " CLP\n";
echo "✅ Precio máximo: \$" . number_format($maxPrice, 0, ',', '.') . " CLP\n";
echo "✅ Precio promedio: \$" . number_format($avgPrice, 0, ',', '.') . " CLP\n\n";

// Test 7: Verificar stock
echo "📦 TEST 7: Verificar Stock\n";
echo "--------------------------------\n";
$inStock = App\Models\Product::where('stock', '>', 0)->count();
$outOfStock = App\Models\Product::where('stock', '=', 0)->count();

echo "✅ Productos en stock: {$inStock}\n";
echo "✅ Productos sin stock: {$outOfStock}\n\n";

// Test 8: Verificar usuarios
echo "👤 TEST 8: Verificar Usuarios\n";
echo "--------------------------------\n";
$users = App\Models\User::all();
foreach ($users as $user) {
    echo "✅ Usuario: {$user->name} ({$user->email})\n";
}
echo "\n";

// Test 9: Performance - Consulta con relaciones
echo "⚡ TEST 9: Performance - Consulta con Relaciones\n";
echo "--------------------------------\n";
$start = microtime(true);
$products = App\Models\Product::with('category', 'images')->take(50)->get();
$end = microtime(true);
$time = round(($end - $start) * 1000, 2);

echo "✅ Consulta de 50 productos con relaciones: {$time}ms\n";
if ($time < 100) {
    echo "✅ Performance: Excelente\n";
} elseif ($time < 500) {
    echo "⚠️ Performance: Aceptable\n";
} else {
    echo "❌ Performance: Necesita optimización\n";
}
echo "\n";

// Test 10: Verificar scopes
echo "🔍 TEST 10: Verificar Scopes del Modelo\n";
echo "--------------------------------\n";
$activeProducts = App\Models\Product::active()->count();
$featuredProducts = App\Models\Product::featured()->count();
$inStockProducts = App\Models\Product::inStock()->count();

echo "✅ Productos activos (scope): {$activeProducts}\n";
echo "✅ Productos destacados (scope): {$featuredProducts}\n";
echo "✅ Productos en stock (scope): {$inStockProducts}\n\n";

echo "========================================\n";
echo "   TESTING COMPLETADO\n";
echo "========================================\n";
