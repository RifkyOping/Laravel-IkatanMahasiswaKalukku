@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative w-full h-[40vh] md:h-[500px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('image/bg.jpeg') }}" class="w-full h-full object-cover object-center" alt="Background">
        </div>

        <!-- Beautiful Gradient Overlay matching the homepage -->
        <div
            class="absolute inset-0 z-10 bg-gradient-to-tr from-imk-600/95 via-imk-500/80 to-imk-300/40 mix-blend-multiply">
        </div>

        <div class="relative z-20 max-w-7xl mx-auto px-4 text-center">
            <h1 data-aos="fade-up" data-aos-delay="100"
                class="text-4xl sm:text-5xl md:text-[66px] font-black tracking-tight text-white drop-shadow-2xl uppercase">
                Tentang <span class="bg-clip-text text-transparent bg-gradient-to-r from-imk-100 to-imk-200">IMK</span>
            </h1>
        </div>
    </div>

    <!-- Main Content Panel (Glassmorphism & Card) -->
    <div class="relative z-30 max-w-6xl mx-auto px-6 lg:px-12 -mt-16 sm:-mt-24 mb-20 text-center">
        <div data-aos="fade-up" data-aos-delay="200"
            class="bg-white/90 backdrop-blur-xl rounded-[40px] shadow-[0_20px_50px_rgba(5,31,32,0.1)] p-8 sm:p-12 md:p-16 border border-white/50">

            <div data-aos="fade-up" data-aos-delay="300" class="flex justify-center mb-8 relative">
                <div class="absolute inset-0 bg-imk-200/20 rounded-full filter blur-2xl transform scale-150"></div>
                <!-- Valid Tailwind sizing: w-32 h-32 (128px) or w-40 h-40 (160px). Or using arbitrary values: h-[120px] -->
                <img src="{{ asset('image/logo.png') }}" alt="Logo IMK"
                    class="w-32 h-32 md:w-40 md:h-40 object-contain relative z-10 drop-shadow-lg transform hover:scale-105 transition-transform duration-500">
            </div>

            <h2 data-aos="fade-up" data-aos-delay="400" class="text-3xl md:text-4xl font-black text-imk-600 mb-8">Ikatan
                Mahasiswa Kalukku</h2>

            <div
                class="text-gray-600 leading-relaxed mb-16 max-w-4xl mx-auto text-justify sm:text-center text-lg font-light">
                <p data-aos="fade-up">
                    <strong class="text-imk-500 font-semibold">Ikatan Mahasiswa Kalukku (IMK)</strong> adalah organisasi
                    kedaerahan yang bersifat independen, didirikan di Kalukku pada tanggal 21 Januari 2018, dan berkedudukan
                    di Kabupaten Majene. Organisasi ini berfungsi sebagai wadah untuk mempersatukan dan menghimpun seluruh
                    mahasiswa asal Kecamatan Kalukku yang sedang menimba ilmu di Kabupaten Majene.
                </p>
                <br>
                <p data-aos="fade-up" data-aos-delay="100">
                    Berasaskan Pancasila dan UUD 1945, IMK memegang peran penting sebagai organisasi kaderisasi dan
                    perjuangan yang bertujuan membina anggotanya menjadi insan yang beriman, bertaqwa, berilmu, kreatif,
                    kritis, dan berguna bagi masyarakat, bangsa, serta negara.
                </p>
                <div data-aos="fade-up" data-aos-delay="200"
                    class="my-8 bg-imk-50/50 p-6 rounded-2xl border border-imk-100 text-center italic text-imk-500 text-xl font-medium shadow-sm">
                    "Mesa Pattuju" (Satu Tujuan) — Tak sedarah, satu daerah, kita saudara.
                </div>
                <p data-aos="fade-up" data-aos-delay="300">
                    Berlandaskan nilai-nilai agama, budaya, dan kekeluargaan, IMK berkomitmen melahirkan kaum intelektual
                    yang profesional agar kelak dapat kembali untuk mengabdi dan membangun daerah Kecamatan Kalukku.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">

                <div data-aos="fade-up" data-aos-delay="100"
                    class="p-8 rounded-3xl bg-white shadow-md border border-gray-100 hover:shadow-xl hover:border-imk-200 transition-all transform hover:-translate-y-2 group">
                    <div
                        class="w-12 h-12 bg-imk-100 rounded-2xl flex items-center justify-center text-imk-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h4 class="text-imk-500 font-black uppercase tracking-widest mb-4 flex items-center">
                        Tujuan
                    </h4>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Terbinanya mahasiswa Kalukku menjadi insan yang beriman, bertaqwa, berilmu, kreatif, kritis yang
                        berguna bagi masyarakat, bangsa dan negara serta bertanggung jawab atas terwujudnya masyarakat adil.
                    </p>
                </div>

                <div data-aos="fade-up" data-aos-delay="200"
                    class="p-8 rounded-3xl bg-white shadow-md border border-gray-100 hover:shadow-xl hover:border-imk-200 transition-all transform hover:-translate-y-2 group">
                    <div
                        class="w-12 h-12 bg-imk-100 rounded-2xl flex items-center justify-center text-imk-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-imk-500 font-black uppercase tracking-widest mb-4">
                        Fungsi
                    </h4>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Ikatan Mahasiswa Kalukku (IMK) berfungsi sebagai organisasi yang mempersatukan dan menghimpun
                        seluruh mahasiswa Kalukku yang sedang menimba ilmu di Kab. Majene.
                    </p>
                </div>

                <div data-aos="fade-up" data-aos-delay="300"
                    class="p-8 rounded-3xl bg-white shadow-md border border-gray-100 hover:shadow-xl hover:border-imk-200 transition-all transform hover:-translate-y-2 group">
                    <div
                        class="w-12 h-12 bg-imk-100 rounded-2xl flex items-center justify-center text-imk-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-imk-500 font-black uppercase tracking-widest mb-4">
                        Usaha
                    </h4>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Membina kader Ikatan Mahasiswa Kalukku untuk menjadi insan yang berintelektual dan mampu bersaing
                        secara profesional serta menjadikan (IMK) sebagai organisasi yang menjunjung tinggi nilai agama,
                        budaya, dan kekeluargaan.
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection