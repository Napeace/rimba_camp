@extends('pengunjung.layouts.app')

@section('title', 'Testimoni Saya')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-green-800">Testimoni Saya</h1>
            <a href="{{ route('pengunjung.testimoni.create') }}"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                Tambah Testimoni Baru
            </a>
        </div>

        @if (session('success'))
            <div id="success-alert"
                class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded animate-fade-in">
                <div class="flex justify-between items-center">
                    <p>{{ session('success') }}</p>
                    <button onclick="closeAlert('success-alert')" class="text-green-700 hover:text-green-900">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div id="error-alert"
                class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded animate-fade-in">
                <div class="flex justify-between items-center">
                    <p>{{ session('error') }}</p>
                    <button onclick="closeAlert('error-alert')" class="text-red-700 hover:text-red-900">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <div class="mt-6 mb-6 flex justify-end">
            <a href="{{ route('pengunjung.testimoni.create') }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 transition duration-300">
                Tambah Testimoni
            </a>
        </div>
        @if ($testimonis->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                    </path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada testimoni</h3>
                <p class="mt-1 text-gray-500">Anda belum memberikan testimoni.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($testimonis as $testimoni)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 animate-fade-in-up">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-green-800">Testimoni</h3>
                                </div>
                            </div>

                            <div class="mt-4">
                                <p class="text-gray-700 whitespace-pre-line">{{ $testimoni->isi }}</p>
                            </div>

                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-sm text-gray-500">
                                    Ditulis pada
                                    {{ \Carbon\Carbon::parse($testimoni->created_at)->timezone('Asia/Jakarta')->format('d F Y, H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        function closeAlert(id) {
            document.getElementById(id).classList.add('animate-fade-out');
            setTimeout(() => {
                document.getElementById(id).remove();
            }, 300);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const items = document.querySelectorAll('.animate-fade-in-up');
            items.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';

                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
@endsection
