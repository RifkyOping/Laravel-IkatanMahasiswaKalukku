<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.galleries.index') }}" title="Kembali"
                class="inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-imk-50 text-imk-600 transition hover:bg-imk-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-imk-400 focus-visible:ring-offset-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div class="min-w-0">
                <h2 class="text-2xl font-black leading-tight text-imk-600 sm:text-3xl">Edit Galeri</h2>
                <p class="mt-1 truncate text-sm text-gray-600">{{ $gallery->title }}</p>
            </div>
        </div>
    </x-slot>

    @php
        // Dinormalkan ke Y-m-d: input type="date" menolak nilai berformat lain
        // (mis. "2026-08-21 00:00:00") dan akan tampil kosong tanpa error.
        $dateValue = $gallery->date ? \Illuminate\Support\Carbon::parse($gallery->date)->format('Y-m-d') : '';
        $endDateValue = $gallery->end_date ? \Illuminate\Support\Carbon::parse($gallery->end_date)->format('Y-m-d') : '';
    @endphp

    <div class="py-8">
        <div class="mx-auto max-w-3xl space-y-6 px-4 sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3">
                    <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-red-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="text-sm font-bold text-red-800">Ada isian yang perlu diperbaiki.</p>
                        <ul class="mt-1 list-inside list-disc space-y-0.5 text-xs text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST"
                enctype="multipart/form-data"
                class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
                @csrf
                @method('PUT')

                <div class="border-b border-gray-100 px-5 py-4 sm:px-7">
                    <h3 class="text-base font-bold text-imk-600">Detail Kegiatan</h3>
                    <p class="mt-0.5 text-xs text-gray-600">Kolom bertanda <span class="text-red-600">*</span> wajib
                        diisi</p>
                </div>

                <div class="space-y-5 px-5 py-6 sm:px-7">
                    <div>
                        <label for="title" class="mb-1.5 block text-sm font-bold text-gray-800">
                            Judul Kegiatan <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}"
                            required
                            class="w-full rounded-xl border-gray-300 text-sm focus:border-imk-500 focus:ring-imk-300">
                        @error('title')
                            <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="mb-1.5 block text-sm font-bold text-gray-800">
                            Deskripsi Kegiatan <span class="text-red-600">*</span>
                        </label>
                        <textarea name="content" id="content" rows="5" required
                            class="w-full rounded-xl border-gray-300 text-sm leading-relaxed focus:border-imk-500 focus:ring-imk-300">{{ old('content', $gallery->content) }}</textarea>
                        @error('content')
                            <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ start: '{{ old('date', $dateValue) }}' }" class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="date" class="mb-1.5 block text-sm font-bold text-gray-800">
                                Tanggal Mulai <span class="text-red-600">*</span>
                            </label>
                            <input type="date" name="date" id="date" x-model="start" required
                                class="w-full rounded-xl border-gray-300 text-sm focus:border-imk-500 focus:ring-imk-300">
                            @error('date')
                                <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_date" class="mb-1.5 block text-sm font-bold text-gray-800">Tanggal
                                Selesai</label>
                            <input type="date" name="end_date" id="end_date"
                                value="{{ old('end_date', $endDateValue) }}" :min="start"
                                class="w-full rounded-xl border-gray-300 text-sm focus:border-imk-500 focus:ring-imk-300">
                            <p class="mt-1.5 text-xs text-gray-600">Opsional, untuk kegiatan lebih dari satu hari.</p>
                            @error('end_date')
                                <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="drive_link" class="mb-1.5 block text-sm font-bold text-gray-800">Link Drive
                            Dokumentasi Lengkap</label>
                        <input type="url" name="drive_link" id="drive_link"
                            value="{{ old('drive_link', $gallery->drive_link) }}"
                            class="w-full rounded-xl border-gray-300 text-sm focus:border-imk-500 focus:ring-imk-300"
                            placeholder="https://drive.google.com/...">
                        <p class="mt-1.5 text-xs text-gray-600">Opsional. Untuk foto yang tidak diunggah ke situs.</p>
                        @error('drive_link')
                            <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <span class="mb-1.5 block text-sm font-bold text-gray-800">Foto Dokumentasi</span>

                        @if ($gallery->images && is_array($gallery->images) && count($gallery->images))
                            <div class="mb-3">
                                <p class="mb-2 text-xs font-bold uppercase tracking-wider text-gray-600">Foto saat ini
                                </p>
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($gallery->images as $img)
                                        <img src="{{ asset('storage/' . $img) }}" alt="Foto kegiatan"
                                            class="h-24 w-24 rounded-xl object-cover ring-1 ring-gray-200 sm:h-28 sm:w-28">
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div x-data="{ over: false, files: [], max: 3, pick(list) { this.files = Array.from(list).map(f => ({ name: f.name, size: (f.size / 1048576).toFixed(2) })) }, drop(e) { this.over = false; this.$refs.input.files = e.dataTransfer.files; this.pick(this.$refs.input.files) } }"
                            @dragover.prevent="over = true" @dragleave.prevent="over = false"
                            @drop.prevent="drop($event)"
                            :class="over ? 'border-imk-500 bg-imk-50' : 'border-gray-300 bg-gray-50'"
                            class="rounded-xl border-2 border-dashed px-5 py-6 text-center transition-colors">

                            <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>

                            <div class="mt-2 flex flex-wrap items-center justify-center gap-1 text-sm">
                                <button type="button" @click="$refs.input.click()"
                                    class="rounded-lg bg-white px-2.5 py-1 font-bold text-imk-600 ring-1 ring-gray-200 transition hover:bg-imk-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-imk-400">
                                    Ganti berkas
                                </button>
                                <span class="text-gray-600">atau tarik ke sini</span>
                            </div>

                            <input id="images" name="images[]" type="file" multiple accept="image/*" class="sr-only"
                                x-ref="input" @change="pick($event.target.files)">

                            <p class="mt-2 text-xs text-gray-600">Biarkan kosong bila tidak ingin mengubah foto.</p>
                            <p class="mt-1 text-xs font-medium text-amber-700">Jika diunggah, seluruh foto lama akan
                                diganti.</p>

                            <template x-if="files.length">
                                <ul class="mt-3 space-y-1.5 text-left">
                                    <template x-for="(f, i) in files" :key="i">
                                        <li
                                            class="flex items-center justify-between gap-3 rounded-lg bg-white px-3 py-2 text-xs ring-1 ring-gray-100">
                                            <span class="truncate font-medium text-gray-800" x-text="f.name"></span>
                                            <span class="flex-shrink-0 tabular-nums text-gray-600"
                                                x-text="f.size + ' MB'"></span>
                                        </li>
                                    </template>
                                </ul>
                            </template>

                            <template x-if="files.length > max">
                                <p class="mt-2 text-xs font-bold text-red-600">
                                    Anda memilih <span x-text="files.length"></span> berkas. Maksimal <span
                                        x-text="max"></span> berkas.
                                </p>
                            </template>
                        </div>

                        @error('images')
                            <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                        @error('images.*')
                            <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div
                    class="flex flex-col-reverse gap-2 border-t border-gray-100 bg-gray-50 px-5 py-4 sm:flex-row sm:justify-end sm:px-7">
                    <a href="{{ route('admin.galleries.index') }}"
                        class="rounded-xl bg-white px-5 py-2.5 text-center text-sm font-bold text-gray-800 ring-1 ring-gray-200 transition hover:bg-gray-100">Batal</a>
                    <button type="submit"
                        class="rounded-xl bg-imk-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-imk-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-imk-400 focus-visible:ring-offset-2">Perbarui
                        Galeri</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
