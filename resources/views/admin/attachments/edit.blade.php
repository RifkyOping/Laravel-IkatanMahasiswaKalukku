<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.attachments.index') }}" title="Kembali"
                class="inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-imk-50 text-imk-600 transition hover:bg-imk-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-imk-400 focus-visible:ring-offset-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div class="min-w-0">
                <h2 class="text-2xl font-black leading-tight text-imk-600 sm:text-3xl">Edit Dokumen</h2>
                <p class="mt-1 truncate text-sm text-gray-600">{{ $attachment->title }}</p>
            </div>
        </div>
    </x-slot>

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

            <form action="{{ route('admin.attachments.update', $attachment->id) }}" method="POST"
                enctype="multipart/form-data"
                class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
                @csrf
                @method('PUT')

                <div class="border-b border-gray-100 px-5 py-4 sm:px-7">
                    <h3 class="text-base font-bold text-imk-600">Detail Dokumen</h3>
                    <p class="mt-0.5 text-xs text-gray-600">Kolom bertanda <span class="text-red-600">*</span> wajib
                        diisi</p>
                </div>

                <div class="space-y-5 px-5 py-6 sm:px-7">
                    <div>
                        <label for="title" class="mb-1.5 block text-sm font-bold text-gray-800">
                            Judul / Nama Tampilan <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $attachment->title) }}"
                            required
                            class="w-full rounded-xl border-gray-300 text-sm focus:border-imk-500 focus:ring-imk-300">
                        @error('title')
                            <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <span class="mb-1.5 block text-sm font-bold text-gray-800">Berkas saat ini</span>
                        <div
                            class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">
                            <div class="flex min-w-0 items-center gap-3">
                                <div
                                    class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-white text-imk-600 ring-1 ring-gray-200">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span
                                    class="truncate text-sm font-medium text-gray-800">{{ $attachment->original_name ?? 'Berkas tidak diketahui' }}</span>
                            </div>
                            <a href="{{ route('lampiran.download', $attachment->id) }}"
                                class="inline-flex items-center gap-1.5 rounded-xl bg-white px-3 py-2 text-xs font-bold text-imk-600 ring-1 ring-gray-200 transition hover:bg-imk-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-imk-400 focus-visible:ring-offset-2">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Unduh
                            </a>
                        </div>
                    </div>

                    <div>
                        <span class="mb-1.5 block text-sm font-bold text-gray-800">Ganti berkas</span>

                        <div x-data="{ over: false, files: [], pick(list) { this.files = Array.from(list).map(f => ({ name: f.name, size: (f.size / 1048576).toFixed(2) })) }, drop(e) { this.over = false; this.$refs.input.files = e.dataTransfer.files; this.pick(this.$refs.input.files) } }"
                            @dragover.prevent="over = true" @dragleave.prevent="over = false"
                            @drop.prevent="drop($event)"
                            :class="over ? 'border-imk-500 bg-imk-50' : 'border-gray-300 bg-gray-50'"
                            class="rounded-xl border-2 border-dashed px-5 py-6 text-center transition-colors">

                            <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>

                            <div class="mt-2 flex flex-wrap items-center justify-center gap-1 text-sm">
                                <button type="button" @click="$refs.input.click()"
                                    class="rounded-lg bg-white px-2.5 py-1 font-bold text-imk-600 ring-1 ring-gray-200 transition hover:bg-imk-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-imk-400">
                                    Pilih berkas baru
                                </button>
                                <span class="text-gray-600">atau tarik ke sini</span>
                            </div>

                            <input id="file" name="file" type="file" class="sr-only" x-ref="input"
                                @change="pick($event.target.files)">

                            <p class="mt-2 text-xs text-gray-600">Biarkan kosong bila tidak ingin mengubah berkas
                                &middot; maksimal 10 MB</p>
                            <p class="mt-1 text-xs font-medium text-amber-700">Jika diunggah, berkas lama akan dihapus
                                permanen.</p>

                            <template x-if="files.length">
                                <div
                                    class="mt-3 flex items-center justify-between gap-3 rounded-lg bg-white px-3 py-2 text-left text-xs ring-1 ring-gray-100">
                                    <span class="truncate font-medium text-gray-800" x-text="files[0].name"></span>
                                    <span class="flex-shrink-0 tabular-nums text-gray-600"
                                        x-text="files[0].size + ' MB'"></span>
                                </div>
                            </template>

                            <template x-if="files.length && parseFloat(files[0].size) > 10">
                                <p class="mt-2 text-xs font-bold text-red-600">Berkas melebihi 10 MB dan akan ditolak
                                    server.</p>
                            </template>
                        </div>

                        @error('file')
                            <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div
                    class="flex flex-col-reverse gap-2 border-t border-gray-100 bg-gray-50 px-5 py-4 sm:flex-row sm:justify-end sm:px-7">
                    <a href="{{ route('admin.attachments.index') }}"
                        class="rounded-xl bg-white px-5 py-2.5 text-center text-sm font-bold text-gray-800 ring-1 ring-gray-200 transition hover:bg-gray-100">Batal</a>
                    <button type="submit"
                        class="rounded-xl bg-imk-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-imk-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-imk-400 focus-visible:ring-offset-2">Perbarui
                        Dokumen</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
