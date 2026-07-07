@extends('layouts.app')

@section('content')
    <div x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)">

        <div class="relative bg-cover bg-center bg-no-repeat text-white h-[400px] flex items-center justify-center overflow-hidden"
            style="background-image: url('{{ asset('image/bg.jpeg') }}');">
            <div class="absolute inset-0 bg-[#0F2A1D]/40"></div>
            <div class="relative max-w-7xl mx-auto px-4 text-center z-10">
                <h1 data-aos="fade-up" data-aos-delay="100"
                    class="text-5xl md:text-[66px] font-bold tracking-tight drop-shadow-md uppercase">Lampiran & Dokumen
                </h1>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="200"
            class="max-w-5xl mx-auto px-6 lg:px-12 bg-white rounded-[39px] shadow-xl p-6 md:p-10 lg:p-16 relative z-20 -mt-14 mb-24">
            <div class="flex justify-between items-center mb-8">
                <h2 data-aos="fade-up" data-aos-delay="300" class="text-2xl font-black text-[#051F20]">Daftar File Unduhan
                </h2>
            </div>

            <div class="space-y-4">
                @forelse($attachments as $item)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}"
                        class="w-full flex flex-col md:flex-row items-center justify-between gap-6 p-6 rounded-3xl bg-gray-50 border border-transparent hover:border-gray-200 transition duration-300">

                        <div class="flex items-center gap-6 w-full md:w-auto">
                            <div
                                class="w-16 h-16 flex-shrink-0 rounded-2xl overflow-hidden bg-white shadow-sm flex items-center justify-center text-imk-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>

                            <div class="flex-grow">
                                <h3 class="font-bold text-xl text-[#051F20]">{{ $item->title }}</h3>
                                <div class="flex items-center gap-3 mt-1 text-sm text-gray-500">
                                    <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg> {{ $item->created_at->format('d M Y') }}</span>
                                    <span>&bull;</span>
                                    <span class="truncate max-w-[150px] sm:max-w-xs">{{ $item->original_name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="w-full md:w-auto mt-4 md:mt-0 flex justify-end">
                            <a href="{{ route('lampiran.download', $item->id) }}"
                                class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-imk-600 text-white font-bold rounded-full hover:bg-imk-700 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 w-full md:w-auto">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Unduh File
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div
                            class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-600 mb-2">Belum Ada Lampiran</h3>
                        <p class="text-gray-400">Saat ini belum ada file atau dokumen yang dapat diunduh.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection