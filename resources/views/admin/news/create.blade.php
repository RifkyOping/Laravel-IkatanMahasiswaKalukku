<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.news.index') }}"
                class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-black text-3xl text-[#051F20] leading-tight">
                {{ __('Tambah Berita') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[39px] shadow-xl p-10 md:p-12 relative overflow-hidden">
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8 relative z-10">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Berita</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-4 bg-gray-50 hover:bg-white transition-colors"
                            placeholder="Masukkan judul berita yang menarik">
                        @error('title')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="source_link" class="block text-sm font-bold text-gray-700 mb-2">Sumber Berita / Link
                            Asli (Opsional)</label>
                        <input type="url" name="source_link" id="source_link" value="{{ old('source_link') }}"
                            class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-4 bg-gray-50 hover:bg-white transition-colors"
                            placeholder="https://contoh.com/berita-asli">
                        @error('source_link')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-bold text-gray-700 mb-2">Isi Konten</label>
                        <textarea name="content" id="content" rows="8" required
                            class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-4 bg-gray-50 hover:bg-white transition-colors"
                            placeholder="Tuliskan isi berita Anda di sini...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="images" class="block text-sm font-bold text-gray-700 mb-2">Gambar Berita (Maksimal 3
                            Gambar)</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-2xl bg-gray-50 hover:bg-gray-100 transition-colors relative group">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-imk-500 transition-colors"
                                    stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="images"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-imk-600 hover:text-imk-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-imk-500 p-1 px-2">
                                        <span>Pilih file</span>
                                        <input id="images" name="images[]" type="file" multiple accept="image/*"
                                            class="sr-only">
                                    </label>
                                    <p class="pl-1 pt-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Bisa memilih lebih dari satu file (Max 3).<br>PNG,
                                    JPG up to 2MB per file.</p>
                            </div>
                        </div>
                        @error('images')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex items-center gap-4 border-t border-gray-100">
                        <button type="submit"
                            class="px-8 py-3 bg-imk-600 text-white font-bold rounded-full hover:bg-imk-700 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">Simpan
                            Berita</button>
                        <a href="{{ route('admin.news.index') }}"
                            class="px-8 py-3 text-gray-600 font-bold bg-gray-100 hover:bg-gray-200 rounded-full transition-all duration-300">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>