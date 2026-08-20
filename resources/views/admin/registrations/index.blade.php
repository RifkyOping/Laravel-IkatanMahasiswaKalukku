<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-black leading-tight text-imk-600 sm:text-3xl">Data Pendaftar</h2>
            <p class="mt-1 text-sm text-gray-600">Kelola data mahasiswa yang mendaftar sebagai anggota IMK</p>
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

            {{-- Kartu kontrol: status pendaftaran + aksi massal --}}
            <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-sm sm:p-5">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                    <form id="formToggleStatus" action="{{ route('admin.registrations.toggleStatus') }}" method="POST"
                        class="flex items-center gap-3">
                        @csrf
                        <div class="min-w-0">
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-600">Status Pendaftaran</p>
                            <p class="mt-0.5 text-sm font-black {{ $setting->is_registration_open ? 'text-emerald-600' : 'text-red-600' }}">
                                {{ $setting->is_registration_open ? 'DIBUKA' : 'DITUTUP' }}
                            </p>
                        </div>

                        <label class="relative ms-auto inline-flex cursor-pointer items-center lg:ms-3">
                            <span class="sr-only">Ubah status pendaftaran</span>
                            <input id="toggleRegistration" type="checkbox" name="is_registration_open" value="1"
                                {{ $setting->is_registration_open ? 'checked' : '' }} class="peer sr-only">
                            <div
                                class="peer h-6 w-11 rounded-full bg-red-500 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-emerald-500 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-emerald-400">
                            </div>
                        </label>
                    </form>

                    <div class="flex flex-wrap gap-2">
                        <button type="button" id="btnWaLink"
                            data-current="{{ $setting->whatsapp_group_link ?? '' }}"
                            data-action="{{ route('admin.registrations.updateWaLink') }}"
                            class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-blue-500 sm:flex-none">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            Link WA
                        </button>

                        @if ($registrations->total() > 0)
                            <button type="button" id="btnExportCsv"
                                data-url-comma="{{ route('admin.registrations.exportCsv') }}?separator=comma"
                                data-url-semicolon="{{ route('admin.registrations.exportCsv') }}?separator=semicolon"
                                class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-500 sm:flex-none">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Ekspor CSV
                            </button>

                            <form id="formDeleteAll" action="{{ route('admin.registrations.destroyAll') }}"
                                method="POST" class="flex-1 sm:flex-none">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="btnDeleteAll"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-bold text-red-600 shadow-sm transition hover:bg-red-600 hover:text-white">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus Semua
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Tabel pendaftar --}}
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-4 py-4 sm:px-5">
                    <h3 class="text-base font-bold text-imk-600">Daftar Pendaftar</h3>
                    <p class="mt-0.5 text-xs text-gray-600">{{ $registrations->total() }} pendaftar terdaftar</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/80">
                            <tr>
                                <th class="hidden w-14 px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 sm:table-cell sm:px-5">
                                    No</th>
                                <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 sm:px-5">
                                    Nama Lengkap</th>
                                <th class="hidden px-5 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 xl:table-cell">
                                    Jenis Kelamin</th>
                                <th class="hidden px-5 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 md:table-cell">
                                    Universitas</th>
                                <th class="hidden px-5 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 lg:table-cell">
                                    Tanggal Daftar</th>
                                <th class="w-28 px-4 py-3 text-center text-xs font-bold uppercase tracking-wider text-gray-600 sm:px-5">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($registrations as $index => $registration)
                                <tr class="transition-colors hover:bg-gray-50">
                                    <td class="hidden px-4 py-4 text-sm font-medium text-gray-600 sm:table-cell sm:px-5">
                                        {{ $registrations->firstItem() + $index }}</td>

                                    <td class="px-4 py-4 sm:px-5">
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-imk-400 to-imk-600 text-sm font-black text-white">
                                                {{ strtoupper(mb_substr($registration->name, 0, 1)) }}
                                            </span>
                                            <div class="min-w-0">
                                                <p class="truncate text-sm font-bold text-imk-600 sm:text-base">
                                                    {{ $registration->name }}</p>
                                                <p class="mt-0.5 truncate text-xs text-gray-600 md:hidden">
                                                    {{ $registration->university }}</p>
                                                <p class="mt-0.5 text-xs text-gray-600 lg:hidden">
                                                    {{ $registration->created_at?->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="hidden whitespace-nowrap px-5 py-4 text-sm text-gray-600 xl:table-cell">
                                        {{ $registration->gender }}</td>

                                    <td class="hidden max-w-xs px-5 py-4 text-sm text-gray-600 md:table-cell">
                                        <span class="block truncate">{{ $registration->university }}</span>
                                    </td>

                                    <td class="hidden whitespace-nowrap px-5 py-4 text-sm text-gray-600 lg:table-cell">
                                        {{ $registration->created_at?->format('d M Y') }}</td>

                                    <td class="px-4 py-4 sm:px-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.registrations.show', $registration->id) }}"
                                                title="Lihat detail"
                                                class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition hover:bg-blue-100 hover:text-blue-700">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.registrations.destroy', $registration->id) }}"
                                                method="POST" class="delete-form inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Hapus"
                                                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-red-600 transition hover:bg-red-100 hover:text-red-700">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-14 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <p class="mt-3 text-sm font-medium text-gray-800">Belum ada pendaftar.</p>
                                        <p class="mt-1 text-xs text-gray-600">Data akan muncul di sini setelah ada yang
                                            mengisi formulir pendaftaran.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($registrations->hasPages())
                <div>{{ $registrations->links() }}</div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Satu basis konfigurasi SweetAlert dipakai bersama, menggantikan
            // blok onclick inline yang sebelumnya menduplikasi styling di 4 tempat.
            const baseClasses = {
                popup: 'rounded-2xl shadow-2xl border border-gray-100 p-6',
                title: 'text-xl font-black text-imk-600 mt-4',
                htmlContainer: 'text-gray-600 mt-2',
                actions: 'mt-6 gap-3 flex w-full flex-wrap justify-center',
                cancelButton: 'px-6 py-2.5 bg-gray-100 text-gray-800 font-bold rounded-xl hover:bg-gray-200 transition',
                input: '!w-full !mx-0 mt-4 px-4 py-3 rounded-xl border border-gray-300 focus:border-imk-500 focus:ring-2 focus:ring-imk-300'
            };

            const confirmBtn = (color) =>
                `px-6 py-2.5 ${color} text-white font-bold rounded-xl transition`;

            // 1. Toggle status pendaftaran
            const toggle = document.getElementById('toggleRegistration');
            if (toggle) {
                toggle.addEventListener('change', function () {
                    const action = this.checked ? 'MEMBUKA' : 'MENUTUP';
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: `Apakah Anda yakin ingin ${action} pendaftaran anggota?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Lanjutkan',
                        cancelButtonText: 'Batal',
                        buttonsStyling: false,
                        customClass: {
                            ...baseClasses,
                            confirmButton: confirmBtn('bg-emerald-600 hover:bg-emerald-500')
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('formToggleStatus').submit();
                        } else {
                            this.checked = !this.checked;
                        }
                    });
                });
            }

            // 2. Atur link grup WhatsApp
            const btnWa = document.getElementById('btnWaLink');
            if (btnWa) {
                btnWa.addEventListener('click', function () {
                    Swal.fire({
                        title: 'Atur Link Grup WhatsApp',
                        input: 'url',
                        inputLabel: 'Link grup yang dibagikan ke pendaftar baru',
                        inputValue: btnWa.dataset.current || '',
                        showCancelButton: true,
                        confirmButtonText: 'Simpan',
                        cancelButtonText: 'Batal',
                        buttonsStyling: false,
                        customClass: {
                            ...baseClasses,
                            confirmButton: confirmBtn('bg-imk-600 hover:bg-imk-500')
                        },
                        inputValidator: (value) => {
                            if (!value) {
                                return 'Link grup WhatsApp tidak boleh kosong!';
                            }
                        }
                    }).then((result) => {
                        if (!result.isConfirmed) return;

                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = btnWa.dataset.action;

                        const fields = {
                            _token: '{{ csrf_token() }}',
                            _method: 'PUT',
                            whatsapp_group_link: result.value
                        };

                        Object.entries(fields).forEach(([name, value]) => {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = name;
                            input.value = value;
                            form.appendChild(input);
                        });

                        document.body.appendChild(form);
                        form.submit();
                    });
                });
            }

            // 3. Ekspor CSV
            const btnExport = document.getElementById('btnExportCsv');
            if (btnExport) {
                btnExport.addEventListener('click', function () {
                    Swal.fire({
                        title: 'Pilih Format Pemisah CSV',
                        text: 'Gunakan Koma (,) untuk standar umum, atau Titik Koma (;) agar rapi di Excel berbahasa Indonesia.',
                        icon: 'question',
                        showCancelButton: true,
                        showDenyButton: true,
                        confirmButtonText: 'Koma (,)',
                        denyButtonText: 'Titik Koma (;)',
                        cancelButtonText: 'Batal',
                        buttonsStyling: false,
                        customClass: {
                            ...baseClasses,
                            confirmButton: confirmBtn('bg-emerald-600 hover:bg-emerald-500'),
                            denyButton: confirmBtn('bg-blue-600 hover:bg-blue-500')
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = btnExport.dataset.urlComma;
                        } else if (result.isDenied) {
                            window.location.href = btnExport.dataset.urlSemicolon;
                        }
                    });
                });
            }

            // 4. Hapus semua pendaftar
            const btnDeleteAll = document.getElementById('btnDeleteAll');
            if (btnDeleteAll) {
                btnDeleteAll.addEventListener('click', function () {
                    Swal.fire({
                        title: 'Hapus Semua Data?',
                        text: 'Peringatan: semua data pendaftar beserta file lampirannya akan dihapus permanen dan tidak dapat dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus Semua',
                        cancelButtonText: 'Batal',
                        buttonsStyling: false,
                        customClass: {
                            ...baseClasses,
                            confirmButton: confirmBtn('bg-red-600 hover:bg-red-500')
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('formDeleteAll').submit();
                        }
                    });
                });
            }
        });
    </script>
</x-app-layout>
