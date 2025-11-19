@extends('web.layouts.app')

@section('title', $category->name . ' - ' . config('app.name'))

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $category->name }}</h1>
                @if($category->description)
                    <p class="text-xl md:text-2xl mb-8">{{ $category->description }}</p>
                @endif

                <!-- Search Bar dentro de la categoría -->
                <div class="max-w-md mx-auto">
                    <form method="GET" action="{{ route('web.category.show', $category->slug) }}" class="flex gap-2">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Buscar en {{ $category->name }}..."
                               class="flex-1 px-4 py-2 rounded-l-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-300">
                        <button type="submit"
                                class="bg-white text-green-600 px-6 py-2 rounded-r-lg hover:bg-gray-100 transition-colors font-semibold">
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

                    <form method="GET" action="{{ route('web.category.show', $category->slug) }}" id="filterForm">
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
                                    class="w-full bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition-colors font-medium">
                                Aplicar Filtros
                            </button>
                            <a href="{{ route('web.category.show', $category->slug) }}"
                               class="block w-full bg-gray-200 text-gray-800 py-2 px-4 rounded hover:bg-gray-300 transition-colors text-center font-medium">
                                Limpiar Filtros
                            </a>
                        </div>
                    </form>

                    <!-- Navegación -->
                    <div class="mt-6 pt-6 border-t">
                        <h4 class="font-medium mb-3 text-gray-700">Navegación</h4>
                        <div class="space-y-2">
                            <a href="{{ route('web.category.index') }}"
                               class="block text-sm text-gray-600 hover:text-green-600 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Todas las categorías
                            </a>
                            <a href="{{ route('web.product.index') }}"
                               class="block text-sm text-gray-600 hover:text-green-600 transition-colors">
                                <i class="fas fa-th mr-2"></i>
                                Todos los productos
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenido Principal -->
            <div class="lg:w-3/4">
                <!-- Header con Ordenamiento -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            @if(request('search'))
                                Resultados para "{{ request('search') }}" en {{ $category->name }}
                            @else
                                Productos de {{ $category->name }}
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
                                class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
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
                        <p class="text-gray-500 mb-6">
                            @if(request('search'))
                                No encontramos productos que coincidan con tu búsqueda "{{ request('search') }}".
                            @else
                                Esta categoría no tiene productos disponibles actualmente.
                            @endif
                        </p>
                        <div class="flex gap-4 justify-center">
                            <a href="{{ route('web.category.show', $category->slug) }}"
                               class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium">
                                Ver todos en {{ $category->name }}
                            </a>
                            <a href="{{ route('web.product.index') }}"
                               class="inline-block bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                                Ver todos los productos
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Auto-submit del formulario cuando cambian los filtros
    document.querySelectorAll('input[type="checkbox"]').forEach(input => {
        input.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });
</script>
@endpush
