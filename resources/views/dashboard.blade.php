<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-3xl text-[#051F20] leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-imk-600 text-white font-bold rounded-full hover:bg-imk-700 transition shadow-sm flex items-center gap-2 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                Tambah Admin
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[39px] shadow-xl p-6 md:p-10 lg:p-16 relative overflow-hidden">
                <!-- Decorative background elements -->
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-imk-50 opacity-50"></div>
                <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-imk-50 opacity-50"></div>
                
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600 text-lg">{{ __("Anda telah login ke sistem. Silakan pilih menu di bawah ini untuk mengelola konten website.") }}</p>

                    @if(session('success'))
                        <div class="mt-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-3">
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    @endif
                    
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <a href="{{ route('admin.news.index') }}" class="group block p-6 bg-gray-50 rounded-3xl border border-gray-100 hover:border-imk-200 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-imk-100 text-imk-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-300 shrink-0">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-.586-1.414l-4.5-4.5A2 2 0 0012.586 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-[#051F20]">Berita</h4>
                                    <p class="text-gray-500 text-sm mt-1">Tambah, edit, atau hapus berita.</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.galleries.index') }}" class="group block p-6 bg-gray-50 rounded-3xl border border-gray-100 hover:border-imk-200 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-imk-100 text-imk-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-300 shrink-0">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-[#051F20]">Galeri</h4>
                                    <p class="text-gray-500 text-sm mt-1">Kelola dokumentasi kegiatan.</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.attachments.index') }}" class="group block p-6 bg-gray-50 rounded-3xl border border-gray-100 hover:border-imk-200 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-imk-100 text-imk-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-300 shrink-0">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-[#051F20]">Dokumen</h4>
                                    <p class="text-gray-500 text-sm mt-1">Upload dan kelola file dokumen.</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.settings.edit') }}" class="group block p-6 bg-gray-50 rounded-3xl border border-gray-100 hover:border-imk-200 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-imk-100 text-imk-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-300 shrink-0">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-[#051F20]">Pengaturan Beranda</h4>
                                    <p class="text-gray-500 text-sm mt-1">Ubah info kontak, sosial media serta foto struktur pada halaman beranda.</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.organizations.index') }}" class="group block p-6 bg-gray-50 rounded-3xl border border-gray-100 hover:border-imk-200 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-imk-100 text-imk-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-300 shrink-0">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-[#051F20]">Struktur Organisasi</h4>
                                    <p class="text-gray-500 text-sm mt-1">Kelola jabatan dan anggota.</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.registrations.index') }}" class="group block p-6 bg-gray-50 rounded-3xl border border-gray-100 hover:border-imk-200 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-imk-100 text-imk-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-300 shrink-0">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-[#051F20]">Data Pendaftar</h4>
                                    <p class="text-gray-500 text-sm mt-1">Kelola data pendaftaran anggota.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
