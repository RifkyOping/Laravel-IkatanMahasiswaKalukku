<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.organizations.index') }}" class="text-gray-500 hover:text-imk-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-black text-3xl text-[#051F20] leading-tight">
                {{ __('Edit Jabatan / Divisi') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[30px] shadow-xl p-8 md:p-10 border border-gray-100">
                <form action="{{ route('admin.organizations.update', $organization->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Jabatan / Divisi</label>
                        <input type="text" name="name" value="{{ old('name', $organization->name) }}" required
                            class="w-full rounded-xl border-gray-300 focus:border-imk-500 focus:ring focus:ring-imk-200">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Bagian (Section)</label>
                        <select name="section" required
                            class="w-full rounded-xl border-gray-300 focus:border-imk-500 focus:ring focus:ring-imk-200">
                            <option value="divisi" {{ (old('section', $organization->section) == 'divisi') ? 'selected' : '' }}>Divisi (Muncul di deretan bawah)</option>
                            <option value="pembina" {{ (old('section', $organization->section) == 'pembina') ? 'selected' : '' }}>Dewan Pembina</option>
                            <option value="pengawas" {{ (old('section', $organization->section) == 'pengawas') ? 'selected' : '' }}>Dewan Pengawas</option>
                            <option value="ketua" {{ (old('section', $organization->section) == 'ketua') ? 'selected' : '' }}>Ketua Umum</option>
                            <option value="sekretaris" {{ (old('section', $organization->section) == 'sekretaris') ? 'selected' : '' }}>Sekretaris</option>
                            <option value="bendahara" {{ (old('section', $organization->section) == 'bendahara') ? 'selected' : '' }}>Bendahara</option>
                        </select>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Urutan Tampil (Opsional)</label>
                        <input type="number" name="sort_order"
                            value="{{ old('sort_order', $organization->sort_order) }}"
                            class="w-full rounded-xl border-gray-300 focus:border-imk-500 focus:ring focus:ring-imk-200">
                        <p class="text-xs text-gray-500 mt-1">Angka lebih kecil tampil lebih dulu (kiri).</p>
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                        <a href="{{ route('admin.organizations.index') }}"
                            class="px-6 py-3 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 transition">Batal</a>
                        <button type="submit"
                            class="px-6 py-3 bg-imk-600 text-white font-bold rounded-xl hover:bg-imk-700 transition">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>