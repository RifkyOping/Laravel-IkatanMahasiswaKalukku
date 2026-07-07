<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-[#051F20] leading-tight">
            {{ __('Struktur Organisasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Daftar Jabatan & Divisi</h3>
                    <p class="text-gray-500 text-sm">Kelola kotak jabatan di bagan struktur organisasi.</p>
                </div>
                <!-- Button trigger modal -->
                <button type="button" onclick="document.getElementById('addModal').classList.remove('hidden')"
                    class="px-6 py-3 bg-imk-600 text-white font-bold rounded-full hover:bg-imk-700 transition shadow-sm">
                    + Tambah Divisi / Jabatan
                </button>
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
                                <th class="py-4 px-6 text-left font-bold text-gray-500">Urutan</th>
                                <th class="py-4 px-6 text-left font-bold text-gray-500">Nama Jabatan/Divisi</th>
                                <th class="py-4 px-6 text-left font-bold text-gray-500">Bagian (Section)</th>
                                <th class="py-4 px-6 text-center font-bold text-gray-500">Anggota</th>
                                <th class="py-4 px-6 text-center font-bold text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($organizations as $org)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-6">{{ $org->sort_order }}</td>
                                    <td class="py-4 px-6 font-bold text-[#051F20]">{{ $org->name }}</td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold uppercase">{{ $org->section }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <a href="{{ route('admin.members.index', $org->id) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-imk-50 text-imk-600 hover:bg-imk-100 font-bold rounded-xl transition">
                                            Kelola Anggota ({{ $org->members()->count() }})
                                        </a>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <a href="{{ route('admin.organizations.edit', $org->id) }}"
                                                class="p-2.5 text-blue-500 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 rounded-xl transition shadow-sm">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.organizations.destroy', $org->id) }}"
                                                method="POST" class="inline-block delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2.5 text-red-500 bg-red-50 hover:bg-red-100 hover:text-red-700 rounded-xl transition shadow-sm">
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"
                onclick="document.getElementById('addModal').classList.add('hidden')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-[30px] shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('admin.organizations.store') }}" method="POST">
                    @csrf
                    <div class="px-8 pt-8 pb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Tambah Jabatan / Divisi</h3>

                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Jabatan / Divisi</label>
                            <input type="text" name="name" required
                                class="w-full rounded-xl border-gray-300 focus:border-imk-500 focus:ring focus:ring-imk-200"
                                placeholder="Contoh: Divisi Keagamaan">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Bagian (Section)</label>
                            <select name="section" required
                                class="w-full rounded-xl border-gray-300 focus:border-imk-500 focus:ring focus:ring-imk-200">
                                <option value="divisi">Divisi (Muncul di deretan bawah)</option>
                                <option value="pembina">Dewan Pembina</option>
                                <option value="pengawas">Dewan Pengawas</option>
                                <option value="ketua">Ketua Umum</option>
                                <option value="sekretaris">Sekretaris</option>
                                <option value="bendahara">Bendahara</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Urutan Tampil (Opsional)</label>
                            <input type="number" name="sort_order" value="0"
                                class="w-full rounded-xl border-gray-300 focus:border-imk-500 focus:ring focus:ring-imk-200">
                            <p class="text-xs text-gray-500 mt-1">Angka lebih kecil tampil lebih dulu (kiri).</p>
                        </div>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 flex justify-end gap-3 rounded-b-[30px]">
                        <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')"
                            class="px-6 py-2 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 transition">Batal</button>
                        <button type="submit"
                            class="px-6 py-2 bg-imk-600 text-white font-bold rounded-xl hover:bg-imk-700 transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>