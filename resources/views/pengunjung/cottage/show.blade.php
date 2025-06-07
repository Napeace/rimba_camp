@extends('pengunjung.layouts.app')

@section('title', 'Detail Cottage ' . $cottage->nomor . ' - RimbaCamp')

@section('content')
    <div class="min-h-screen bg-gradient-to-br mt-24 from-green-50 to-blue-50">
        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-3">

                    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 animate-fade-in">
                        <div class="relative h-96 bg-gradient-to-r from-green-400 to-blue-500">
                            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                            <div class="absolute top-6 left-6">
                                <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-medium">
                                    Tersedia
                                </span>
                            </div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <h1 class="text-4xl font-bold mb-2">Cottage {{ $cottage->nomor }}</h1>
                                <p class="text-lg opacity-90">Kapasitas {{ $cottage->kapasitas }} Orang</p>
                            </div>

                            <div class="absolute bottom-6 right-6">
                                <div class="flex space-x-2">
                                    <button
                                        class="gallery-btn bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-2 rounded-full transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </button>
                                    <button
                                        class="gallery-btn bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-2 rounded-full transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-8 mb-8 animate-slide-up">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Cottage</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="info-card bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-lg">
                                <div class="flex items-center mb-3">
                                    <div class="bg-green-500 p-2 rounded-full mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900">Kapasitas</h3>
                                </div>
                                <p class="text-3xl font-bold text-green-600">{{ $cottage->kapasitas }}</p>
                                <p class="text-sm text-gray-600">Orang maksimal</p>
                            </div>

                            <div class="info-card bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-lg">
                                <div class="flex items-center mb-3">
                                    <div class="bg-blue-500 p-2 rounded-full mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900">Harga</h3>
                                </div>
                                <p class="text-3xl font-bold text-blue-600">{{ $cottage->formatted_price }}</p>
                                <p class="text-sm text-gray-600">per malam</p>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Fasilitas Tersedia</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach ($cottage->fasilitas_array as $fasilitas)
                                    <div
                                        class="facility-item flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                        <div class="bg-green-500 p-1 rounded-full mr-3">
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">{{ trim($fasilitas) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Aturan Cottage</h3>
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg">
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 text-yellow-500 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.865-.833-2.635 0L4.178 16.5c-.77.833.192 2.5 1.732 2.5z">
                                            </path>
                                        </svg>
                                        Check-in: 08:00 | Check-out: 12:00
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 text-yellow-500 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.865-.833-2.635 0L4.178 16.5c-.77.833.192 2.5 1.732 2.5z">
                                            </path>
                                        </svg>
                                        Dilarang merokok di dalam cottage
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 text-yellow-500 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.865-.833-2.635 0L4.178 16.5c-.77.833.192 2.5 1.732 2.5z">
                                            </path>
                                        </svg>
                                        Jaga kebersihan dan ketertiban
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 text-yellow-500 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.865-.833-2.635 0L4.178 16.5c-.77.833.192 2.5 1.732 2.5z">
                                            </path>
                                        </svg>
                                        Tidak diperbolehkan membawa hewan peliharaan
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-lg mt-6  p-6 animate-slide-right flex space-x-4">
                            <a href="{{ route('cottage.index') }}"
                                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 px-6 rounded-lg text-center font-semibold transition-all duration-200 transform">
                                Kembali ke Daftar Cottage
                            </a>
                            <a href="{{ route('cottage.reserve', $cottage->id) }}"
                                class="flex-1 bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 text-white py-3 px-6 rounded-lg text-center font-semibold transition-all duration-200 transform">
                                Reservasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {

            /*  */
            from {
                opacity: 0;
                transform: translateY(-10px);
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

        @keyframes slide-right {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slide-up 0.8s ease-out;
        }

        .animate-slide-right {
            animation: slide-right 0.8s ease-out;
        }

        .info-card {
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .facility-item {
            transition: all 0.2s ease;
        }

        .facility-item:hover {
            transform: translateX(4px);
        }

        .gallery-btn:hover {
            transform: scale(1.1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkinInput = document.getElementById('checkinDate');
            const checkoutInput = document.getElementById('checkoutDate');
            const checkAvailabilityBtn = document.getElementById('checkAvailability');
            const availabilityResult = document.getElementById('availabilityResult');
            const totalNightsSpan = document.getElementById('totalNights');
            const totalPriceSpan = document.getElementById('totalPrice');

            const pricePerNight = {{ $cottage->harga_per_malam }};

            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            checkinInput.setAttribute('min', today);

            checkinInput.addEventListener('change', function() {
                const checkinDate = new Date(this.value);
                const minCheckout = new Date(checkinDate);
                minCheckout.setDate(minCheckout.getDate() + 1);
                checkoutInput.setAttribute('min', minCheckout.toISOString().split('T')[0]);

                if (checkoutInput.value && new Date(checkoutInput.value) <= checkinDate) {
                    checkoutInput.value = '';
                }
            });

            function calculatePrice() {
                const checkinDate = new Date(checkinInput.value);
                const checkoutDate = new Date(checkoutInput.value);

                if (checkinInput.value && checkoutInput.value && checkoutDate > checkinDate) {
                    const timeDiff = checkoutDate.getTime() - checkinDate.getTime();
                    const nights = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    const totalPrice = nights * pricePerNight;

                    totalNightsSpan.textContent = nights;
                    totalPriceSpan.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');

                    return {
                        nights,
                        totalPrice
                    };
                }

                return null;
            }

            checkAvailabilityBtn.addEventListener('click', function() {
                if (!checkinInput.value || !checkoutInput.value) {
                    alert('Mohon pilih tanggal check-in dan check-out terlebih dahulu');
                    return;
                }

                const calculation = calculatePrice();
                if (calculation) {
                    this.textContent = 'Mengecek...';
                    this.disabled = true;

                    setTimeout(() => {
                        availabilityResult.classList.remove('hidden');
                        availabilityResult.style.opacity = '0';
                        availabilityResult.style.transform = 'translateY(10px)';

                        setTimeout(() => {
                            availabilityResult.style.transition = 'all 0.3s ease';
                            availabilityResult.style.opacity = '1';
                            availabilityResult.style.transform = 'translateY(0)';
                        }, 50);

                        this.textContent = 'Cek Ketersediaan';
                        this.disabled = false;
                    }, 1000);
                }
            });

            // Update price when dates change
            [checkinInput, checkoutInput].forEach(input => {
                input.addEventListener('change', calculatePrice);
            });
        });

        function shareThis() {
            if (navigator.share) {
                navigator.share({
                    title: 'Cottage {{ $cottage->nomor }} - RimbaCamp',
                    text: 'Lihat cottage amazing ini di RimbaCamp!',
                    url: window.location.href
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Link telah disalin ke clipboard!');
                });
            }
        }

        // Add smooth scrolling for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add parallax effect to hero image
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.bg-gradient-to-r');
            if (parallax) {
                const speed = scrolled * 0.5;
                parallax.style.transform = `translateY(${speed}px)`;
            }
        });
    </script>
@endsection
