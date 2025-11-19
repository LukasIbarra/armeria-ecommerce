@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-bold text-gray-900">Gestión de Productos</h1>
  <a href="{{ route('admin.products.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg">
    <i class="fas fa-plus mr-2"></i>Agregar Producto
  </a>
</div>

<!-- Filters -->
<div class="bg-white p-4 rounded-lg shadow-sm mb-6">
  <form method="GET" class="flex flex-wrap gap-4">
    <div class="flex-1 min-w-0">
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar productos..."
             class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
    </div>
    <div class="w-48">
      <select name="category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
        <option value="">Todas las categorías</option>
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="w-32">
      <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
        <option value="">Todos</option>
        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Activos</option>
        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactivos</option>
      </select>
    </div>
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg">
      <i class="fas fa-search mr-2"></i>Filtrar
    </button>
    <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
      <i class="fas fa-times mr-2"></i>Limpiar
    </a>
  </form>
</div>

<!-- Products Table -->
<div class="bg-white shadow-sm rounded-lg overflow-hidden">
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-emerald-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">Producto</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">Categoría</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">Precio</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">Stock</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">Estado</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">Destacado</th>
          <th class="px-6 py-3 text-right text-xs font-medium text-emerald-800 uppercase tracking-wider">Acciones</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @forelse($products as $product)
          <tr class="hover:bg-emerald-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-12 w-12">
                  @if($product->images->first())
                    <img class="h-12 w-12 rounded-lg object-cover" src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}">
                  @else
                    <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                      <i class="fas fa-image text-gray-400"></i>
                    </div>
                  @endif
                </div>
                <div class="ml-4">
                  <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                  <div class="text-sm text-gray-500">{{ Str::limit($product->description, 50) }}</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $product->category->name }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              ${{ number_format($product->price, 0, ',', '.') }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ $product->stock }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $product->status === 'active' ? 'Activo' : 'Inactivo' }}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              @if($product->is_featured)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                  <i class="fas fa-star mr-1"></i>Sí
                </span>
              @else
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                  No
                </span>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.products.show', $product) }}" class="text-emerald-600 hover:text-emerald-900">
                  <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-900">
                  <i class="fas fa-edit"></i>
                </a>
                <button onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}')" class="text-red-600 hover:text-red-900">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
              No se encontraron productos
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  @if($products->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
      {{ $products->appends(request()->query())->links() }}
    </div>
  @endif
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(productId, productName) {
  Swal.fire({
    title: '¿Estás seguro?',
    text: `¿Quieres eliminar el producto "${productName}"? Esta acción no se puede deshacer.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#6b7280',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = `/admin/products/${productId}`;

      const csrfToken = document.createElement('input');
      csrfToken.type = 'hidden';
      csrfToken.name = '_token';
      csrfToken.value = '{{ csrf_token() }}';
      form.appendChild(csrfToken);

      const methodField = document.createElement('input');
      methodField.type = 'hidden';
      methodField.name = '_method';
      methodField.value = 'DELETE';
      form.appendChild(methodField);

      document.body.appendChild(form);
      form.submit();
    }
  });
}

// Listen for success/error messages from server
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
@endsection
