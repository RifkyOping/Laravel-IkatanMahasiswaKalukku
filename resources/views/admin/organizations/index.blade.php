<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black leading-tight text-imk-600 sm:text-3xl">Struktur Organisasi</h2>
                <p class="mt-1 text-sm text-gray-600">Kelola kotak jabatan di bagan struktur organisasi</p>
            </div>

            <button type="button" onclick="document.getElementById('addModal').classList.remove('hidden')"
                class="inline-flex items-center gap-2 rounded-xl bg-imk-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-imk-500 focus:outline-none focus:ring-2 focus:ring-imk-400 focus:ring-offset-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Divisi / Jabatan
            </button>
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
                <div class="border-b border-gray-100 px-4 py-4 sm:px-5">
                    <h3 class="text-base font-bold text-imk-600">Daftar Jabatan &amp; Divisi</h3>
                    <p class="mt-0.5 text-xs text-gray-600">
                        {{ $organizations->count() }} jabatan &middot; {{ $organizations->sum('members_count') }} anggota
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/80">
                            <tr>
                                <th class="hidden w-20 px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 sm:table-cell sm:px-5">
                                    Urutan</th>
                                <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 sm:px-5">
                                    Nama Jabatan / Divisi</th>
                                <th class="hidden px-5 py-3 text-xs font-bold uppercase tracking-wider text-gray-600 md:table-cell">
                                    Bagian</th>
                                <th class="hidden px-5 py-3 text-center text-xs font-bold uppercase tracking-wider text-gray-600 lg:table-cell">
                                    Anggota</th>
                                <th class="w-28 px-4 py-3 text-center text-xs font-bold uppercase tracking-wider text-gray-600 sm:px-5">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($organizations as $org)
                                <tr class="transition-colors hover:bg-gray-50">
                                    <td class="hidden px-4 py-4 sm:table-cell sm:px-5">
                                        <span
                                            class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-gray-100 text-xs font-bold text-gray-600">
                                            {{ $org->sort_order }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 sm:px-5">
                                        <p class="text-sm font-bold text-imk-600 sm:text-base">{{ $org->name }}</p>

                                        <div class="mt-1.5 flex flex-wrap items-center gap-2 md:hidden">
                                            <span
                                                class="inline-flex items-center rounded-full bg-gray-100 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-gray-600">
                                                {{ $org->section }}
                                            </span>
                                            <a href="{{ route('admin.members.index', $org->id) }}"
                                                class="inline-flex items-center gap-1 text-xs font-bold text-imk-600 hover:underline lg:hidden">
                                                {{ $org->members_count }} anggota
                                                <svg class="h-3 w-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </div>

                                        <div class="mt-1.5 hidden md:block lg:hidden">
                                            <a href="{{ route('admin.members.index', $org->id) }}"
                                                class="inline-flex items-center gap-1 text-xs font-bold text-imk-600 hover:underline">
                                                {{ $org->members_count }} anggota
                                                <svg class="h-3 w-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>

                                    <td class="hidden px-5 py-4 md:table-cell">
                                        <span
                                            class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-bold uppercase tracking-wide text-gray-600">
                                            {{ $org->section }}
                                        </span>
                                    </td>

                                    <td class="hidden px-5 py-4 text-center lg:table-cell">
                                        <a href="{{ route('admin.members.index', $org->id) }}"
                                            class="inline-flex items-center gap-2 rounded-xl bg-imk-50 px-3 py-2 text-sm font-bold text-imk-600 transition hover:bg-imk-100">
                                            Kelola Anggota
                                            <span
                                                class="inline-flex h-5 min-w-[1.25rem] items-center justify-center rounded-full bg-imk-600 px-1.5 text-[10px] font-black text-white">
                                                {{ $org->members_count }}
                                            </span>
                                        </a>
                                    </td>

                                    <td class="px-4 py-4 sm:px-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.organizations.edit', $org->id) }}" title="Edit"
                                                class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition hover:bg-blue-100 hover:text-blue-700">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.organizations.destroy', $org->id) }}"
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
                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                        </svg>
                                        <p class="mt-3 text-sm font-medium text-gray-800">Belum ada jabatan atau divisi.
                                        </p>
                                        <p class="mt-1 text-xs text-gray-600">Tambahkan jabatan untuk mulai menyusun
                                            bagan struktur.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal tambah jabatan --}}
    <div id="addModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true"
        aria-labelledby="addModalTitle">
        <div class="fixed inset-0 bg-gray-900/60 transition-opacity"
            onclick="document.getElementById('addModal').classList.add('hidden')" aria-hidden="true"></div>

        <div class="fixed inset-0 flex items-end justify-center p-0 sm:items-center sm:p-4">
            <div
                class="relative max-h-[90vh] w-full overflow-y-auto rounded-t-2xl bg-white shadow-xl sm:max-w-lg sm:rounded-2xl">
                <form action="{{ route('admin.organizations.store') }}" method="POST">
                    @csrf
                    <div class="px-5 pb-5 pt-6 sm:px-7">
                        <h3 id="addModalTitle" class="text-lg font-black text-imk-600">Tambah Jabatan / Divisi</h3>
                        <p class="mt-1 text-sm text-gray-600">Kotak baru akan muncul di bagan struktur organisasi.</p>

                        <div class="mt-6 space-y-4">
                            <div>
                                <label for="org_name" class="mb-1.5 block text-sm font-bold text-gray-800">Nama Jabatan /
                                    Divisi</label>
                                <input id="org_name" type="text" name="name" required
                                    value="{{ old('name') }}"
                                    class="w-full rounded-xl border-gray-300 text-sm focus:border-imk-500 focus:ring-imk-300"
                                    placeholder="Contoh: Divisi Keagamaan">
                                @error('name')
                                    <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="org_section" class="mb-1.5 block text-sm font-bold text-gray-800">Bagian
                                    (Section)</label>
                                <select id="org_section" name="section" required
                                    class="w-full rounded-xl border-gray-300 text-sm focus:border-imk-500 focus:ring-imk-300">
                                    <option value="divisi">Divisi (muncul di deretan bawah)</option>
                                    <option value="pembina">Dewan Pembina</option>
                                    <option value="pengawas">Dewan Pengawas</option>
                                    <option value="ketua">Ketua Umum</option>
                                    <option value="sekretaris">Sekretaris</option>
                                    <option value="bendahara">Bendahara</option>
                                </select>
                                @error('section')
                                    <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="org_sort" class="mb-1.5 block text-sm font-bold text-gray-800">Urutan Tampil
                                    (opsional)</label>
                                <input id="org_sort" type="number" name="sort_order"
                                    value="{{ old('sort_order', 0) }}"
                                    class="w-full rounded-xl border-gray-300 text-sm focus:border-imk-500 focus:ring-imk-300">
                                <p class="mt-1 text-xs text-gray-600">Angka lebih kecil tampil lebih dulu (kiri).</p>
                                @error('sort_order')
                                    <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex flex-col-reverse gap-2 border-t border-gray-100 bg-gray-50 px-5 py-4 sm:flex-row sm:justify-end sm:px-7">
                        <button type="button"
                            onclick="document.getElementById('addModal').classList.add('hidden')"
                            class="rounded-xl bg-white px-5 py-2.5 text-sm font-bold text-gray-800 ring-1 ring-gray-200 transition hover:bg-gray-100">Batal</button>
                        <button type="submit"
                            class="rounded-xl bg-imk-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-imk-500">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                document.getElementById('addModal')?.classList.add('hidden');
            }
        });

        @if ($errors->any() && old('name'))
            document.getElementById('addModal')?.classList.remove('hidden');
        @endif
    </script>
</x-app-layout>
