@extends('web.layouts.app')

@section('content')
    <!-- Hero Section with Weapons Carousel -->
    <section class="relative w-full h-screen bg-cover bg-center" 
             style="background-image: url('{{ asset('images/hero-banner-dark.jpg') }}');">
        <!-- Overlay oscuro -->
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>

        <!-- Swiper Hero -->
        <div class="relative z-10 flex justify-center items-center h-full">
            <div class="swiper weaponsSwiper w-full max-w-7xl px-4 bg-transparent" style="background: transparent !important;">
                <div class="swiper-wrapper" style="background: transparent !important;">
                    
                    <!-- Slide 1: T4E -->
                    <div class="swiper-slide flex flex-col md:flex-row items-center justify-center text-white h-screen bg-transparent" style="background: transparent !important;">
                        <div class="md:w-1/2 flex justify-center" data-aos="fade-left" data-aos-delay="200">
                            <img src="{{ asset('images/t4e-hero.png') }}" 
                                 alt="T4E" 
                                 class="object-contain max-h-[28rem] drop-shadow-lg bg-transparent" />
                        </div>
                        <div class="md:w-1/2 mt-8 md:mt-0 md:pl-12 bg-transparent" style="background: transparent !important;">
                            <h2 class="text-5xl font-extrabold text-[#556B2F] mb-4"
                                data-aos="fade-right" data-aos-delay="400">T4E</h2>
                            <p class="text-lg mb-4 max-w-md"
                               data-aos="fade-right" data-aos-delay="600">
                                Arma de entrenamiento con características realistas y segura para prácticas.
                            </p>
                            <p class="text-4xl font-extrabold text-[#8F9779] mb-6 transform scale-75"
                               data-aos="zoom-in" data-aos-delay="800" data-aos-easing="ease-in-out" data-aos-duration="600">$350.000</p>
                            <a href="#"
                               class="inline-block bg-[#556B2F] hover:bg-[#2F4F4F] text-white font-semibold py-3 px-8 rounded shadow-lg"
                               data-aos="fade-up" data-aos-delay="1000" data-aos-anchor-placement="bottom-bottom" data-aos-duration="600" data-aos-easing="ease-in-out" data-aos-offset="100" data-aos-anchor=".swiper-slide">
                                Ver Más
                            </a>
                        </div>
                    </div>

                    <!-- Slide 2: Traumatica -->
                    <div class="swiper-slide flex flex-col md:flex-row items-center justify-center text-white h-screen bg-transparent" style="background: transparent !important;">
                        <div class="md:w-1/2 flex justify-center" data-aos="fade-left" data-aos-delay="200">
                            <img src="{{ asset('images/traumatica-hero.png') }}" 
                                 alt="Traumatica" 
                                 class="object-contain max-h-[28rem] drop-shadow-lg bg-transparent" />
                        </div>
                        <div class="md:w-1/2 mt-8 md:mt-0 md:pl-12 bg-transparent" style="background: transparent !important;">
                            <h2 class="text-5xl font-extrabold text-[#556B2F] mb-4"
                                data-aos="fade-right" data-aos-delay="400">Traumatica</h2>
                            <p class="text-lg mb-4 max-w-md"
                               data-aos="fade-right" data-aos-delay="600">
                                Arma de defensa personal con alta potencia y diseño ergonómico.
                            </p>
                            <p class="text-4xl font-extrabold text-[#8F9779] mb-6 transform scale-75"
                               data-aos="zoom-in" data-aos-delay="800" data-aos-easing="ease-in-out" data-aos-duration="600">$450.000</p>
                            <a href="#"
                               class="inline-block bg-[#556B2F] hover:bg-[#2F4F4F] text-white font-semibold py-3 px-8 rounded shadow-lg"
                               data-aos="fade-up" data-aos-delay="1000" data-aos-anchor-placement="bottom-bottom" data-aos-duration="600" data-aos-easing="ease-in-out" data-aos-offset="100" data-aos-anchor=".swiper-slide">
                                Ver Más
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pagination & Navigation -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next text-white"></div>
                <div class="swiper-button-prev text-white"></div>
            </div>
        </div>
    </section>

    <!-- Sección Categorías con carrusel -->
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold mb-8">Categorías</h2>
        <div class="swiper categoriesSwiper">
            <div class="swiper-wrapper">
                <!-- Ejemplo de categoría -->
                <div class="swiper-slide relative rounded-lg overflow-hidden shadow-lg cursor-pointer hover:shadow-2xl transition-shadow duration-300">
                    <img src="{{ asset('images/category-example.jpg') }}" alt="Categoría ejemplo" class="w-full h-40 object-cover" />
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                        <span class="text-white font-semibold text-lg px-4 py-2 bg-[#556B2F] rounded-full">Armas De Fuego</span>
                    </div>
                </div>
                <!-- Repetir para otras categorías -->
            </div>
            <!-- Paginación -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Sección Productos Destacados -->
    <section class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Productos Destacados</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Primera fila de productos -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product1.jpg') }}" alt="Producto 1" class="w-full h-48 object-contain" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 1</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$100.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product2.jpg') }}" alt="Producto 2" class="w-full h-48 object-contain" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 2</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$120.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product3.jpg') }}" alt="Producto 3" class="w-full h-48 object-contain" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 3</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$90.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product4.jpg') }}" alt="Producto 4" class="w-full h-48 object-contain" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 4</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$110.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <!-- Segunda fila de productos -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product5.jpg') }}" alt="Producto 5" class="w-full h-48 object-contain" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 5</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$130.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product6.jpg') }}" alt="Producto 6" class="w-full h-48 object-contain" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 6</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$140.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product7.jpg') }}" alt="Producto 7" class="w-full h-48 object-contain" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 7</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$150.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product8.jpg') }}" alt="Producto 8" class="w-full h-48 object-contain" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 8</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$160.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <button class="bg-[#556B2F] text-white py-2 px-6 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más Productos</button>
            </div>
        </div>
    </section>

    <!-- Sección CTA -->
    <section class="max-w-7xl mx-auto px-4 py-12 flex flex-col md:flex-row items-center justify-between bg-[#556B2F] rounded-lg text-white">
        <div class="mb-6 md:mb-0">
            <h2 class="text-3xl font-bold">¿Quieres recibir nuestras ofertas?</h2>
            <p class="mt-2">Suscríbete a nuestro newsletter y no te pierdas ninguna promoción.</p>
        </div>
        <form class="flex" action="#" method="POST">
            <input type="email" name="email" placeholder="Tu correo electrónico" required class="rounded-l px-4 py-2 text-gray-900" />
            <button type="submit" class="bg-[#2F4F4F] px-6 py-2 rounded-r font-semibold hover:bg-[#8F9779] transition-colors">Suscribirse</button>
        </form>
    </section>

    <!-- Sección Vestuario y Equipo -->
    <section class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="relative rounded-lg overflow-hidden shadow-lg">
            <img src="{{ asset('images/vestuario.jpg') }}" alt="Vestuario y Equipo" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white p-6">
                <h2 class="text-3xl font-bold mb-4">Vestuario y Equipo</h2>
                <button class="bg-[#556B2F] px-6 py-2 rounded hover:bg-[#2F4F4F] transition-colors">Comprar Ahora</button>
            </div>
        </div>
        <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <img src="{{ asset('images/product9.jpg') }}" alt="Producto 9" class="w-full h-48 object-contain" />
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Producto 9</h3>
                    <p class="text-[#556B2F] font-bold text-xl">$80.000</p>
                    <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <img src="{{ asset('images/product10.jpg') }}" alt="Producto 10" class="w-full h-48 object-contain" />
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Producto 10</h3>
                    <p class="text-[#556B2F] font-bold text-xl">$95.000</p>
                    <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                </div>
            </div>
        </div>
    </section>

        <!-- Sección Equipo de Caza -->
    <section class="max-w-7xl mx-auto px-4 py-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="relative rounded-lg overflow-hidden shadow-lg">
            <img src="{{ asset('images/vestuario.jpg') }}" alt="Vestuario y Equipo" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white p-6">
                <h2 class="text-3xl font-bold mb-4">Equipo de Caza</h2>
                <button class="bg-[#556B2F] px-6 py-2 rounded hover:bg-[#2F4F4F] transition-colors">Comprar Ahora</button>
            </div>
        </div>
        <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <img src="{{ asset('images/product9.jpg') }}" alt="Producto 9" class="w-full h-48 object-contain" />
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Producto 9</h3>
                    <p class="text-[#556B2F] font-bold text-xl">$80.000</p>
                    <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <img src="{{ asset('images/product10.jpg') }}" alt="Producto 10" class="w-full h-48 object-contain" />
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Producto 10</h3>
                    <p class="text-[#556B2F] font-bold text-xl">$95.000</p>
                    <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Imágenes Referenciales -->
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold mb-8">Nuestra Armería</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <img src="{{ asset('images/armeria1.jpg') }}" alt="Armería 1" class="rounded-lg object-cover h-64 w-full" />
            <img src="{{ asset('images/armeria2.jpg') }}" alt="Armería 2" class="rounded-lg object-cover h-64 w-full" />
            <img src="{{ asset('images/armeria3.jpg') }}" alt="Armería 3" class="rounded-lg object-cover h-64 w-full" />
        </div>
    </section>

    <!-- Sección Productos Destacados -->
    <section class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Camping / Trekking</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Primera fila de productos -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product1.jpg') }}" alt="Producto 1" class="w-full h-48 object-cover" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 1</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$100.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product2.jpg') }}" alt="Producto 2" class="w-full h-48 object-cover" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 2</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$120.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product3.jpg') }}" alt="Producto 3" class="w-full h-48 object-cover" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 3</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$90.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product4.jpg') }}" alt="Producto 4" class="w-full h-48 object-cover" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 4</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$110.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <!-- Segunda fila de productos -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product5.jpg') }}" alt="Producto 5" class="w-full h-48 object-cover" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 5</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$130.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product6.jpg') }}" alt="Producto 6" class="w-full h-48 object-cover" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 6</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$140.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product7.jpg') }}" alt="Producto 7" class="w-full h-48 object-cover" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 7</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$150.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('images/product8.jpg') }}" alt="Producto 8" class="w-full h-48 object-cover" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Producto 8</h3>
                        <p class="text-[#556B2F] font-bold text-xl">$160.000</p>
                        <a href="#" class="inline-block mt-4 bg-[#556B2F] text-white py-2 px-4 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más</a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <button class="bg-[#556B2F] text-white py-2 px-6 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más Productos</button>
            </div>
        </div>
    </section>

    <!-- Sección Mapa y Contacto -->
    <section class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-2 gap-12">
        <div>
            <h2 class="text-3xl font-bold mb-6">Encuéntranos</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3329.123456789!2d-70.123456!3d-33.123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzPCsDA3JzAwLjAiUyA3MMKwMDcnMDAuMCJX!5e0!3m2!1ses!2scl!4v0000000000000" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div>
            <h2 class="text-3xl font-bold mb-6">Contáctanos</h2>
            <form action="#" method="POST" class="space-y-4">
                <input type="text" name="name" placeholder="Nombre" required class="w-full px-4 py-2 border rounded" />
                <input type="email" name="email" placeholder="Correo electrónico" required class="w-full px-4 py-2 border rounded" />
                <textarea name="message" placeholder="Mensaje" rows="4" required class="w-full px-4 py-2 border rounded"></textarea>
            <button type="submit" class="bg-[#556B2F] text-white px-6 py-2 rounded hover:bg-[#2F4F4F] transition-colors">Enviar</button>
            </form>
        </div>
    </section>
@endsection
