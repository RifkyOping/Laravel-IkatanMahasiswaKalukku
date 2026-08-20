@php
    // Kartu statistik & menu dirender dari array agar tidak ada markup yang
    // diduplikasi enam kali seperti versi sebelumnya.
    $cards = [
        [
            'label' => 'Berita',
            'total' => $stats['news']['total'],
            'recent' => $stats['news']['recent'],
            'url' => route('admin.news.index'),
            'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-.586-1.414l-4.5-4.5A2 2 0 0012.586 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14z',
        ],
        [
            'label' => 'Galeri',
            'total' => $stats['galleries']['total'],
            'recent' => $stats['galleries']['recent'],
            'url' => route('admin.galleries.index'),
            'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
        ],
        [
            'label' => 'Pendaftar',
            'total' => $stats['registrations']['total'],
            'recent' => $stats['registrations']['recent'],
            'url' => route('admin.registrations.index'),
            'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
        ],
        [
            'label' => 'Dokumen',
            'total' => $stats['attachments']['total'],
            'recent' => $stats['attachments']['recent'],
            'url' => route('admin.attachments.index'),
            'icon' => 'M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13',
        ],
    ];

    $menus = [
        [
            'label' => 'Berita',
            'desc' => 'Tambah, edit, atau hapus berita',
            'url' => route('admin.news.index'),
            'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-.586-1.414l-4.5-4.5A2 2 0 0012.586 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14z',
        ],
        [
            'label' => 'Galeri',
            'desc' => 'Kelola dokumentasi kegiatan',
            'url' => route('admin.galleries.index'),
            'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
        ],
        [
            'label' => 'Dokumen',
            'desc' => 'Upload dan kelola file lampiran',
            'url' => route('admin.attachments.index'),
            'icon' => 'M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13',
        ],
        [
            'label' => 'Struktur Organisasi',
            'desc' => 'Kelola jabatan dan anggota',
            'url' => route('admin.organizations.index'),
            'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
        ],
        [
            'label' => 'Data Pendaftar',
            'desc' => 'Kelola data pendaftaran anggota',
            'url' => route('admin.registrations.index'),
            'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
        ],
        [
            'label' => 'Pengaturan Beranda',
            'desc' => 'Kontak, sosial media, dan foto struktur',
            'url' => route('admin.settings.edit'),
            'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z',
        ],
        [
            'label' => 'Akun Admin',
            'desc' => 'Daftar pengguna yang punya akses',
            'url' => route('admin.users.index'),
            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
        ],
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black leading-tight text-imk-600 sm:text-3xl">Dashboard</h2>
                <p class="mt-1 text-sm text-gray-600">
                    Ringkasan konten dan aktivitas website
                    @if ($orgPeriod)
                        <span class="text-gray-400">&middot;</span> Periode {{ $orgPeriod }}
                    @endif
                </p>
            </div>

            <a href="{{ route('register') }}"
                class="inline-flex items-center gap-2 rounded-full bg-imk-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-imk-500 focus:outline-none focus:ring-2 focus:ring-imk-400 focus:ring-offset-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Tambah Admin
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                </div>
            @endif

            {{-- Lapis 1: sambutan + status pendaftaran --}}
            <section class="relative overflow-hidden rounded-3xl px-6 py-7 sm:px-8"
                style="background: radial-gradient(120% 140% at 100% 0%, #235347 0%, #0B2B26 55%, #051F20 100%)">
                <div class="pointer-events-none absolute -right-16 -top-24 h-64 w-64 rounded-full bg-imk-200/10 blur-3xl"></div>

                <div class="relative flex flex-wrap items-end justify-between gap-6">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-[.2em] text-imk-200">Selamat datang</p>
                        <h3 class="mt-1.5 text-2xl font-black text-white sm:text-3xl">{{ Auth::user()->name }}</h3>
                        <p class="mt-1.5 max-w-xl text-sm text-imk-100/80">
                            Kelola berita, galeri, dokumen, dan data pendaftar dari satu tempat.
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        @if ($isRegistrationOpen)
                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-400/15 px-4 py-2 text-xs font-bold text-emerald-300 ring-1 ring-inset ring-emerald-400/30">
                                <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                                Pendaftaran dibuka
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-bold text-imk-100 ring-1 ring-inset ring-white/20">
                                <span class="h-2 w-2 rounded-full bg-gray-400"></span>
                                Pendaftaran ditutup
                            </span>
                        @endif

                        <a href="{{ route('admin.registrations.index') }}"
                            class="inline-flex items-center gap-1.5 rounded-full bg-white px-4 py-2 text-xs font-bold text-imk-600 transition hover:bg-imk-50">
                            Atur pendaftaran
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>

            {{-- Lapis 2: kartu statistik --}}
            <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($cards as $card)
                    <a href="{{ $card['url'] }}"
                        class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-0.5 hover:border-imk-200 hover:shadow-lg">
                        <div class="flex items-start justify-between">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-imk-100 text-imk-300 transition group-hover:bg-imk-300 group-hover:text-white">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}" />
                                </svg>
                            </span>

                            @if ($card['recent'] > 0)
                                <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-bold text-emerald-700">
                                    +{{ $card['recent'] }}
                                </span>
                            @endif
                        </div>

                        <p class="mt-4 text-3xl font-black tabular-nums text-imk-600">{{ number_format($card['total']) }}</p>
                        <p class="mt-0.5 text-sm font-semibold text-gray-700">{{ $card['label'] }}</p>
                        <p class="mt-1 text-xs text-gray-500">
                            {{ $card['recent'] > 0 ? $card['recent'] . ' baru dalam 30 hari' : 'Tidak ada tambahan baru' }}
                        </p>
                    </a>
                @endforeach
            </section>

            {{-- Lapis 3: tren + aktivitas terbaru --}}
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <div class="rounded-2xl border border-gray-200 bg-white p-6 lg:col-span-2">
                    <div class="flex flex-wrap items-baseline justify-between gap-2">
                        <div>
                            <h4 class="text-base font-bold text-imk-600">Tren Pendaftar</h4>
                            <p class="mt-0.5 text-xs text-gray-500">Enam bulan terakhir</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            Total <span class="font-bold text-imk-600">{{ number_format($stats['registrations']['total']) }}</span>
                        </p>
                    </div>

                    <div class="mt-6 flex h-44 items-end gap-3">
                        @foreach ($trend as $point)
                            <div class="group flex flex-1 flex-col items-center justify-end gap-2">
                                <span class="text-xs font-bold tabular-nums text-gray-600">{{ $point['count'] }}</span>

                                <div class="flex w-full items-end justify-center" style="height: 7.5rem">
                                    <div class="w-full rounded-t-lg bg-imk-200/45 transition-all duration-300 group-hover:bg-imk-300"
                                        style="height: {{ max(4, (int) round($point['count'] / $trendMax * 100)) }}%"></div>
                                </div>

                                <span class="text-[11px] font-medium uppercase tracking-wide text-gray-500">{{ $point['label'] }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 border-t border-gray-100 pt-5">
                        <div class="flex items-center justify-between">
                            <h5 class="text-sm font-bold text-imk-600">Pendaftar Terbaru</h5>
                            <a href="{{ route('admin.registrations.index') }}" class="text-xs font-semibold text-imk-300 hover:text-imk-600 hover:underline">Lihat semua</a>
                        </div>

                        @if ($recentRegistrations->isEmpty())
                            <p class="mt-4 rounded-xl bg-gray-50 px-4 py-6 text-center text-sm text-gray-500">Belum ada pendaftar yang masuk.</p>
                        @else
                            <ul class="mt-3 divide-y divide-gray-100">
                                @foreach ($recentRegistrations as $registration)
                                    <li class="flex items-center gap-3 py-3">
                                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-imk-100 text-xs font-bold uppercase text-imk-300">
                                            {{ \Illuminate\Support\Str::substr($registration->name, 0, 2) }}
                                        </span>
                                        <div class="min-w-0 flex-1">
                                            <p class="truncate text-sm font-semibold text-gray-800">{{ $registration->name }}</p>
                                            <p class="truncate text-xs text-gray-500">{{ $registration->study_program }} &middot; {{ $registration->university }}</p>
                                        </div>
                                        <span class="shrink-0 text-xs text-gray-400">{{ $registration->created_at?->diffForHumans(short: true) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white p-6">
                        <h4 class="text-base font-bold text-imk-600">Ringkasan Lain</h4>

                        <dl class="mt-4 space-y-3">
                            <div class="flex items-center justify-between rounded-xl bg-gray-50 px-4 py-3">
                                <dt class="text-sm text-gray-600">Jabatan</dt>
                                <dd class="text-sm font-bold tabular-nums text-imk-600">{{ number_format($organizationCount) }}</dd>
                            </div>
                            <div class="flex items-center justify-between rounded-xl bg-gray-50 px-4 py-3">
                                <dt class="text-sm text-gray-600">Anggota struktur</dt>
                                <dd class="text-sm font-bold tabular-nums text-imk-600">{{ number_format($memberCount) }}</dd>
                            </div>
                            <div class="flex items-center justify-between rounded-xl bg-gray-50 px-4 py-3">
                                <dt class="text-sm text-gray-600">Dokumen disembunyikan</dt>
                                <dd class="text-sm font-bold tabular-nums text-imk-600">{{ number_format($hiddenAttachmentCount) }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-white p-6">
                        <div class="flex items-center justify-between">
                            <h4 class="text-base font-bold text-imk-600">Berita Terbaru</h4>
                            <a href="{{ route('admin.news.index') }}" class="text-xs font-semibold text-imk-300 hover:text-imk-600 hover:underline">Kelola</a>
                        </div>

                        @if ($recentNews->isEmpty())
                            <p class="mt-4 rounded-xl bg-gray-50 px-4 py-6 text-center text-sm text-gray-500">Belum ada berita.</p>
                        @else
                            <ul class="mt-3 space-y-3">
                                @foreach ($recentNews as $news)
                                    <li>
                                        <a href="{{ route('admin.news.edit', $news) }}" class="group block">
                                            <p class="line-clamp-2 text-sm font-semibold text-gray-800 transition group-hover:text-imk-300">{{ $news->title }}</p>
                                            <p class="mt-0.5 text-xs text-gray-400">{{ $news->created_at?->translatedFormat('d M Y') }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </section>

            {{-- Lapis 4: menu pengelolaan --}}
            <section class="rounded-2xl border border-gray-200 bg-white p-6">
                <h4 class="text-base font-bold text-imk-600">Menu Pengelolaan</h4>
                <p class="mt-0.5 text-xs text-gray-500">Semua modul yang bisa kamu kelola</p>

                <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($menus as $menu)
                        <a href="{{ $menu['url'] }}"
                            class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50/70 px-4 py-3.5 transition hover:border-imk-200 hover:bg-white hover:shadow-md">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-white text-imk-300 ring-1 ring-gray-100 transition group-hover:bg-imk-300 group-hover:text-white group-hover:ring-imk-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $menu['icon'] }}" />
                                </svg>
                            </span>

                            <span class="min-w-0">
                                <span class="block truncate text-sm font-bold text-gray-800">{{ $menu['label'] }}</span>
                                <span class="block truncate text-xs text-gray-500">{{ $menu['desc'] }}</span>
                            </span>

                            <svg class="ms-auto h-4 w-4 shrink-0 text-gray-300 transition group-hover:translate-x-0.5 group-hover:text-imk-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endforeach
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
