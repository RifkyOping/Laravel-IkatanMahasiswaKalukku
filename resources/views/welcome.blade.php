@extends('layouts.app')

@section('content')
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-float-delayed {
            animation: float 6s ease-in-out 3s infinite;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .text-gradient {
            background: linear-gradient(to right, #DAF1DE, #8EB69B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>

    @if(session('error'))
        <div class="fixed top-24 left-1/2 transform -translate-x-1/2 z-[100] w-full max-w-md" x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-lg flex justify-between items-start">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 font-bold">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
                <button @click="show = false" class="ml-auto text-red-400 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    @endif

    <div x-data="{ 
        open: false, 
        selectedNews: { title: '', content: '', images: [], date: '', source_link: '' }, 
        scrolled: false,
        currentImageIndex: 0,
        nextImage() {
            if (this.currentImageIndex < this.selectedNews.images.length - 1) {
                this.currentImageIndex++;
            } else {
                this.currentImageIndex = 0;
            }
        },
        prevImage() {
            if (this.currentImageIndex > 0) {
                this.currentImageIndex--;
            } else {
                this.currentImageIndex = this.selectedNews.images.length - 1;
            }
        },
        shareContent() {
            const shareData = {
                title: this.selectedNews.title,
                text: 'Lihat berita ini di website Ikatan Mahasiswa Kalukku:\n' + this.selectedNews.title,
                url: window.location.origin + '/berita'
            };
            if (navigator.share) {
                navigator.share(shareData).catch(console.error);
            } else {
                navigator.clipboard.writeText(window.location.origin + '/berita').then(() => {
                    alert('Link halaman berhasil disalin ke clipboard!');
                });
            }
        }
    }"
         @scroll.window="scrolled = (window.pageYOffset > 50)">

        <!-- Hero Section -->
        <div class="relative w-full min-h-[85vh] flex items-center justify-center overflow-hidden">
            <!-- Background Image with Parallax effect via fixed/absolute trick -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('image/bg.jpeg') }}" class="w-full h-full object-cover object-center" alt="Background">
            </div>
            
            <!-- Beautiful Gradient Overlay -->
            <div class="absolute inset-0 z-10 bg-gradient-to-tr from-imk-600/95 via-imk-500/80 to-imk-300/40 mix-blend-multiply"></div>
            <div class="absolute inset-0 z-10 bg-gradient-to-b from-transparent via-transparent to-white/5"></div>

            <!-- Floating Decorative Shapes -->
            <div class="absolute top-20 left-10 w-72 h-72 bg-imk-200 rounded-full mix-blend-screen filter blur-[80px] opacity-30 animate-pulse z-10"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-imk-100 rounded-full mix-blend-screen filter blur-[100px] opacity-20 animate-pulse z-10" style="animation-delay: 2s;"></div>

            <!-- Hero Content -->
            <div class="relative z-20 max-w-7xl mx-auto px-6 text-center animate-float">
                <div data-aos="fade-up" class="inline-block mb-6 px-6 py-2 rounded-full border border-imk-200/30 bg-imk-600/30 backdrop-blur-sm text-imk-100 text-sm font-semibold tracking-widest shadow-lg">
                    SELAMAT DATANG DI WEBSITE
                </div>
                <h1 data-aos="fade-up" data-aos-delay="200" class="text-5xl sm:text-6xl md:text-[80px] font-black tracking-tight text-white drop-shadow-2xl leading-tight mb-6 uppercase">
                    Ikatan Mahasiswa <span class="text-gradient">Kalukku</span>
                </h1>
                <p data-aos="fade-up" data-aos-delay="400" class="mt-6 md:text-2xl text-lg text-imk-100 max-w-3xl mx-auto drop-shadow-md font-light leading-relaxed">
                    "Mesa Pattuju" <br> 
                    <span class="font-medium text-white italic mt-2 block">Tak Sedarah, Satu Daerah, Kita Saudara</span>
                </p>

                <!-- Action Button -->
                <div data-aos="fade-up" data-aos-delay="600" class="mt-12 flex justify-center gap-4">
                    <a href="#tentang" class="px-8 py-4 bg-imk-200 hover:bg-white text-imk-600 rounded-full font-bold transition-all duration-300 transform hover:-translate-y-1 hover:shadow-[0_10px_40px_rgba(142,182,155,0.5)]">
                        Kenali Kami Lebih Dalam
                    </a>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
                <a href="#tentang" class="text-imk-100 opacity-70 hover:opacity-100 transition-opacity">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                </a>
            </div>
        </div>

        <!-- About Section (Glassmorphism & Cards) -->
        <div id="tentang" class="relative z-30 max-w-6xl mx-auto px-6 lg:px-12 -mt-20">
            <div data-aos="fade-up" class="glass-panel rounded-[40px] shadow-[0_20px_50px_rgba(5,31,32,0.1)] p-6 md:p-10 lg:p-16">
                
                <div class="text-center mb-12">
                    {{-- <h2 class="text-sm font-bold text-imk-300 tracking-widest uppercase mb-2">Tentang Kami</h2> --}}
                    <h3 data-aos="fade-up" class="text-3xl md:text-4xl font-black text-imk-600">Perjuangan & Dedikasi</h3>
                    <div data-aos="fade-up" data-aos-delay="200" class="w-20 h-1.5 bg-imk-200 mx-auto mt-6 rounded-full"></div>
                </div>

                <div class="space-y-6 text-gray-600 leading-relaxed text-lg text-justify font-light">
                    <p data-aos="fade-up" data-aos-delay="100">
                        <strong class="text-imk-500 font-semibold">Ikatan Mahasiswa Kalukku (IMK)</strong> adalah organisasi kedaerahan yang bersifat independen, didirikan di Kalukku pada tanggal 21 Januari 2018, dan berkedudukan di Kabupaten Majene. Organisasi ini berfungsi sebagai wadah untuk mempersatukan dan menghimpun seluruh mahasiswa asal Kecamatan Kalukku yang sedang menimba ilmu di Kabupaten Majene.
                    </p>
                    
                    <div data-aos="fade-up" data-aos-delay="200" class="relative bg-gradient-to-r from-imk-100/40 to-transparent border-l-4 border-imk-300 p-8 rounded-r-2xl my-8 overflow-hidden group hover:from-imk-100/60 transition-colors">
                        <div class="absolute right-0 top-0 opacity-5 transform group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                        </div>
                        <p class="text-imk-600 font-semibold text-xl md:text-2xl italic relative z-10">
                            "Mesa Pattuju" (Satu Tujuan) <br/>
                            <span class="text-imk-400 text-lg md:text-xl">Tak sedarah, satu daerah, kita saudara.</span>
                        </p>
                    </div>

                    <p data-aos="fade-up" data-aos-delay="300">
                        Dengan berlandaskan nilai-nilai agama, budaya, dan kekeluargaan, IMK berkomitmen melahirkan kaum intelektual yang profesional agar kelak dapat kembali untuk mengabdi dan membangun daerah Kecamatan Kalukku.
                    </p>
                </div>

                <!-- 4 Pillars Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-16">
                    <!-- Card 1 -->
                    <div data-aos="fade-up" data-aos-delay="100" class="group bg-white p-8 rounded-[30px] shadow-sm hover:shadow-2xl border border-gray-100 hover:border-imk-200 transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-14 h-14 bg-imk-100 text-imk-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform group-hover:bg-imk-500 group-hover:text-white">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-xl text-imk-600 mb-3">Organisasi Kaderisasi</h3>
                        <p class="text-gray-500 leading-relaxed">Membina insan yang beriman, bertaqwa, dan kreatif secara berkelanjutan.</p>
                    </div>
                    <!-- Card 2 -->
                    <div data-aos="fade-up" data-aos-delay="200" class="group bg-white p-8 rounded-[30px] shadow-sm hover:shadow-2xl border border-gray-100 hover:border-imk-200 transition-all duration-300 transform hover:-translate-y-2 animate-float-delayed" style="animation: none;">
                        <div class="w-14 h-14 bg-imk-100 text-imk-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform group-hover:bg-imk-500 group-hover:text-white">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                        </div>
                        <h3 class="font-bold text-xl text-imk-600 mb-3">Pusat Intelektual</h3>
                        <p class="text-gray-500 leading-relaxed">Wadah diskusi mahasiswa untuk melahirkan pemikiran kritis dan profesional.</p>
                    </div>
                    <!-- Card 3 -->
                    <div data-aos="fade-up" data-aos-delay="300" class="group bg-white p-8 rounded-[30px] shadow-sm hover:shadow-2xl border border-gray-100 hover:border-imk-200 transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-14 h-14 bg-imk-100 text-imk-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform group-hover:bg-imk-500 group-hover:text-white">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-xl text-imk-600 mb-3">Nilai Kekeluargaan</h3>
                        <p class="text-gray-500 leading-relaxed">Menjunjung tinggi budaya dan nilai agama sebagai fondasi persaudaraan sejati.</p>
                    </div>
                    <!-- Card 4 -->
                    <div data-aos="fade-up" data-aos-delay="400" class="group bg-white p-8 rounded-[30px] shadow-sm hover:shadow-2xl border border-gray-100 hover:border-imk-200 transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-14 h-14 bg-imk-100 text-imk-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform group-hover:bg-imk-500 group-hover:text-white">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="font-bold text-xl text-imk-600 mb-3">Pengabdian Daerah</h3>
                        <p class="text-gray-500 leading-relaxed">Komitmen nyata untuk kembali membangun dan memajukan Kecamatan Kalukku.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Organizational Structure Section -->
        <div class="bg-gray-50 py-24 relative overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute top-0 left-0 w-64 h-64 bg-emerald-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-imk-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 translate-x-1/3 translate-y-1/3"></div>

            <div class="max-w-6xl mx-auto px-6 text-center relative z-10">
                <div class="mb-20">
                    <h2 class="text-sm font-bold text-emerald-600 tracking-widest uppercase mb-3" data-aos="fade-up">Struktur Organisasi</h2>
                    <h3 class="text-4xl md:text-5xl font-black text-[#051F20]" data-aos="fade-up" data-aos-delay="100">PENGURUS IKATAN MAHASISWA KALUKKU</h3>
                    <div class="w-24 h-1.5 bg-emerald-500 mx-auto mt-6 rounded-full" data-aos="fade-up" data-aos-delay="200"></div>
                </div>
                
                <div class="flex flex-col md:flex-row justify-center items-center md:items-end gap-10 lg:gap-16">
                    <!-- Sekretaris Umum (Kiri) -->
                    <div class="flex flex-col items-center group w-full md:w-1/3 order-2 md:order-1" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-64 h-80 lg:w-72 lg:h-96 overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 mb-6 relative">
                            <img src="{{ $setting->sekretaris_photo ? asset('storage/' . $setting->sekretaris_photo) : asset('image/pengurus/sekretaris.jpg') }}" alt="Sekretaris IMK"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#051F20]/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        </div>
                        @foreach($sekretaris as $org)
                            @foreach($org->members as $member)
                                <h3 class="text-xl lg:text-2xl font-bold text-[#051F20] group-hover:text-emerald-700 transition-colors">{{ $member->name }}</h3>
                            @endforeach
                        @endforeach
                        <p class="text-sm text-emerald-600 font-bold mt-2 uppercase tracking-wide">Sekretaris Umum</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $setting->org_period ?? 'Periode 2025-2026' }}</p>
                    </div>

                    <!-- Ketua Umum (Tengah - Lebih Besar/Tinggi) -->
                    <div class="flex flex-col items-center group w-full md:w-1/3 md:-mt-12 z-20 order-1 md:order-2" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-72 h-96 lg:w-[340px] lg:h-[460px] overflow-hidden rounded-[2.5rem] shadow-2xl hover:shadow-[0_20px_50px_rgba(5,31,32,0.25)] transition-all duration-500 mb-6 relative border-4 border-white">
                            <img src="{{ $setting->ketua_photo ? asset('storage/' . $setting->ketua_photo) : asset('image/pengurus/ketua.jpeg') }}" alt="Ketua IMK"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#051F20]/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        </div>
                        @foreach($ketua as $org)
                            @foreach($org->members as $member)
                                <h3 class="text-2xl lg:text-3xl font-black text-[#051F20] group-hover:text-emerald-700 transition-colors">{{ $member->name }}</h3>
                            @endforeach
                        @endforeach
                        <p class="text-base text-emerald-600 font-bold mt-2 uppercase tracking-widest">Ketua Umum</p>
                        <p class="text-sm text-gray-500 mt-1 font-medium">{{ $setting->org_period ?? 'Periode 2025-2026' }}</p>
                    </div>

                    <!-- Bendahara Umum (Kanan) -->
                    <div class="flex flex-col items-center group w-full md:w-1/3 order-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-64 h-80 lg:w-72 lg:h-96 overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 mb-6 relative">
                            <img src="{{ $setting->bendahara_photo ? asset('storage/' . $setting->bendahara_photo) : asset('image/pengurus/bendahara.jpeg') }}" alt="Bendahara IMK"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#051F20]/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        </div>
                        @foreach($bendahara as $org)
                            @foreach($org->members as $member)
                                <h3 class="text-xl lg:text-2xl font-bold text-[#051F20] group-hover:text-emerald-700 transition-colors">{{ $member->name }}</h3>
                            @endforeach
                        @endforeach
                        <p class="text-sm text-emerald-600 font-bold mt-2 uppercase tracking-wide">Bendahara Umum</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $setting->org_period ?? 'Periode 2025-2026' }}</p>
                    </div>
                </div>

                <div class="mt-20" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('struktur') }}" class="inline-flex items-center gap-3 px-10 py-4 bg-[#051F20] text-white hover:bg-emerald-700 rounded-full font-bold transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                        Lihat Struktur Organisasi Lengkap
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- News Section -->
        <div class="bg-white py-24">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 data-aos="fade-up" class="text-sm font-bold text-imk-400 tracking-widest uppercase mb-2">Kabar Terkini</h2>
                        <h2 data-aos="fade-up" data-aos-delay="100" class="text-4xl font-black text-imk-600">Berita & Informasi</h2>
                    </div>
                    <a data-aos="fade-up" data-aos-delay="200" href="{{ route('berita') }}" class="hidden sm:flex items-center text-imk-500 font-bold hover:text-imk-300 transition group">
                        Lihat Semua 
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($news as $item)
                        @php
                            $imagesArray = is_array($item->images) ? $item->images : [];
                            $imageUrls = array_map(function($img) { return asset('storage/' . $img); }, $imagesArray);
                            $imagesJson = json_encode($imageUrls);
                        @endphp
                        <button
                            data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}"
                            @click="open = true; currentImageIndex = 0; selectedNews = {
                                title: '{{ addslashes($item->title) }}',
                                content: `{{ addslashes(str_replace(["\r", "\n"], ['', '\n'], $item->content)) }}`,
                                images: {{ $imagesJson }},
                                date: '{{ $item->created_at->format('d M Y') }}',
                                source_link: '{{ $item->source_link ? addslashes($item->source_link) : '' }}'
                            }"
                            class="group bg-white rounded-3xl shadow-md hover:shadow-2xl border border-gray-50 transition-all duration-300 overflow-hidden text-left w-full flex flex-col h-full transform hover:-translate-y-1">
                            <div class="relative h-56 overflow-hidden w-full bg-gray-100 flex items-center justify-center">
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors z-10"></div>
                                @if(count($imagesArray) > 0)
                                    <img src="{{ asset('storage/' . $imagesArray[0]) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 ease-in-out">
                                @else
                                    <svg class="w-12 h-12 text-gray-300 relative z-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                @endif
                                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-imk-600 text-xs font-bold px-3 py-1.5 rounded-full z-20 shadow-sm">
                                    {{ $item->created_at->format('M d') }}
                                </div>
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="font-bold text-lg text-imk-600 leading-tight mb-3 group-hover:text-imk-300 transition-colors">
                                    {{ $item->title }}
                                </h3>
                                <p class="text-sm text-gray-500 line-clamp-3 mb-4 font-light">
                                    {{ Str::limit($item->content, 100) }}
                                </p>
                                <div class="mt-auto flex items-center text-imk-400 text-sm font-semibold group-hover:text-imk-500">
                                    Baca selengkapnya
                                    <svg class="w-4 h-4 ml-1 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- News Detail Modal -->
        <div x-show="open" 
             style="display: none;"
             class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 backdrop-blur-none"
             x-transition:enter-end="opacity-100 backdrop-blur-sm"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 backdrop-blur-sm"
             x-transition:leave-end="opacity-0 backdrop-blur-none">
             
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-imk-600/80" @click="open = false"></div>

            <!-- Modal Panel -->
            <div class="bg-white rounded-[40px] w-full max-w-3xl max-h-[90vh] overflow-y-auto relative shadow-[0_0_50px_rgba(0,0,0,0.3)] transform transition-all"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-10 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-10 scale-95"
                 @click.away="open = false">
                
                <button @click="open = false" class="absolute top-6 right-6 w-10 h-10 bg-white/50 hover:bg-white backdrop-blur-md rounded-full flex items-center justify-center text-gray-500 hover:text-imk-600 transition shadow-sm z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                
                <div class="relative h-80 w-full bg-gray-100 group">
                    <template x-if="selectedNews.images.length > 0">
                        <img :src="selectedNews.images[currentImageIndex]" class="w-full h-full object-cover transition-opacity duration-300">
                    </template>
                    <template x-if="selectedNews.images.length === 0">
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </template>
                    
                    <!-- Slider Controls -->
                    <template x-if="selectedNews.images.length > 1">
                        <div>
                            <button @click.stop="prevImage()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm focus:outline-none z-30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                            <button @click.stop="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm focus:outline-none z-30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                            
                            <!-- Indicators -->
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-30">
                                <template x-for="(img, index) in selectedNews.images" :key="index">
                                    <button @click.stop="currentImageIndex = index" :class="currentImageIndex === index ? 'bg-white w-6' : 'bg-white/50 w-2 hover:bg-white/80'" class="h-2 rounded-full transition-all duration-300 focus:outline-none"></button>
                                </template>
                            </div>
                        </div>
                    </template>

                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-20 pointer-events-none"></div>
                    <div class="absolute bottom-6 left-8 right-8 z-30 pointer-events-none">
                        <span class="px-3 py-1 bg-imk-500 text-white text-xs font-bold rounded-md mb-3 inline-block shadow-sm" x-text="selectedNews.date"></span>
                        <h2 class="text-3xl md:text-4xl font-black text-white leading-tight drop-shadow-lg" x-text="selectedNews.title"></h2>
                    </div>
                </div>
                
                <div class="p-8 md:p-12">
                    <p class="text-gray-700 leading-relaxed text-lg whitespace-pre-line text-justify" x-text="selectedNews.content"></p>
                    
                    <div class="mt-8 pt-6 border-t border-gray-100 flex flex-wrap gap-4 items-center justify-between">
                        <div class="flex flex-wrap gap-4 items-center">
                            <template x-if="selectedNews.source_link">
                                <a :href="selectedNews.source_link" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-imk-50 text-imk-600 hover:bg-imk-600 hover:text-white rounded-full font-bold transition-all duration-300">
                                    <span>Baca Sumber Asli</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            </template>
                            
                            <button @click="shareContent()" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 hover:bg-emerald-600 hover:text-white rounded-full font-bold transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                                <span>Bagikan</span>
                            </button>
                        </div>
                        
                        <button @click="open = false" class="px-8 py-3 bg-imk-100 text-imk-600 hover:bg-imk-200 rounded-full font-bold transition ml-auto">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
