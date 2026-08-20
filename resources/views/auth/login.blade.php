<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="relative z-10 mb-4 rounded-2xl border border-green-200 bg-green-50 px-4 py-2.5 text-center" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="preserve-3d relative z-10 space-y-4" style="transform: translateZ(24px)">
        @csrf

        <!-- Email Address -->
        <div class="relative z-10">
            <x-input-label for="email" value="Email" class="ms-1 text-xs uppercase tracking-wider text-imk-400" />

            <div class="relative mt-1.5">
                <span class="pointer-events-none absolute inset-y-0 left-0 z-10 flex items-center pl-3.5 text-imk-200">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </span>

                <x-text-input id="email"
                                class="relative block w-full rounded-xl border-gray-200 bg-gray-50/80 py-2.5 pl-10 text-sm shadow-inner transition focus:bg-white"
                                type="email"
                                name="email"
                                :value="old('email')"
                                placeholder="nama@email.com"
                                required autofocus autocomplete="username" />
            </div>

            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div class="relative z-10">
            <x-input-label for="password" value="Kata Sandi" class="ms-1 text-xs uppercase tracking-wider text-imk-400" />

            <div class="relative mt-1.5">
                <span class="pointer-events-none absolute inset-y-0 left-0 z-10 flex items-center pl-3.5 text-imk-200">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </span>

                <x-text-input id="password"
                                class="relative block w-full rounded-xl border-gray-200 bg-gray-50/80 py-2.5 pl-10 text-sm shadow-inner transition focus:bg-white"
                                type="password"
                                name="password"
                                placeholder="Masukkan kata sandi"
                                required autocomplete="current-password" />
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="relative z-10 flex flex-wrap items-center justify-between gap-2">
            <label for="remember_me" class="inline-flex cursor-pointer items-center">
                <input id="remember_me" type="checkbox" name="remember"
                        class="h-4 w-4 cursor-pointer rounded border-gray-300 text-imk-600 shadow-sm focus:ring-imk-400">
                <span class="ms-2 text-xs text-gray-600">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="rounded-md text-xs font-medium text-imk-300 underline-offset-2 transition-colors hover:text-imk-600 hover:underline focus:outline-none focus:ring-2 focus:ring-imk-400 focus:ring-offset-2"
                    href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            @endif
        </div>

        <!-- Submit -->
        <div class="relative z-10 pt-1">
            <div class="pointer-events-none absolute inset-x-6 -bottom-2 z-0 h-7 rounded-full bg-imk-300/50 blur-xl"></div>

            <x-primary-button class="relative z-10 w-full justify-center py-3 shadow-[0_20px_38px_-16px_rgba(5,31,32,.9)]">
                <svg class="me-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Masuk
            </x-primary-button>
        </div>
    </form>

    <div class="relative z-10 mt-6 border-t border-gray-100 pt-4 text-center">
        <a href="/" class="inline-flex items-center text-xs text-gray-500 transition-colors hover:text-imk-600">
            <svg class="me-1.5 h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke beranda
        </a>
    </div>
</x-guest-layout>
