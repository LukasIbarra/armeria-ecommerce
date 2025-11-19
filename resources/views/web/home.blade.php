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
                            <img src="{{ asset('images/logo.png') }}" 
                                 alt="T4E" 
                                 class="object-contain max-h-[38rem] drop-shadow-lg bg-transparent" />
                        </div>
                        <div class="md:w-1/2 mt-8 md:mt-0 md:pl-12 bg-transparent" style="background: transparent !important;">
                            <h2 class="text-5xl font-extrabold text-[#556B2F] mb-4"
                                data-aos="fade-right" data-aos-delay="400">Valle Tactico</h2>
                            <p class="text-lg mb-4 max-w-md"
                               data-aos="fade-right" data-aos-delay="600">
                                Ven a visitarnos y descubre nuestra amplia gama de armas y accesorios tácticos en Ulriksen.
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
        @if($categories->count() > 0)
            <div class="swiper categoriesSwiper">
                <div class="swiper-wrapper">
                    @foreach($categories as $category)
                    <div class="swiper-slide relative rounded-lg overflow-hidden shadow-lg cursor-pointer hover:shadow-2xl transition-shadow duration-300">
                        <a href="{{ route('web.category.show', $category->slug) }}" class="block w-full h-full">
                            <!-- Placeholder image for now - you can add category images later -->
                            <div class="w-full h-40 bg-gradient-to-br from-[#556B2F] to-[#2F4F4F] flex items-center justify-center">
                                <i class="fas fa-tag text-white text-4xl"></i>
                            </div>
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-white p-4">
                                <span class="font-semibold text-lg px-4 py-2 bg-[#556B2F] rounded-full mb-2">{{ $category->name }}</span>
                                <span class="text-sm">{{ $category->products_count }} productos</span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <!-- Paginación -->
                <div class="swiper-pagination"></div>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">No hay categorías disponibles en este momento.</p>
            </div>
        @endif
    </section>

    <!-- Sección Productos Destacados -->
    <section class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Productos Destacados</h2>
            @if($featuredProducts->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <a href="{{ route('web.product.index') }}" class="bg-[#556B2F] text-white py-2 px-6 rounded hover:bg-[#2F4F4F] transition-colors">Ver Más Productos</a>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No hay productos destacados disponibles en este momento.</p>
                </div>
            @endif
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
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold mb-8">Vestuario y Equipo</h2>
        @if($vestuarioCategory && $vestuarioProducts->count() > 0)
            <div class="grid grid-cols-4 gap-6">
                <!-- Card principal de categoría (ocupa 2 filas) -->
                <div class="col-span-1 row-span-2 relative rounded-lg overflow-hidden shadow-lg group cursor-pointer">
                    <a href="{{ route('web.category.show', $vestuarioCategory->slug) }}" class="block w-full h-full">
                        <img src="{{ asset('images/vestuario.jpg') }}" alt="Vestuario y Equipo" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-60 transition-all duration-300 flex flex-col justify-center items-center text-white p-6">
                            <h3 class="text-2xl font-bold mb-2">{{ $vestuarioCategory->name }}</h3>
                            <p class="text-sm mb-2">{{ $vestuarioCategory->products_count }} productos</p>
                            <span class="bg-[#556B2F] px-3 py-1 text-sm rounded hover:bg-[#2F4F4F] transition-colors">Ver Todos</span>
                        </div>
                    </a>
                </div>
                <!-- Productos de la categoría (3 productos en el lado derecho) -->
                @foreach($vestuarioProducts as $product)
                    <div class="col-span-1">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Categoría de vestuario no disponible en este momento.</p>
            </div>
        @endif
    </section>

    <!-- Sección Equipo de Caza -->
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold mb-8">Equipo de Caza</h2>
        @if($cazaCategory && $cazaProducts->count() > 0)
            <div class="grid grid-cols-4 gap-6">
                <!-- Card principal de categoría (ocupa 2 filas) -->
                <div class="col-span-1 row-span-2 relative rounded-lg overflow-hidden shadow-lg group cursor-pointer">
                    <a href="{{ route('web.category.show', $cazaCategory->slug) }}" class="block w-full h-full">
                        <img src="{{ asset('images/caza.jpg') }}" alt="Equipo de Caza" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-60 transition-all duration-300 flex flex-col justify-center items-center text-white p-6">
                            <h3 class="text-2xl font-bold mb-2">{{ $cazaCategory->name }}</h3>
                            <p class="text-sm mb-2">{{ $cazaCategory->products_count }} productos</p>
                            <span class="bg-[#556B2F] px-3 py-1 text-sm rounded hover:bg-[#2F4F4F] transition-colors">Ver Todos</span>
                        </div>
                    </a>
                </div>
                <!-- Productos de la categoría (3 productos en el lado derecho) -->
                @foreach($cazaProducts as $product)
                    <div class="col-span-1">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Categoría de caza no disponible en este momento.</p>
            </div>
        @endif
    </section>

    <!-- Sección Imágenes Referenciales -->
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold mb-8">Nuestra Armería</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <img src="{{ asset('images/armeria1.webp') }}" alt="Armería 1" class="rounded-lg object-cover h-64 w-full" />
            <img src="{{ asset('images/armeria2.webp') }}" alt="Armería 2" class="rounded-lg object-cover h-64 w-full" />
            <img src="{{ asset('images/armeria3.webp') }}" alt="Armería 3" class="rounded-lg object-cover h-64 w-full" />
        </div>
    </section>

    <!-- Sección Camping / Trekking -->
    <section class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Camping / Trekking</h2>
            @if($campingCategory && $campingProducts->count() > 0)
                <div class="grid grid-cols-5 gap-4">
                    <!-- Card principal de categoría (ocupa 2 filas) -->
                    <div class="col-span-2 row-span-3 relative rounded-lg overflow-hidden shadow-lg group cursor-pointer">
                        <a href="{{ route('web.category.show', $campingCategory->slug) }}" class="block w-full h-full">
                            <img src="{{ asset('images/trekking.jpg') }}" alt="Camping / Trekking" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
                            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-60 transition-all duration-300 flex flex-col justify-center items-center text-white p-6">
                                <h3 class="text-2xl font-bold mb-2">{{ $campingCategory->name }}</h3>
                                <p class="text-sm mb-2">{{ $campingCategory->products_count }} productos</p>
                                <span class="bg-[#556B2F] px-3 py-1 text-sm rounded hover:bg-[#2F4F4F] transition-colors">Ver Todos</span>
                            </div>
                        </a>
                    </div>
                    <!-- Productos de la categoría (6 productos en el lado derecho) -->
                    @foreach($campingProducts as $product)
                        <div class="col-span-1">
                            <x-product-card :product="$product" />
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">Categoría de camping no disponible en este momento.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Sección Mapa y Contacto -->
    <section class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-2 gap-12">
        <div>
            <h2 class="text-3xl font-bold mb-6">Encuéntranos</h2>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3457.5425737251126!2d-71.25587430000002!3d-29.93506840000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9691cbdea3024bab%3A0x633dff3562691f51!2sValle%20t%C3%A1ctico!5e0!3m2!1ses!2scl!4v1763131583108!5m2!1ses!2scl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>        </div>
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
