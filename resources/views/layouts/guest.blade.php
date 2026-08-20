<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Login</title>
        <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* ===== Panggung 3D ===== */
            .scene { perspective: 1500px; perspective-origin: 50% 35%; }
            .preserve-3d { transform-style: preserve-3d; }

            .tilt {
                transform: rotateX(var(--rx, 0deg)) rotateY(var(--ry, 0deg));
                transition: transform .55s cubic-bezier(.22, .61, .36, 1);
                will-change: transform;
            }
            .tilt--active { transition: transform .12s linear; }

            /* ===== Lantai grid perspektif ===== */
            .grid-floor {
                position: absolute;
                left: -25%; right: -25%; bottom: -18%;
                height: 70vh;
                background-image:
                    linear-gradient(rgba(142, 182, 155, .20) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(142, 182, 155, .20) 1px, transparent 1px);
                background-size: 72px 72px;
                transform: rotateX(74deg);
                transform-origin: bottom center;
                animation: grid-scroll 7s linear infinite;
                -webkit-mask-image: linear-gradient(to top, rgba(0, 0, 0, .85), transparent 78%);
                mask-image: linear-gradient(to top, rgba(0, 0, 0, .85), transparent 78%);
            }
            @keyframes grid-scroll {
                from { background-position: 0 0; }
                to   { background-position: 0 72px; }
            }

            /* ===== Kubus 3D melayang ===== */
            .cube { position: relative; transform-style: preserve-3d; animation: cube-spin 20s linear infinite; }
            .cube span {
                position: absolute;
                inset: 0;
                border: 1px solid rgba(218, 241, 222, .38);
                background: rgba(142, 182, 155, .07);
                box-shadow: inset 0 0 24px rgba(218, 241, 222, .12);
            }
            .cube span:nth-child(1) { transform: translateZ(var(--half)); }
            .cube span:nth-child(2) { transform: rotateY(180deg) translateZ(var(--half)); }
            .cube span:nth-child(3) { transform: rotateY(90deg) translateZ(var(--half)); }
            .cube span:nth-child(4) { transform: rotateY(-90deg) translateZ(var(--half)); }
            .cube span:nth-child(5) { transform: rotateX(90deg) translateZ(var(--half)); }
            .cube span:nth-child(6) { transform: rotateX(-90deg) translateZ(var(--half)); }
            @keyframes cube-spin {
                from { transform: rotateX(0deg) rotateY(0deg); }
                to   { transform: rotateX(360deg) rotateY(360deg); }
            }

            .float-slow { animation: float-slow 8s ease-in-out infinite; }
            @keyframes float-slow {
                0%, 100% { transform: translateY(0); }
                50%      { transform: translateY(-20px); }
            }

            .ring-spin { animation: ring-spin 16s linear infinite; }
            @keyframes ring-spin {
                from { transform: rotate(0deg); }
                to   { transform: rotate(360deg); }
            }

            /* ===== Aksesibilitas: hormati preferensi kurangi gerak ===== */
            @media (prefers-reduced-motion: reduce) {
                .grid-floor, .cube, .float-slow, .ring-spin { animation: none !important; }
                .tilt, .tilt--active { transition: none; }
            }
        </style>
    </head>
    <body class="relative min-h-screen w-full overflow-hidden font-sans antialiased" style="background: #051F20">

        <!-- Gradasi dasar -->
        <div class="absolute inset-0 z-0" style="background: radial-gradient(120% 90% at 50% -10%, #235347 0%, #0B2B26 48%, #051F20 100%)"></div>

        <!-- Orb bercahaya -->
        <div class="pointer-events-none absolute -left-32 -top-32 z-0 h-[26rem] w-[26rem] rounded-full bg-imk-200/25 blur-[130px]"></div>
        <div class="pointer-events-none absolute -bottom-40 -right-32 z-0 h-[34rem] w-[34rem] rounded-full bg-imk-300/45 blur-[150px]"></div>

        <!-- Lantai grid perspektif -->
        <div class="scene pointer-events-none absolute inset-0 z-0">
            <div class="grid-floor"></div>
        </div>

        <!-- Kubus 3D melayang (hanya layar besar) -->
        <div class="scene pointer-events-none absolute inset-0 z-10 hidden md:block">
            <div class="float-slow absolute left-[10%] top-[16%]">
                <div class="cube h-20 w-20" style="--half: 40px">
                    <span></span><span></span><span></span><span></span><span></span><span></span>
                </div>
            </div>
            <div class="float-slow absolute right-[11%] top-[22%]" style="animation-delay: 1.5s">
                <div class="cube h-12 w-12" style="--half: 24px">
                    <span></span><span></span><span></span><span></span><span></span><span></span>
                </div>
            </div>
            <div class="float-slow absolute bottom-[14%] left-[17%]" style="animation-delay: 3s">
                <div class="cube h-14 w-14" style="--half: 28px">
                    <span></span><span></span><span></span><span></span><span></span><span></span>
                </div>
            </div>
            <div class="float-slow absolute bottom-[18%] right-[16%]" style="animation-delay: 4.5s">
                <div class="cube h-16 w-16" style="--half: 32px">
                    <span></span><span></span><span></span><span></span><span></span><span></span>
                </div>
            </div>
        </div>

        <main class="scene relative z-20 flex min-h-screen items-center justify-center px-4 py-16">
            <div x-data="{ rect: null, px: 0.5, py: 0.5, rx: 0, ry: 0, gx: 50, gy: 50, active: false }"
                    x-on:mousemove="rect = $el.getBoundingClientRect(); px = ($event.clientX - rect.left) / rect.width; py = ($event.clientY - rect.top) / rect.height; gx = px * 100; gy = py * 100; ry = (px - 0.5) * 18; rx = (0.5 - py) * 14; active = true"
                    x-on:mouseleave="rx = 0; ry = 0; gx = 50; gy = 50; active = false"
                    class="preserve-3d w-full sm:max-w-md">

                <div class="tilt preserve-3d relative"
                        :class="active ? 'tilt--active' : ''"
                        :style="`--rx: ${rx}deg; --ry: ${ry}deg`">

                    <!-- Lapisan cahaya & bayangan di belakang kartu -->
                    <div class="pointer-events-none absolute -inset-8 rounded-[46px] bg-imk-200/20 blur-3xl" style="transform: translateZ(-80px)"></div>
                    <div class="pointer-events-none absolute -bottom-10 left-1/2 h-24 w-4/5 rounded-full bg-black/60 blur-2xl" style="transform: translate3d(-50%, 0, -120px)"></div>

                    <!-- Kartu -->
                    <div class="preserve-3d relative overflow-hidden rounded-[32px] border border-white/70 bg-white/95 px-8 pb-10 pt-20 shadow-[0_60px_120px_-30px_rgba(0,0,0,.75)]">

                        <!-- Kilau mengikuti kursor -->
                        <div class="pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-300"
                                :class="active ? 'opacity-100' : ''"
                                :style="`background: radial-gradient(520px circle at ${gx}% ${gy}%, rgba(255,255,255,.6), transparent 45%)`"></div>

                        <!-- Aksen atas -->
                        <div class="pointer-events-none absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-imk-100/70 to-transparent"></div>

                        <div class="relative text-center" style="transform: translateZ(45px)">
                            <p class="text-[11px] font-bold uppercase tracking-[.3em] text-imk-200">Ikatan Mahasiswa Kalukku</p>
                            <h2 class="mt-2 text-3xl font-black tracking-tight text-imk-600">Selamat Datang</h2>
                            <p class="mt-1 text-sm text-gray-500">Silakan masuk ke akun Anda</p>
                        </div>

                        <div class="preserve-3d relative mt-8">
                            {{ $slot }}
                        </div>
                    </div>

                    <!-- Logo melayang di atas kartu -->
                    <a href="/" class="group absolute left-1/2 top-0 z-30" style="transform: translate3d(-50%, -50%, 110px)">
                        <span class="relative flex h-28 w-28 items-center justify-center">
                            <span class="ring-spin absolute inset-0 rounded-full border-2 border-dashed border-imk-200/70"></span>
                            <span class="absolute inset-2 rounded-full bg-gradient-to-br from-white to-imk-100 shadow-[0_25px_45px_-15px_rgba(5,31,32,.75)] transition-transform duration-300 group-hover:scale-105"></span>
                            <img src="{{ asset('image/logo.png') }}" alt="Logo IMK" class="relative h-20 w-20 object-contain drop-shadow-lg">
                        </span>
                    </a>
                </div>
            </div>
        </main>
    </body>
</html>
