<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-[#051F20] leading-tight">
            {{ __('Kelola Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-8 px-2">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Daftar Galeri</h3>
                    <p class="text-gray-500 text-sm mt-1">Kelola foto dan dokumentasi kegiatan yang tampil di website.
                    </p>
                </div>
                <a href="{{ route('admin.galleries.create') }}"
                    class="flex items-center gap-2 px-6 py-3 bg-imk-600 text-white font-bold rounded-full hover:bg-imk-700 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Galeri
                </a>
            </div>

            @if(session('success'))
                <div
                    class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-[39px] shadow-xl overflow-hidden border border-gray-100">
                <div class="overflow-x-auto p-4 md:p-8">
                    <table class="min-w-full w-full border-collapse">
                        <thead>
                            <tr class="border-b-2 border-gray-100">
                                <th
                                    class="py-4 px-6 text-left text-sm font-bold text-gray-400 uppercase tracking-wider w-16">
                                    No</th>
                                <th
                                    class="py-4 px-6 text-left text-sm font-bold text-gray-400 uppercase tracking-wider">
                                    Judul & Foto</th>
                                <th
                                    class="py-4 px-6 text-left text-sm font-bold text-gray-400 uppercase tracking-wider">
                                    Tanggal Kegiatan</th>
                                <th
                                    class="py-4 px-6 text-center text-sm font-bold text-gray-400 uppercase tracking-wider w-40">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($galleries as $item)
                                <tr class="hover:bg-gray-50/50 transition duration-200">
                                    <td class="py-5 px-6 text-left font-medium text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="py-5 px-6 text-left">
                                        <div class="flex items-center gap-4">
                                            @if($item->images && is_array($item->images) && count($item->images) > 0)
                                                <img src="{{ asset('storage/' . $item->images[0]) }}"
                                                    class="w-20 h-16 rounded-2xl object-cover shadow-sm">
                                            @else
                                                <div
                                                    class="w-20 h-16 rounded-2xl bg-gray-100 flex items-center justify-center text-gray-400 shadow-sm">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <span class="font-bold text-[#051F20] text-lg">{{ $item->title }}</span>
                                        </div>
                                    </td>
                                    <td class="py-5 px-6 text-left text-gray-500 font-medium">
                                        {{ $item->date ? \Carbon\Carbon::parse($item->date)->format('d M Y') : '' }}</td>
                                    <td class="py-5 px-6 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <a href="{{ route('admin.galleries.edit', $item->id) }}"
                                                class="p-2.5 text-blue-500 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 rounded-xl transition shadow-sm">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.galleries.destroy', $item->id) }}" method="POST"
                                                class="inline-block delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2.5 text-red-500 bg-red-50 hover:bg-red-100 hover:text-red-700 rounded-xl transition shadow-sm">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-16 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                </path>
                                            </svg>
                                            <p class="text-lg">Belum ada galeri yang ditambahkan.</p>
                                        </div>
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