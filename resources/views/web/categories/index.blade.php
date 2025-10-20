@extends('web.layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-red-600 to-red-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Nuestras Categorías</h1>
                <p class="text-xl md:text-2xl mb-8">Explora nuestros productos organizados por categorías</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Categorías Disponibles</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Navega por nuestras categorías para encontrar exactamente lo que necesitas.
                Cada categoría contiene productos especializados para diferentes actividades.
            </p>
        </div>

        @if($categories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($categories as $category)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden group">
                        <!-- Placeholder para imagen de categoría (puedes agregar después) -->
                        <div class="h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center group-hover:from-red-50 group-hover:to-red-100 transition-colors">
                            <div class="text-center">
                                <i class="fas fa-tags text-4xl text-gray-400 group-hover:text-red-500 transition-colors mb-2"></i>
                                <p class="text-sm text-gray-500">Imagen próximamente</p>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $category->name }}</h3>

                            @if($category->description)
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $category->description }}</p>
                            @endif

                            <div class="flex items-center justify-between mb-4">
                                <span class="text-sm text-gray-500">
                                    {{ $category->products_count }} productos
                                </span>
                                <span class="text-sm font-medium text-red-600">
                                    Ver productos →
                                </span>
                            </div>

                            <a href="{{ route('web.category.show', $category->slug) }}"
                               class="block w-full bg-red-600 hover:bg-red-700 text-white text-center py-3 px-4 rounded-lg font-semibold transition-colors">
                                Explorar Categoría
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- No hay categorías -->
            <div class="text-center py-16">
                <div class="mb-4">
                    <i class="fas fa-tags text-6xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No hay categorías disponibles</h3>
                <p class="text-gray-500">Estamos trabajando para agregar nuevas categorías próximamente.</p>
            </div>
        @endif

        <!-- Call to Action -->
        <div class="mt-16 text-center">
            <div class="bg-gray-50 rounded-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">¿No encuentras lo que buscas?</h3>
                <p class="text-gray-600 mb-6">
                    Explora todos nuestros productos sin filtros para encontrar exactamente lo que necesitas.
                </p>
                <a href="{{ route('web.product.index') }}"
                   class="inline-block bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                    <i class="fas fa-search mr-2"></i>
                    Ver Todos los Productos
                </a>
            </div>
        </div>
    </div>
@endsection
