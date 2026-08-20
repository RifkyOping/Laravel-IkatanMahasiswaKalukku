<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black leading-tight text-imk-600">
                    Akun Admin
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Daftar akun yang memiliki akses ke panel administrasi IMK
                </p>
            </div>

            <a href="{{ route('register') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-imk-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-imk-500 focus:outline-none focus:ring-2 focus:ring-imk-400 focus:ring-offset-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Admin
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3">
                    <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-emerald-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                </div>
            @endif

            {{-- Statistik ringkas --}}
            @php
                $cards = [
                    [
                        'label' => 'Total Akun Admin',
                        'value' => $totalUsers,
                        'caption' => 'Akun dengan akses panel',
                        'icon' =>
                            'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                    ],
                    [
                        'label' => 'Akun Baru',
                        'value' => $recentUsers,
                        'caption' => 'Ditambahkan dalam 30 hari',
                        'icon' =>
                            'M12 9v3m0 0v3m3-3h-3m0 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z',
                    ],
                    [
                        'label' => 'Admin Terbaru',
                        'value' => $newestUser?->name ?? '—',
                        'caption' => $newestUser?->created_at
                            ? 'Bergabung ' . $newestUser->created_at->format('d M Y')
                            : 'Belum ada akun',
                        'icon' =>
                            'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($cards as $card)
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                        <div class="flex items-start gap-4">
                            <span
                                class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-imk-50 text-imk-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $card['icon'] }}" />
                                </svg>
                            </span>
                            <div class="min-w-0">
                                <p class="text-xs font-bold uppercase tracking-wider text-gray-600">
                                    {{ $card['label'] }}
                                </p>
                                <p class="mt-1 truncate text-2xl font-black text-imk-600" title="{{ $card['value'] }}">
                                    {{ $card['value'] }}
                                </p>
                                <p class="mt-0.5 truncate text-xs text-gray-600">{{ $card['caption'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Tabel akun --}}
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm" x-data="{ q: '' }">
                <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-100 px-5 py-4">
                    <div>
                        <h3 class="text-base font-bold text-imk-600">Daftar Akun Terdaftar</h3>
                        <p class="mt-0.5 text-xs text-gray-600">Diurutkan dari yang paling baru</p>
                    </div>

                    @if ($users->count() > 5)
                        <label class="relative block w-full sm:w-64">
                            <span class="sr-only">Cari akun</span>
                            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-600"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input x-model="q" type="search" placeholder="Cari nama atau email…"
                                class="w-full rounded-xl border-gray-200 py-2 pl-9 pr-3 text-sm text-gray-800 placeholder-gray-400 focus:border-imk-300 focus:ring-imk-300" />
                        </label>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/80">
                            <tr>
                                <th class="px-5 py-3 text-xs font-bold uppercase tracking-wider text-gray-600">Akun</th>
                                <th class="hidden px-5 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 md:table-cell">
                                    Email</th>
                                <th class="px-5 py-3 text-xs font-bold uppercase tracking-wider text-gray-600">Terdaftar
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($users as $user)
                                <tr class="transition-colors hover:bg-gray-50"
                                    x-show="q === '' || @js(strtolower($user->name . ' ' . $user->email)).includes(q.toLowerCase().trim())">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-imk-400 to-imk-600 text-sm font-black text-white">
                                                {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                                            </span>
                                            <div class="min-w-0">
                                                <div class="flex items-center gap-2">
                                                    <span
                                                        class="truncate font-semibold text-gray-800">{{ $user->name }}</span>
                                                    @if ($user->id === auth()->id())
                                                        <span
                                                            class="flex-shrink-0 rounded-full bg-imk-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-imk-600">Anda</span>
                                                    @endif
                                                </div>
                                                <p class="truncate text-xs text-gray-600 md:hidden">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden px-5 py-4 text-sm text-gray-600 md:table-cell">
                                        {{ $user->email }}
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4">
                                        <p class="text-sm font-medium text-gray-800">
                                            {{ $user->created_at?->format('d M Y') ?? '—' }}</p>
                                        <p class="text-xs text-gray-600">
                                            {{ $user->created_at?->format('H:i') }}</p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-5 py-12 text-center">
                                        <svg class="mx-auto h-10 w-10 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <p class="mt-3 text-sm font-medium text-gray-800">Belum ada akun yang terdaftar.</p>
                                        <p class="mt-1 text-xs text-gray-600">Tambahkan admin baru untuk mulai mengelola
                                            website.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
