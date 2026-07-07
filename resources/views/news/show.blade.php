@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8 md:py-12 pt-20 md:pt-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex mb-6 md:mb-8 overflow-x-auto pb-2 hide-scrollbar" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 whitespace-nowrap">
                <li class="inline-flex items-center">
                    <a href="{{ route('welcome') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-imk-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <a href="{{ route('berita') }}" class="ml-1 text-sm font-medium text-gray-500 hover:text-imk-600 md:ml-2">Berita</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2 line-clamp-1 max-w-[150px] sm:max-w-[200px]">{{ $news->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <article class="bg-white rounded-3xl md:rounded-[39px] shadow-xl overflow-hidden p-5 sm:p-8 md:p-12">
            
            <header class="mb-8 md:mb-10 text-center">
                <p class="text-xs md:text-sm text-emerald-600 font-bold tracking-widest uppercase mb-2 md:mb-3">{{ $news->created_at->format('d M Y') }}</p>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-[#051F20] leading-tight mb-4 md:mb-6">
                    {{ $news->title }}
                </h1>
            </header>

            @php
                $imagesArray = [];
                if (is_array($news->images)) {
                    $imagesArray = $news->images;
                } elseif (is_string($news->images)) {
                    $decoded = json_decode($news->images, true);
                    $imagesArray = is_array($decoded) ? $decoded : [];
                }
            @endphp

            @if(count($imagesArray) > 0)
            <div x-data="{ currentImageIndex: 0 }" class="relative w-full rounded-2xl md:rounded-3xl overflow-hidden bg-gray-100 mb-8 md:mb-12 group h-64 sm:h-[300px] md:h-[500px]">
                @foreach($imagesArray as $index => $img)
                <img x-show="currentImageIndex === {{ $index }}" 
                     src="{{ asset('storage/' . $img) }}" 
                     alt="{{ $news->title }}" 
                     class="w-full h-full object-cover transition-opacity duration-500"
                     style="display: {{ $index === 0 ? 'block' : 'none' }};">
                @endforeach

                @if(count($imagesArray) > 1)
                <div>
                    <!-- Prev Button -->
                    <button @click="currentImageIndex = currentImageIndex > 0 ? currentImageIndex - 1 : {{ count($imagesArray) - 1 }}" 
                            class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-2 md:p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm focus:outline-none">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <!-- Next Button -->
                    <button @click="currentImageIndex = currentImageIndex < {{ count($imagesArray) - 1 }} ? currentImageIndex + 1 : 0" 
                            class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-2 md:p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm focus:outline-none">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                    
                    <!-- Indicators -->
                    <div class="absolute bottom-4 md:bottom-6 left-1/2 -translate-x-1/2 flex gap-1.5 md:gap-2">
                        @foreach($imagesArray as $index => $img)
                            <button @click="currentImageIndex = {{ $index }}" 
                                    :class="currentImageIndex === {{ $index }} ? 'bg-white w-6 md:w-8' : 'bg-white/50 w-1.5 md:w-2 hover:bg-white/80'" 
                                    class="h-1.5 md:h-2 rounded-full transition-all duration-300 focus:outline-none"></button>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            @endif

            <div class="prose prose-base md:prose-lg prose-emerald max-w-none text-gray-700 leading-relaxed whitespace-pre-line mb-8 md:mb-12">
                {!! nl2br(e($news->content)) !!}
            </div>
            
            <div x-data="{
                shareContent() {
                    navigator.clipboard.writeText(window.location.href).then(() => {
                        if(typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Link berita berhasil disalin ke clipboard!',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        } else {
                            alert('Link berita berhasil disalin ke clipboard!');
                        }
                    });
                }
            }" class="pt-6 md:pt-8 border-t border-gray-100 flex flex-col md:flex-row gap-6 md:gap-4 items-center justify-between">
                
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 w-full md:w-auto">
                    @if($news->source_link)
                    <a href="{{ $news->source_link }}" target="_blank" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-imk-50 text-imk-600 hover:bg-imk-600 hover:text-white rounded-full font-bold transition-all duration-300 w-full sm:w-auto">
                        <span>Baca Sumber Asli</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                    @endif
                    
                    <button @click="shareContent()" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 hover:bg-emerald-600 hover:text-white rounded-full font-bold transition-all duration-300 w-full sm:w-auto">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                        <span>Salin Link Berita</span>
                    </button>
                </div>

                <a href="{{ route('berita') }}" class="text-gray-500 hover:text-imk-600 font-bold inline-flex items-center justify-center gap-2 w-full md:w-auto pt-4 md:pt-0 border-t md:border-0 border-gray-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar Berita
                </a>
            </div>

        </article>
    </div>
</div>
@endsection
