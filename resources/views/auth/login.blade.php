<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full max-w-md">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-black rounded-full mb-6 shadow-2xl border-2 border-green-600">
                <img src="{{ asset('images/logo.png') }}" alt="Valle Táctico" class="w-16 h-16 object-contain">
            </div>
            <h2 class="text-3xl font-bold text-white mb-3 tracking-wide">PANEL ADMINISTRATIVO</h2>
            <p class="text-green-400 text-lg font-medium">Valle Táctico - Gestión de Armería</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-lg shadow-lg p-8 border border-gray-200">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Correo Electrónico')" class="text-gray-700 font-medium" />
                    <x-text-input id="email"
                                  class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required
                                  autofocus
                                  autocomplete="username"
                                  placeholder="admin@valletactico.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 font-medium" />

                    <x-text-input id="password"
                                  class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors"
                                  type="password"
                                  name="password"
                                  required
                                  autocomplete="current-password"
                                  placeholder="••••••••" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Remember Me -->
                <div class="mb-6">
                    <label for="remember_me" class="inline-flex items-center text-gray-700">
                        <input id="remember_me"
                               type="checkbox"
                               class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500"
                               name="remember">
                        <span class="ms-2 text-sm">{{ __('Recordarme') }}</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 hover:text-green-600 transition-colors underline" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif

                    <x-primary-button class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        {{ __('Iniciar Sesión') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">
                © 2024 Valle Táctico. Todos los derechos reservados.
            </p>
        </div>
    </div>
</x-guest-layout>
