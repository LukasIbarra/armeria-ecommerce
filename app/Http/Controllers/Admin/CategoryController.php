<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Filtros
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $categories = $query->withCount('products')->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Asegurar unicidad del slug
        $originalSlug = $data['slug'];
        $count = 1;
        while (Category::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        Category::create($data);

        return response()->json(['success' => true, 'message' => 'Categoría creada exitosamente.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->loadCount('products');

        return response()->json([
            'name' => $category->name,
            'description' => $category->description,
            'status' => $category->status,
            'products_count' => $category->products_count,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json([
            'name' => $category->name,
            'description' => $category->description,
            'status' => $category->status,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Asegurar unicidad del slug
        $originalSlug = $data['slug'];
        $count = 1;
        while (Category::where('slug', $data['slug'])->where('id', '!=', $category->id)->exists()) {
            $data['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        $category->update($data);

        return response()->json(['success' => true, 'message' => 'Categoría actualizada exitosamente.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Verificar si la categoría tiene productos asociados
        if ($category->products()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar la categoría porque tiene productos asociados.'
            ], 422);
        }

        $category->delete();

        return response()->json(['success' => true, 'message' => 'Categoría eliminada exitosamente.']);
    }
}
