<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-3xl text-[#051F20] leading-tight">
                {{ __('Daftar Akun Terdaftar') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Statistik Card -->
                <div class="bg-white rounded-[39px] shadow-xl p-8 relative overflow-hidden flex items-center">
                    <div
                        class="w-16 h-16 bg-emerald-100 text-imk-600 rounded-2xl flex items-center justify-center mr-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 font-bold mb-1">Total Akun Admin</p>
                        <h3 class="text-4xl font-black text-[#051F20]">{{ $totalUsers }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[39px] shadow-xl p-8 relative overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-2 border-gray-100">
                                <th class="py-4 px-6 font-bold text-gray-500 uppercase tracking-wider text-sm">Nama</th>
                                <th class="py-4 px-6 font-bold text-gray-500 uppercase tracking-wider text-sm">Email
                                </th>
                                <th class="py-4 px-6 font-bold text-gray-500 uppercase tracking-wider text-sm">Terdaftar
                                    Sejak</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-full bg-emerald-100 text-imk-600 flex items-center justify-center font-bold">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <span class="font-semibold text-gray-800">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600">
                                        {{ $user->email }}
                                    </td>
                                    <td class="py-4 px-6 text-gray-600">
                                        {{ $user->created_at->format('d M Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-8 px-6 text-center text-gray-400">
                                        Belum ada akun yang terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>