@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
  <div class="bg-white shadow-sm rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Crear Nuevo Producto</h1>
        <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
          <i class="fas fa-arrow-left mr-2"></i>Volver
        </a>
      </div>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Información básica -->
        <div class="md:col-span-2">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Información Básica</h3>
        </div>

        <div class="md:col-span-2">
          <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
          <input type="text" name="name" id="name" value="{{ old('name') }}" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div class="md:col-span-2">
          <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
          <textarea name="description" id="description" rows="4" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('description') }}</textarea>
          @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
          <input type="text" name="sku" id="sku" value="{{ old('sku') }}" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          @error('sku')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
          <select name="category_id" id="category_id" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
            <option value="">Seleccionar categoría</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
          @error('category_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Información de precio e inventario -->
        <div class="md:col-span-2">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Precio e Inventario</h3>
        </div>

        <div>
          <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
          <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          @error('price')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
          <input type="number" name="stock" id="stock" value="{{ old('stock') }}" min="0" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          @error('stock')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Estado y configuración -->
        <div class="md:col-span-2">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Estado y Configuración</h3>
        </div>

        <div>
          <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
          <select name="status" id="status" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
            <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Activo</option>
            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactivo</option>
          </select>
          @error('status')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div class="flex items-center">
          <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                 class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
          <label for="is_featured" class="ml-2 block text-sm text-gray-900">Producto destacado</label>
          @error('is_featured')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Imagen -->
        <div class="md:col-span-2">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Imagen del Producto</h3>

          <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Imagen del Producto</label>
            <input type="file" name="image" id="image" accept="image/*"
                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            <p class="mt-1 text-sm text-gray-500">PNG, JPG, GIF, WebP hasta 2MB</p>
            @error('image')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>

      <!-- Botones de acción -->
      <div class="mt-8 flex justify-end space-x-3">
        <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
          Cancelar
        </a>
        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg">
          <i class="fas fa-save mr-2"></i>Crear Producto
        </button>
      </div>
    </form>
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
