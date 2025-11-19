@extends('web.layouts.app')

@section('title', $product->name . ' - ' . config('app.name'))

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Galería de Imágenes -->
            <div class="space-y-4">
                @if($product->images->count() > 0)
                    <!-- Imagen Principal -->
                    <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                        <img id="mainImage"
                             src="{{ asset('storage/' . $product->mainImage->path) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover rounded-lg">
                    </div>

                    <!-- Miniaturas -->
                    @if($product->images->count() > 1)
                        <div class="grid grid-cols-4 gap-2">
                            @foreach($product->images as $image)
                                <button onclick="changeMainImage('{{ asset('storage/' . $image->path) }}')"
                                        class="aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 {{ $image->is_main ? 'border-red-500' : 'border-gray-200' }} hover:border-red-300 transition-colors">
                                    <img src="{{ asset('storage/' . $image->path) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover rounded-lg">
                                </button>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="aspect-square bg-gray-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-image text-gray-400 text-6xl"></i>
                    </div>
                @endif
            </div>

            <!-- Información del Producto -->
            <div class="space-y-6">
                <!-- Breadcrumb -->
                <nav class="text-sm text-gray-500">
                    <a href="{{ route('web.home') }}" class="hover:text-red-600">Inicio</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('web.product.index') }}" class="hover:text-red-600">Productos</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('web.category.show', $product->category->slug) }}" class="hover:text-red-600">{{ $product->category->name }}</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-900">{{ $product->name }}</span>
                </nav>

                <!-- Título y Precio -->
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-sm text-gray-500 uppercase tracking-wide">{{ $product->category->name }}</span>
                        @if($product->is_featured)
                            <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-semibold">DESTACADO</span>
                        @endif
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                    <div class="flex items-center gap-4 mb-4">
                        <span class="text-3xl font-bold text-red-600">{{ $product->formatted_price }}</span>
                        <span class="text-lg text-gray-500">
                            @if($product->stock > 10)
                                <span class="text-green-600">● En stock</span>
                            @elseif($product->stock > 0)
                                <span class="text-orange-600">● ¡Últimas {{ $product->stock }} unidades!</span>
                            @else
                                <span class="text-red-600">● Agotado</span>
                            @endif
                        </span>
                    </div>
                </div>

                <!-- SKU -->
                <div>
                    <span class="text-sm text-gray-600">SKU: <span class="font-mono">{{ $product->sku }}</span></span>
                </div>

                <!-- Descripción -->
                @if($product->description)
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Descripción</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                    </div>
                @endif

                <!-- Acciones -->
                <div class="space-y-4">
                    @if($product->stock > 0)
                        <div class="flex gap-4">
                            <div class="flex items-center gap-2">
                                <label class="text-sm font-medium">Cantidad:</label>
                                <input type="number"
                                       id="quantity"
                                       value="1"
                                       min="1"
                                       max="{{ $product->stock }}"
                                       class="w-20 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <button class="flex-1 bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors add-to-cart"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}"
                                    data-price="{{ $product->price }}">
                                <i class="fas fa-cart-plus mr-2"></i>
                                Agregar al Carrito
                            </button>
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-colors">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    @else
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-red-800">Producto agotado</h4>
                                    <p class="text-red-600 text-sm">Este producto no está disponible actualmente.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Información Adicional -->
                <div class="border-t pt-6">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-900">Categoría:</span>
                            <a href="{{ route('web.category.show', $product->category->slug) }}"
                               class="text-red-600 hover:text-red-700 ml-1">
                                {{ $product->category->name }}
                            </a>
                        </div>
                        <div>
                            <span class="font-medium text-gray-900">Stock disponible:</span>
                            <span class="ml-1">{{ $product->stock }} unidades</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos Relacionados -->
        @if($relatedProducts->count() > 0)
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Productos Relacionados</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <x-product-card :product="$relatedProduct" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    function changeMainImage(imageSrc) {
        document.getElementById('mainImage').src = imageSrc;
    }

    // Actualizar miniaturas activas
    document.querySelectorAll('.grid button').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.grid button').forEach(btn => {
                btn.classList.remove('border-red-500');
                btn.classList.add('border-gray-200');
            });
            this.classList.remove('border-gray-200');
            this.classList.add('border-red-500');
        });
    });
</script>
@endpush
