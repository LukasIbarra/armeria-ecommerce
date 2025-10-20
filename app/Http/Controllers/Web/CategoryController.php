<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
            ->whereHas('products', function ($query) {
                $query->active()->inStock();
            })
            ->get();

        return view('web.categories.index', compact('categories'));
    }

    public function show(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $query = Product::with(['category', 'images', 'mainImage'])
            ->where('category_id', $category->id)
            ->active()
            ->inStock();

        // Búsqueda dentro de la categoría
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

        // Obtener rangos de precios para esta categoría
        $priceRanges = [
            'min' => Product::where('category_id', $category->id)->active()->inStock()->min('price'),
            'max' => Product::where('category_id', $category->id)->active()->inStock()->max('price'),
        ];

        return view('web.categories.show', compact(
            'category',
            'products',
            'priceRanges'
        ));
    }
}
