<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Pendaftar') }}
            </h2>
            <a href="{{ route('admin.registrations.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-10 text-gray-900">

                    <div class="border-b border-gray-200 pb-4 mb-6">
                        <h3 class="text-2xl font-bold text-imk-600">{{ $registration->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Mendaftar pada:
                            {{ $registration->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Data Pribadi -->
                        <div>
                            <h4 class="font-bold text-gray-800 border-b pb-2 mb-4">Data Pribadi</h4>
                            <table class="w-full text-sm">
                                <tbody>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-2 text-gray-500 w-1/3">Nama Lengkap</td>
                                        <td class="py-2 font-medium">{{ $registration->name }}</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-2 text-gray-500">Jenis Kelamin</td>
                                        <td class="py-2 font-medium">{{ $registration->gender }}</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-2 text-gray-500">Tempat, Tgl Lahir</td>
                                        <td class="py-2 font-medium">{{ $registration->birth_place }},
                                            {{ \Carbon\Carbon::parse($registration->birth_date)->format('d M Y') }}</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-2 text-gray-500">Nomor HP/WA</td>
                                        <td class="py-2 font-medium">
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $registration->phone) }}"
                                                target="_blank"
                                                class="text-green-600 hover:underline flex items-center gap-1">
                                                {{ $registration->phone }}
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pendidikan -->
                        <div>
                            <h4 class="font-bold text-gray-800 border-b pb-2 mb-4">Data Pendidikan</h4>
                            <table class="w-full text-sm">
                                <tbody>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-2 text-gray-500 w-1/3">Asal Sekolah</td>
                                        <td class="py-2 font-medium">{{ $registration->high_school }}</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-2 text-gray-500">Universitas</td>
                                        <td class="py-2 font-medium">{{ $registration->university }}</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-2 text-gray-500">Fakultas</td>
                                        <td class="py-2 font-medium">{{ $registration->faculty }}</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-2 text-gray-500">Program Studi</td>
                                        <td class="py-2 font-medium">{{ $registration->study_program }}</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-2 text-gray-500">Angkatan</td>
                                        <td class="py-2 font-medium">{{ $registration->entry_year }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="font-bold text-gray-800 border-b pb-2 mb-4">Alamat</h4>
                        <table class="w-full text-sm">
                            <tbody>
                                <tr class="border-b border-gray-100">
                                    <td class="py-2 text-gray-500 w-1/4 align-top">Alamat di Kalukku</td>
                                    <td class="py-2 font-medium">{{ $registration->address_kalukku }}</td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-2 text-gray-500 w-1/4 align-top">Alamat di Majene</td>
                                    <td class="py-2 font-medium">{{ $registration->address_majene ?: '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <h4 class="font-bold text-gray-800 mb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-imk-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                            Dokumen Izin Orang Tua
                        </h4>
                        @if($registration->parent_permit_file)
                            <div class="flex items-center gap-4 mt-4">
                                <a href="{{ asset('storage/' . $registration->parent_permit_file) }}" target="_blank"
                                    class="px-4 py-2 bg-imk-600 text-white rounded shadow hover:bg-imk-700 transition flex items-center gap-2 text-sm font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Lihat File
                                </a>
                                <a href="{{ asset('storage/' . $registration->parent_permit_file) }}" download
                                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded shadow hover:bg-gray-300 transition flex items-center gap-2 text-sm font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Download
                                </a>
                            </div>
                        @else
                            <p class="text-red-500 text-sm mt-2 font-medium">File tidak ditemukan.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>