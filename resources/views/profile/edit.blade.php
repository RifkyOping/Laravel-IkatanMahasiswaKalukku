<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-black leading-tight text-imk-600">
                Pengaturan Akun
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Kelola informasi profil, kata sandi, dan keamanan akun Anda
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- Kartu identitas --}}
                <aside class="lg:col-span-1">
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm lg:sticky lg:top-6">
                        <div class="flex items-center gap-4">
                            <span
                                class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-imk-400 to-imk-600 text-xl font-black text-white">
                                {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                            </span>
                            <div class="min-w-0">
                                <p class="truncate text-lg font-black text-imk-600">{{ $user->name }}</p>
                                <p class="truncate text-sm text-gray-600">{{ $user->email }}</p>
                            </div>
                        </div>

                        <dl class="mt-6 space-y-3 border-t border-gray-100 pt-5 text-sm">
                            <div class="flex items-center justify-between gap-3">
                                <dt class="text-gray-600">Peran</dt>
                                <dd class="font-semibold text-gray-800">Administrator</dd>
                            </div>
                            <div class="flex items-center justify-between gap-3">
                                <dt class="text-gray-600">Bergabung</dt>
                                <dd class="font-semibold text-gray-800">
                                    {{ $user->created_at?->format('d M Y') ?? '—' }}</dd>
                            </div>
                        </dl>

                        <a href="{{ route('dashboard') }}"
                            class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-bold text-gray-800 transition hover:border-imk-300 hover:text-imk-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </aside>

                {{-- Form pengaturan --}}
                <div class="space-y-6 lg:col-span-2">
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="rounded-2xl border border-red-100 bg-red-50/40 p-6 shadow-sm sm:p-8">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
