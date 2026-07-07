<style>
    .org-box {
        background: transparent;
        border: 2px solid white;
        border-radius: 12px;
        padding: 20px 16px 16px 16px;
        color: white;
        text-align: center;
        position: relative;
        z-index: 10;
        background-color: #0A3A2A;
        min-width: 220px;
    }

    .org-box-title {
        background-color: #0A3A2A;
        color: #ffb800;
        font-weight: bold;
        padding: 4px 16px;
        border-radius: 20px;
        display: inline-block;
        position: absolute;
        top: -16px;
        left: 50%;
        transform: translateX(-50%);
        border: 2px solid white;
        white-space: nowrap;
        font-size: 0.85rem;
        z-index: 20;
    }
</style>

<div class="min-h-screen bg-[#0A3A2A] py-16 px-4 md:px-8 relative overflow-hidden"
    style="background-image: url('{{ asset('image/logo.png') }}'); background-repeat: no-repeat; background-position: center; background-size: 35%; background-attachment: fixed; background-blend-mode: soft-light;">

    <!-- Background overlay agar teks tetap terbaca -->
    <div class="absolute inset-0 bg-[#0A3A2A]/80 z-0"></div>

    <div class="max-w-7xl mx-auto relative z-10">

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row items-center justify-center mb-16 relative">
            <div class="text-center text-white">
                <h1 class="text-3xl md:text-5xl font-black uppercase tracking-wider drop-shadow-md">Ikatan Mahasiswa
                    Kalukku</h1>
                <h2 class="text-xl md:text-3xl font-bold mt-2 text-white drop-shadow-md">
                    {{ $setting->org_period ?? 'Periode 2025/2026' }}</h2>
            </div>
        </div>

        <!-- Organizational Tree Structure -->
        <div class="flex flex-col items-center w-full mt-16 md:mt-24">

            <!-- LEVEL 1: Pengawas - Ketua - Pembina -->
            <div
                class="flex flex-col md:flex-row items-center justify-center w-full relative mb-12 md:mb-16 gap-12 md:gap-0">

                <!-- Garis horizontal penghubung khusus level 1 -->
                <div
                    class="absolute top-1/2 left-[16.66%] right-[16.66%] h-[2px] border-t-2 border-dashed border-white hidden md:block z-0">
                </div>

                <!-- Dewan Pengawas -->
                <div class="md:w-1/3 flex justify-center relative z-10 order-2 md:order-1">
                    @foreach($pengawas as $org)
                        <div class="org-box" data-aos="fade-up" data-aos-delay="100">
                            <div class="org-box-title">{{ $org->name }}</div>
                            <div class="space-y-1">
                                @foreach($org->members as $member)
                                    <p class="text-sm font-bold">{{ $member->name }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Ketua Umum -->
                <div class="md:w-1/3 flex justify-center relative z-20 order-3 md:order-2">
                    @foreach($ketua as $org)
                        <div class="org-box !border-4 shadow-[0_0_20px_rgba(255,255,255,0.3)]" data-aos="fade-up">
                            <div class="org-box-title">{{ $org->name }}</div>
                            <div class="space-y-1">
                                @foreach($org->members as $member)
                                    <p class="text-base font-black">{{ $member->name }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <!-- Garis vertikal turun dari ketua ke persimpangan sek/ben -->
                    <div
                        class="absolute top-full left-1/2 w-[2px] h-[150px] bg-white hidden md:block -translate-x-1/2 z-0">
                    </div>
                </div>

                <!-- Dewan Pembina -->
                <div class="md:w-1/3 flex justify-center relative z-10 md:-translate-y-24 order-1 md:order-3">
                    <!-- Garis vertikal turun ke garis horizontal -->
                    <div
                        class="absolute top-1/2 left-1/2 w-[2px] h-24 border-l-2 border-dashed border-white hidden md:block -translate-x-1/2 z-0">
                    </div>

                    @foreach($pembina as $org)
                        <div class="org-box" data-aos="fade-up" data-aos-delay="200">
                            <div class="org-box-title">{{ $org->name }}</div>
                            <div class="space-y-1">
                                @foreach($org->members as $member)
                                    <p class="text-sm font-bold">{{ $member->name }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- LEVEL 2: Sekretaris & Bendahara -->
            <div class="flex justify-center w-full md:w-3/4 lg:w-2/3 relative mb-12 md:mb-16">
                <!-- Garis vertikal terus ke bawah dari tengah -->
                <div
                    class="absolute top-0 left-1/2 w-[2px] h-[calc(100%+4rem)] bg-white hidden md:block -translate-x-1/2 z-0">
                </div>

                <div class="flex flex-col md:flex-row w-full relative z-10">
                    <!-- Sekretaris -->
                    <div class="w-full md:w-1/2 flex justify-center relative mb-6 md:mb-0">
                        <!-- Horizontal line segment -->
                        <div class="absolute top-0 right-0 h-[2px] bg-white hidden md:block z-0 w-1/2"></div>

                        <!-- Garis vertikal kecil ke kotak sek -->
                        <div class="absolute top-0 left-1/2 w-[2px] h-6 bg-white hidden md:block -translate-x-1/2">
                        </div>
                        <div class="mt-0 md:mt-6 w-full flex justify-center">
                            @foreach($sekretaris as $org)
                                <div class="org-box mx-2" data-aos="fade-up" data-aos-delay="300">
                                    <div class="org-box-title">{{ $org->name }}</div>
                                    <div class="space-y-1">
                                        @foreach($org->members as $member)
                                            <p class="text-sm font-bold">{{ $member->name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Bendahara -->
                    <div class="w-full md:w-1/2 flex justify-center relative mb-6 md:mb-0">
                        <!-- Horizontal line segment -->
                        <div class="absolute top-0 left-0 h-[2px] bg-white hidden md:block z-0 w-1/2"></div>

                        <!-- Garis vertikal kecil ke kotak ben -->
                        <div class="absolute top-0 left-1/2 w-[2px] h-6 bg-white hidden md:block -translate-x-1/2">
                        </div>
                        <div class="mt-0 md:mt-6 w-full flex justify-center">
                            @foreach($bendahara as $org)
                                <div class="org-box mx-2" data-aos="fade-up" data-aos-delay="400">
                                    <div class="org-box-title">{{ $org->name }}</div>
                                    <div class="space-y-1">
                                        @foreach($org->members as $member)
                                            <p class="text-sm font-bold">{{ $member->name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Label Divisi (Pill) di tengah garis vertikal -->
            <div class="relative z-20 mb-8 hidden md:flex justify-center w-full">
                <div class="bg-[#0A3A2A] border-2 border-white rounded-full px-8 py-2">
                    <span class="font-bold text-[#ffb800]">Divisi</span>
                </div>
                <!-- Garis vertikal lanjut ke bawah -->
                <div class="absolute -bottom-8 left-1/2 w-[2px] h-8 bg-white hidden md:block -translate-x-1/2 z-0">
                </div>
            </div>

            <!-- LEVEL 3: Divisi-divisi -->
            <div class="w-full relative mt-8 md:mt-0">
                <div class="flex flex-col md:flex-row justify-center items-start w-full relative z-10 px-2">
                    @foreach($divisi as $index => $org)
                        <div class="flex-1 flex justify-center relative w-full pt-6 md:pt-0 mb-6 md:mb-0">
                            <!-- Horizontal line segment for Divisi -->
                            @if($divisi->count() > 1)
                                @if($loop->first)
                                    <div class="absolute top-0 right-0 h-[2px] bg-white hidden md:block z-0 w-1/2"></div>
                                @elseif($loop->last)
                                    <div class="absolute top-0 left-0 h-[2px] bg-white hidden md:block z-0 w-1/2"></div>
                                @else
                                    <div class="absolute top-0 left-0 right-0 h-[2px] bg-white hidden md:block z-0 w-full"></div>
                                @endif
                            @endif

                            <!-- Garis vertikal kecil turun ke masing-masing divisi -->
                            <div class="absolute top-0 left-1/2 w-[2px] h-6 bg-white hidden md:block -translate-x-1/2">
                            </div>

                            <div class="org-box w-full max-w-[280px] lg:max-w-full mx-0 md:mx-2 lg:mx-3 min-h-[150px] mt-0 md:mt-6"
                                data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                                <div class="org-box-title !text-[11px] lg:!text-[10px] xl:!text-xs !px-3">{{ $org->name }}
                                </div>
                                <div class="space-y-2 mt-4">
                                    @foreach($org->members as $member)
                                        <p
                                            class="text-sm font-bold {{ $loop->first ? 'text-[#ffb800] pb-2 border-b border-gray-500/50 mb-2' : 'text-gray-100' }}">
                                            {{ $member->name }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>