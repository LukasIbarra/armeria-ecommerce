<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images', 'mainImage'])
            ->active()
            ->inStock();

        // Filtro por categoría
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Búsqueda por nombre o descripción
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filtro por precio mínimo
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        // Filtro por precio máximo
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Filtro por productos destacados
        if ($request->filled('featured') && $request->featured == '1') {
            $query->featured();
        }

        // Ordenamiento
        $sortBy = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');

        switch ($sortBy) {
            case 'price':
                $query->orderBy('price', $sortOrder);
                break;
            case 'name':
                $query->orderBy('name', $sortOrder);
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'featured':
                $query->orderBy('is_featured', 'desc')->orderBy('name', 'asc');
                break;
            default:
                $query->orderBy('name', 'asc');
        }

        // Paginación
        $products = $query->paginate(12)->withQueryString();

        // Obtener todas las categorías para el filtro
        $categories = Category::withCount('products')->get();

        // Obtener rangos de precios para filtros
        $priceRanges = [
            'min' => Product::active()->inStock()->min('price'),
            'max' => Product::active()->inStock()->max('price'),
        ];

        return view('web.products.index', compact(
            'products',
            'categories',
            'priceRanges'
        ));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'images', 'variants'])
            ->where('slug', $slug)
            ->active()
            ->inStock()
            ->firstOrFail();

        // Productos relacionados (misma categoría, excluyendo el actual)
        $relatedProducts = Product::with(['category', 'mainImage'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->inStock()
            ->limit(4)
            ->get();

        return view('web.products.show', compact('product', 'relatedProducts'));
    }
}
