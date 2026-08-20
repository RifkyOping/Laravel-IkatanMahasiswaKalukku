<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.organizations.index') }}" aria-label="Kembali"
                class="inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl text-gray-600 transition hover:bg-gray-100 hover:text-imk-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div class="min-w-0">
                <h2 class="truncate text-2xl font-black leading-tight text-imk-600 sm:text-3xl">Edit Jabatan / Divisi
                </h2>
                <p class="mt-1 truncate text-sm text-gray-600">{{ $organization->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
                <form action="{{ route('admin.organizations.update', $organization->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-5 p-5 sm:p-7">
                        <div>
                            <label for="name" class="mb-1.5 block text-sm font-bold text-gray-800">Nama Jabatan /
                                Divisi</label>
                            <input id="name" type="text" name="name"
                                value="{{ old('name', $organization->name) }}" required
                                class="w-full rounded-xl border-gray-300 text-sm focus:border-imk-500 focus:ring-imk-300">
                            @error('name')
                                <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="section" class="mb-1.5 block text-sm font-bold text-gray-800">Bagian
                                (Section)</label>
                            @php
                                $sections = [
                                    'divisi' => 'Divisi (muncul di deretan bawah)',
                                    'pembina' => 'Dewan Pembina',
                                    'pengawas' => 'Dewan Pengawas',
                                    'ketua' => 'Ketua Umum',
                                    'sekretaris' => 'Sekretaris',
                                    'bendahara' => 'Bendahara',
                                ];
                                $currentSection = old('section', $organization->section);
                            @endphp
                            <select id="section" name="section" required
                                class="w-full rounded-xl border-gray-300 text-sm focus:border-imk-500 focus:ring-imk-300">
                                @foreach ($sections as $value => $label)
                                    <option value="{{ $value }}" {{ $currentSection === $value ? 'selected' : '' }}>
                                        {{ $label }}</option>
                                @endforeach
                            </select>
                            @error('section')
                                <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="sort_order" class="mb-1.5 block text-sm font-bold text-gray-800">Urutan Tampil
                                (opsional)</label>
                            <input id="sort_order" type="number" name="sort_order"
                                value="{{ old('sort_order', $organization->sort_order) }}"
                                class="w-full rounded-xl border-gray-300 text-sm focus:border-imk-500 focus:ring-imk-300">
                            <p class="mt-1 text-xs text-gray-600">Angka lebih kecil tampil lebih dulu (kiri).</p>
                            @error('sort_order')
                                <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div
                        class="flex flex-col-reverse gap-2 border-t border-gray-100 bg-gray-50 px-5 py-4 sm:flex-row sm:justify-end sm:px-7">
                        <a href="{{ route('admin.organizations.index') }}"
                            class="rounded-xl bg-white px-5 py-2.5 text-center text-sm font-bold text-gray-800 ring-1 ring-gray-200 transition hover:bg-gray-100">Batal</a>
                        <button type="submit"
                            class="rounded-xl bg-imk-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-imk-500">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
