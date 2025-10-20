<footer class="bg-white border-t border-gray-200 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
            <h3 class="text-lg font-semibold mb-4">Contacto</h3>
            <p>Armería del Pozo</p>
            <p>Teléfono: +56 9 1234 5678</p>
            <p>Email: contacto@armeriadelpozo.cl</p>
            <p>Dirección: Calle Falsa 123, Santiago, Chile</p>
        </div>
        <div>
            <h3 class="text-lg font-semibold mb-4">Enlaces rápidos</h3>
            <ul class="space-y-2">
                <li><a href="{{ url('/') }}" class="hover:text-[#556B2F]">Inicio</a></li>
                <li><a href="{{ route('web.category.index') }}" class="hover:text-[#556B2F]">Categorías</a></li>
                <li><a href="{{ route('web.cart.index') }}" class="hover:text-[#556B2F]">Carrito</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-[#556B2F]">Iniciar sesión</a></li>
            </ul>
        </div>
        <div>
            <h3 class="text-lg font-semibold mb-4">Legal</h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-[#556B2F]">Términos y condiciones</a></li>
                <li><a href="#" class="hover:text-[#556B2F]">Política de privacidad</a></li>
            </ul>
        </div>
        <div>
            <h3 class="text-lg font-semibold mb-4">Síguenos</h3>
            <div class="flex space-x-4">
                <a href="#" class="text-gray-700 hover:text-[#556B2F]" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54v-2.89h2.54V9.845c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.772-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/>
                    </svg>
                </a>
                <a href="#" class="text-gray-700 hover:text-[#556B2F]" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 2A3.75 3.75 0 004 7.75v8.5A3.75 3.75 0 007.75 20h8.5a3.75 3.75 0 003.75-3.75v-8.5A3.75 3.75 0 0016.25 4h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 2a3 3 0 100 6 3 3 0 000-6zm4.5-3a1.25 1.25 0 110 2.5 1.25 1.25 0 010-2.5z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="bg-gray-100 text-center py-4 text-sm text-gray-600">
        &copy; {{ date('Y') }} Armería del Pozo. Todos los derechos reservados.
    </div>
</footer>
