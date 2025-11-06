@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-bold text-gray-900">Gestión de Productos</h1>
  <button onclick="openCreateModal()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg">
    <i class="fas fa-plus mr-2"></i>Agregar Producto
  </button>
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
                <button onclick="openShowModal({{ $product->id }})" class="text-emerald-600 hover:text-emerald-900">
                  <i class="fas fa-eye"></i>
                </button>
                <button onclick="openEditModal({{ $product->id }})" class="text-blue-600 hover:text-blue-900">
                  <i class="fas fa-edit"></i>
                </button>
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

<!-- Create Product Modal -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
  <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
    <div class="mt-3">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-medium text-gray-900">Crear Nuevo Producto</h3>
        <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <form id="createForm" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
            <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          </div>

          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="description" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"></textarea>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Precio</label>
            <input type="number" name="price" step="0.01" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Stock</label>
            <input type="number" name="stock" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Categoría</label>
            <select name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
              <option value="">Seleccionar categoría</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">SKU</label>
            <input type="text" name="sku" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            <select name="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
              <option value="active">Activo</option>
              <option value="inactive">Inactivo</option>
            </select>
          </div>

          <div class="flex items-center">
            <input type="checkbox" name="is_featured" value="1" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
            <label class="ml-2 block text-sm text-gray-900">Producto destacado</label>
          </div>

          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Imagen del Producto</label>
            <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
          </div>
        </div>

        <div class="flex justify-end space-x-3 mt-6">
          <button type="button" onclick="closeCreateModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            Cancelar
          </button>
          <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg">
            Crear Producto
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Product Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
  <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
    <div class="mt-3">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-medium text-gray-900">Editar Producto</h3>
        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <form id="editForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
            <input type="text" name="name" id="edit_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          </div>

          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="description" id="edit_description" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"></textarea>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Precio</label>
            <input type="number" name="price" id="edit_price" step="0.01" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Stock</label>
            <input type="number" name="stock" id="edit_stock" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Categoría</label>
            <select name="category_id" id="edit_category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
              <option value="">Seleccionar categoría</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">SKU</label>
            <input type="text" name="sku" id="edit_sku" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            <select name="status" id="edit_status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
              <option value="active">Activo</option>
              <option value="inactive">Inactivo</option>
            </select>
          </div>

          <div class="flex items-center">
            <input type="checkbox" name="is_featured" id="edit_is_featured" value="1" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
            <label class="ml-2 block text-sm text-gray-900">Producto destacado</label>
          </div>

          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Imagen del Producto</label>
            <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            <div id="current_image" class="mt-2 hidden">
              <img id="current_image_preview" class="h-20 w-20 object-cover rounded-lg">
              <p class="text-sm text-gray-500 mt-1">Imagen actual</p>
            </div>
          </div>
        </div>

        <div class="flex justify-end space-x-3 mt-6">
          <button type="button" onclick="closeEditModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            Cancelar
          </button>
          <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg">
            Actualizar Producto
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Show Product Modal -->
<div id="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
  <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
    <div class="mt-3">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-medium text-gray-900">Detalles del Producto</h3>
        <button onclick="closeShowModal()" class="text-gray-400 hover:text-gray-600">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="space-y-4">
        <div class="flex items-center space-x-4">
          <div id="show_image" class="h-20 w-20 rounded-lg bg-gray-200 flex items-center justify-center">
            <i class="fas fa-image text-gray-400 text-2xl"></i>
          </div>
          <div>
            <h4 id="show_name" class="text-xl font-semibold text-gray-900"></h4>
            <p id="show_category" class="text-sm text-gray-500"></p>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Precio</label>
            <p id="show_price" class="text-lg font-semibold text-emerald-600"></p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Stock</label>
            <p id="show_stock" class="text-lg font-semibold"></p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            <p id="show_status" class="text-sm"></p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Destacado</label>
            <p id="show_featured" class="text-sm"></p>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">SKU</label>
          <p id="show_sku" class="text-sm text-gray-900"></p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Descripción</label>
          <p id="show_description" class="text-sm text-gray-700"></p>
        </div>
      </div>

      <div class="flex justify-end mt-6">
        <button onclick="closeShowModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
          Cerrar
        </button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function openCreateModal() {
  document.getElementById('createModal').classList.remove('hidden');
}

function closeCreateModal() {
  document.getElementById('createModal').classList.add('hidden');
  document.getElementById('createForm').reset();
}

function openEditModal(productId) {
  fetch(`/admin/products/${productId}/edit`)
    .then(response => response.json())
    .then(data => {
      document.getElementById('edit_name').value = data.name;
      document.getElementById('edit_description').value = data.description;
      document.getElementById('edit_price').value = data.price;
      document.getElementById('edit_stock').value = data.stock;
      document.getElementById('edit_category_id').value = data.category_id;
      document.getElementById('edit_sku').value = data.sku;
      document.getElementById('edit_status').value = data.status;
      document.getElementById('edit_is_featured').checked = data.is_featured;

      if (data.image) {
        document.getElementById('current_image_preview').src = `/storage/${data.image}`;
        document.getElementById('current_image').classList.remove('hidden');
      } else {
        document.getElementById('current_image').classList.add('hidden');
      }

      document.getElementById('editForm').action = `/admin/products/${productId}`;
      document.getElementById('editModal').classList.remove('hidden');
    });
}

function closeEditModal() {
  document.getElementById('editModal').classList.add('hidden');
  document.getElementById('editForm').reset();
  document.getElementById('current_image').classList.add('hidden');
}

function openShowModal(productId) {
  fetch(`/admin/products/${productId}`)
    .then(response => response.json())
    .then(data => {
      document.getElementById('show_name').textContent = data.name;
      document.getElementById('show_category').textContent = data.category;
      document.getElementById('show_price').textContent = `$${data.price.toLocaleString()}`;
      document.getElementById('show_stock').textContent = data.stock;
      document.getElementById('show_sku').textContent = data.sku;
      document.getElementById('show_description').textContent = data.description;

      const statusElement = document.getElementById('show_status');
      statusElement.textContent = data.status === 'active' ? 'Activo' : 'Inactivo';
      statusElement.className = `text-sm ${data.status === 'active' ? 'text-green-600' : 'text-red-600'}`;

      const featuredElement = document.getElementById('show_featured');
      featuredElement.innerHTML = data.is_featured ? '<i class="fas fa-star text-yellow-500 mr-1"></i>Sí' : 'No';

      if (data.image) {
        document.getElementById('show_image').innerHTML = `<img src="/storage/${data.image}" class="h-20 w-20 object-cover rounded-lg" alt="${data.name}">`;
      } else {
        document.getElementById('show_image').innerHTML = '<i class="fas fa-image text-gray-400 text-2xl"></i>';
      }

      document.getElementById('showModal').classList.remove('hidden');
    });
}

function closeShowModal() {
  document.getElementById('showModal').classList.add('hidden');
}

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

// Close modals when clicking outside
document.addEventListener('click', function(event) {
  const createModal = document.getElementById('createModal');
  const editModal = document.getElementById('editModal');
  const showModal = document.getElementById('showModal');

  if (event.target === createModal) {
    closeCreateModal();
  }
  if (event.target === editModal) {
    closeEditModal();
  }
  if (event.target === showModal) {
    closeShowModal();
  }
});
</script>
@endsection
