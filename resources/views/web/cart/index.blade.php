@extends('web.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Carrito de Compras</h1>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Items del carrito -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Productos en tu carrito</h2>
                    </div>

                    <div class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                            <div class="p-6 flex items-center space-x-4">
                                <div class="flex-shrink-0 w-20 h-20 bg-gray-200 rounded-lg overflow-hidden">
                                    @if($item->product->mainImage)
                                        <img src="{{ asset('storage/' . $item->product->mainImage->path) }}"
                                             alt="{{ $item->product->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-medium text-gray-900">
                                        <a href="{{ route('web.product.show', $item->product->slug) }}" class="hover:text-red-600">
                                            {{ $item->product->name }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-500">Precio unitario: ${{ number_format($item->unit_price, 0, ',', '.') }}</p>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                            class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center"
                                            {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                        <i class="fas fa-minus text-xs"></i>
                                    </button>

                                    <input type="number" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                           onchange="updateQuantity({{ $item->id }}, this.value)"
                                           class="w-16 text-center border border-gray-300 rounded px-2 py-1 text-sm">

                                    <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                            class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center"
                                            {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                        <i class="fas fa-plus text-xs"></i>
                                    </button>
                                </div>

                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900" id="item-total-{{ $item->id }}">
                                        ${{ number_format($item->quantity * $item->unit_price, 0, ',', '.') }}
                                    </p>
                                </div>

                                <button onclick="removeItem({{ $item->id }})"
                                        class="text-red-600 hover:text-red-900 p-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200">
                        <button onclick="clearCart()"
                                class="text-red-600 hover:text-red-900 text-sm font-medium">
                            <i class="fas fa-trash mr-1"></i>Vaciar carrito
                        </button>
                    </div>
                </div>
            </div>

            <!-- Resumen del pedido -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-sm rounded-lg p-6 sticky top-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Resumen del pedido</h2>

                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span>Subtotal ({{ $cartItems->sum('quantity') }} productos)</span>
                            <span id="cart-subtotal">${{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <span>Envío</span>
                            <span>Por calcular</span>
                        </div>

                        <hr class="my-3">

                        <div class="flex justify-between text-lg font-medium">
                            <span>Total</span>
                            <span id="cart-total">${{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3">
                        <button class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                            Proceder al pago
                        </button>

                        <a href="{{ route('web.home') }}"
                           class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-3 rounded-lg font-medium text-center block transition-colors">
                            Continuar comprando
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-shopping-cart text-gray-400 text-3xl"></i>
            </div>
            <h2 class="text-2xl font-medium text-gray-900 mb-2">Tu carrito está vacío</h2>
            <p class="text-gray-500 mb-6">¡Agrega algunos productos para comenzar!</p>
            <a href="{{ route('web.home') }}"
               class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Ir a la tienda
            </a>
        </div>
    @endif
</div>

<script>
function updateQuantity(itemId, quantity) {
    if (quantity < 1) return;

    fetch(`/cart/items/${itemId}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`item-total-${itemId}`).textContent = `$${data.item_total.toLocaleString()}`;
            document.getElementById('cart-subtotal').textContent = `$${data.cart_total.toLocaleString()}`;
            document.getElementById('cart-total').textContent = `$${data.cart_total.toLocaleString()}`;

            // Actualizar contador del carrito en el header
            updateCartCount(data.cart_count);

            // Mostrar mensaje de éxito
            showMessage(data.message, 'success');
        } else {
            showMessage(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('Error al actualizar la cantidad', 'error');
    });
}

function removeItem(itemId) {
    if (!confirm('¿Estás seguro de que quieres eliminar este producto del carrito?')) {
        return;
    }

    fetch(`/cart/items/${itemId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Recargar la página para actualizar la vista
        } else {
            showMessage(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('Error al eliminar el producto', 'error');
    });
}

function clearCart() {
    if (!confirm('¿Estás seguro de que quieres vaciar el carrito?')) {
        return;
    }

    fetch('/cart', {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Recargar la página para actualizar la vista
        } else {
            showMessage(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('Error al vaciar el carrito', 'error');
    });
}

function updateCartCount(count) {
    const cartCountElements = document.querySelectorAll('.cart-count');
    cartCountElements.forEach(element => {
        element.textContent = count;
        element.style.display = count > 0 ? 'flex' : 'none';
    });
}

function showMessage(message, type) {
    // Crear elemento de mensaje temporal
    const messageDiv = document.createElement('div');
    messageDiv.className = `fixed top-4 right-4 px-4 py-2 rounded-lg text-white z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
    messageDiv.textContent = message;

    document.body.appendChild(messageDiv);

    setTimeout(() => {
        document.body.removeChild(messageDiv);
    }, 3000);
}
</script>
@endsection
