@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
  <div class="bg-white shadow-sm rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Detalles del Producto</h1>
        <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
          <i class="fas fa-arrow-left mr-2"></i>Volver
        </a>
      </div>
    </div>

    <div class="p-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Imagen del producto -->
        <div class="space-y-4">
          <h3 class="text-lg font-semibold text-gray-900">Imagen</h3>
          <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
            @if($product->images->first())
              <img src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}"
                   class="w-full h-full object-cover">
            @else
              <div class="w-full h-full flex items-center justify-center">
                <i class="fas fa-image text-gray-400 text-6xl"></i>
              </div>
            @endif
          </div>
        </div>

        <!-- Información del producto -->
        <div class="space-y-6">
          <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Información General</h3>
            <dl class="space-y-3">
              <div>
                <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                <dd class="text-sm text-gray-900">{{ $product->name }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">SKU</dt>
                <dd class="text-sm text-gray-900">{{ $product->sku }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Categoría</dt>
                <dd class="text-sm text-gray-900">{{ $product->category->name }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Estado</dt>
                <dd class="text-sm">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $product->status === 'active' ? 'Activo' : 'Inactivo' }}
                  </span>
                </dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Producto Destacado</dt>
                <dd class="text-sm">
                  @if($product->is_featured)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                      <i class="fas fa-star mr-1"></i>Sí
                    </span>
                  @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                      No
                    </span>
                  @endif
                </dd>
              </div>
            </dl>
          </div>

          <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Información de Inventario</h3>
            <dl class="space-y-3">
              <div>
                <dt class="text-sm font-medium text-gray-500">Precio</dt>
                <dd class="text-lg font-semibold text-emerald-600">${{ number_format($product->price, 0, ',', '.') }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Stock</dt>
                <dd class="text-sm text-gray-900">{{ $product->stock }} unidades</dd>
              </div>
            </dl>
          </div>
        </div>
      </div>

      <!-- Descripción -->
      <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Descripción</h3>
        <div class="bg-gray-50 rounded-lg p-4">
          <p class="text-sm text-gray-700 whitespace-pre-line">{{ $product->description }}</p>
        </div>
      </div>

      <!-- Variantes (si existen) -->
      @if($product->variants->count() > 0)
      <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Variantes</h3>
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Extra</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($product->variants as $variant)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $variant->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $variant->value }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  ${{ number_format($variant->price_modifier, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $variant->stock }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @endif

      <!-- Acciones -->
      <div class="mt-8 flex justify-end space-x-3">
        <a href="{{ route('admin.products.edit', $product) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
          <i class="fas fa-edit mr-2"></i>Editar
        </a>
        <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
          <i class="fas fa-list mr-2"></i>Ver Todos
        </a>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Check for success message in session
  @if(session('success'))
    Swal.fire({
      icon: 'success',
      title: '¡Éxito!',
      text: '{{ session('success') }}',
      timer: 3000,
      showConfirmButton: false
    });
  @endif

  // Check for error message in session
  @if(session('error'))
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '{{ session('error') }}',
      timer: 3000,
      showConfirmButton: false
    });
  @endif
});
</script>
@endpush
