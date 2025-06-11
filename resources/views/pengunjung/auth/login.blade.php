@extends('pengunjung.layouts.auth')

@section('title', 'Masuk - rimbacamp')

@section('content')
    <div class="space-y-8">
        {{-- Header --}}
        <div class="text-center animate-fade-in">
            <div class="flex justify-center mb-6">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center glass-effect animate-pulse-glow leaf-bounce shadow-2xl">
                    <i class="fas fa-mountain text-white text-3xl"></i>
                </div>
            </div>
            <h2 class="text-4xl font-extrabold text-white mb-2 tracking-wide">
                Selamat Datang Kembali!
            </h2>
            <p class="text-green-100 text-lg">
                Masuk ke petualangan alam Anda
            </p>
        </div>

        {{-- Login Form --}}
        <div
            class="glass-effect rounded-3xl p-8 bg-white bg-opacity-15 border border-green-200 border-opacity-30 animate-slide-up shadow-2xl">
            @if ($errors->any())
                <div
                    class="mb-6 bg-red-500 bg-opacity-25 border border-red-400 border-opacity-40 text-red-100 px-4 py-3 rounded-xl backdrop-blur-sm">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span class="text-sm font-medium">{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-6">
                @csrf

                {{-- Email Field --}}
                <div class="group">
                    <label for="email" class="block text-sm font-semibold text-green-100 mb-3">
                        <i class="fas fa-envelope mr-2"></i>Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-green-300 text-opacity-80"></i>
                        </div>
                        <input id="email" name="email" type="email" required
                            class="w-full pl-12 pr-4 py-4 bg-white bg-opacity-20 border-2 border-green-300 border-opacity-30 rounded-xl text-white placeholder-green-200 placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 focus:bg-opacity-25 transition-all duration-300 backdrop-blur-sm"
                            placeholder="Masukkan email Anda" value="{{ old('email') }}">
                    </div>
                </div>

                {{-- Password Field --}}
                <div class="group">
                    <label for="password" class="block text-sm font-semibold text-green-100 mb-3">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-green-300 text-opacity-80"></i>
                        </div>
                        <input id="password" name="password" type="password" required
                            class="w-full pl-12 pr-12 py-4 bg-white bg-opacity-20 border-2 border-green-300 border-opacity-30 rounded-xl text-white placeholder-green-200 placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 focus:bg-opacity-25 transition-all duration-300 backdrop-blur-sm"
                            placeholder="Masukkan password Anda">
                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center">
                            <i id="password-toggle"
                                class="fas fa-eye text-green-300 text-opacity-80 hover:text-green-200 hover:text-opacity-100 transition-all duration-200"></i>
                        </button>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-4 px-6 border-2 border-transparent text-sm font-bold rounded-xl text-green-800 bg-gradient-to-r from-green-400 to-emerald-400 hover:from-green-300 hover:to-emerald-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300 transform hover:scale-105 hover-lift shadow-xl">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                            <i
                                class="fas fa-sign-in-alt text-green-700 group-hover:text-green-600 transition-colors duration-200"></i>
                        </span>
                        Masuk ke Akun
                    </button>
                </div>
            </form>

            {{-- Register Link --}}
            <div class="mt-8 text-center">
                <p class="text-green-100 text-sm">
                    Belum punya akun?
                    <a href="{{ route('pengunjung.register') }}"
                        class="font-bold text-green-200 hover:text-green-100 transition-all duration-200 underline underline-offset-2">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        </div>

        {{-- Back to Home --}}
        <div class="text-center animate-fade-in">
            <a href="/"
                class="inline-flex items-center text-green-200 hover:text-green-100 transition-all duration-200 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('password-toggle');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add loading state to form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sedang masuk...';

            // Re-enable button after 3 seconds if form hasn't been submitted
            setTimeout(() => {
                if (submitBtn.disabled) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            }, 3000);
        });

        // Add interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Input focus effects
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('scale-105');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('scale-105');
                });
            });
        });
    </script>
@endsection
