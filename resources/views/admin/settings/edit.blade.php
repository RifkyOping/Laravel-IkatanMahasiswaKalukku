<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-black leading-tight text-imk-600 sm:text-3xl">Pengaturan Beranda</h2>
            <p class="mt-1 text-sm text-gray-600">Atur informasi kontak, media sosial, dan foto pengurus di website</p>
        </div>
    </x-slot>

    @php
        // Foto & nama pengurus. Kunci di sini menentukan id/name field
        // (mis. ketua_photo, ketua_photo_cropped, ketua_photo_preview, ketua_name)
        // sehingga harus sama dengan yang dipakai controller dan skrip Cropper.
        $photoFields = [
            ['key' => 'ketua', 'label' => 'Ketua Umum', 'default' => 'image/pengurus/ketua.jpeg'],
            ['key' => 'sekretaris', 'label' => 'Sekretaris Umum', 'default' => 'image/pengurus/sekretaris.jpg'],
            ['key' => 'bendahara', 'label' => 'Bendahara Umum', 'default' => 'image/pengurus/bendahara.jpeg'],
        ];

        // Field kontak & media sosial dirender lewat loop supaya markup toggle
        // "Tampilkan" tidak perlu diduplikasi tujuh kali.
        $contactFields = [
            [
                'name' => 'address',
                'label' => 'Alamat Sekretariat',
                'type' => 'textarea',
                'toggle' => 'show_address',
                'hint' => 'Gunakan <br> untuk membuat baris baru.',
            ],
            ['name' => 'email', 'label' => 'Alamat Email', 'type' => 'email', 'toggle' => 'show_email'],
            ['name' => 'phone', 'label' => 'Nomor Telepon', 'type' => 'text', 'toggle' => 'show_phone'],
        ];

        $socialFields = [
            [
                'name' => 'instagram',
                'label' => 'Link Instagram',
                'type' => 'url',
                'toggle' => 'show_instagram',
                'placeholder' => 'https://instagram.com/...',
            ],
            [
                'name' => 'facebook',
                'label' => 'Link Facebook',
                'type' => 'url',
                'toggle' => 'show_facebook',
                'placeholder' => 'https://facebook.com/...',
            ],
            [
                'name' => 'whatsapp',
                'label' => 'Link WhatsApp',
                'type' => 'url',
                'toggle' => 'show_whatsapp',
                'placeholder' => 'https://wa.me/...',
            ],
            [
                'name' => 'youtube',
                'label' => 'Link YouTube',
                'type' => 'url',
                'toggle' => 'show_youtube',
                'placeholder' => 'https://youtube.com/...',
            ],
        ];

        $inputClasses =
            'block w-full rounded-xl border-gray-300 bg-white p-3 text-sm text-gray-800 shadow-sm transition focus:border-imk-500 focus:ring-imk-300';
    @endphp

    <div class="py-8">
        <div class="mx-auto max-w-4xl space-y-6 px-4 sm:px-6 lg:px-8">

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

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3">
                    <p class="text-sm font-bold text-red-800">Ada isian yang perlu diperbaiki:</p>
                    <ul class="mt-1.5 list-inside list-disc space-y-0.5 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Pengaturan umum --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-7">
                    <h3 class="text-base font-bold text-imk-600">Pengaturan Umum</h3>
                    <p class="mt-1 text-sm text-gray-600">Teks periode kepengurusan yang tampil di bagan struktur.</p>

                    <div class="mt-5">
                        <label for="org_period" class="mb-1.5 block text-sm font-bold text-gray-800">Periode
                            Kepengurusan</label>
                        <input type="text" name="org_period" id="org_period"
                            value="{{ old('org_period', $setting->org_period) }}" placeholder="Contoh: Periode 2025/2026"
                            class="{{ $inputClasses }}">
                        @error('org_period')
                            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Foto pengurus --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-7">
                    <h3 class="text-base font-bold text-imk-600">Foto &amp; Nama Pengurus Inti</h3>
                    <p class="mt-1 text-sm text-gray-600">Setelah memilih foto, jendela pemotongan akan terbuka agar
                        proporsinya pas.</p>

                    <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($photoFields as $photo)
                            @php
                                $photoName = $photo['key'] . '_photo';
                                $nameField = $photo['key'] . '_name';
                                $storedPhoto = $setting->{$photoName};
                            @endphp

                            <div class="rounded-xl border border-gray-100 bg-gray-50/60 p-4">
                                <p class="text-sm font-bold text-gray-800">{{ $photo['label'] }}</p>

                                <img src="{{ $storedPhoto ? asset('storage/' . $storedPhoto) : asset($photo['default']) }}"
                                    alt="Foto {{ $photo['label'] }}" id="{{ $photoName }}_preview"
                                    class="mt-3 aspect-[3/4] w-full rounded-xl object-cover {{ $storedPhoto ? '' : 'opacity-50' }}">

                                @unless ($storedPhoto)
                                    <p class="mt-1.5 text-xs text-gray-600">Masih memakai foto bawaan.</p>
                                @endunless

                                <input type="hidden" name="{{ $photoName }}_cropped"
                                    id="{{ $photoName }}_cropped">

                                <input type="file" name="{{ $photoName }}" id="{{ $photoName }}"
                                    accept="image/*"
                                    class="mt-3 block w-full text-xs text-gray-600 file:mr-3 file:rounded-full file:border-0 file:bg-imk-50 file:px-3 file:py-2 file:text-xs file:font-bold file:text-imk-600 hover:file:bg-imk-100">
                                @error($photoName)
                                    <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                                @enderror

                                <label for="{{ $nameField }}"
                                    class="mb-1.5 mt-4 block text-xs font-bold uppercase tracking-wider text-gray-600">Nama</label>
                                <input type="text" name="{{ $nameField }}" id="{{ $nameField }}"
                                    value="{{ old($nameField, $setting->{$nameField}) }}"
                                    placeholder="Nama {{ $photo['label'] }}" class="{{ $inputClasses }}">
                                @error($nameField)
                                    <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Kontak & media sosial --}}
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    @foreach ([['Informasi Kontak', 'Ditampilkan di bagian kontak dan footer.', $contactFields], ['Tautan Media Sosial', 'Ikon sosial hanya muncul jika tautannya diaktifkan.', $socialFields]] as [$sectionTitle, $sectionHint, $fields])
                        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-7">
                            <h3 class="text-base font-bold text-imk-600">{{ $sectionTitle }}</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $sectionHint }}</p>

                            <div class="mt-5 space-y-5">
                                @foreach ($fields as $field)
                                    @php
                                        $isChecked = old($field['toggle'], $setting->{$field['toggle']} ?? true);
                                    @endphp

                                    <div>
                                        <div class="mb-1.5 flex flex-wrap items-center justify-between gap-2">
                                            <label for="{{ $field['name'] }}"
                                                class="text-sm font-bold text-gray-800">{{ $field['label'] }}</label>

                                            <label class="relative inline-flex cursor-pointer items-center">
                                                <span class="sr-only">Tampilkan {{ $field['label'] }}</span>
                                                <input type="checkbox" name="{{ $field['toggle'] }}" value="1"
                                                    {{ $isChecked ? 'checked' : '' }} class="peer sr-only">
                                                <div
                                                    class="peer h-5 w-9 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-4 after:w-4 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-imk-500 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-imk-300">
                                                </div>
                                                <span
                                                    class="ms-2 text-xs font-bold text-gray-600">Tampilkan</span>
                                            </label>
                                        </div>

                                        @if ($field['type'] === 'textarea')
                                            <textarea name="{{ $field['name'] }}" id="{{ $field['name'] }}" rows="3"
                                                class="{{ $inputClasses }}">{{ old($field['name'], $setting->{$field['name']}) }}</textarea>
                                        @else
                                            <input type="{{ $field['type'] }}" name="{{ $field['name'] }}"
                                                id="{{ $field['name'] }}"
                                                value="{{ old($field['name'], $setting->{$field['name']}) }}"
                                                placeholder="{{ $field['placeholder'] ?? '' }}"
                                                class="{{ $inputClasses }}">
                                        @endif

                                        @if (!empty($field['hint']))
                                            <p class="mt-1 text-xs text-gray-600">{{ $field['hint'] }}</p>
                                        @endif

                                        @error($field['name'])
                                            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Simpan --}}
                <div
                    class="flex flex-col-reverse gap-3 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:p-6">
                    <p class="text-xs text-gray-600">Perubahan langsung berlaku di halaman publik setelah disimpan.</p>
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-imk-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-imk-500 focus:outline-none focus:ring-2 focus:ring-imk-400 focus:ring-offset-2 sm:w-auto">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal pemotongan foto --}}
    <div id="cropModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-black/80 p-3 sm:p-4"
        role="dialog" aria-modal="true" aria-labelledby="cropModalTitle">
        <div class="flex max-h-[92vh] w-full max-w-2xl flex-col overflow-hidden rounded-2xl bg-white shadow-2xl">
            <div class="flex items-center justify-between gap-3 border-b border-gray-100 bg-gray-50 px-4 py-4 sm:px-6">
                <h3 id="cropModalTitle" class="text-base font-bold text-imk-600 sm:text-lg">Sesuaikan Foto</h3>
                <button type="button" id="closeCropModal" aria-label="Tutup"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-gray-600 transition hover:bg-gray-200 hover:text-red-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div
                class="relative flex min-h-[240px] flex-grow items-center justify-center overflow-hidden bg-gray-900 p-3 sm:min-h-[360px] sm:p-6">
                <img id="cropImage" src="" alt="Pratinjau pemotongan"
                    class="max-h-[50vh] max-w-full object-contain sm:max-h-[60vh]">
            </div>

            <div
                class="flex flex-col-reverse gap-2 border-t border-gray-100 bg-gray-50 px-4 py-4 sm:flex-row sm:justify-end sm:px-6">
                <button type="button" id="cancelCrop"
                    class="rounded-xl bg-white px-5 py-2.5 text-sm font-bold text-gray-800 ring-1 ring-gray-200 transition hover:bg-gray-100">Batal</button>
                <button type="button" id="saveCrop"
                    class="rounded-xl bg-imk-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-imk-500">Potong
                    &amp; Gunakan</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let cropper = null;
            let currentInputId = null;

            const cropModal = document.getElementById('cropModal');
            const cropImage = document.getElementById('cropImage');
            const saveCropBtn = document.getElementById('saveCrop');
            const cancelCropBtn = document.getElementById('cancelCrop');
            const closeCropModalBtn = document.getElementById('closeCropModal');

            const photoInputs = ['ketua_photo', 'sekretaris_photo', 'bendahara_photo'];

            photoInputs.forEach(inputId => {
                const inputEl = document.getElementById(inputId);
                if (!inputEl) return;

                inputEl.addEventListener('change', function (e) {
                    const files = e.target.files;
                    if (!files || files.length === 0) return;

                    const reader = new FileReader();
                    reader.onload = function (event) {
                        cropImage.src = event.target.result;
                        currentInputId = inputId;
                        cropModal.classList.remove('hidden');

                        if (cropper) {
                            cropper.destroy();
                        }

                        const ratio = inputId === 'ketua_photo' ? 340 / 460 : 72 / 96;

                        cropper = new Cropper(cropImage, {
                            aspectRatio: ratio,
                            viewMode: 1,
                            autoCropArea: 1,
                            responsive: true,
                            background: false,
                        });
                    };
                    reader.readAsDataURL(files[0]);
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

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && !cropModal.classList.contains('hidden')) {
                    hideModal();
                }
            });

            saveCropBtn.addEventListener('click', function () {
                if (!cropper || !currentInputId) return;

                const canvas = cropper.getCroppedCanvas({
                    width: currentInputId === 'ketua_photo' ? 680 : 576,
                    height: currentInputId === 'ketua_photo' ? 920 : 768,
                });

                if (!canvas) return;

                const base64Image = canvas.toDataURL('image/jpeg', 0.9);
                document.getElementById(currentInputId + '_cropped').value = base64Image;

                const previewImage = document.getElementById(currentInputId + '_preview');
                previewImage.src = base64Image;
                previewImage.classList.remove('opacity-50');

                cropModal.classList.add('hidden');
                cropper.destroy();
                cropper = null;
            });
        });
    </script>
</x-app-layout>
