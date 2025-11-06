@props(['user'])

<header class="h-16 bg-white shadow flex items-center justify-between px-6 border-b sticky top-0 z-30">
  <div class="flex items-center gap-4 w-full md:w-auto">
    <button id="sidebar-toggle" class="md:hidden text-gray-600 hover:text-gray-800 p-2 rounded-lg hover:bg-gray-100">
      <i class="fa-solid fa-bars"></i>
    </button>
    <div class="relative flex-1 max-w-md">
      <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-gray-400"></i>
      <input type="search" placeholder="Buscar..." class="w-full pl-10 pr-3 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm">
    </div>
  </div>

  <div class="flex items-center gap-3">
    <div class="hidden md:block text-sm text-gray-700">{{ $user->name }}</div>
    <form method="POST" action="{{ route('logout') }}" class="md:hidden">
      @csrf
      <button type="submit" class="text-gray-500 hover:text-gray-700 p-2 rounded-lg hover:bg-gray-100">
        <i class="fa-solid fa-sign-out-alt"></i>
      </button>
    </form>
  </div>
</header>
