@extends('layouts.app')

@section('content')
    <div x-data="{ 
        open: false, 
        selectedNews: { title: '', content: '', images: [], date: '', endDate: '', driveLink: '', url: '' },
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
            navigator.clipboard.writeText(this.selectedNews.url).then(() => {
                if(typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Link kegiatan berhasil disalin ke clipboard!',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                } else {
                    alert('Link halaman berhasil disalin ke clipboard!');
                }
            });
        }
    }">

        <div class="relative bg-cover bg-center bg-no-repeat text-white h-[500px] flex items-center justify-center overflow-hidden"
            style="background-image: url('{{ asset('image/bg.jpeg') }}');">
            <div class="absolute inset-0 bg-[#0F2A1D]/40"></div>
            <div class="relative max-w-7xl mx-auto px-4 text-center z-10">
                <h1 data-aos="fade-up" data-aos-delay="100"
                    class="text-5xl md:text-[66px] font-bold tracking-tight drop-shadow-md uppercase">Galeri Kegiatan IMK
                </h1>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="200"
            class="max-w-6xl mx-auto px-6 lg:px-12 bg-white rounded-[39px] shadow-xl p-6 md:p-10 lg:p-16 relative z-20 -mt-14">
            <h2 data-aos="fade-up" data-aos-delay="300" class="text-3xl font-bold text-gray-800 mb-10 text-center">Galeri
                Kegiatan</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                @forelse($galleries as $item)
                        @php
                            $imagesArray = is_array($item->images) ? $item->images : [];
                            $imageUrls = array_map(function ($img) {
                                return asset('storage/' . $img); }, $imagesArray);
                            $imagesJson = json_encode($imageUrls);
                        @endphp
                        <button data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}" @click="open = true; currentImageIndex = 0; selectedNews = {
                        title: '{{ addslashes($item->title) }}',
                        content: `{{ addslashes(str_replace(["\r", "\n"], ['', '\n'], $item->content)) }}`,
                        images: {{ $imagesJson }},
                        date: '{{ $item->date ? \Carbon\Carbon::parse($item->date)->format('d M Y') : ($item->created_at ? $item->created_at->format('d M Y') : '') }}',
                        endDate: '{{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('d M Y') : '' }}',
                        driveLink: '{{ $item->drive_link ?? '' }}',
                        url: '{{ route('galeri.show', $item->id) }}'
                    }" class="group text-left focus:outline-none w-full">
                            <div
                                class="overflow-hidden rounded-2xl shadow-md transition duration-300 group-hover:shadow-2xl bg-gray-100 flex items-center justify-center">
                                @if(count($imagesArray) > 0)
                                    <img src="{{ asset('storage/' . $imagesArray[0]) }}" alt="{{ $item->title }}"
                                        class="w-full h-64 object-cover transform transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-64 bg-gray-100 flex items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <h3 class="mt-4 text-lg font-semibold text-gray-700 text-center group-hover:text-imk-600 transition">
                                {{ $item->title }}
                            </h3>
                        </button>
                @empty
                    <div class="col-span-1 md:col-span-3 text-center py-10 text-gray-400">
                        Belum ada galeri kegiatan.
                    </div>
                @endforelse

            </div>
        </div>

        <!-- Modal Pop-up (Similar to Berita) -->
        <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
            x-transition.opacity style="display: none;">

            <div @click.away="open = false"
                class="bg-white rounded-[39px] p-8 max-w-2xl w-full max-h-[90vh] overflow-y-auto relative shadow-2xl">
                <button @click="open = false"
                    class="absolute top-6 right-8 text-gray-400 hover:text-black transition z-10 bg-white/80 rounded-full p-1 backdrop-blur-sm shadow-sm focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>

                <!-- Image Slider -->
                <div class="relative w-full h-72 rounded-3xl overflow-hidden bg-gray-100 mb-8 group">

                    <template x-if="selectedNews.images.length > 0">
                        <img :src="selectedNews.images[currentImageIndex]"
                            class="w-full h-full object-cover transition-opacity duration-300">
                    </template>
                    <template x-if="selectedNews.images.length === 0">
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </template>

                    <!-- Slider Controls (Tampil jika gambar lebih dari 1) -->
                    <template x-if="selectedNews.images.length > 1">
                        <div>
                            <!-- Prev Button -->
                            <button @click.stop="prevImage()"
                                class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <!-- Next Button -->
                            <button @click.stop="nextImage()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </button>

                            <!-- Indicators -->
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                                <template x-for="(img, index) in selectedNews.images" :key="index">
                                    <button @click.stop="currentImageIndex = index"
                                        :class="currentImageIndex === index ? 'bg-white w-6' : 'bg-white/50 w-2 hover:bg-white/80'"
                                        class="h-2 rounded-full transition-all duration-300 focus:outline-none"></button>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>

                <h2 class="text-3xl font-black text-[#051F20]" x-text="selectedNews.title"></h2>
                <p class="text-sm text-emerald-700 font-bold mt-2">
                    <span x-text="selectedNews.date"></span>
                    <template x-if="selectedNews.endDate">
                        <span> - <span x-text="selectedNews.endDate"></span></span>
                    </template>
                </p>
                <p class="text-gray-700 mt-6 leading-relaxed text-lg whitespace-pre-line" x-text="selectedNews.content"></p>

                <div class="mt-8 pt-6 border-t border-gray-100 flex flex-wrap gap-4 items-center">
                    <template x-if="selectedNews.driveLink">
                        <a :href="selectedNews.driveLink" target="_blank"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-imk-600 text-white hover:bg-imk-700 rounded-full font-bold shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            <span>Lihat Dokumentasi Lengkap</span>
                        </a>
                    </template>

                    <button @click="shareContent()"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 hover:bg-emerald-600 hover:text-white rounded-full font-bold transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3">
                            </path>
                        </svg>
                        <span>Bagikan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection