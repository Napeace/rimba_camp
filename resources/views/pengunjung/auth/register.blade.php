@extends('pengunjung.layouts.auth')

@section('title', 'Register - RimbaCamp')

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
                Buat Akun Baru
            </h2>
            <p class="text-green-100 text-lg">
                Daftar untuk memulai petualangan alam Anda
            </p>
        </div>

        {{-- Register Form --}}
        <div
            class="glass-effect w-full max-w-3xl mx-auto rounded-3xl p-10 bg-white bg-opacity-15 border border-green-200 border-opacity-30 animate-slide-up shadow-2xl">
            @if ($errors->any())
                <div
                    class="mb-6 bg-red-500 bg-opacity-25 border border-red-400 border-opacity-40 text-red-100 px-4 py-3 rounded-xl backdrop-blur-sm">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span class="text-sm font-medium">{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('pengunjung.register') }}" class="space-y-6" novalidate>
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Name Field --}}
                    <div class="group">
                        <label for="name" class="block text-sm font-semibold text-green-100 mb-3">
                            <i class="fas fa-user mr-2"></i>Nama Lengkap
                        </label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                            class="w-full pl-12 pr-4 py-4 bg-white bg-opacity-20 border-2 border-green-300 border-opacity-30 rounded-xl text-white placeholder-green-200 placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 focus:bg-opacity-25 transition-all duration-300 backdrop-blur-sm @error('name') border-red-500 @enderror"
                            placeholder="Masukkan nama lengkap Anda" />
                    </div>

                    {{-- Email Field --}}
                    <div class="group">
                        <label for="email" class="block text-sm font-semibold text-green-100 mb-3">
                            <i class="fas fa-envelope mr-2"></i>Email
                        </label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                            class="w-full pl-12 pr-4 py-4 bg-white bg-opacity-20 border-2 border-green-300 border-opacity-30 rounded-xl text-white placeholder-green-200 placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 focus:bg-opacity-25 transition-all duration-300 backdrop-blur-sm @error('email') border-red-500 @enderror"
                            placeholder="Masukkan email Anda" />
                    </div>

                    {{-- Phone Field --}}
                    <div class="group">
                        <label for="phone" class="block text-sm font-semibold text-green-100 mb-3">
                            <i class="fas fa-phone mr-2"></i>Telepon (opsional)
                        </label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                            class="w-full pl-12 pr-4 py-4 bg-white bg-opacity-20 border-2 border-green-300 border-opacity-30 rounded-xl text-white placeholder-green-200 placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 focus:bg-opacity-25 transition-all duration-300 backdrop-blur-sm @error('phone') border-red-500 @enderror"
                            placeholder="Masukkan nomor telepon Anda" />
                    </div>

                    {{-- Password Field --}}
                    <div class="group relative">
                        <label for="password" class="block text-sm font-semibold text-green-100 mb-3">
                            <i class="fas fa-lock mr-2"></i>Password
                        </label>
                        <input id="password" name="password" type="password" required
                            class="w-full pl-12 pr-12 py-4 bg-white bg-opacity-20 border-2 border-green-300 border-opacity-30 rounded-xl text-white placeholder-green-200 placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 focus:bg-opacity-25 transition-all duration-300 backdrop-blur-sm @error('password') border-red-500 @enderror"
                            placeholder="Masukkan password Anda" />
                    </div>

                    {{-- Confirm Password Field --}}
                    <div class="group relative">
                        <label for="password_confirmation" class="block text-sm font-semibold text-green-100 mb-3">
                            <i class="fas fa-lock mr-2"></i>Konfirmasi Password
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="w-full pl-12 pr-12 py-4 bg-white bg-opacity-20 border-2 border-green-300 border-opacity-30 rounded-xl text-white placeholder-green-200 placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 focus:bg-opacity-25 transition-all duration-300 backdrop-blur-sm"
                            placeholder="Konfirmasi password Anda" />
                    </div>
                </div>

                {{-- Submit Button --}}
                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-4 px-6 border-2 border-transparent text-sm font-bold rounded-xl text-green-800 bg-gradient-to-r from-green-400 to-emerald-400 hover:from-green-300 hover:to-emerald-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300 transform hover:scale-105 hover-lift shadow-xl">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                            <i
                                class="fas fa-user-plus text-green-700 group-hover:text-green-600 transition-colors duration-200"></i>
                        </span>
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            {{-- Login Link --}}
            <div class="mt-8 text-center">
                <p class="text-green-100 text-sm">
                    Sudah punya akun?
                    <a href="{{ route('pengunjung.login') }}"
                        class="font-bold text-green-200 hover:text-green-100 transition-all duration-200 underline underline-offset-2">
                        Masuk di sini
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

    <script>
        // Add loading state to form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mendaftarkan...';

            setTimeout(() => {
                if (submitBtn.disabled) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            }, 3000);
        });

        // Input animation effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll(
                'input[type="email"], input[type="password"], input[type="text"]');
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
