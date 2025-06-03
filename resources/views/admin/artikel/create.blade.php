@extends('admin.layouts.app')

@section('title', 'Tambah Artikel - Rimba Camp')

@section('body-class', 'bg-gray-50')

@push('styles')
<meta name="referrer" content="origin">
<script src="https://cdn.tiny.cloud/1/csopzeiw6d1sm30gdxeha7uo1q0iirqnunhtbrzq2ju82x8m/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endpush

@section('content')
<div class="min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-4xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.artikel.index') }}"
                       class="text-gray-600 hover:text-gray-900 transition duration-200">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Tambah Artikel Baru</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 py-6">
        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="bg-white rounded-lg shadow-sm border">
                <div class="p-6">
                    <!-- Judul -->
                    <div class="mb-6">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Artikel <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="judul"
                               name="judul"
                               value="{{ old('judul') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('judul') border-red-500 @enderror"
                               placeholder="Masukkan judul artikel..."
                               required>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div class="mb-6">
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar Artikel
                        </label>
                        <div class="mt-2 relative">
                            <!-- Input file yang tersembunyi -->
                            <input id="gambar"
                                name="gambar"
                                type="file"
                                accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                            <!-- Area upload yang bisa diklik -->
                            <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 hover:bg-gray-50 transition duration-200 cursor-pointer">
                                <div class="space-y-1 text-center">
                                    <div class="preview-container hidden">
                                        <img id="image-preview" class="mx-auto h-32 w-auto rounded-lg" alt="Preview">
                                        <button type="button"
                                                id="remove-image"
                                                class="mt-2 text-sm text-red-600 hover:text-red-800 relative z-20">
                                            Hapus gambar
                                        </button>
                                    </div>
                                    <div id="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-3"></i>
                                        <div class="text-sm text-gray-600">
                                            <span class="font-medium text-blue-600">Upload gambar</span>
                                            <span class="pl-1">atau drag and drop</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Isi Artikel -->
                    <div class="mb-6">
                        <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                            Isi Artikel <span class="text-red-500">*</span>
                        </label>
                        <textarea id="isi"
                                  name="isi"
                                  rows="15"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('isi') border-red-500 @enderror"
                                  placeholder="Tulis isi artikel di sini..."
                                  required>{{ old('isi') }}</textarea>
                        @error('isi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-lg">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.artikel.index') }}"
                           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                            <i class="fas fa-save"></i>
                            Simpan Artikel
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// TinyMCE Editor
tinymce.init({
    selector: '#isi',
    height: 400,
    menubar: false,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
});

// Form submission handler
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitButton = document.querySelector('button[type="submit"]');

    if (form && submitButton) {
        form.addEventListener('submit', function(e) {
            // Sync TinyMCE content
            if (tinymce.get('isi')) {
                tinymce.get('isi').save();
            }

            // Disable submit button to prevent double submission
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

            // Basic validation
            const judul = document.getElementById('judul').value.trim();
            const isi = tinymce.get('isi') ? tinymce.get('isi').getContent() : document.getElementById('isi').value;

            if (!judul) {
                e.preventDefault();
                alert('Judul artikel harus diisi!');
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="fas fa-save"></i> Simpan Artikel';
                return false;
            }

            if (!isi || isi.trim() === '') {
                e.preventDefault();
                alert('Isi artikel harus diisi!');
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="fas fa-save"></i> Simpan Artikel';
                return false;
            }

            console.log('Form akan disubmit dengan data:', {
                judul: judul,
                isi: isi.substring(0, 100) + '...'
            });
        });
    }
});

// Image Preview
document.getElementById('gambar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validate file size (2MB = 2048KB)
        if (file.size > 2048 * 1024) {
            alert('Ukuran gambar terlalu besar! Maksimal 2MB.');
            this.value = '';
            return;
        }

        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            alert('Format gambar tidak didukung! Gunakan JPEG, PNG, JPG, atau GIF.');
            this.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
            document.querySelector('.preview-container').classList.remove('hidden');
            document.getElementById('upload-placeholder').classList.add('hidden');
        }
        reader.readAsDataURL(file);
    }
});

// Remove Image
document.getElementById('remove-image').addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    document.getElementById('gambar').value = '';
    document.querySelector('.preview-container').classList.add('hidden');
    document.getElementById('upload-placeholder').classList.remove('hidden');
});

// Drag and Drop
const dropZone = document.querySelector('.border-dashed');

if (dropZone) {
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.classList.add('border-blue-500', 'bg-blue-50');
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-blue-500', 'bg-blue-50');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const fileInput = document.getElementById('gambar');
            fileInput.files = files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });
}

// Debug: Log semua event handler
console.log('Artikel form scripts loaded successfully');
</script>
@endpush
