@if (request()->routeIs('dashboard') || request()->routeIs('profile.*') || request()->is('admin/*'))
    {{-- ========================================== --}}
    {{-- NAVIGASI DASHBOARD (SETELAH LOGIN)         --}}
    {{-- ========================================== --}}
    @php
        $onDashboard = request()->routeIs('dashboard');
        $onKonten = request()->routeIs('admin.news.*', 'admin.galleries.*', 'admin.attachments.*');
        $onOrganisasi = request()->routeIs('admin.organizations.*', 'admin.members.*', 'admin.registrations.*');
        $onPengaturan = request()->routeIs('admin.settings.*', 'admin.users.*');

        $topBase = 'inline-flex items-center gap-1 border-b-2 px-1 pt-1 text-sm font-semibold leading-5 transition duration-150 ease-in-out';
        $topOn = 'border-white text-white';
        $topOff = 'border-transparent text-imk-100 hover:border-imk-200 hover:text-white';

        $itemOn = 'bg-imk-50 font-bold text-imk-600';

        $panelBase = 'flex items-center gap-3 border-l-4 py-2.5 pe-4 ps-4 text-base font-medium transition duration-150 ease-in-out';
        $panelOn = 'border-white bg-imk-500 text-white';
        $panelOff = 'border-transparent text-imk-100 hover:border-imk-300 hover:bg-imk-500 hover:text-white';
    @endphp

    <nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-imk-500 bg-imk-600 shadow-md">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex">
                    {{-- Logo --}}
                    <div class="flex shrink-0 items-center">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('image/logo.png') }}" class="block h-10 w-auto sm:h-12" alt="Logo IMK">
                        </a>
                    </div>

                    {{-- Link navigasi (desktop) --}}
                    <div class="hidden lg:-my-px lg:ms-10 lg:flex lg:space-x-8">
                        <a href="{{ route('dashboard') }}"
                            class="{{ $topBase }} {{ $onDashboard ? $topOn : $topOff }}">
                            Dashboard
                        </a>

                        {{-- Grup: Konten --}}
                        <div class="flex items-center">
                            <x-dropdown align="left" width="w-56">
                                <x-slot name="trigger">
                                    <button class="{{ $topBase }} {{ $onKonten ? $topOn : $topOff }} h-16">
                                        Konten
                                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.news.index')"
                                        class="{{ request()->routeIs('admin.news.*') ? $itemOn : '' }}">Berita</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.galleries.index')"
                                        class="{{ request()->routeIs('admin.galleries.*') ? $itemOn : '' }}">Galeri</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.attachments.index')"
                                        class="{{ request()->routeIs('admin.attachments.*') ? $itemOn : '' }}">Dokumen</x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        {{-- Grup: Organisasi --}}
                        <div class="flex items-center">
                            <x-dropdown align="left" width="w-56">
                                <x-slot name="trigger">
                                    <button class="{{ $topBase }} {{ $onOrganisasi ? $topOn : $topOff }} h-16">
                                        Organisasi
                                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.organizations.index')"
                                        class="{{ request()->routeIs('admin.organizations.*', 'admin.members.*') ? $itemOn : '' }}">Struktur
                                        Organisasi</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.registrations.index')"
                                        class="{{ request()->routeIs('admin.registrations.*') ? $itemOn : '' }}">Data
                                        Pendaftar</x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        {{-- Grup: Pengaturan --}}
                        <div class="flex items-center">
                            <x-dropdown align="left" width="w-56">
                                <x-slot name="trigger">
                                    <button class="{{ $topBase }} {{ $onPengaturan ? $topOn : $topOff }} h-16">
                                        Pengaturan
                                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.settings.edit')"
                                        class="{{ request()->routeIs('admin.settings.*') ? $itemOn : '' }}">Pengaturan
                                        Beranda</x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.users.index')"
                                        class="{{ request()->routeIs('admin.users.*') ? $itemOn : '' }}">Akun
                                        Admin</x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>

                {{-- Menu pengguna (desktop) --}}
                <div class="hidden lg:ms-6 lg:flex lg:items-center lg:gap-3">
                    <a href="{{ route('welcome') }}" target="_blank" rel="noopener"
                        class="inline-flex items-center gap-1.5 text-sm font-semibold text-imk-100 transition hover:text-white">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Lihat Web
                    </a>

                    <x-dropdown align="right" width="w-48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center rounded-lg border border-transparent bg-white px-3 py-2 text-sm font-bold leading-4 text-imk-600 shadow-sm transition ease-in-out hover:bg-imk-50 focus:outline-none">
                                <span class="max-w-[10rem] truncate">{{ Auth::user()->name ?? 'User' }}</span>
                                <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')"
                                class="{{ request()->routeIs('profile.*') ? $itemOn : '' }}">Pengaturan
                                Akun</x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-600 hover:bg-red-50">Keluar</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                {{-- Hamburger --}}
                <div class="-me-2 flex items-center lg:hidden">
                    <button @click="open = ! open" :aria-expanded="open.toString()" aria-label="Buka menu navigasi"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-imk-100 transition duration-150 ease-in-out hover:bg-imk-500 hover:text-white focus:bg-imk-500 focus:text-white focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Panel navigasi mobile --}}
        <div :class="{ 'block': open, 'hidden': ! open }"
            class="hidden max-h-[calc(100vh-4rem)] overflow-y-auto bg-imk-700 pb-4 lg:hidden">

            <div class="pt-2">
                <a href="{{ route('dashboard') }}" class="{{ $panelBase }} {{ $onDashboard ? $panelOn : $panelOff }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </div>

            <p class="px-4 pb-1 pt-4 text-[11px] font-bold uppercase tracking-wider text-imk-200">Konten</p>
            <div class="space-y-1">
                <a href="{{ route('admin.news.index') }}"
                    class="{{ $panelBase }} {{ request()->routeIs('admin.news.*') ? $panelOn : $panelOff }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    Berita
                </a>
                <a href="{{ route('admin.galleries.index') }}"
                    class="{{ $panelBase }} {{ request()->routeIs('admin.galleries.*') ? $panelOn : $panelOff }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Galeri
                </a>
                <a href="{{ route('admin.attachments.index') }}"
                    class="{{ $panelBase }} {{ request()->routeIs('admin.attachments.*') ? $panelOn : $panelOff }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Dokumen
                </a>
            </div>

            <p class="px-4 pb-1 pt-4 text-[11px] font-bold uppercase tracking-wider text-imk-200">Organisasi</p>
            <div class="space-y-1">
                <a href="{{ route('admin.organizations.index') }}"
                    class="{{ $panelBase }} {{ request()->routeIs('admin.organizations.*', 'admin.members.*') ? $panelOn : $panelOff }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                    Struktur Organisasi
                </a>
                <a href="{{ route('admin.registrations.index') }}"
                    class="{{ $panelBase }} {{ request()->routeIs('admin.registrations.*') ? $panelOn : $panelOff }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Data Pendaftar
                </a>
            </div>

            <p class="px-4 pb-1 pt-4 text-[11px] font-bold uppercase tracking-wider text-imk-200">Pengaturan</p>
            <div class="space-y-1">
                <a href="{{ route('admin.settings.edit') }}"
                    class="{{ $panelBase }} {{ request()->routeIs('admin.settings.*') ? $panelOn : $panelOff }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    </svg>
                    Pengaturan Beranda
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="{{ $panelBase }} {{ request()->routeIs('admin.users.*') ? $panelOn : $panelOff }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Akun Admin
                </a>
                <a href="{{ route('welcome') }}" target="_blank" rel="noopener"
                    class="{{ $panelBase }} {{ $panelOff }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Lihat Web
                </a>
            </div>

            {{-- Info pengguna --}}
            <div class="mt-4 border-t border-imk-500 pt-4">
                <div class="flex items-center gap-3 px-4">
                    <span
                        class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-imk-500 text-sm font-black text-white">
                        {{ strtoupper(mb_substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </span>
                    <div class="min-w-0">
                        <div class="truncate text-base font-bold text-white">{{ Auth::user()->name ?? 'User' }}</div>
                        <div class="truncate text-sm text-imk-200">{{ Auth::user()->email ?? '' }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}"
                        class="{{ $panelBase }} {{ request()->routeIs('profile.*') ? $panelOn : $panelOff }}">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pengaturan Akun
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="{{ $panelBase }} border-transparent text-red-200 hover:border-red-300 hover:bg-imk-500 hover:text-white">
                            <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </nav>
@else
    {{-- ========================================== --}}
    {{-- NAVIGASI PUBLIK (SEBELUM LOGIN)            --}}
    {{-- ========================================== --}}
    @php
        $publicLinks = [
            ['label' => 'Beranda', 'url' => route('welcome'), 'active' => request()->is('/')],
            ['label' => 'Tentang', 'url' => url('/tentang'), 'active' => request()->routeIs('tentang')],
            ['label' => 'Berita', 'url' => route('berita'), 'active' => request()->routeIs('berita')],
            ['label' => 'Struktur', 'url' => route('struktur'), 'active' => request()->routeIs('struktur')],
            ['label' => 'Galeri', 'url' => route('galeri'), 'active' => request()->routeIs('galeri')],
            ['label' => 'Lampiran', 'url' => route('lampiran'), 'active' => request()->routeIs('lampiran')],
            ['label' => 'Pendaftaran', 'url' => route('pendaftaran'), 'active' => request()->routeIs('pendaftaran')],
        ];
    @endphp

    <nav x-data="{ open: false }"
        class="sticky top-0 z-50 border-b border-gray-100 bg-white/90 shadow-sm backdrop-blur-md transition-all duration-300">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between sm:h-20">

                <div class="flex flex-1 justify-start">
                    <a href="{{ route('welcome') }}">
                        <img class="h-12 w-12 object-contain transition-transform hover:scale-105 sm:h-16 sm:w-16"
                            src="{{ asset('image/logo.png') }}" alt="Logo IMK">
                    </a>
                </div>

                <div class="hidden flex-none justify-center lg:flex">
                    <div class="flex space-x-1 rounded-[15px] border border-imk-100/50 bg-imk-50/80 p-1.5">
                        @foreach ($publicLinks as $link)
                            <a href="{{ $link['url'] }}"
                                class="rounded-[10px] px-3.5 py-2 text-sm font-bold transition duration-300 xl:px-5 {{ $link['active'] ? 'bg-imk-600 text-white shadow-md' : 'text-gray-600 hover:bg-white hover:text-imk-600' }}">
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="hidden flex-1 items-center justify-end lg:flex">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="transform rounded-full border border-imk-200 bg-imk-100 px-6 py-2.5 text-sm font-bold text-imk-600 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:bg-imk-200 hover:shadow-md">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="transform rounded-full bg-imk-600 px-6 py-2.5 text-sm font-bold text-white shadow-md transition-all duration-300 hover:-translate-y-0.5 hover:bg-imk-500 hover:shadow-lg">
                            Masuk
                        </a>
                    @endauth
                </div>

                {{-- Hamburger (mobile) --}}
                <div class="flex items-center lg:hidden">
                    <button @click="open = ! open" :aria-expanded="open.toString()" aria-label="Buka menu navigasi"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-gray-600 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-imk-600 focus:bg-gray-100 focus:text-imk-600 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Panel navigasi mobile (publik) --}}
        <div :class="{ 'block': open, 'hidden': ! open }"
            class="absolute inset-x-0 z-50 hidden max-h-[calc(100vh-4rem)] overflow-y-auto border-b border-gray-100 bg-white shadow-lg lg:hidden">
            <div class="space-y-1 pb-3 pt-2">
                @foreach ($publicLinks as $link)
                    <a href="{{ $link['url'] }}"
                        class="block w-full border-l-4 py-3 pe-4 ps-6 text-base font-medium transition duration-150 ease-in-out {{ $link['active'] ? 'border-imk-600 bg-imk-50 font-bold text-imk-600' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:text-imk-600' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="border-t border-gray-100 px-6 pb-4 pt-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="flex w-full justify-center rounded-xl border border-imk-200 bg-imk-100 px-6 py-3 text-center text-sm font-bold text-imk-600 transition-all duration-300 hover:bg-imk-200">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="flex w-full justify-center rounded-xl bg-imk-600 px-6 py-3 text-center text-sm font-bold text-white transition-all duration-300 hover:bg-imk-500">
                        Masuk Admin
                    </a>
                @endauth
            </div>
        </div>
    </nav>
@endif
