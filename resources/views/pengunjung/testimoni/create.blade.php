@extends('pengunjung.layouts.app')

@section('title', 'Buat Testimoni')

@section('content')
    <div class="max-w-3xl mt-32 mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center mb-6">
                    <a href="{{ route('pengunjung.testimoni.index') }}" class="mr-4 text-green-600 hover:text-green-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold text-green-800">Buat Testimoni</h1>
                </div>

                <form action="{{ route('pengunjung.testimoni.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">Ulasan Anda</label>
                        <textarea id="isi" name="isi" rows="6" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Bagikan pengalaman Anda selama menginap di Rimba Camp...">{{ old('isi') }}</textarea>
                        @error('isi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-4 pt-4">
                        <a href="{{ route('pengunjung.testimoni.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300">
                            Kirim Testimoni
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk rating bintang
        function setRating(rating) {
            const stars = document.querySelectorAll('#rating-container svg');
            const ratingInput = document.getElementById('rating-input');

            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                    star.style.fill = 'currentColor';
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                    star.style.fill = 'none';
                }
            });

            ratingInput.value = rating;
        }

        // Animasi untuk halaman create
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');
            form.classList.add('opacity-0', 'translate-y-5');

            setTimeout(() => {
                form.classList.remove('opacity-0', 'translate-y-5');
                form.classList.add('opacity-100', 'translate-y-0');
                form.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            }, 100);
        });
    </script>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
@endsection
