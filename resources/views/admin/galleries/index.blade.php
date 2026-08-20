<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black leading-tight text-imk-600 sm:text-3xl">Kelola Galeri</h2>
                <p class="mt-1 text-sm text-gray-600">Kelola foto dan dokumentasi kegiatan yang tampil di website</p>
            </div>

            <a href="{{ route('admin.galleries.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-imk-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-imk-500 focus:outline-none focus:ring-2 focus:ring-imk-400 focus:ring-offset-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Galeri
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3">
                    <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-emerald-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
                <div class="flex items-center justify-between gap-3 border-b border-gray-100 px-4 py-4 sm:px-5">
                    <div>
                        <h3 class="text-base font-bold text-imk-600">Daftar Galeri</h3>
                        <p class="mt-0.5 text-xs text-gray-600">{{ $galleries->count() }} kegiatan</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/80">
                            <tr>
                                <th class="hidden w-14 px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 sm:table-cell sm:px-5">
                                    No</th>
                                <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 sm:px-5">
                                    Judul &amp; Foto</th>
                                <th class="hidden px-5 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 md:table-cell">
                                    Tanggal Kegiatan</th>
                                <th class="w-28 px-4 py-3 text-center text-xs font-bold uppercase tracking-wider text-gray-600 sm:px-5">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($galleries as $item)
                                <tr class="transition-colors hover:bg-gray-50">
                                    <td class="hidden px-4 py-4 text-sm font-medium text-gray-600 sm:table-cell sm:px-5">
                                        {{ $loop->iteration }}</td>

                                    <td class="px-4 py-4 sm:px-5">
                                        <div class="flex items-center gap-3">
                                            @if ($item->images && is_array($item->images) && count($item->images) > 0)
                                                <img src="{{ asset('storage/' . $item->images[0]) }}" alt=""
                                                    class="h-12 w-16 flex-shrink-0 rounded-xl object-cover sm:h-16 sm:w-20">
                                            @else
                                                <div
                                                    class="flex h-12 w-16 flex-shrink-0 items-center justify-center rounded-xl bg-gray-100 text-gray-400 sm:h-16 sm:w-20">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <p class="truncate text-sm font-bold text-imk-600 sm:text-base">
                                                    {{ $item->title }}</p>
                                                <p class="mt-0.5 text-xs text-gray-600 md:hidden">
                                                    {{ $item->date ? \Carbon\Carbon::parse($item->date)->format('d M Y') : '—' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="hidden whitespace-nowrap px-5 py-4 text-sm text-gray-600 md:table-cell">
                                        {{ $item->date ? \Carbon\Carbon::parse($item->date)->format('d M Y') : '—' }}
                                    </td>

                                    <td class="px-4 py-4 sm:px-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.galleries.edit', $item->id) }}" title="Edit"
                                                class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition hover:bg-blue-100 hover:text-blue-700">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.galleries.destroy', $item->id) }}"
                                                method="POST" class="delete-form inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Hapus"
                                                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-red-600 transition hover:bg-red-100 hover:text-red-700">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-14 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mt-3 text-sm font-medium text-gray-800">Belum ada galeri yang
                                            ditambahkan.</p>
                                        <a href="{{ route('admin.galleries.create') }}"
                                            class="mt-4 inline-flex items-center gap-2 rounded-xl bg-imk-600 px-4 py-2 text-sm font-bold text-white transition hover:bg-imk-500">
                                            Tambah galeri pertama
                                        </a>
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
