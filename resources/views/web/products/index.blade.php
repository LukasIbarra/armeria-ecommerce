@extends('web.layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-red-600 to-red-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Nuestros Productos</h1>
                <p class="text-xl md:text-2xl mb-8">Descubre nuestra amplia gama de productos de calidad</p>

                <!-- Search Bar -->
                <div class="max-w-md mx-auto">
                    <form method="GET" action="{{ route('web.product.index') }}" class="flex gap-2">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Buscar productos..."
                               class="flex-1 px-4 py-2 rounded-l-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-300">
                        <button type="submit"
                                class="bg-white text-red-600 px-6 py-2 rounded-r-lg hover:bg-gray-100 transition-colors font-semibold">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filtros -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Filtros</h3>

                    <form method="GET" action="{{ route('web.product.index') }}" id="filterForm">
                        <!-- Categorías -->
                        <div class="mb-6">
                            <h4 class="font-medium mb-3 text-gray-700">Categorías</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio"
                                           name="category"
                                           value=""
                                           {{ !request('category') ? 'checked' : '' }}
                                           class="mr-2">
                                    <span class="text-sm">Todas las categorías</span>
                                </label>
                                @foreach($categories as $category)
                                    <label class="flex items-center">
                                        <input type="radio"
                                               name="category"
                                               value="{{ $category->id }}"
                                               {{ request('category') == $category->id ? 'checked' : '' }}
                                               class="mr-2">
                                        <span class="text-sm">{{ $category->name }} ({{ $category->products_count }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Rango de Precios -->
                        <div class="mb-6">
                            <h4 class="font-medium mb-3 text-gray-700">Rango de Precios</h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm text-gray-600 mb-1">Precio mínimo</label>
                                    <input type="number"
                                           name="price_min"
                                           value="{{ request('price_min') }}"
                                           min="{{ $priceRanges['min'] ?? 0 }}"
                                           max="{{ $priceRanges['max'] ?? 100000 }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-600 mb-1">Precio máximo</label>
                                    <input type="number"
                                           name="price_max"
                                           value="{{ request('price_max') }}"
                                           min="{{ $priceRanges['min'] ?? 0 }}"
                                           max="{{ $priceRanges['max'] ?? 100000 }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500">
                                </div>
                            </div>
                        </div>

                        <!-- Productos Destacados -->
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox"
                                       name="featured"
                                       value="1"
                                       {{ request('featured') == '1' ? 'checked' : '' }}
                                       class="mr-2">
                                <span class="text-sm">Solo productos destacados</span>
                            </label>
                        </div>

                        <!-- Botones -->
                        <div class="space-y-2">
                            <button type="submit"
                                    class="w-full bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 transition-colors font-medium">
                                Aplicar Filtros
                            </button>
                            <a href="{{ route('web.product.index') }}"
                               class="block w-full bg-gray-200 text-gray-800 py-2 px-4 rounded hover:bg-gray-300 transition-colors text-center font-medium">
                                Limpiar Filtros
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contenido Principal -->
            <div class="lg:w-3/4">
                <!-- Header con Ordenamiento -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            @if(request('search'))
                                Resultados para "{{ request('search') }}"
                            @elseif(request('category'))
                                @php
                                    $categoryName = $categories->where('id', request('category'))->first()->name ?? 'Categoría';
                                @endphp
                                Productos de {{ $categoryName }}
                            @else
                                Todos los Productos
                            @endif
                        </h2>
                        <p class="text-gray-600 mt-1">{{ $products->total() }} productos encontrados</p>
                    </div>

                    <!-- Ordenamiento -->
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-600">Ordenar por:</span>
                        <select name="sort"
                                form="filterForm"
                                onchange="document.getElementById('filterForm').submit()"
                                class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500 text-sm">
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nombre A-Z</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Precio menor a mayor</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Más recientes</option>
                            <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Destacados primero</option>
                        </select>
                    </div>
                </div>

                <!-- Productos -->
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>

                    <!-- Paginación -->
                    <div class="flex justify-center">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @else
                    <!-- No hay productos -->
                    <div class="text-center py-16">
                        <div class="mb-4">
                            <i class="fas fa-search text-6xl text-gray-300"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">No se encontraron productos</h3>
                        <p class="text-gray-500 mb-6">Intenta ajustar tus filtros o búsqueda</p>
                        <a href="{{ route('web.product.index') }}"
                           class="inline-block bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors font-medium">
                            Ver todos los productos
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Auto-submit del formulario cuando cambian los filtros
    document.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(input => {
        input.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });
</script>
@endpush
