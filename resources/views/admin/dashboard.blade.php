@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <!-- Total Products -->
  <div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center">
      <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
        <i class="fas fa-box fa-2x"></i>
      </div>
      <div class="ml-4">
        <p class="text-sm font-medium text-gray-600">Total Productos</p>
        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_products'] }}</p>
      </div>
    </div>
  </div>

  <!-- Active Products -->
  <div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center">
      <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
        <i class="fas fa-check-circle fa-2x"></i>
      </div>
      <div class="ml-4">
        <p class="text-sm font-medium text-gray-600">Productos Activos</p>
        <p class="text-2xl font-semibold text-gray-900">{{ $stats['active_products'] }}</p>
      </div>
    </div>
  </div>

  <!-- Total Categories -->
  <div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center">
      <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
        <i class="fas fa-tags fa-2x"></i>
      </div>
      <div class="ml-4">
        <p class="text-sm font-medium text-gray-600">Categorías</p>
        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_categories'] }}</p>
      </div>
    </div>
  </div>

  <!-- Total Orders -->
  <div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center">
      <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
        <i class="fas fa-shopping-cart fa-2x"></i>
      </div>
      <div class="ml-4">
        <p class="text-sm font-medium text-gray-600">Total Órdenes</p>
        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_orders'] }}</p>
      </div>
    </div>
  </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
  <!-- Recent Products -->
  <div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Productos Recientes</h3>
    <div class="space-y-4">
      @forelse($recentProducts as $product)
        <div class="flex items-center space-x-4">
          <div class="flex-shrink-0">
            @if($product->images->first())
              <img class="h-10 w-10 rounded-lg object-cover" src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}">
            @else
              <div class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center">
                <i class="fas fa-image text-gray-400 text-sm"></i>
              </div>
            @endif
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</p>
            <p class="text-sm text-gray-500">${{ number_format($product->price, 0, ',', '.') }}</p>
          </div>
          <div class="flex-shrink-0">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
              {{ $product->status === 'active' ? 'Activo' : 'Inactivo' }}
            </span>
          </div>
        </div>
      @empty
        <p class="text-gray-500 text-center py-4">No hay productos recientes</p>
      @endforelse
    </div>
  </div>

  <!-- Recent Orders -->
  <div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Órdenes Recientes</h3>
    <div class="space-y-4">
      @forelse($recentOrders as $order)
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-gray-900">Orden #{{ $order->id }}</p>
            <p class="text-sm text-gray-500">{{ $order->user->name }}</p>
          </div>
          <div class="text-right">
            <p class="text-sm font-medium text-gray-900">${{ number_format($order->total, 0, ',', '.') }}</p>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
              @if($order->status === 'pending') bg-yellow-100 text-yellow-800
              @elseif($order->status === 'processing') bg-blue-100 text-blue-800
              @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
              @elseif($order->status === 'delivered') bg-green-100 text-green-800
              @else bg-red-100 text-red-800 @endif">
              {{ ucfirst($order->status) }}
            </span>
          </div>
        </div>
      @empty
        <p class="text-gray-500 text-center py-4">No hay órdenes recientes</p>
      @endforelse
    </div>
  </div>
</div>

<!-- Quick Actions -->
<div class="mt-8 bg-white rounded-lg shadow p-6">
  <h3 class="text-lg font-medium text-gray-900 mb-4">Acciones Rápidas</h3>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <a href="{{ route('admin.products.create') }}" class="flex items-center justify-center px-4 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
      <i class="fas fa-plus mr-2"></i>Agregar Producto
    </a>
    <a href="{{ route('admin.products.index') }}" class="flex items-center justify-center px-4 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
      <i class="fas fa-list mr-2"></i>Ver Productos
    </a>
    <a href="{{ route('web.home') }}" class="flex items-center justify-center px-4 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
      <i class="fas fa-home mr-2"></i>Ver Tienda
    </a>
  </div>
</div>
@endsection
