@extends('admin.layouts.app')

@section('title', 'Login Admin - Rimba Camp')
@section('body-class', 'bg-gradient-to-br from-emerald-500 via-green-600 to-teal-700 relative')

@section('content')
<body class="bg-gradient-to-br from-emerald-500 via-green-600 to-teal-700 min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Enhanced Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Floating Particles -->
        <div class="absolute top-10 left-10 w-2 h-2 bg-white/30 rounded-full animate-bounce delay-100"></div>
        <div class="absolute top-32 right-20 w-1 h-1 bg-white/40 rounded-full animate-ping delay-300"></div>
        <div class="absolute bottom-20 left-16 w-1.5 h-1.5 bg-white/35 rounded-full animate-pulse delay-700"></div>

        <!-- Enhanced Glowing Orbs -->
        <div class="absolute -top-16 -right-16 w-40 h-40 bg-gradient-to-br from-white/20 to-emerald-300/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-1/3 -left-20 w-56 h-56 bg-gradient-to-tr from-teal-300/15 to-white/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute bottom-1/3 right-1/5 w-28 h-28 bg-gradient-to-bl from-green-200/25 to-white/15 rounded-full blur-2xl animate-pulse delay-500"></div>

        <!-- Geometric Shapes -->
        <div class="absolute top-20 right-32 w-6 h-6 border border-white/20 rotate-45 animate-spin" style="animation-duration: 15s;"></div>
        <div class="absolute bottom-24 left-24 w-4 h-4 bg-white/10 rotate-12 animate-bounce delay-200"></div>
    </div>

    <!-- Optimized Login Container -->
    <div class="bg-white/95 backdrop-blur-2xl rounded-2xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border-2 border-white/40 p-8 w-full max-w-md relative z-10 transform hover:scale-[1.01] transition-all duration-500 hover:shadow-[0_35px_60px_-12px_rgba(16,185,129,0.4)]">
        <!-- Multiple Glow Effects -->
        <div class="absolute -inset-3 bg-gradient-to-r from-emerald-400/20 via-green-400/20 to-teal-400/20 rounded-2xl blur-2xl opacity-75"></div>
        <div class="absolute -inset-1 bg-gradient-to-br from-white/30 via-emerald-100/20 to-teal-100/20 rounded-2xl blur-xl"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-white/60 via-white/50 to-white/40 rounded-2xl"></div>

        <!-- Header Enhanced -->
        <div class="text-center mb-8 relative">
            <!-- Icon Container with Glow -->
            <div class="relative mb-6">
                <div class="absolute inset-0 bg-gradient-to-br from-green-400 to-emerald-600 w-20 h-20 rounded-2xl blur-lg opacity-20 animate-pulse mx-auto"></div>
                <div class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto shadow-xl border border-green-100/50 transform hover:rotate-6 hover:scale-110 transition-all duration-500 relative">
                    <i class="fas fa-tree text-transparent bg-gradient-to-br from-green-600 to-emerald-700 bg-clip-text text-3xl"></i>
                    <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-transparent rounded-2xl"></div>
                </div>
            </div>

            <h1 class="text-3xl font-black bg-gradient-to-r from-gray-800 via-gray-700 to-gray-900 bg-clip-text text-transparent mb-2">Admin Rimba Camp</h1>
            <p class="text-gray-500 text-base font-semibold">Silakan masuk untuk mengelola sistem</p>

            <!-- Enhanced Divider -->
            <div class="relative mt-4">
                <div class="w-20 h-1 bg-gradient-to-r from-green-400 via-emerald-500 to-teal-500 rounded-full mx-auto shadow-lg"></div>
                <div class="absolute inset-0 w-20 h-1 bg-gradient-to-r from-green-300 to-emerald-400 rounded-full mx-auto blur-sm opacity-60"></div>
            </div>
        </div>

        <!-- Enhanced Alerts -->
        @if (session('success'))
        <div class="bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-r-xl mb-6 shadow-lg border-t border-r border-b border-green-100">
            <div class="flex items-center">
                <div class="bg-green-500 w-6 h-6 rounded-full flex items-center justify-center mr-3 shadow-md">
                    <i class="fas fa-check text-white text-xs"></i>
                </div>
                <span class="font-semibold text-base">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-gradient-to-r from-red-50 via-pink-50 to-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-r-xl mb-6 shadow-lg border-t border-r border-b border-red-100">
            <div class="flex items-start">
                <div class="bg-red-500 w-6 h-6 rounded-full flex items-center justify-center mr-3 shadow-md mt-0.5">
                    <i class="fas fa-exclamation text-white text-xs"></i>
                </div>
                <div>
                    @foreach ($errors->all() as $error)
                        <div class="font-semibold text-base">{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Enhanced Form -->
        <form method="POST" action="{{ route('admin.login.process') }}" class="space-y-6">
            @csrf

            <!-- Enhanced Email Field -->
            <div class="group relative">
                <label for="email" class="block text-sm font-bold text-gray-700 mb-3">
                    <i class="fas fa-envelope mr-2 text-green-600"></i>Email
                </label>
                <div class="relative">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-3 focus:ring-green-200/50 focus:border-green-500 transition-all duration-400 bg-gradient-to-r from-gray-50 to-white hover:from-white hover:to-gray-50 hover:border-gray-300 text-base font-medium placeholder-gray-400 shadow-inner @error('email') border-red-400 bg-gradient-to-r from-red-50 to-pink-50 @enderror"
                        placeholder="Masukkan Email Anda"
                        required
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                        <i class="fas fa-user-shield text-gray-400 group-focus-within:text-green-600 transition-all duration-400"></i>
                    </div>
                    <!-- Input Glow Effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-green-400/10 to-emerald-400/10 rounded-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-400 blur-sm -z-10"></div>
                </div>
                @error('email')
                <p class="text-red-600 text-sm mt-2 flex items-center font-medium">
                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                </p>
                @enderror
            </div>

            <!-- Enhanced Password Field -->
            <div class="group relative">
                <label for="password" class="block text-sm font-bold text-gray-700 mb-3">
                    <i class="fas fa-lock mr-2 text-green-600"></i>Password
                </label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-3 focus:ring-green-200/50 focus:border-green-500 transition-all duration-400 bg-gradient-to-r from-gray-50 to-white hover:from-white hover:to-gray-50 hover:border-gray-300 text-base font-medium placeholder-gray-400 shadow-inner @error('password') border-red-400 bg-gradient-to-r from-red-50 to-pink-50 @enderror"
                        placeholder="Masukkan Password Anda"
                        required
                    >
                    <button
                        type="button"
                        onclick="togglePassword()"
                        class="absolute right-4 top-5 transform -translate-y-1/2 text-gray-400 hover:text-green-600 transition-all duration-400 rounded-lg hover:bg-green-50 flex items-center justify-center"
                    >
                        <i id="toggleIcon" class="fas fa-eye"></i>
                    </button>
                    <!-- Input Glow Effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-green-400/10 to-emerald-400/10 rounded-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-400 blur-sm -z-10"></div>
                </div>
                @error('password')
                <p class="text-red-600 text-sm mt-2 flex items-center font-medium">
                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ $message }}
                </p>
                @enderror
            </div>

            <!-- Enhanced Submit Button -->
            <button
                type="submit"
                class="w-full bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 hover:from-green-700 hover:via-emerald-700 hover:to-teal-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-400 flex items-center justify-center shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-[1.02] active:scale-[0.98] relative overflow-hidden group"
            >
                <!-- Button Glow Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-400"></div>

                <!-- Button Content -->
                <i class="fas fa-sign-in-alt mr-3 text-lg"></i>
                <span class="text-lg">Masuk ke Dashboard</span>

                <!-- Shimmer Effect -->
                <div class="absolute inset-0 -skew-x-12 bg-gradient-to-r from-transparent via-white/20 to-transparent opacity-0 group-hover:opacity-100 group-hover:animate-pulse"></div>
            </button>
        </form>

        <!-- Enhanced Footer -->
        <div class="text-center mt-6 pt-6 border-t border-gradient-to-r from-transparent via-gray-200 to-transparent">
            <p class="text-gray-400 text-sm flex items-center justify-center font-medium">
                <i class="fas fa-copyright mr-2 text-green-500"></i>
                2025 Rimba Camp
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Enhanced entrance animation
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.bg-white\\/95');
            const elements = container.querySelectorAll('div, h1, p, form, input, button');

            // Initial state
            container.style.opacity = '0';
            container.style.transform = 'translateY(30px) scale(0.95)';

            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
            });

            // Animate container
            setTimeout(() => {
                container.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0) scale(1)';
            }, 100);

            // Animate elements with stagger
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, 200 + (index * 50));
            });
        });

        // Enhanced hover effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');

            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
