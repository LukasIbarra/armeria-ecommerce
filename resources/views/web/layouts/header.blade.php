<header class="relative z-[60]">

    <!-- Barra superior verde fija -->
    <div class="bg-[#556B2F] text-white text-sm fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4 py-1">
            <nav class="flex space-x-6">
                <a href="{{ url('/') }}" class="hover:underline">Inicio</a>
                <a href="{{ url('/') }}" class="hover:underline">Catálogo</a>
                <a href="{{ url('/contacto') }}" class="hover:underline">Contacto</a>
                <a href="{{ url('/horarios') }}" class="hover:underline">Horarios</a>
                <a href="{{ url('/ubicacion') }}" class="hover:underline">Ubicación</a>
            </nav>
            <div class="flex space-x-6 items-center">
                <a href="https://wa.me/56942461112" target="_blank" class="flex items-center space-x-1 hover:underline">
                    <i class="fab fa-whatsapp"></i>
                    <span>+569 4246 1112</span>
                </a>
                <span class="border-l border-white h-5"></span>
                <a href="https://wa.me/56952170535" target="_blank" class="flex items-center space-x-1 hover:underline">
                    <i class="fab fa-whatsapp"></i>
                    <span>+569 5217 0535</span>
                </a>
                <span class="border-l border-white h-5"></span>
                <a href="tel:+5622018798" class="flex items-center space-x-1 hover:underline">
                    <i class="fas fa-phone-alt"></i>
                    <span>+562 2201 8798</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Barra principal negra -->
    <div class="bg-black text-white shadow fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}">
                    <img class="h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="Armería Logo" />
                </a>
            </div>

            <!-- Barra de búsqueda -->
            <div class="flex-1 mx-6">
                <form action="{{ url('/') }}" method="GET">
                    <input type="text" name="q" placeholder="Búsqueda de productos"
                           class="w-full rounded-md py-2 px-4 text-black focus:outline-none" />
                </form>
            </div>

            <!-- Iconos -->
            <div class="flex items-center space-x-4">
                <a href="#" class="text-white hover:text-[#556B2F]" title="Shuffle">
                    <i class="fas fa-random fa-lg"></i>
                </a>
                <a href="#" class="text-white hover:text-[#556B2F]" title="Favoritos">
                    <i class="fas fa-heart fa-lg"></i>
                </a>
                @guest
                    <a href="{{ route('login') }}" class="text-white hover:text-[#556B2F]" title="Iniciar sesión">
                        <i class="fas fa-user fa-lg"></i>
                    </a>
                @else
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-[#556B2F]" title="Panel Admin">
                            <i class="fas fa-cog fa-lg"></i>
                        </a>
                    @else
                        <a href="{{ url('/') }}" class="text-white hover:text-[#556B2F]" title="Perfil">
                            <i class="fas fa-user fa-lg"></i>
                        </a>
                    @endif
                @endguest
                <a href="{{ url('/') }}" class="bg-white text-black rounded p-2 shadow" title="Pedidos">
                    <i class="fas fa-clipboard-list fa-lg"></i>
                </a>
                <a href="{{ url('/') }}" class="bg-[#556B2F] hover:bg-[#2F4F4F] text-white rounded-full p-3 relative" title="Carrito">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute top-0 right-0 bg-red-600 rounded-full text-xs w-5 h-5 flex items-center justify-center">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
            </div>
        </div>

        <!-- Barra inferior con categorías -->
        <nav class="bg-black border-t border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <ul class="flex space-x-6 text-[#556B2F] font-semibold py-2">
                    <!-- Dropdown Accesorios -->
                    <li class="relative group">
  <div class="flex items-center space-x-1 cursor-pointer hover:text-[#2F4F4F]">
    <i class="fas fa-tools"></i>
    <span>Accesorios</span>
    <i class="fas fa-chevron-down text-xs"></i>
  </div>

  <!-- Dropdown -->
  <div class="absolute top-full left-0 bg-black/95 backdrop-blur-sm border border-gray-700 rounded-md shadow-2xl
              opacity-0 invisible group-hover:opacity-100 group-hover:visible
              transition-all duration-300 ease-out transform scale-95 group-hover:scale-100
              z-[9999] w-[480px] mt-2">
    <div class="grid grid-cols-2 gap-1 p-3 max-h-[70vh] scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900">
      @foreach([
        ['bolsos-y-mochilas', 'Bolsos y Mochilas', 'fa-briefcase'],
        ['calcetas-cubre-mangas', 'Calcetas - Cubre Mangas', 'fa-socks'],
        ['calzado-tactico', 'Calzado Táctico', 'fa-shoe-prints'],
        ['chalecos-tacticos-operativos', 'Chalecos Tácticos', 'fa-vest'],
        ['chalecos-y-collar-mascotas', 'Chalecos Mascotas', 'fa-dog'],
        ['cinturones-operativos-tacticos', 'Cinturones', 'fa-grip-lines'],
        ['equipo-tactico', 'Equipo Táctico', 'fa-cogs'],
        ['funda-pistola-y-porta-cargadores', 'Fundas Pistola', 'fa-archive'],
        ['gorros-y-boonie', 'Gorros y Boonie', 'fa-hat-cowboy'],
        ['guantes-polainas-bufandas', 'Guantes y Bufandas', 'fa-mitten'],
        ['lentes-tacticos', 'Lentes Tácticos', 'fa-glasses'],
        ['linternas-tacticas', 'Linternas Tácticas', 'fa-lightbulb'],
        ['municion-postones-c02', 'Munición / C02', 'fa-bullet'],
        ['parches', 'Parches', 'fa-tag'],
        ['pouches-tacticos', 'Pouches Tácticos', 'fa-box-open'],
        ['radios-tacticas-comunicacion', 'Radios Comunicación', 'fa-broadcast-tower'],
        ['regalos-varios', 'Regalos Varios', 'fa-gift'],
        ['rodilleras', 'Rodilleras', 'fa-shield-alt'],
        ['vestuario-tactico', 'Vestuario Táctico', 'fa-tshirt'],
      ] as $item)
        <a href="{{ route('web.category.show', $item[0]) }}"
           class="flex items-center space-x-2 px-3 py-2 text-sm hover:bg-gray-800 rounded transition">
           <i class="fas {{ $item[2] }}"></i>
           <span>{{ $item[1] }}</span>
        </a>
      @endforeach
    </div>
  </div>
</li>

                    <li class="flex items-center space-x-1 cursor-pointer hover:text-[#2F4F4F]">
                        <i class="fas fa-bullseye"></i>
                        <a href="{{ route('web.category.show', 'airsoft') }}">Airsoft</a>
                    </li>
                    <li class="flex items-center space-x-1 cursor-pointer hover:text-[#2F4F4F]">
                        <i class="fas fa-bolt"></i>
                        <a href="{{ route('web.category.show', 'armamento-traumatico-y-defensa') }}">Armamento Traumático</a>
                    </li>
                    <li class="flex items-center space-x-1 cursor-pointer hover:text-[#2F4F4F]">
                        <i class="fas fa-campground"></i>
                        <a href="{{ route('web.category.show', 'camping-trekking') }}">Camping Trekking</a>
                    </li>
                    <li class="flex items-center space-x-1 cursor-pointer hover:text-[#2F4F4F]">
                        <i class="fas fa-deer"></i>
                        <a href="{{ route('web.category.show', 'caza') }}">Caza</a>
                    </li>
                    <li class="flex items-center space-x-1 cursor-pointer hover:text-[#2F4F4F]">
                        <i class="fas fa-shield-alt"></i>
                        <a href="{{ route('web.category.show', 'guardias-seguridad') }}">Guardias Seguridad</a>
                    </li>
                    <li class="flex items-center space-x-1 cursor-pointer hover:text-[#2F4F4F]">
                        <i class="fas fa-tshirt"></i>
                        <a href="{{ route('web.category.show', 'tenidas-y-calzado') }}">Teñidas y Calzado</a>
                    </li>
                    <li class="flex items-center space-x-1 cursor-pointer hover:text-[#2F4F4F]">
                        <i class="fas fa-box"></i>
                        <a href="{{ route('web.product.index') }}">Productos</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
