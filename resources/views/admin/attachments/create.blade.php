<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.attachments.index') }}"
                class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-black text-3xl text-[#051F20] leading-tight">
                {{ __('Tambah Lampiran') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[39px] shadow-xl p-10 md:p-12 relative overflow-hidden">
                <form action="{{ route('admin.attachments.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8 relative z-10">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul / Nama
                            Tampilan</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-4 bg-gray-50 hover:bg-white transition-colors"
                            placeholder="Misal: Formulir Pendaftaran, Modul Materi, dll">
                        @error('title')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="file" class="block text-sm font-bold text-gray-700 mb-2">File Lampiran</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-2xl bg-gray-50 hover:bg-gray-100 transition-colors relative group">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-imk-500 transition-colors"
                                    stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="file"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-imk-600 hover:text-imk-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-imk-500 p-1 px-2">
                                        <span>Pilih file</span>
                                        <input id="file" name="file" type="file" required class="sr-only">
                                    </label>
                                    <p class="pl-1 pt-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Format PDF, DOCX, XLSX, dll up to 10MB.</p>
                            </div>
                        </div>
                        @error('file')
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
                            Lampiran</button>
                        <a href="{{ route('admin.attachments.index') }}"
                            class="px-8 py-3 text-gray-600 font-bold bg-gray-100 hover:bg-gray-200 rounded-full transition-all duration-300">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>