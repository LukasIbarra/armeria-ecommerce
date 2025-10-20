@props(['product'])

<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <div class="relative">
        @if($product->mainImage)
            <div class="w-full h-48 bg-gray-100 rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $product->mainImage->path) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover">
            </div>
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-lg">
                <i class="fas fa-image text-gray-400 text-3xl"></i>
            </div>
        @endif

        @if($product->is_featured)
            <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-xs font-semibold">
                DESTACADO
            </div>
        @endif

        @if($product->stock <= 5)
            <div class="absolute top-2 right-2 bg-orange-500 text-white px-2 py-1 rounded text-xs font-semibold">
                ¡ÚLTIMAS UNIDADES!
            </div>
        @endif
    </div>

    <div class="p-4">
        <div class="mb-2">
            <span class="text-xs text-gray-500 uppercase tracking-wide">
                {{ $product->category->name }}
            </span>
        </div>

        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
            <a href="{{ route('web.product.show', $product->slug) }}"
               class="hover:text-red-600 transition-colors">
                {{ $product->name }}
            </a>
        </h3>

        <div class="flex items-center justify-between mb-3">
            <span class="text-xl font-bold text-red-600">
                {{ $product->formatted_price }}
            </span>
            <span class="text-sm text-gray-500">
                Stock: {{ $product->stock }}
            </span>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('web.product.show', $product->slug) }}"
               class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded text-center text-sm font-medium transition-colors">
                Ver Detalles
            </a>
            <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm font-medium transition-colors add-to-cart"
                    data-product-id="{{ $product->id }}"
                    data-product-name="{{ $product->name }}"
                    data-price="{{ $product->price }}">
                <i class="fas fa-cart-plus"></i>
            </button>
        </div>
    </div>
</div>
