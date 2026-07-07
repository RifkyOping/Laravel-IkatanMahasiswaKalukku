<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-[#051F20] leading-tight">
            {{ __('Data Pendaftar IMK') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Daftar Pendaftar Terbaru</h3>
                    <p class="text-gray-500 text-sm">Kelola data mahasiswa yang mendaftar sebagai anggota.</p>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Toggle Status Pendaftaran -->
                    <form action="{{ route('admin.registrations.toggleStatus') }}" method="POST"
                        class="flex items-center bg-white shadow-sm p-3 rounded-[20px] border border-gray-100">
                        @csrf
                        <span class="mr-3 text-sm font-bold text-gray-700">Status Pendaftaran:</span>
                        <label class="relative inline-flex items-center cursor-pointer mr-3">
                            <input type="checkbox" name="is_registration_open" value="1" onchange="
                                    const checkbox = this;
                                    const action = checkbox.checked ? 'MEMBUKA' : 'MENUTUP';
                                    Swal.fire({
                                        title: 'Konfirmasi',
                                        text: 'Apakah Anda yakin ingin ' + action + ' pendaftaran anggota?',
                                        icon: 'question',
                                        showCancelButton: true,
                                        confirmButtonText: 'Ya, Lanjutkan',
                                        cancelButtonText: 'Batal',
                                        buttonsStyling: false,
                                        customClass: {
                                            popup: 'rounded-[30px] shadow-2xl border border-gray-100 p-6',
                                            title: 'text-2xl font-black text-[#051F20] mt-4',
                                            htmlContainer: 'text-gray-500 mt-2',
                                            actions: 'mt-8 gap-4 flex w-full justify-center',
                                            confirmButton: 'px-8 py-3 bg-emerald-500 text-white font-bold rounded-full hover:bg-emerald-600 transition-all duration-300',
                                            cancelButton: 'px-8 py-3 bg-gray-100 text-gray-700 font-bold rounded-full hover:bg-gray-200 transition-all duration-300'
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            checkbox.form.submit();
                                        } else {
                                            checkbox.checked = !checkbox.checked;
                                        }
                                    });
                                " {{ $setting->is_registration_open ? 'checked' : '' }} class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-red-500 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-emerald-400 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500">
                            </div>
                        </label>
                        <span
                            class="text-xs font-bold {{ $setting->is_registration_open ? 'text-emerald-600' : 'text-red-600' }}">
                            {{ $setting->is_registration_open ? 'DIBUKA' : 'DITUTUP' }}
                        </span>
                    </form>

                    <!-- Tombol Ekspor CSV -->
                    @if($registrations->total() > 0)
                    <button type="button" onclick="
                        Swal.fire({
                            title: 'Pilih Format Pemisah CSV',
                            text: 'Gunakan Koma (,) untuk standar umum atau Titik Koma (;) untuk Excel berbahasa Indonesia.',
                            icon: 'question',
                            showCancelButton: true,
                            showDenyButton: true,
                            confirmButtonText: 'Koma (,)',
                            denyButtonText: 'Titik Koma (;)',
                            cancelButtonText: 'Batal',
                            buttonsStyling: false,
                            customClass: {
                                popup: 'rounded-[30px] shadow-2xl border border-gray-100 p-6',
                                title: 'text-xl font-black text-[#051F20] mt-4',
                                htmlContainer: 'text-gray-500 mt-2 text-sm',
                                actions: 'mt-6 gap-3 flex w-full justify-center flex-wrap',
                                confirmButton: 'px-6 py-2.5 bg-emerald-500 text-white font-bold rounded-full hover:bg-emerald-600 transition-all duration-300',
                                denyButton: 'px-6 py-2.5 bg-blue-500 text-white font-bold rounded-full hover:bg-blue-600 transition-all duration-300',
                                cancelButton: 'px-6 py-2.5 bg-gray-100 text-gray-700 font-bold rounded-full hover:bg-gray-200 transition-all duration-300'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('admin.registrations.exportCsv') }}?separator=comma';
                            } else if (result.isDenied) {
                                window.location.href = '{{ route('admin.registrations.exportCsv') }}?separator=semicolon';
                            }
                        });
                    " class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-3 rounded-[20px] font-bold shadow-sm transition-all duration-300" title="Ekspor Data ke CSV/Excel">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Ekspor CSV
                    </button>

                    <!-- Tombol Hapus Semua -->
                    <form action="{{ route('admin.registrations.destroyAll') }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="
                            const form = this.closest('form');
                            Swal.fire({
                                title: 'Hapus Semua Data?',
                                text: 'Peringatan: Semua data pendaftar beserta file lampirannya akan dihapus secara permanen dan tidak dapat dikembalikan!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Ya, Hapus Semua',
                                cancelButtonText: 'Batal',
                                buttonsStyling: false,
                                customClass: {
                                    popup: 'rounded-[30px] shadow-2xl border border-gray-100 p-6',
                                    title: 'text-2xl font-black text-[#051F20] mt-4',
                                    htmlContainer: 'text-gray-500 mt-2',
                                    actions: 'mt-8 gap-4 flex w-full justify-center',
                                    confirmButton: 'px-8 py-3 bg-red-500 text-white font-bold rounded-full hover:bg-red-600 transition-all duration-300',
                                    cancelButton: 'px-8 py-3 bg-gray-100 text-gray-700 font-bold rounded-full hover:bg-gray-200 transition-all duration-300'
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                }
                            });
                        " class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-600 hover:bg-red-500 hover:text-white px-5 py-3 rounded-[20px] font-bold shadow-sm transition-all duration-300" title="Hapus Semua Pendaftar">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus Semua
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            @if(session('success'))
                <div
                    class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3">
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-[30px] shadow-xl overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-4 px-6 text-left font-bold text-gray-500 w-16">No</th>
                                <th class="py-4 px-6 text-left font-bold text-gray-500">Nama Lengkap</th>
                                <th class="py-4 px-6 text-left font-bold text-gray-500">Jenis Kelamin</th>
                                <th class="py-4 px-6 text-left font-bold text-gray-500">Universitas</th>
                                <th class="py-4 px-6 text-left font-bold text-gray-500">Tanggal Daftar</th>
                                <th class="py-4 px-6 text-center font-bold text-gray-500 w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($registrations as $index => $registration)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-6 text-gray-500">{{ $registrations->firstItem() + $index }}</td>
                                    <td class="py-4 px-6 font-bold text-[#051F20]">{{ $registration->name }}</td>
                                    <td class="py-4 px-6 text-gray-600">{{ $registration->gender }}</td>
                                    <td class="py-4 px-6 text-gray-600">{{ $registration->university }}</td>
                                    <td class="py-4 px-6 text-gray-600">{{ $registration->created_at->format('d M Y') }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <!-- Tombol Detail / Lihat -->
                                            <a href="{{ route('admin.registrations.show', $registration->id) }}"
                                                class="p-2.5 text-blue-500 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 rounded-xl transition shadow-sm"
                                                title="Lihat Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            <!-- Tombol Hapus dengan SweetAlert -->
                                            <form action="{{ route('admin.registrations.destroy', $registration->id) }}"
                                                method="POST" class="inline-block delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2.5 text-red-500 bg-red-50 hover:bg-red-100 hover:text-red-700 rounded-xl transition shadow-sm"
                                                    title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center text-gray-500">Belum ada pendaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $registrations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>