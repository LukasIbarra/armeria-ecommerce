@props(['user'])

<aside id="sidebar" class="flex flex-col w-64 bg-[#1b3329] text-gray-100 fixed inset-y-0 left-0 z-50 transform transition-transform duration-300 ease-in-out md:translate-x-0 -translate-x-full">
  <div class="flex items-center px-6 py-4 border-b border-[#254437]">
    <img src="{{ asset('images/logo.png') }}" class="h-9 w-auto" alt="Logo">
    <span class="ml-2 text-lg font-semibold">Panel Admin</span>
  </div>

  <nav class="flex-1 px-3 py-6 space-y-1">
    <x-sidebar-item icon="fa-solid fa-gauge" label="Inicio" route="admin.dashboard" />
    <x-sidebar-item icon="fa-solid fa-box" label="Productos" route="admin.products.index" />
    <x-sidebar-item icon="fa-solid fa-tags" label="Categorías" route="admin.categories.index" />
    <x-sidebar-disabled icon="fa-solid fa-users" label="Usuarios (Próximamente)" />
    <x-sidebar-disabled icon="fa-solid fa-cart-shopping" label="Órdenes (Próximamente)" />
  </nav>

  <div class="px-6 py-4 border-t border-[#254437] flex items-center justify-between text-sm">
    <div>
      <p class="font-medium">{{ $user->name }}</p>
      <p class="text-gray-400">Administrador</p>
    </div>
    <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
      @csrf
      <button type="submit" class="text-gray-400 hover:text-white">
        <i class="fa-solid fa-sign-out-alt"></i>
      </button>
    </form>
  </div>
</aside>
