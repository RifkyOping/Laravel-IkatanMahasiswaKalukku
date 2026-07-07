@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#0A3A2A] py-32 px-4 md:px-8 relative overflow-hidden"
        style="background-image: url('{{ asset('image/logo.png') }}'); background-repeat: no-repeat; background-position: center; background-size: 70%; background-blend-mode: soft-light;">

        <!-- Background overlay -->
        <div class="absolute inset-0 bg-[#0A3A2A]/90 z-0"></div>

        <div class="max-w-4xl mx-auto relative z-10">
            <!-- Header -->
            <div class="text-center mb-12" data-aos="fade-down">
                <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-wider mb-4 drop-shadow-lg">
                    Pendaftaran Anggota Baru
                </h1>
                <p class="text-[#ffb800] text-lg font-medium max-w-2xl mx-auto">
                    Silakan isi formulir di bawah ini dengan data yang sebenar-benarnya untuk bergabung menjadi bagian dari
                    Ikatan Mahasiswa Kalukku (IMK).
                </p>
            </div>

            @if(session('success'))
                <div
                    class="mb-8 p-4 bg-green-500/20 border border-green-500 rounded-xl text-green-300 text-center font-semibold flex flex-col items-center gap-3 animate-fade-in-up">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-8 p-4 bg-red-500/20 border border-red-500 rounded-xl text-red-300">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 md:p-10 border border-white/20 shadow-2xl"
                data-aos="fade-up" data-aos-delay="100">
                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <!-- Data Pribadi -->
                    <div>
                        <h3
                            class="text-[#ffb800] text-xl font-bold mb-4 flex items-center gap-2 border-b border-white/10 pb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Data Pribadi
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#ffb800] focus:ring-1 focus:ring-[#ffb800] transition-all placeholder-gray-400"
                                    placeholder="Masukkan nama lengkap">
                            </div>

                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Jenis Kelamin</label>
                                <select name="gender" required
                                    class="w-full bg-[#0d4a36] border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#ffb800] focus:ring-1 focus:ring-[#ffb800] transition-all">
                                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Pilih Jenis Kelamin
                                    </option>
                                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Tempat Lahir</label>
                                <input type="text" name="birth_place" value="{{ old('birth_place') }}" required
                                    class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#ffb800] focus:ring-1 focus:ring-[#ffb800] transition-all placeholder-gray-400"
                                    placeholder="Tempat lahir">
                            </div>

                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Tanggal Lahir</label>
                                <input type="date" name="birth_date" value="{{ old('birth_date') }}" required
                                    class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#ffb800] focus:ring-1 focus:ring-[#ffb800] transition-all"
                                    style="color-scheme: dark;">
                            </div>

                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Nomor HP / WhatsApp</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" required
                                    class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#ffb800] focus:ring-1 focus:ring-[#ffb800] transition-all placeholder-gray-400"
                                    placeholder="Contoh: 081234567890">
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="pt-4">
                        <h3
                            class="text-[#ffb800] text-xl font-bold mb-4 flex items-center gap-2 border-b border-white/10 pb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Alamat
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Alamat di Kalukku</label>
                                <textarea name="address_kalukku" required rows="3"
                                    class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#ffb800] focus:ring-1 focus:ring-[#ffb800] transition-all placeholder-gray-400"
                                    placeholder="Alamat lengkap di Kalukku">{{ old('address_kalukku') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Alamat di Majene</label>
                                <textarea name="address_majene" rows="3"
                                    class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#ffb800] focus:ring-1 focus:ring-[#ffb800] transition-all placeholder-gray-400"
                                    placeholder="Alamat lengkap jika berdomisili di Majene">{{ old('address_majene') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Data Pendidikan -->
                    <div class="pt-4">
                        <h3
                            class="text-[#ffb800] text-xl font-bold mb-4 flex items-center gap-2 border-b border-white/10 pb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l-9-5v7l9 5" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5v7l-9 5" />
                            </svg>
                            Data Pendidikan
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Asal Sekolah</label>
                                <input type="text" name="high_school" value="{{ old('high_school') }}" required
                                    class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#ffb800] focus:ring-1 focus:ring-[#ffb800] transition-all placeholder-gray-400"
                                    placeholder="SMA/SMK sederajat">
                            </div>
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Universitas / Perguruan
                                    Tinggi</label>
                                <input type="text" name="university" value="{{ old('university') }}" required
                                    class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#ffb800] focus:ring-1 focus:ring-[#ffb800] transition-all placeholder-gray-400"
                                    placeholder="Universitas saat ini">
                            </div>
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Fakultas</label>
                                <input type="text" name="faculty" value="{{ old('faculty') }}" required
                                    class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#ffb800] focus:ring-1 focus:ring-[#ffb800] transition-all placeholder-gray-400"
                                    placeholder="Fakultas">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-white text-sm font-semibold mb-2">Program Studi</label>
                                    <input type="text" name="study_program" value="{{ old('study_program') }}" required
                                        class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#ffb800] focus:ring-1 focus:ring-[#ffb800] transition-all placeholder-gray-400"
                                        placeholder="Jurusan">
                                </div>
                                <div>
                                    <label class="block text-white text-sm font-semibold mb-2">Angkatan</label>
                                    <input type="number" name="entry_year" value="{{ old('entry_year') }}" required
                                        class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#ffb800] focus:ring-1 focus:ring-[#ffb800] transition-all placeholder-gray-400"
                                        placeholder="Contoh: 2024">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen -->
                    <div class="pt-4">
                        <h3
                            class="text-[#ffb800] text-xl font-bold mb-4 flex items-center gap-2 border-b border-white/10 pb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                            Upload Dokumen
                        </h3>

                        <div class="bg-[#ffb800]/10 border border-[#ffb800]/30 rounded-xl p-4 mb-4">
                            <p class="text-white text-sm">
                                <span class="font-bold text-[#ffb800]">PENTING:</span> Harap mendownload format Surat Izin
                                Orang Tua terlebih dahulu di halaman <a href="{{ route('lampiran') }}"
                                    class="text-blue-400 hover:text-blue-300 underline underline-offset-2 font-semibold">Lampiran</a>.
                                Isi, tanda tangani, lalu upload file tersebut (Maks 5MB, Format PDF/JPG/PNG).
                            </p>
                        </div>

                        <div>
                            <label class="block text-white text-sm font-semibold mb-2">Upload Surat Izin Orang Tua</label>
                            <input type="file" name="parent_permit_file" accept=".pdf,.jpg,.jpeg,.png,.docx" required
                                class="block w-full text-sm text-gray-300 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[#ffb800] file:text-[#0A3A2A] hover:file:bg-yellow-400 file:transition-all file:cursor-pointer bg-white/5 border border-white/20 rounded-xl focus:outline-none">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-8 text-center">
                        <button type="submit"
                            class="bg-[#ffb800] hover:bg-yellow-400 text-[#0A3A2A] px-12 py-4 rounded-xl text-lg font-black tracking-wide shadow-xl hover:shadow-2xl hover:-translate-y-1 transition duration-300 w-full md:w-auto">
                            KIRIM PENDAFTARAN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.5s ease-out forwards;
        }
    </style>

    @if(session('registration_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Terima Kasih Telah Mendaftar!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Gabung Grup WhatsApp',
                    cancelButtonText: 'Tutup',
                    buttonsStyling: false,
                    customClass: {
                        popup: 'rounded-[30px] shadow-2xl border border-gray-100 p-6',
                        title: 'text-2xl font-black text-[#051F20] mt-4',
                        htmlContainer: 'text-gray-500 mt-2',
                        actions: 'mt-8 gap-4 flex w-full justify-center',
                        confirmButton: 'px-8 py-3 bg-[#25D366] text-white font-bold rounded-full hover:bg-[#128C7E] transition-all duration-300',
                        cancelButton: 'px-8 py-3 bg-gray-100 text-gray-700 font-bold rounded-full hover:bg-gray-200 transition-all duration-300'
                    }
                }).then((result) => {
                    @if(session('whatsapp_link'))
                        if (result.isConfirmed) {
                            window.open('{{ session('whatsapp_link') }}', '_blank');
                        }
                    @else
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Mohon Maaf',
                                text: 'Link Grup WhatsApp belum tersedia saat ini.',
                                icon: 'info',
                                confirmButtonText: 'Tutup',
                                buttonsStyling: false,
                                customClass: {
                                    popup: 'rounded-[30px]',
                                    confirmButton: 'px-6 py-2 bg-blue-500 text-white rounded-full'
                                }
                            });
                        }
                    @endif
                });
            });
        </script>
    @endif
@endsection