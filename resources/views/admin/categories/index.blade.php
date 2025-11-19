@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-bold text-gray-900">Gestión de Categorías</h1>
  <button onclick="openCreateModal()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg">
    <i class="fas fa-plus mr-2"></i>Agregar Categoría
  </button>
</div>

<!-- Filters -->
<div class="bg-white p-4 rounded-lg shadow-sm mb-6">
  <form method="GET" class="flex flex-wrap gap-4">
    <div class="flex-1 min-w-0">
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar categorías..."
             class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
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
    <a href="{{ route('admin.categories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
      <i class="fas fa-times mr-2"></i>Limpiar
    </a>
  </form>
</div>

<!-- Categories Table -->
<div class="bg-white shadow-sm rounded-lg overflow-hidden">
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-emerald-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">Categoría</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">Descripción</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">Productos</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">Estado</th>
          <th class="px-6 py-3 text-right text-xs font-medium text-emerald-800 uppercase tracking-wider">Acciones</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @forelse($categories as $category)
          <tr class="hover:bg-emerald-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
              <div class="text-sm text-gray-500">{{ $category->slug }}</div>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-900">{{ Str::limit($category->description, 50) }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ $category->products_count }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $category->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $category->status === 'active' ? 'Activo' : 'Inactivo' }}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <div class="flex justify-end space-x-2">
                <button onclick="openShowModal({{ $category->id }})" class="text-emerald-600 hover:text-emerald-900">
                  <i class="fas fa-eye"></i>
                </button>
                <button onclick="openEditModal({{ $category->id }})" class="text-blue-600 hover:text-blue-900">
                  <i class="fas fa-edit"></i>
                </button>
                <button onclick="confirmDelete({{ $category->id }}, '{{ $category->name }}')" class="text-red-600 hover:text-red-900">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
              No se encontraron categorías
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  @if($categories->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
      {{ $categories->appends(request()->query())->links() }}
    </div>
  @endif
</div>

<!-- Create Category Modal -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
  <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
    <div class="mt-3">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-medium text-gray-900">Crear Nueva Categoría</h3>
        <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <form id="createForm" method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Nombre de la Categoría</label>
            <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"></textarea>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            <select name="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
              <option value="active">Activo</option>
              <option value="inactive">Inactivo</option>
            </select>
          </div>
        </div>

        <div class="flex justify-end space-x-3 mt-6">
          <button type="button" onclick="closeCreateModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            Cancelar
          </button>
          <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg">
            Crear Categoría
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Category Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
  <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
    <div class="mt-3">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-medium text-gray-900">Editar Categoría</h3>
        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <form id="editForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Nombre de la Categoría</label>
            <input type="text" name="name" id="edit_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="description" id="edit_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"></textarea>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            <select name="status" id="edit_status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
              <option value="active">Activo</option>
              <option value="inactive">Inactivo</option>
            </select>
          </div>
        </div>

        <div class="flex justify-end space-x-3 mt-6">
          <button type="button" onclick="closeEditModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            Cancelar
          </button>
          <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg">
            Actualizar Categoría
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Show Category Modal -->
<div id="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
  <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
    <div class="mt-3">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-medium text-gray-900">Detalles de la Categoría</h3>
        <button onclick="closeShowModal()" class="text-gray-400 hover:text-gray-600">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Nombre</label>
          <p id="show_name" class="text-lg font-semibold text-gray-900"></p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Descripción</label>
          <p id="show_description" class="text-sm text-gray-700"></p>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            <p id="show_status" class="text-sm"></p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Productos Asociados</label>
            <p id="show_products_count" class="text-lg font-semibold"></p>
          </div>
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

function openEditModal(categoryId) {
  fetch(`/admin/categories/${categoryId}/edit`)
    .then(response => response.json())
    .then(data => {
      document.getElementById('edit_name').value = data.name;
      document.getElementById('edit_description').value = data.description;
      document.getElementById('edit_status').value = data.status;

      document.getElementById('editForm').action = `/admin/categories/${categoryId}`;
      document.getElementById('editModal').classList.remove('hidden');
    });
}

function closeEditModal() {
  document.getElementById('editModal').classList.add('hidden');
  document.getElementById('editForm').reset();
}

function openShowModal(categoryId) {
  fetch(`/admin/categories/${categoryId}`)
    .then(response => response.json())
    .then(data => {
      document.getElementById('show_name').textContent = data.name;
      document.getElementById('show_description').textContent = data.description || 'Sin descripción';
      document.getElementById('show_products_count').textContent = data.products_count;

      const statusElement = document.getElementById('show_status');
      statusElement.textContent = data.status === 'active' ? 'Activo' : 'Inactivo';
      statusElement.className = `text-sm ${data.status === 'active' ? 'text-green-600' : 'text-red-600'}`;

      document.getElementById('showModal').classList.remove('hidden');
    });
}

function closeShowModal() {
  document.getElementById('showModal').classList.add('hidden');
}

function confirmDelete(categoryId, categoryName) {
  Swal.fire({
    title: '¿Estás seguro?',
    text: `¿Quieres eliminar la categoría "${categoryName}"? Esta acción no se puede deshacer.`,
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
      form.action = `/admin/categories/${categoryId}`;

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
