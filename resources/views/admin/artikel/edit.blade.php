@extends('admin.layouts.app')

@section('title', 'Edit Artikel - Rimba Camp')

@section('body-class', 'bg-gray-50')

@section('content')
<div class="min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-4xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.artikel.show', $artikel) }}"
                       class="text-gray-600 hover:text-gray-900 transition duration-200">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Edit Artikel</h1>
                </div>
                <div class="text-sm text-gray-500">
                    <span>Terakhir diperbarui: {{ $artikel->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 py-6">
        <form action="{{ route('admin.artikel.update', $artikel) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                               value="{{ old('judul', $artikel->judul) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('judul') border-red-500 @enderror"
                               placeholder="Masukkan judul artikel..."
                               required>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Slug akan otomatis diperbarui: <span id="slug-preview" class="font-mono">{{ $artikel->slug }}</span></p>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-6">
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar Artikel
                        </label>

                        <!-- Current Image -->
                        @if($artikel->gambar)
                            <div class="mb-4" id="current-image">
                                <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                                <div class="relative inline-block">
                                    <img src="{{ Storage::url($artikel->gambar) }}"
                                        alt="{{ $artikel->judul }}"
                                        class="h-32 w-auto rounded-lg border">
                                    <button type="button"
                                            id="remove-current-image"
                                            class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <!-- Upload New Image -->
                        <div class="mt-2 relative" id="upload-zone">
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
                                            Hapus gambar baru
                                        </button>
                                    </div>
                                    <div id="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-3"></i>
                                        <div class="text-sm text-gray-600">
                                            <span class="font-medium text-blue-600">{{ $artikel->gambar ? 'Ganti gambar' : 'Upload gambar' }}</span>
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
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-y @error('isi') border-red-500 @enderror"
                                  placeholder="Tulis isi artikel di sini..."
                                  required>{{ old('isi', $artikel->isi) }}</textarea>
                        @error('isi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.artikel.show', $artikel) }}"
                               class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                                <i class="fas fa-times"></i>
                                Batal
                            </a>
                            <a href="{{ route('admin.artikel.index') }}"
                               class="text-gray-600 hover:text-gray-800 px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                                <i class="fas fa-list"></i>
                                Ke Daftar
                            </a>
                        </div>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                            <i class="fas fa-save"></i>
                            Perbarui Artikel
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Preview Card -->
        <div class="mt-6 bg-white rounded-lg shadow-sm border p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Preview Perubahan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Data Saat Ini</h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm"><strong>Judul:</strong> {{ $artikel->judul }}</p>
                        <p class="text-sm"><strong>Slug:</strong> {{ $artikel->slug }}</p>
                        <p class="text-sm"><strong>Gambar:</strong> {{ $artikel->gambar ? 'Ada' : 'Tidak ada' }}</p>
                        <p class="text-sm"><strong>Words:</strong> {{ str_word_count(strip_tags($artikel->isi)) }}</p>
                    </div>
                </div>
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Tips Edit</h4>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li><i class="fas fa-lightbulb mr-2"></i>Slug akan otomatis diperbarui jika judul berubah</li>
                            <li><i class="fas fa-image mr-2"></i>Upload gambar baru akan mengganti yang lama</li>
                            <li><i class="fas fa-save mr-2"></i>Jangan lupa simpan perubahan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Slug Preview
document.getElementById('judul').addEventListener('input', function(e) {
    const judul = e.target.value;
    const slug = judul.toLowerCase()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '');
    document.getElementById('slug-preview').textContent = slug || '{{ $artikel->slug }}';
});

// Form submission handler
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitButton = document.querySelector('button[type="submit"]');

    if (form && submitButton) {
        form.addEventListener('submit', function(e) {
            // Disable submit button to prevent double submission
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memperbarui...';

            // Basic validation
            const judul = document.getElementById('judul').value.trim();
            const isi = document.getElementById('isi').value.trim();

            if (!judul) {
                e.preventDefault();
                alert('Judul artikel harus diisi!');
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="fas fa-save"></i> Perbarui Artikel';
                return false;
            }

            if (!isi) {
                e.preventDefault();
                alert('Isi artikel harus diisi!');
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="fas fa-save"></i> Perbarui Artikel';
                return false;
            }
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

// Remove New Image
document.getElementById('remove-image').addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    document.getElementById('gambar').value = '';
    document.querySelector('.preview-container').classList.add('hidden');
    document.getElementById('upload-placeholder').classList.remove('hidden');
});

// Remove Current Image
@if($artikel->gambar)
document.getElementById('remove-current-image').addEventListener('click', function() {
    if (confirm('Hapus gambar saat ini? Gambar akan dihapus setelah artikel disimpan.')) {
        document.getElementById('current-image').style.display = 'none';
        // Add hidden input to indicate image should be removed
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'remove_image';
        input.value = '1';
        document.querySelector('form').appendChild(input);
    }
});
@endif

// Drag and Drop
const dropZone = document.getElementById('upload-zone');

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

console.log('Edit artikel form scripts loaded successfully');
</script>
@endpush
