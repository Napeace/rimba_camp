@extends('pengunjung.layouts.app')

@section('title', 'Reservasi Cottage ' . $cottage->nomor . ' - RimbaCamp')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-green-600 to-emerald-700 text-white pt-32 pb-16">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="relative container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 animate-fade-in">
                    Reservasi Cottage {{ $cottage->nomor }}
                </h1>
                <p class="text-xl opacity-90 animate-slide-up">
                    Lengkapi form di bawah untuk memesan cottage impian Anda
                </p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden sticky top-8 animate-slide-in-left">
                    <div
                        class="relative h-48 bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center">
                        <div class="text-white text-center">
                            <svg class="w-16 h-16 mx-auto mb-2 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            <span class="text-lg font-semibold">{{ $cottage->nomor }}</span>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Cottage {{ $cottage->nomor }}</h3>

                        <div class="space-y-4 mb-6">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM5 8a2 2 0 11-4 0 2 2 0 014 0zM19 8a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>Kapasitas: <strong>{{ $cottage->kapasitas }} Orang</strong></span>
                            </div>

                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" />
                                </svg>
                                <span>Harga: <strong class="text-green-600">Rp
                                        {{ number_format($cottage->harga_per_malam, 0, ',', '.') }}</strong> / malam</span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 mb-2">Fasilitas:</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach (explode(',', $cottage->fasilitas) as $fasilitas)
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ trim($fasilitas) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-800 mb-2">Ringkasan Harga:</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span>Harga per malam:</span>
                                    <span class="font-medium">Rp
                                        {{ number_format($cottage->harga_per_malam, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Jumlah malam:</span>
                                    <span class="font-medium" id="totalNights">0</span>
                                </div>
                                <hr class="my-2">
                                <div class="flex justify-between text-lg font-bold text-green-600">
                                    <span>Total:</span>
                                    <span id="totalPrice">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-8 animate-slide-in-right">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Form Reservasi</h2>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 animate-shake">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('cottage.storeReservation') }}" method="POST" enctype="multipart/form-data"
                        id="reservationForm">
                        @csrf
                        <input type="hidden" name="cottage_id" value="{{ $cottage->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="tanggal_checkin" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Check-in <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal_checkin" id="tanggal_checkin"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                    value="{{ old('tanggal_checkin') }}" min="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_checkout" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Check-out <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal_checkout" id="tanggal_checkout"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                    value="{{ old('tanggal_checkout') }}" required>
                            </div>
                        </div>

                        <div class="form-group mt-6">
                            <label for="jumlah_tamu" class="block text-sm font-medium text-gray-700 mb-2">
                                Jumlah Tamu <span class="text-red-500">*</span>
                            </label>
                            <select name="jumlah_tamu" id="jumlah_tamu"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                required>
                                <option value="">Pilih jumlah tamu</option>
                                @for ($i = 1; $i <= $cottage->kapasitas; $i++)
                                    <option value="{{ $i }}" {{ old('jumlah_tamu') == $i ? 'selected' : '' }}>
                                        {{ $i }} {{ $i == 1 ? 'Orang' : 'Orang' }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group mt-6">
                            <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">
                                Bukti Pembayaran <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="hidden"
                                    accept="image/jpeg,image/png,image/jpg" required>
                                <div class="upload-area border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-green-500 transition-colors duration-200"
                                    onclick="document.getElementById('bukti_pembayaran').click()">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <p class="text-gray-600 mb-2">Klik untuk upload bukti pembayaran</p>
                                    <p class="text-sm text-gray-500">Format: JPG, JPEG, PNG (Max: 2MB)</p>
                                </div>
                                <div id="file-preview" class="mt-4 hidden">
                                    <div
                                        class="flex items-center justify-between bg-green-50 border border-green-200 rounded-lg p-3">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                                            </svg>
                                            <span class="text-sm text-green-800" id="file-name"></span>
                                        </div>
                                        <button type="button" onclick="removeFile()"
                                            class="text-red-500 hover:text-red-700">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-6">
                            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">
                                Catatan (Opsional)
                            </label>
                            <textarea name="catatan" id="catatan" rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                placeholder="Tambahkan catatan khusus untuk reservasi Anda...">{{ old('catatan') }}</textarea>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-6">
                            <h4 class="font-semibold text-blue-800 mb-2">Informasi Pembayaran:</h4>
                            <p class="text-sm text-blue-700 mb-2">
                                Silakan transfer ke rekening berikut:
                            </p>
                            <div class="bg-white rounded p-3 text-sm">
                                <p><strong>Bank BCA:</strong> 1234567890</p>
                                <p><strong>Atas Nama:</strong> RimbaCamp</p>
                                <p class="text-red-600 font-medium mt-2">
                                    Total yang harus dibayar: <span id="paymentAmount">Rp 0</span>
                                </p>
                            </div>
                        </div>


                        <div class="mt-8 flex gap-4">
                            <a href="{{ route('cottage.index') }}"
                                class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 text-center py-4 px-6 rounded-lg font-medium transition-colors duration-200">
                                Kembali
                            </a>
                            <button type="submit" id="submitBtn"
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white py-4 px-6 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2 hidden" id="loading-spinner" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                        </path>
                                    </svg>
                                    <span id="submit-text">Buat Reservasi</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Animations */
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-in-left {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slide-in-right {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }

        .animate-slide-up {
            animation: slide-up 1s ease-out 0.3s both;
        }

        .animate-slide-in-left {
            animation: slide-in-left 0.8s ease-out;
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.8s ease-out 0.2s both;
        }

        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }

        .form-group {
            opacity: 0;
            animation: slide-up 0.6s ease-out forwards;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.1s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.2s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.3s;
        }

        .form-group:nth-child(4) {
            animation-delay: 0.4s;
        }

        .form-group:nth-child(5) {
            animation-delay: 0.5s;
        }

        .upload-area.dragover {
            border-color: #10b981;
            background-color: #f0fdf4;
        }

        #loading-spinner.spin {
            animation: spin 1s linear infinite;
        }

        /* Enhanced hover effects */
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkinInput = document.getElementById('tanggal_checkin');
            const checkoutInput = document.getElementById('tanggal_checkout');
            const fileInput = document.getElementById('bukti_pembayaran');
            const uploadArea = document.querySelector('.upload-area');
            const filePreview = document.getElementById('file-preview');
            const fileName = document.getElementById('file-name');
            const form = document.getElementById('reservationForm');
            const submitBtn = document.getElementById('submitBtn');
            const loadingSpinner = document.getElementById('loading-spinner');
            const submitText = document.getElementById('submit-text');

            const cottagePrice = {{ $cottage->harga_per_malam }};

            // Calculate total price
            function calculateTotal() {
                const checkin = new Date(checkinInput.value);
                const checkout = new Date(checkoutInput.value);

                if (checkin && checkout && checkout > checkin) {
                    const diffTime = Math.abs(checkout - checkin);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    const totalPrice = diffDays * cottagePrice;

                    document.getElementById('totalNights').textContent = diffDays + ' malam';
                    document.getElementById('totalPrice').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
                    document.getElementById('paymentAmount').textContent = 'Rp ' + totalPrice.toLocaleString(
                        'id-ID');
                } else {
                    document.getElementById('totalNights').textContent = '0';
                    document.getElementById('totalPrice').textContent = 'Rp 0';
                    document.getElementById('paymentAmount').textContent = 'Rp 0';
                }
            }

            // Set minimum checkout date
            function setMinCheckout() {
                if (checkinInput.value) {
                    const checkinDate = new Date(checkinInput.value);
                    const nextDay = new Date(checkinDate);
                    nextDay.setDate(checkinDate.getDate() + 1);
                    checkoutInput.min = nextDay.toISOString().split('T')[0];

                    if (checkoutInput.value && new Date(checkoutInput.value) <= checkinDate) {
                        checkoutInput.value = '';
                    }
                }
            }

            // Event listeners for date inputs
            checkinInput.addEventListener('change', function() {
                setMinCheckout();
                calculateTotal();

                // Add animation effect
                this.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 200);
            });

            checkoutInput.addEventListener('change', function() {
                calculateTotal();

                // Add animation effect
                this.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 200);
            });

            // File upload handling
            // Move event listeners outside of click event to fix upload issue
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    handleFileSelect(files[0]);
                }
            });

            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    handleFileSelect(this.files[0]);
                }
            });

            uploadArea.addEventListener('click', function() {
                // Clear the file input value to allow re-selecting the same file
                fileInput.value = '';
                fileInput.click();
            });

            function handleFileSelect(file) {
                // Check file type
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, JPEG, atau PNG.');
                    return;
                }

                // Check file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    return;
                }

                fileName.textContent = file.name;
                filePreview.classList.remove('hidden');
                uploadArea.style.display = 'none';

                // Add success animation
                filePreview.style.transform = 'scale(0.8)';
                filePreview.style.opacity = '0';
                setTimeout(() => {
                    filePreview.style.transform = 'scale(1)';
                    filePreview.style.opacity = '1';
                    filePreview.style.transition = 'all 0.3s ease';
                }, 100);
            }

            // Remove file function
            window.removeFile = function() {
                fileInput.value = '';
                filePreview.classList.add('hidden');
                uploadArea.style.display = 'block';
            };

            // Form submission
            form.addEventListener('submit', function(e) {
                submitBtn.disabled = true;
                loadingSpinner.classList.remove('hidden');
                loadingSpinner.classList.add('spin');
                submitText.textContent = 'Memproses...';

                // Re-enable if there's an error (page doesn't redirect)
                setTimeout(() => {
                    submitBtn.disabled = false;
                    loadingSpinner.classList.add('hidden');
                    loadingSpinner.classList.remove('spin');
                    submitText.textContent = 'Buat Reservasi';
                }, 5000);
            });

            // Add smooth scroll to form if there are errors
            @if ($errors->any())
                setTimeout(() => {
                    document.querySelector('.bg-red-100').scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 500);
            @endif

            // Initialize
            setMinCheckout();
            calculateTotal();
        });
    </script>
@endsection
