<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex min-w-0 items-center gap-3">
                <a href="{{ route('admin.registrations.index') }}" aria-label="Kembali"
                    class="inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl text-gray-600 transition hover:bg-gray-100 hover:text-imk-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div class="min-w-0">
                    <h2 class="truncate text-2xl font-black leading-tight text-imk-600 sm:text-3xl">Detail Pendaftar</h2>
                    <p class="mt-1 truncate text-sm text-gray-600">{{ $registration->name }}</p>
                </div>
            </div>
        </div>
    </x-slot>

    @php
        // Nomor lokal 08xx tidak valid untuk wa.me yang menuntut kode negara,
        // jadi awalan 0 dinormalkan menjadi 62. URL dirangkai di sini agar tidak
        // perlu menggabung string di dalam ekspresi Blade.
        $waDigits = preg_replace('/[^0-9]/', '', (string) $registration->phone);
        $waNumber = str_starts_with($waDigits, '0') ? '62' . substr($waDigits, 1) : $waDigits;
        $waUrl = $waNumber ? 'https://wa.me/' . $waNumber : null;

        $dataPribadi = [
            'Nama Lengkap' => $registration->name,
            'Jenis Kelamin' => $registration->gender,
            'Tempat Lahir' => $registration->birth_place ?: '—',
            'Tanggal Lahir' => $registration->birth_date
                ? \Carbon\Carbon::parse($registration->birth_date)->format('d M Y')
                : '—',
        ];

        $dataPendidikan = [
            'Asal Sekolah' => $registration->high_school ?: '—',
            'Universitas' => $registration->university ?: '—',
            'Fakultas' => $registration->faculty ?: '—',
            'Program Studi' => $registration->study_program ?: '—',
            'Angkatan' => $registration->entry_year ?: '—',
        ];

        $dataAlamat = [
            'Alamat di Kalukku' => $registration->address_kalukku ?: '—',
            'Alamat di Majene' => $registration->address_majene ?: '—',
        ];
    @endphp

    <div class="py-8">
        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Identitas --}}
            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex min-w-0 items-center gap-4">
                        <span
                            class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-imk-400 to-imk-600 text-xl font-black text-white">
                            {{ strtoupper(mb_substr($registration->name, 0, 1)) }}
                        </span>
                        <div class="min-w-0">
                            <p class="truncate text-lg font-black text-imk-600">{{ $registration->name }}</p>
                            <p class="mt-0.5 text-sm text-gray-600">
                                Mendaftar {{ $registration->created_at?->format('d M Y, H:i') ?? '—' }}
                            </p>
                        </div>
                    </div>

                    @if ($waUrl)
                        <a href="{{ $waUrl }}" target="_blank" rel="noopener"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Hubungi via WhatsApp
                        </a>
                    @endif
                </div>
            </div>

            {{-- Data pribadi & pendidikan --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-6">
                    <h3 class="text-base font-bold text-imk-600">Data Pribadi</h3>
                    <dl class="mt-4 divide-y divide-gray-100">
                        @foreach ($dataPribadi as $label => $value)
                            <div class="flex flex-col gap-1 py-3 sm:flex-row sm:items-start sm:gap-4">
                                <dt class="text-xs font-bold uppercase tracking-wider text-gray-600 sm:w-2/5">
                                    {{ $label }}</dt>
                                <dd class="break-words text-sm font-medium text-gray-800 sm:flex-1">{{ $value }}</dd>
                            </div>
                        @endforeach

                        <div class="flex flex-col gap-1 py-3 sm:flex-row sm:items-start sm:gap-4">
                            <dt class="text-xs font-bold uppercase tracking-wider text-gray-600 sm:w-2/5">Nomor HP/WA
                            </dt>
                            <dd class="text-sm font-medium sm:flex-1">
                                @if ($waUrl)
                                    <a href="{{ $waUrl }}" target="_blank" rel="noopener"
                                        class="inline-flex items-center gap-1.5 text-emerald-700 hover:underline">
                                        {{ $registration->phone }}
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                @else
                                    <span class="text-gray-800">—</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-6">
                    <h3 class="text-base font-bold text-imk-600">Data Pendidikan</h3>
                    <dl class="mt-4 divide-y divide-gray-100">
                        @foreach ($dataPendidikan as $label => $value)
                            <div class="flex flex-col gap-1 py-3 sm:flex-row sm:items-start sm:gap-4">
                                <dt class="text-xs font-bold uppercase tracking-wider text-gray-600 sm:w-2/5">
                                    {{ $label }}</dt>
                                <dd class="break-words text-sm font-medium text-gray-800 sm:flex-1">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>

            {{-- Alamat --}}
            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-6">
                <h3 class="text-base font-bold text-imk-600">Alamat</h3>
                <dl class="mt-4 divide-y divide-gray-100">
                    @foreach ($dataAlamat as $label => $value)
                        <div class="flex flex-col gap-1 py-3 sm:flex-row sm:items-start sm:gap-4">
                            <dt class="text-xs font-bold uppercase tracking-wider text-gray-600 sm:w-1/4">{{ $label }}
                            </dt>
                            <dd class="break-words text-sm font-medium text-gray-800 sm:flex-1">{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            {{-- Dokumen izin orang tua --}}
            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex items-center gap-2">
                    <svg class="h-5 w-5 flex-shrink-0 text-imk-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                    <h3 class="text-base font-bold text-imk-600">Dokumen Izin Orang Tua</h3>
                </div>

                @if ($registration->parent_permit_file)
                    <div class="mt-4 flex flex-col gap-2 sm:flex-row">
                        <a href="{{ asset('storage/' . $registration->parent_permit_file) }}" target="_blank"
                            rel="noopener"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-imk-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-imk-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Lihat File
                        </a>
                        <a href="{{ asset('storage/' . $registration->parent_permit_file) }}" download
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-bold text-gray-800 ring-1 ring-gray-200 transition hover:bg-gray-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Unduh
                        </a>
                    </div>
                @else
                    <div class="mt-4 flex items-start gap-3 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3">
                        <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-sm font-medium text-amber-800">Pendaftar ini belum mengunggah dokumen izin orang
                            tua.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
