<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('images')->where('is_featured', true)->limit(8)->get();
        return view('web.home', compact('featuredProducts'));
    }
}
