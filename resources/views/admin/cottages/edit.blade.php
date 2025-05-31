@extends('admin.layouts.app')

@section('title', 'Edit Cottage - Rimba Camp')
@section('body-class', 'bg-gray-100')

@section('content')
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <i class="fas fa-tree text-green-600 text-2xl mr-3"></i>
                    <h1 class="text-xl font-bold text-gray-800">Rimba Camp Admin</h1>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.cottages.index') }}" class="text-gray-600 hover:text-gray-800 transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="max-w-4xl mx-auto py-8 px-4">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Edit Cottage {{ $cottage->nomor }}</h2>
            <p class="text-gray-600">Ubah informasi cottage di bawah ini</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.cottages.update', $cottage) }}" method="POST" id="cottageForm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nomor Cottage -->
                    <div>
                        <label for="nomor" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nomor Cottage <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="nomor"
                               name="nomor"
                               value="{{ old('nomor', $cottage->nomor) }}"
                               placeholder="Contoh: C001"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nomor') border-red-500 @enderror">
                        @error('nomor')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kapasitas -->
                    <div>
                        <label for="kapasitas" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kapasitas (orang) <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                               id="kapasitas"
                               name="kapasitas"
                               value="{{ old('kapasitas', $cottage->kapasitas) }}"
                               min="1"
                               max="20"
                               placeholder="Jumlah orang"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kapasitas') border-red-500 @enderror">
                        @error('kapasitas')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Harga Per Malam -->
                <div class="mt-6">
                    <label for="harga_per_malam" class="block text-sm font-semibold text-gray-700 mb-2">
                        Harga Per Malam (Rp) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-500">Rp</span>
                        <input type="number"
                               id="harga_per_malam"
                               name="harga_per_malam"
                               value="{{ old('harga_per_malam', $cottage->harga_per_malam) }}"
                               min="50000"
                               max="2000000"
                               step="1000"
                               placeholder="350000"
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('harga_per_malam') border-red-500 @enderror">
                    </div>
                    @error('harga_per_malam')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Minimal Rp 50.000, Maksimal Rp 2.000.000</p>
                </div>

                <!-- Fasilitas -->
                <div class="mt-6">
                    <label for="fasilitas" class="block text-sm font-semibold text-gray-700 mb-2">
                        Fasilitas <span class="text-red-500">*</span>
                    </label>
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-3">Pilih fasilitas yang tersedia (opsional):</p>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3" id="facilitiesCheckboxes">
                            @php
                                $existingFacilities = explode(', ', old('fasilitas', $cottage->fasilitas));
                                $availableFacilities = ['AC', 'TV', 'Kamar Mandi Dalam', 'Teras', 'Wifi', 'Lemari Es', 'Dapur Kecil', 'Dapur Lengkap', 'Ruang Tamu', 'BBQ Area'];
                            @endphp

                            @foreach($availableFacilities as $facility)
                            <label class="flex items-center">
                                <input type="checkbox"
                                       class="facility-checkbox mr-2"
                                       value="{{ $facility }}"
                                       {{ in_array($facility, $existingFacilities) ? 'checked' : '' }}>
                                <span class="text-sm">{{ $facility }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <textarea id="fasilitas"
                              name="fasilitas"
                              rows="4"
                              placeholder="Masukkan fasilitas cottage, pisahkan dengan koma. Contoh: AC, TV, Kamar Mandi Dalam, Teras, Wifi"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('fasilitas') border-red-500 @enderror">{{ old('fasilitas', $cottage->fasilitas) }}</textarea>
                    @error('fasilitas')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Pisahkan setiap fasilitas dengan koma (,)</p>
                </div>

                <!-- Preview Card -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Preview Cottage</h3>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6" id="previewCard">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-home text-blue-600 text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-gray-800" id="previewNomor">{{ $cottage->nomor }}</h4>
                                    <p class="text-gray-600" id="previewKapasitas">{{ $cottage->kapasitas }} orang</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-green-600" id="previewHarga">{{ $cottage->formatted_price }}</p>
                                <p class="text-sm text-gray-500">per malam</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h5 class="font-semibold text-gray-700 mb-2">Fasilitas:</h5>
                            <div id="previewFasilitas" class="text-gray-600">
                                @if($cottage->fasilitas)
                                    @foreach(explode(', ', $cottage->fasilitas) as $fasilitas)
                                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ $fasilitas }}</span>
                                    @endforeach
                                @else
                                    <em>Belum ada fasilitas</em>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 mt-8">
                    <a href="{{ route('admin.cottages.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-200">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-200">
                        <i class="fas fa-save mr-2"></i>Update Cottage
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Update preview card
        function updatePreview() {
            const nomor = document.getElementById('nomor').value || '-';
            const kapasitas = document.getElementById('kapasitas').value || '-';
            const harga = document.getElementById('harga_per_malam').value;
            const fasilitas = document.getElementById('fasilitas').value;

            document.getElementById('previewNomor').textContent = nomor;
            document.getElementById('previewKapasitas').textContent = kapasitas + ' orang';

            if (harga) {
                const formattedHarga = new Intl.NumberFormat('id-ID').format(harga);
                document.getElementById('previewHarga').textContent = 'Rp ' + formattedHarga;
            } else {
                document.getElementById('previewHarga').textContent = 'Rp -';
            }

            const fasilitasDiv = document.getElementById('previewFasilitas');
            if (fasilitas.trim()) {
                const fasilitasList = fasilitas.split(',').map(f => f.trim()).filter(f => f);
                fasilitasDiv.innerHTML = fasilitasList.map(f =>
                    `<span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1 mb-1">${f}</span>`
                ).join('');
            } else {
                fasilitasDiv.innerHTML = '<em>Belum ada fasilitas</em>';
            }
        }

        // Update checkboxes based on textarea content
        function updateCheckboxesFromTextarea() {
            const facilitiesText = document.getElementById('fasilitas').value;
            const facilitiesArray = facilitiesText ? facilitiesText.split(',').map(f => f.trim()).filter(f => f) : [];

            // Update checkboxes based on textarea content
            document.querySelectorAll('.facility-checkbox').forEach(checkbox => {
                checkbox.checked = facilitiesArray.includes(checkbox.value);
            });
        }

        // Update facilities textarea when checkboxes change
        function updateFacilitiesText() {
            const checkboxes = document.querySelectorAll('.facility-checkbox:checked');
            const selectedFromCheckboxes = Array.from(checkboxes).map(cb => cb.value);
            const currentText = document.getElementById('fasilitas').value;

            // Parse existing facilities from textarea
            const existingFacilities = currentText ? currentText.split(',').map(f => f.trim()).filter(f => f) : [];

            // Get predefined facilities that might be in checkboxes
            const predefinedFacilities = ['AC', 'TV', 'Kamar Mandi Dalam', 'Teras', 'Wifi', 'Lemari Es', 'Dapur Kecil', 'Dapur Lengkap', 'Ruang Tamu', 'BBQ Area'];

            // Separate custom facilities (not in predefined list) from existing facilities
            const customFacilities = existingFacilities.filter(facility => !predefinedFacilities.includes(facility));

            // Combine selected checkboxes with custom facilities
            const allFacilities = [...selectedFromCheckboxes, ...customFacilities].filter(f => f);

            document.getElementById('fasilitas').value = allFacilities.join(', ');
            updatePreview();
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize checkboxes based on existing textarea content
            updateCheckboxesFromTextarea();

            // Update preview on input changes
            ['nomor', 'kapasitas', 'harga_per_malam', 'fasilitas'].forEach(id => {
                document.getElementById(id).addEventListener('input', updatePreview);
            });

            // Update facilities when checkboxes change
            document.querySelectorAll('.facility-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', updateFacilitiesText);
            });

            // Update checkboxes when textarea is manually edited
            document.getElementById('fasilitas').addEventListener('input', function() {
                updateCheckboxesFromTextarea();
                updatePreview();
            });

            // Initial preview update
            updatePreview();

            // Format number input
            document.getElementById('harga_per_malam').addEventListener('input', function(e) {
                const value = e.target.value.replace(/\D/g, '');
                e.target.value = value;
            });
        });

        // Form validation
        document.getElementById('cottageForm').addEventListener('submit', function(e) {
            const nomor = document.getElementById('nomor').value.trim();
            const kapasitas = document.getElementById('kapasitas').value;
            const harga = document.getElementById('harga_per_malam').value;
            const fasilitas = document.getElementById('fasilitas').value.trim();

            if (!nomor || !kapasitas || !harga || !fasilitas) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi!');
                return false;
            }

            if (kapasitas < 1 || kapasitas > 20) {
                e.preventDefault();
                alert('Kapasitas harus antara 1-20 orang!');
                return false;
            }

            if (harga < 50000 || harga > 2000000) {
                e.preventDefault();
                alert('Harga harus antara Rp 50.000 - Rp 2.000.000!');
                return false;
            }
        });
    </script>
</body>
@endsection
