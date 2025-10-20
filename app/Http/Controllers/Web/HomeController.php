<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener productos destacados con imágenes
        $featuredProducts = Product::with('images', 'category')
            ->where('is_featured', true)
            ->where('status', 'active')
            ->limit(8)
            ->get();

        // Obtener categorías principales (sin parent_id)
        $categories = Category::whereNull('parent_id')
            ->withCount('products')
            ->get();

        // Obtener algunos productos recientes para mostrar variedad
        $recentProducts = Product::with('images', 'category')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        // Obtener categorías específicas para las secciones destacadas
        $vestuarioCategory = Category::withCount('products')->where('name', 'like', '%Vestuario%')->first();
        $cazaCategory = Category::withCount('products')->where('name', 'like', '%Caza%')->first();
        $campingCategory = Category::withCount('products')->where('name', 'like', '%Camping%')->orWhere('name', 'like', '%Trekking%')->first();

        // Obtener productos por categorías para las secciones
        $vestuarioProducts = Product::with('images', 'category')
            ->whereHas('category', function($query) {
                $query->where('name', 'like', '%Vestuario%')
                      ->orWhere('name', 'like', '%Teñidas%')
                      ->orWhere('name', 'like', '%Calzado%');
            })
            ->where('status', 'active')
            ->limit(3)
            ->get();

        $cazaProducts = Product::with('images', 'category')
            ->whereHas('category', function($query) {
                $query->where('name', 'like', '%Caza%');
            })
            ->where('status', 'active')
            ->limit(3)
            ->get();

        $campingProducts = Product::with('images', 'category')
            ->whereHas('category', function($query) {
                $query->where('name', 'like', '%Camping%')
                      ->orWhere('name', 'like', '%Trekking%');
            })
            ->where('status', 'active')
            ->limit(6)
            ->get();

        return view('web.home', compact('featuredProducts', 'categories', 'recentProducts', 'vestuarioCategory', 'cazaCategory', 'campingCategory', 'vestuarioProducts', 'cazaProducts', 'campingProducts'));
    }
}
