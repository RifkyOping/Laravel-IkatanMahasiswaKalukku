<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black leading-tight text-imk-600 sm:text-3xl">Kelola Dokumen</h2>
                <p class="mt-1 text-sm text-gray-600">Kelola file atau dokumen untuk diunduh oleh pengunjung</p>
            </div>

            <a href="{{ route('admin.attachments.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-imk-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-imk-500 focus:outline-none focus:ring-2 focus:ring-imk-400 focus:ring-offset-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Dokumen
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
                        <h3 class="text-base font-bold text-imk-600">Daftar Dokumen</h3>
                        <p class="mt-0.5 text-xs text-gray-600">
                            {{ $attachments->count() }} file
                            @php $hidden = $attachments->where('is_hidden', true)->count(); @endphp
                            @if ($hidden > 0)
                                &middot; {{ $hidden }} tersembunyi
                            @endif
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/80">
                            <tr>
                                <th class="hidden w-14 px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 sm:table-cell sm:px-5">
                                    No</th>
                                <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 sm:px-5">
                                    Nama / Judul File</th>
                                <th class="hidden px-5 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 lg:table-cell">
                                    Nama File Asli</th>
                                <th class="hidden px-5 py-3 text-center text-xs font-bold uppercase tracking-wider text-gray-600 sm:table-cell">
                                    Status</th>
                                <th class="w-36 px-4 py-3 text-center text-xs font-bold uppercase tracking-wider text-gray-600 sm:px-5">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($attachments as $item)
                                <tr class="transition-colors hover:bg-gray-50">
                                    <td class="hidden px-4 py-4 text-sm font-medium text-gray-600 sm:table-cell sm:px-5">
                                        {{ $loop->iteration }}</td>

                                    <td class="px-4 py-4 sm:px-5">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-imk-50 text-imk-600">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="truncate text-sm font-bold text-imk-600 sm:text-base">
                                                    {{ $item->title }}</p>
                                                <p class="mt-0.5 truncate text-xs text-gray-600 lg:hidden">
                                                    {{ $item->original_name ?? '—' }}</p>
                                                <div class="mt-1.5 sm:hidden">
                                                    @if ($item->is_hidden)
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-red-100 bg-red-50 px-2 py-0.5 text-[10px] font-bold text-red-600">Tersembunyi</span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-emerald-100 bg-emerald-50 px-2 py-0.5 text-[10px] font-bold text-emerald-600">Publik</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="hidden max-w-xs px-5 py-4 text-sm text-gray-600 lg:table-cell">
                                        <span class="block truncate">{{ $item->original_name ?? '—' }}</span>
                                    </td>

                                    <td class="hidden px-5 py-4 text-center sm:table-cell">
                                        @if ($item->is_hidden)
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full border border-red-100 bg-red-50 px-3 py-1 text-xs font-bold text-red-600">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                                </svg>
                                                Tersembunyi
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-600">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Publik
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4 sm:px-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <form action="{{ route('admin.attachments.toggleVisibility', $item->id) }}"
                                                method="POST" class="toggle-visibility-form inline-block"
                                                data-status="{{ $item->is_hidden ? 'tampilkan' : 'sembunyikan' }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    title="{{ $item->is_hidden ? 'Tampilkan ke Publik' : 'Sembunyikan dari Publik' }}"
                                                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl transition {{ $item->is_hidden ? 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100 hover:text-emerald-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-800' }}">
                                                    @if ($item->is_hidden)
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    @else
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                                        </svg>
                                                    @endif
                                                </button>
                                            </form>

                                            <a href="{{ route('admin.attachments.edit', $item->id) }}" title="Edit"
                                                class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition hover:bg-blue-100 hover:text-blue-700">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.attachments.destroy', $item->id) }}"
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
                                    <td colspan="5" class="px-5 py-14 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="mt-3 text-sm font-medium text-gray-800">Belum ada dokumen yang
                                            ditambahkan.</p>
                                        <a href="{{ route('admin.attachments.create') }}"
                                            class="mt-4 inline-flex items-center gap-2 rounded-xl bg-imk-600 px-4 py-2 text-sm font-bold text-white transition hover:bg-imk-500">
                                            Tambah dokumen pertama
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.toggle-visibility-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const status = this.getAttribute('data-status');
                    const isTampilkan = status === 'tampilkan';
                    const actionText = isTampilkan
                        ? 'menampilkan dokumen ini ke publik'
                        : 'menyembunyikan dokumen ini dari publik';
                    const confirmBtnColor = isTampilkan
                        ? 'bg-emerald-600 hover:bg-emerald-700'
                        : 'bg-amber-500 hover:bg-amber-600';

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: `Apakah Anda yakin ingin ${actionText}?`,
                        icon: isTampilkan ? 'info' : 'warning',
                        showCancelButton: true,
                        confirmButtonText: isTampilkan ? 'Ya, Tampilkan' : 'Ya, Sembunyikan',
                        cancelButtonText: 'Batal',
                        buttonsStyling: false,
                        customClass: {
                            popup: 'rounded-2xl shadow-2xl border border-gray-100 p-6',
                            title: 'text-xl font-black text-imk-600 mt-4',
                            htmlContainer: 'text-gray-600 mt-2',
                            actions: 'mt-6 gap-3 flex w-full justify-center',
                            confirmButton: `px-6 py-2.5 ${confirmBtnColor} text-white font-bold rounded-xl transition`,
                            cancelButton: 'px-6 py-2.5 bg-gray-100 text-gray-800 font-bold rounded-xl hover:bg-gray-200 transition'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
