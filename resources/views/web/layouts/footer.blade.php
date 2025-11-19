<footer class="bg-[#0d0d0d] text-gray-300 border-t border-gray-800 mt-16">
    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-4 gap-10">

        <!-- Logo y descripción -->
        <div class="space-y-4">
            <img src="{{ asset('images/logo.png') }}" alt="Armería del Pozo" class="h-16 object-contain">
            <p class="text-sm leading-relaxed text-gray-400">
                Armería ubicada en Ulriksen, La Serena. Especialistas en implementos tácticos,
                accesorios de tiro deportivo y artículos de seguridad.
            </p>
        </div>

        <!-- Contacto -->
        <div>
            <h3 class="text-lg font-semibold mb-4 text-white flex items-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                Contacto
            </h3>
            <ul class="space-y-2 text-sm">
                <li>Tel: +56 9 1234 5678</li>
                <li>Email: contacto@valletactico.cl</li>
                <li>Ulriksen, La Serena</li>
            </ul>
        </div>

        <!-- Enlaces rápidos -->
        <div>
            <h3 class="text-lg font-semibold mb-4 text-white flex items-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path d="M4 6h16M4 12h12M4 18h8"/></svg>
                Enlaces rápidos
            </h3>

            <ul class="space-y-2 text-sm">
                <li><a href="{{ url('/') }}" class="hover:text-orange-500">Inicio</a></li>
                <li><a href="{{ route('web.category.index') }}" class="hover:text-orange-500">Categorías</a></li>
                <li><a href="{{ route('web.cart.index') }}" class="hover:text-orange-500">Carrito</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-orange-500">Iniciar sesión</a></li>
            </ul>
        </div>

        <!-- Redes sociales -->
        <div>
            <h3 class="text-lg font-semibold mb-4 text-white flex items-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M14.31 8a3.38 3.38 0 0 1 0 8m-4.62 0a3.38 3.38 0 0 1 0-8"/></svg>
                Síguenos
            </h3>
            <div class="flex space-x-4">

                <!-- Instagram -->
                <a href="https://instagram.com/" target="_blank"
                   class="hover:text-orange-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor"
                         viewBox="0 0 24 24">
                        <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 2A3.75 3.75 0 004 7.75v8.5A3.75 3.75 0 007.75 20h8.5a3.75 3.75 0 003.75-3.75v-8.5A3.75 3.75 0 0016.25 4h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm4.5-3a1.25 1.25 0 110 2.5 1.25 1.25 0 010-2.5z"/>
                    </svg>
                </a>

                <!-- Icono estilo militar / objetivo -->
                <span class="text-gray-500">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364l-1.414 1.414M7.05 16.95l-1.414 1.414M16.95 16.95l1.414 1.414M7.05 7.05L5.636 5.636"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </span>
            </div>
        </div>

    </div>

    <div class="bg-black text-center py-4 text-sm text-gray-500">
        &copy; {{ date('Y') }} Valle Táctico — Todos los derechos reservados.
    </div>
</footer>
