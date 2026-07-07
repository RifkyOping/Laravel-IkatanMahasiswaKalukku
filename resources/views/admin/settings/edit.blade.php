<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <x-slot name="header">
        <h2 class="font-black text-3xl text-[#051F20] leading-tight">
            {{ __('Pengaturan Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[39px] shadow-xl p-10 md:p-12 relative overflow-hidden">

                @if (session('success'))
                    <div
                        class="mb-8 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl flex items-center gap-3">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8 relative z-10">
                    @csrf
                    @method('PUT')

                    <div class="mb-8 p-6 bg-gray-50 border border-gray-100 rounded-3xl">
                        <h3 class="text-xl font-bold text-[#051F20] mb-4">Pengaturan Umum</h3>
                        <div>
                            <label for="org_period" class="block text-sm font-bold text-gray-700 mb-2">Teks Periode
                                Kepengurusan (Digunakan di Bagan Struktur)</label>
                            <input type="text" name="org_period" id="org_period"
                                value="{{ old('org_period', $setting->org_period) }}"
                                placeholder="Contoh: Periode 2025/2026"
                                class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-4 bg-white hover:bg-gray-50 transition-colors">
                            @error('org_period') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mb-8 p-6 bg-gray-50 border border-gray-100 rounded-3xl">
                        <h3 class="text-xl font-bold text-[#051F20] mb-4">Foto Struktur (Halaman Beranda)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Ketua Photo -->
                            <div>
                                <label for="ketua_photo" class="block text-sm font-bold text-gray-700 mb-2">Foto Ketua
                                    Umum</label>
                                @if($setting->ketua_photo)
                                    <img src="{{ asset('storage/' . $setting->ketua_photo) }}" alt="Ketua"
                                        id="ketua_photo_preview" class="w-full h-40 object-cover rounded-xl mb-2">
                                @else
                                    <img src="{{ asset('image/pengurus/ketua.jpeg') }}" alt="Ketua Default"
                                        id="ketua_photo_preview"
                                        class="w-full h-40 object-cover rounded-xl mb-2 opacity-50">
                                @endif
                                <input type="hidden" name="ketua_photo_cropped" id="ketua_photo_cropped">
                                <input type="file" name="ketua_photo" id="ketua_photo" accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-imk-50 file:text-imk-700 hover:file:bg-imk-100 mb-3">
                                @error('ketua_photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror

                                <label for="ketua_name" class="block text-sm font-bold text-gray-700 mb-1">Nama Ketua
                                    Umum</label>
                                <input type="text" name="ketua_name" id="ketua_name"
                                    value="{{ old('ketua_name', $setting->ketua_name) }}" placeholder="Nama Ketua"
                                    class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-2 bg-white hover:bg-gray-50 transition-colors">
                                @error('ketua_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Sekretaris Photo -->
                            <div>
                                <label for="sekretaris_photo" class="block text-sm font-bold text-gray-700 mb-2">Foto
                                    Sekretaris Umum</label>
                                @if($setting->sekretaris_photo)
                                    <img src="{{ asset('storage/' . $setting->sekretaris_photo) }}" alt="Sekretaris"
                                        id="sekretaris_photo_preview" class="w-full h-40 object-cover rounded-xl mb-2">
                                @else
                                    <img src="{{ asset('image/pengurus/sekretaris.jpg') }}" alt="Sekretaris Default"
                                        id="sekretaris_photo_preview"
                                        class="w-full h-40 object-cover rounded-xl mb-2 opacity-50">
                                @endif
                                <input type="hidden" name="sekretaris_photo_cropped" id="sekretaris_photo_cropped">
                                <input type="file" name="sekretaris_photo" id="sekretaris_photo" accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-imk-50 file:text-imk-700 hover:file:bg-imk-100 mb-3">
                                @error('sekretaris_photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror

                                <label for="sekretaris_name" class="block text-sm font-bold text-gray-700 mb-1">Nama
                                    Sekretaris Umum</label>
                                <input type="text" name="sekretaris_name" id="sekretaris_name"
                                    value="{{ old('sekretaris_name', $setting->sekretaris_name) }}"
                                    placeholder="Nama Sekretaris"
                                    class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-2 bg-white hover:bg-gray-50 transition-colors">
                                @error('sekretaris_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Bendahara Photo -->
                            <div>
                                <label for="bendahara_photo" class="block text-sm font-bold text-gray-700 mb-2">Foto
                                    Bendahara Umum</label>
                                @if($setting->bendahara_photo)
                                    <img src="{{ asset('storage/' . $setting->bendahara_photo) }}" alt="Bendahara"
                                        id="bendahara_photo_preview" class="w-full h-40 object-cover rounded-xl mb-2">
                                @else
                                    <img src="{{ asset('image/pengurus/bendahara.jpeg') }}" alt="Bendahara Default"
                                        id="bendahara_photo_preview"
                                        class="w-full h-40 object-cover rounded-xl mb-2 opacity-50">
                                @endif
                                <input type="hidden" name="bendahara_photo_cropped" id="bendahara_photo_cropped">
                                <input type="file" name="bendahara_photo" id="bendahara_photo" accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-imk-50 file:text-imk-700 hover:file:bg-imk-100 mb-3">
                                @error('bendahara_photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror

                                <label for="bendahara_name" class="block text-sm font-bold text-gray-700 mb-1">Nama
                                    Bendahara Umum</label>
                                <input type="text" name="bendahara_name" id="bendahara_name"
                                    value="{{ old('bendahara_name', $setting->bendahara_name) }}"
                                    placeholder="Nama Bendahara"
                                    class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-2 bg-white hover:bg-gray-50 transition-colors">
                                @error('bendahara_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Kolom Kontak Dasar -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-bold text-[#051F20] border-b pb-2">Informasi Kontak</h3>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label for="address" class="block text-sm font-bold text-gray-700">Alamat
                                        Sekretariat (Gunakan &lt;br&gt; untuk baris baru)</label>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="show_address" value="1" {{ old('show_address', $setting->show_address ?? true) ? 'checked' : '' }} class="sr-only peer">
                                        <div
                                            class="w-9 h-5 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-imk-400 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-imk-500">
                                        </div>
                                        <span class="ml-2 text-xs text-gray-500 font-bold">Tampilkan</span>
                                    </label>
                                </div>
                                <textarea name="address" id="address" rows="3"
                                    class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-4 bg-gray-50 hover:bg-white transition-colors">{{ old('address', $setting->address) }}</textarea>
                                @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label for="email" class="block text-sm font-bold text-gray-700">Alamat
                                        Email</label>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="show_email" value="1" {{ old('show_email', $setting->show_email ?? true) ? 'checked' : '' }} class="sr-only peer">
                                        <div
                                            class="w-9 h-5 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-imk-400 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-imk-500">
                                        </div>
                                        <span class="ml-2 text-xs text-gray-500 font-bold">Tampilkan</span>
                                    </label>
                                </div>
                                <input type="email" name="email" id="email" value="{{ old('email', $setting->email) }}"
                                    class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-4 bg-gray-50 hover:bg-white transition-colors">
                                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label for="phone" class="block text-sm font-bold text-gray-700">Nomor
                                        Telepon</label>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="show_phone" value="1" {{ old('show_phone', $setting->show_phone ?? true) ? 'checked' : '' }} class="sr-only peer">
                                        <div
                                            class="w-9 h-5 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-imk-400 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-imk-500">
                                        </div>
                                        <span class="ml-2 text-xs text-gray-500 font-bold">Tampilkan</span>
                                    </label>
                                </div>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone) }}"
                                    class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-4 bg-gray-50 hover:bg-white transition-colors">
                                @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Kolom Media Sosial -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-bold text-[#051F20] border-b pb-2">Tautan Media Sosial</h3>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label for="instagram" class="block text-sm font-bold text-gray-700">Link
                                        Instagram</label>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="show_instagram" value="1" {{ old('show_instagram', $setting->show_instagram ?? true) ? 'checked' : '' }} class="sr-only peer">
                                        <div
                                            class="w-9 h-5 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-imk-400 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-imk-500">
                                        </div>
                                        <span class="ml-2 text-xs text-gray-500 font-bold">Tampilkan</span>
                                    </label>
                                </div>
                                <input type="url" name="instagram" id="instagram"
                                    value="{{ old('instagram', $setting->instagram) }}"
                                    placeholder="https://instagram.com/..."
                                    class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-4 bg-gray-50 hover:bg-white transition-colors">
                                @error('instagram') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label for="facebook" class="block text-sm font-bold text-gray-700">Link
                                        Facebook</label>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="show_facebook" value="1" {{ old('show_facebook', $setting->show_facebook ?? true) ? 'checked' : '' }} class="sr-only peer">
                                        <div
                                            class="w-9 h-5 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-imk-400 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-imk-500">
                                        </div>
                                        <span class="ml-2 text-xs text-gray-500 font-bold">Tampilkan</span>
                                    </label>
                                </div>
                                <input type="url" name="facebook" id="facebook"
                                    value="{{ old('facebook', $setting->facebook) }}"
                                    placeholder="https://facebook.com/..."
                                    class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-4 bg-gray-50 hover:bg-white transition-colors">
                                @error('facebook') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label for="whatsapp" class="block text-sm font-bold text-gray-700">Link
                                        WhatsApp</label>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="show_whatsapp" value="1" {{ old('show_whatsapp', $setting->show_whatsapp ?? true) ? 'checked' : '' }} class="sr-only peer">
                                        <div
                                            class="w-9 h-5 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-imk-400 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-imk-500">
                                        </div>
                                        <span class="ml-2 text-xs text-gray-500 font-bold">Tampilkan</span>
                                    </label>
                                </div>
                                <input type="url" name="whatsapp" id="whatsapp"
                                    value="{{ old('whatsapp', $setting->whatsapp) }}" placeholder="https://wa.me/..."
                                    class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-4 bg-gray-50 hover:bg-white transition-colors">
                                @error('whatsapp') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label for="youtube" class="block text-sm font-bold text-gray-700">Link
                                        YouTube</label>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="show_youtube" value="1" {{ old('show_youtube', $setting->show_youtube ?? true) ? 'checked' : '' }} class="sr-only peer">
                                        <div
                                            class="w-9 h-5 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-imk-400 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-imk-500">
                                        </div>
                                        <span class="ml-2 text-xs text-gray-500 font-bold">Tampilkan</span>
                                    </label>
                                </div>
                                <input type="url" name="youtube" id="youtube"
                                    value="{{ old('youtube', $setting->youtube) }}"
                                    placeholder="https://youtube.com/..."
                                    class="block w-full border-gray-200 focus:border-imk-400 focus:ring-imk-400 rounded-2xl shadow-sm text-gray-700 p-4 bg-gray-50 hover:bg-white transition-colors">
                                @error('youtube') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 flex items-center justify-end border-t border-gray-100">
                        <button type="submit"
                            class="px-8 py-3 bg-imk-600 text-white font-bold rounded-full hover:bg-imk-700 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                            Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Crop Modal -->
    <div id="cropModal"
        class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
        <div class="bg-white rounded-[30px] shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="text-xl font-bold text-[#051F20]">Sesuaikan Foto</h3>
                <button type="button" id="closeCropModal" class="text-gray-400 hover:text-red-500 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div
                class="p-6 flex-grow overflow-hidden relative bg-gray-900 flex justify-center items-center min-h-[400px]">
                <img id="cropImage" src="" alt="Crop Preview" class="max-w-full max-h-[60vh] object-contain">
            </div>
            <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <button type="button" id="cancelCrop"
                    class="px-6 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 transition">Batal</button>
                <button type="button" id="saveCrop"
                    class="px-6 py-2.5 bg-imk-600 text-white font-bold rounded-xl hover:bg-imk-700 transition">Crop &
                    Simpan</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let cropper = null;
            const cropModal = document.getElementById('cropModal');
            const cropImage = document.getElementById('cropImage');
            const saveCropBtn = document.getElementById('saveCrop');
            const cancelCropBtn = document.getElementById('cancelCrop');
            const closeCropModalBtn = document.getElementById('closeCropModal');

            let currentInputId = null;

            const photoInputs = ['ketua_photo', 'sekretaris_photo', 'bendahara_photo'];

            photoInputs.forEach(inputId => {
                const inputEl = document.getElementById(inputId);
                inputEl.addEventListener('change', function (e) {
                    const files = e.target.files;
                    if (files && files.length > 0) {
                        const reader = new FileReader();
                        reader.onload = function (event) {
                            cropImage.src = event.target.result;
                            currentInputId = inputId;
                            cropModal.classList.remove('hidden');

                            if (cropper) {
                                cropper.destroy();
                            }

                            let ratio = 3 / 4;
                            if (inputId === 'ketua_photo') {
                                ratio = 340 / 460;
                            } else {
                                ratio = 72 / 96;
                            }

                            cropper = new Cropper(cropImage, {
                                aspectRatio: ratio,
                                viewMode: 1,
                                autoCropArea: 1,
                                responsive: true,
                                background: false,
                            });
                        };
                        reader.readAsDataURL(files[0]);
                    }
                });
            });

            function hideModal() {
                cropModal.classList.add('hidden');
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                if (currentInputId) {
                    document.getElementById(currentInputId).value = '';
                    currentInputId = null;
                }
            }

            cancelCropBtn.addEventListener('click', hideModal);
            closeCropModalBtn.addEventListener('click', hideModal);

            saveCropBtn.addEventListener('click', function () {
                if (!cropper || !currentInputId) return;

                const canvas = cropper.getCroppedCanvas({
                    width: currentInputId === 'ketua_photo' ? 680 : 576,
                    height: currentInputId === 'ketua_photo' ? 920 : 768,
                });

                if (canvas) {
                    const base64Image = canvas.toDataURL('image/jpeg', 0.9);
                    document.getElementById(currentInputId + '_cropped').value = base64Image;
                    const previewImage = document.getElementById(currentInputId + '_preview');
                    previewImage.src = base64Image;
                    previewImage.classList.remove('opacity-50');

                    cropModal.classList.add('hidden');
                    cropper.destroy();
                    cropper = null;
                }
            });
        });
    </script>
</x-app-layout>