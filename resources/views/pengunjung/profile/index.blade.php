@extends('pengunjung.layouts.app')
@section('title', 'Profil Pengunjung - RimbaCamp')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-teal-50 pt-32 pb-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Header Section -->
            <div class="text-center mb-8 fade-in">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-green-500 to-teal-600 rounded-full mb-4 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Profil Anda</h1>
                <p class="text-gray-600">Kelola informasi pribadi Anda di RimbaCamp</p>
            </div>

            <!-- Success Alert -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-gradient-to-r from-green-100 to-emerald-100 border border-green-300 text-green-800 rounded-xl shadow-sm alert-success"
                    id="successAlert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Profile Form Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden form-card">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-green-600 to-teal-600 px-8 py-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Edit Profil</h2>
                            <p class="text-green-100 text-sm">Perbarui informasi pribadi Anda</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form action="{{ route('pengunjung.profile.update') }}" method="POST" class="p-8 space-y-6"
                    id="profileForm">
                    @csrf

                    <!-- Personal Information Section -->
                    <div class="form-section">
                        <div class="flex items-center mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                Informasi Pribadi
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Field -->
                            <div class="form-group">
                                <label for="name" class="block text-gray-700 font-semibold mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Nama Lengkap
                                </label>
                                <div class="relative">
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $user->name) }}" required
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 pl-12 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 @error('name') border-red-400 ring-2 ring-red-200 @enderror">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email" class="block text-gray-700 font-semibold mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Email
                                </label>
                                <div class="relative">
                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', $user->email) }}" required
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 pl-12 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 @error('email') border-red-400 ring-2 ring-red-200 @enderror">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Phone Field -->
                            <div class="form-group md:col-span-2">
                                <label for="phone" class="block text-gray-700 font-semibold mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    Nomor HP
                                    <span class="text-sm text-gray-500 ml-2">(opsional)</span>
                                </label>
                                <div class="relative">
                                    <input type="text" id="phone" name="phone"
                                        value="{{ old('phone', $user->phone) }}"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 pl-12 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 @error('phone') border-red-400 ring-2 ring-red-200 @enderror"
                                        placeholder="Contoh: +62 812-3456-7890">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                @error('phone')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">Keamanan</span>
                        </div>
                    </div>

                    <!-- Security Section -->
                    <div class="form-section">
                        <div class="flex items-center mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                Ubah Password
                            </h3>
                        </div>

                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-yellow-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.314 16.5c-.77.833.192 2.5 1.732 2.5z">
                                    </path>
                                </svg>
                                <span class="text-yellow-800 text-sm">Kosongkan jika tidak ingin mengubah password</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Password Field -->
                            <div class="form-group">
                                <label for="password" class="block text-gray-700 font-semibold mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                    Password Baru
                                </label>
                                <div class="relative">
                                    <input type="password" id="password" name="password"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 pl-12 pr-12 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 @error('password') border-red-400 ring-2 ring-red-200 @enderror"
                                        placeholder="Minimal 8 karakter">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center"
                                        onclick="togglePassword('password')">
                                        <svg class="w-5 h-5 text-gray-400 hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            id="togglePassword1">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="form-group">
                                <label for="password_confirmation"
                                    class="block text-gray-700 font-semibold mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                    Konfirmasi Password
                                </label>
                                <div class="relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 pl-12 pr-12 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300"
                                        placeholder="Ketik ulang password baru">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                            </path>
                                        </svg>
                                    </div>
                                    <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center"
                                        onclick="togglePassword('password_confirmation')">
                                        <svg class="w-5 h-5 text-gray-400 hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            id="togglePassword2">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Data Anda akan disimpan dengan aman
                        </div>
                        <button type="submit"
                            class="bg-gradient-to-r from-green-600 to-teal-600 text-white px-8 py-3 rounded-xl hover:from-green-700 hover:to-teal-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                            id="submitBtn">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                <span id="submitText">Simpan Perubahan</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        .form-card {
            animation: slideUp 0.6s ease-out;
        }

        .form-section {
            animation: fadeInUp 0.8s ease-out;
        }

        .form-group {
            animation: fadeInUp 0.6s ease-out;
        }

        .alert-success {
            animation: slideDown 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            animation-delay: 0.1s;
            animation-fill-mode: both;
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

        /* Loading state */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .loading .spinner {
            display: inline-block;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Smooth focus transitions */
        input:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        /* Hover effects */
        .form-group:hover input {
            border-color: #10b981;
        }

        /* Button press effect */
        button:active {
            transform: scale(0.98);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide success alert
            const successAlert = document.getElementById('successAlert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.transition = 'opacity 0.5s ease-out';
                    successAlert.style.opacity = '0';
                    setTimeout(() => {
                        successAlert.remove();
                    }, 500);
                }, 5000);
            }

            // Form submission with loading state
            const form = document.getElementById('profileForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');

            form.addEventListener('submit', function(e) {
                // Add loading state
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
                submitText.innerHTML = `
            <svg class="w-5 h-5 mr-2 spinner" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Menyimpan...
        `;
            });

            // Password toggle functionality
            window.togglePassword = function(fieldId) {
                const passwordField = document.getElementById(fieldId);
                const toggleIcon = fieldId === 'password' ? document.getElementById('togglePassword1') :
                    document.getElementById('togglePassword2');

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    toggleIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
            `;
                } else {
                    passwordField.type = 'password';
                    toggleIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            `;
                }
            };

            // Real-time validation
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const phoneInput = document.getElementById('phone');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');

            // Name validation
            nameInput.addEventListener('input', function() {
                validateField(this, this.value.trim().length >= 2, 'Nama harus minimal 2 karakter');
            });

            // Email validation
            emailInput.addEventListener('input', function() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                validateField(this, emailRegex.test(this.value), 'Format email tidak valid');
            });

            // Phone validation
            phoneInput.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    removeValidationStyles(this);
                    return;
                }
                const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,20}$/;
                validateField(this, phoneRegex.test(this.value), 'Format nomor HP tidak valid');
            });

            // Password validation
            passwordInput.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    removeValidationStyles(this);
                    return;
                }
                const isValid = this.value.length >= 8;
                validateField(this, isValid, 'Password harus minimal 8 karakter');

                // Check confirm password if it has value
                if (confirmPasswordInput.value.trim() !== '') {
                    validatePasswordConfirmation();
                }
            });

            // Confirm password validation
            confirmPasswordInput.addEventListener('input', function() {
                validatePasswordConfirmation();
            });

            function validatePasswordConfirmation() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (confirmPassword.trim() === '') {
                    removeValidationStyles(confirmPasswordInput);
                    return;
                }

                validateField(confirmPasswordInput, password === confirmPassword,
                    'Konfirmasi password tidak cocok');
            }

            function validateField(field, isValid, errorMessage) {
                const fieldContainer = field.closest('.form-group');
                let errorElement = fieldContainer.querySelector('.validation-error');

                if (isValid) {
                    field.classList.remove('border-red-400', 'ring-2', 'ring-red-200');
                    field.classList.add('border-green-400', 'ring-2', 'ring-green-200');
                    if (errorElement) {
                        errorElement.remove();
                    }
                } else {
                    field.classList.remove('border-green-400', 'ring-2', 'ring-green-200');
                    field.classList.add('border-red-400', 'ring-2', 'ring-red-200');

                    if (!errorElement) {
                        errorElement = document.createElement('p');
                        errorElement.className = 'text-red-500 text-sm mt-2 flex items-center validation-error';
                        errorElement.innerHTML = `
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    ${errorMessage}
                `;
                        fieldContainer.appendChild(errorElement);
                    } else {
                        errorElement.innerHTML = `
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    ${errorMessage}
                `;
                    }
                }
            }

            function removeValidationStyles(field) {
                field.classList.remove('border-red-400', 'ring-2', 'ring-red-200', 'border-green-400',
                    'ring-green-200');
                const fieldContainer = field.closest('.form-group');
                const errorElement = fieldContainer.querySelector('.validation-error');
                if (errorElement) {
                    errorElement.remove();
                }
            }

            // Smooth scrolling for form sections
            const formSections = document.querySelectorAll('.form-section');
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            formSections.forEach(section => {
                observer.observe(section);
            });

            // Phone number formatting
            phoneInput.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');

                if (value.startsWith('62')) {
                    value = '+' + value;
                } else if (value.startsWith('0')) {
                    value = '+62' + value.substring(1);
                } else if (value.length > 0 && !value.startsWith('+')) {
                    value = '+62' + value;
                }

                // Format display
                if (value.length > 3) {
                    value = value.substring(0, 3) + ' ' + value.substring(3);
                }
                if (value.length > 7) {
                    value = value.substring(0, 7) + '-' + value.substring(7);
                }
                if (value.length > 12) {
                    value = value.substring(0, 12) + '-' + value.substring(12);
                }

                this.value = value.substring(0, 20); // Limit length
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + S to save
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    form.submit();
                }

                // Escape to clear focused field
                if (e.key === 'Escape') {
                    document.activeElement.blur();
                }
            });

            // Enhanced focus management
            const inputs = document.querySelectorAll('input');
            inputs.forEach((input, index) => {
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && input.type !== 'submit') {
                        e.preventDefault();
                        const nextInput = inputs[index + 1];
                        if (nextInput) {
                            nextInput.focus();
                        } else {
                            submitBtn.focus();
                        }
                    }
                });

                // Add focus animations
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                    this.parentElement.style.transition = 'transform 0.2s ease';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Progress indicator for form completion
            function updateFormProgress() {
                const requiredFields = [nameInput, emailInput];
                const filledFields = requiredFields.filter(field => field.value.trim() !== '');
                const progress = (filledFields.length / requiredFields.length) * 100;

                // You can add a progress bar here if needed
                console.log(`Form completion: ${progress}%`);
            }

            // Monitor form completion
            [nameInput, emailInput, phoneInput, passwordInput, confirmPasswordInput].forEach(input => {
                input.addEventListener('input', updateFormProgress);
            });

            // Initial form state
            updateFormProgress();

            // Prevent form submission if there are validation errors
            form.addEventListener('submit', function(e) {
                const hasErrors = document.querySelectorAll('.validation-error').length > 0;
                const requiredFieldsEmpty = !nameInput.value.trim() || !emailInput.value.trim();

                if (hasErrors || requiredFieldsEmpty) {
                    e.preventDefault();

                    // Focus first invalid field
                    const firstInvalidField = document.querySelector('.border-red-400') ||
                        (requiredFieldsEmpty ? nameInput : null);
                    if (firstInvalidField) {
                        firstInvalidField.focus();
                        firstInvalidField.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }

                    // Reset button state
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('loading');
                    submitText.innerHTML = `
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                </svg>
                Simpan Perubahan
            `;

                    // Show error notification
                    showNotification('Harap periksa dan lengkapi form dengan benar', 'error');
                }
            });

            // Notification system
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-x-full ${
            type === 'error' ? 'bg-red-100 text-red-800 border border-red-300' : 
            type === 'success' ? 'bg-green-100 text-green-800 border border-green-300' :
            'bg-blue-100 text-blue-800 border border-blue-300'
        }`;

                notification.innerHTML = `
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    ${type === 'error' ? 
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>' :
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
                    }
                </svg>
                <span class="font-medium">${message}</span>
            </div>
        `;

                document.body.appendChild(notification);

                // Animate in
                setTimeout(() => {
                    notification.style.transform = 'translateX(0)';
                }, 100);

                // Auto remove
                setTimeout(() => {
                    notification.style.transform = 'translateX(full)';
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }, 3000);
            }
        });
    </script>
@endsection
