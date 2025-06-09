@extends('pengunjung.layouts.app')

@section('title', 'Cottage - Rimbacamp')

@section('content')
    <div class="relative bg-gradient-to-r from-green-600 to-emerald-700 text-white pt-40 pb-24">
        <div class="absolute mt-16 inset-0 bg-black opacity-20"></div>
        <div class="relative container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 animate-fade-in">
                Cottage Rimbacamp
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90 animate-slide-up">
                Nikmati pengalaman menginap yang tak terlupakan di tengah alam
            </p>
            <div class="inline-flex items-center bg-white bg-opacity-20 rounded-full px-6 py-3 backdrop-blur-sm">
                <span>Pilih cottage kesukaan Anda</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 animate-slide-up">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Filter Cottage</h2>
            <form id="filterForm" method="GET" action="{{ route('cottage.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <!-- Check-in Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Check-in</label>
                        <input type="date" id="checkIn" name="check_in" value="{{ request('check_in') }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>

                    <!-- Check-out Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Check-out</label>
                        <input type="date" id="checkOut" name="check_out" value="{{ request('check_out') }}"
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>

                    <!-- Capacity -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kapasitas</label>
                        <select id="filterKapasitas" name="kapasitas"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Semua Kapasitas</option>
                            <option value="2" {{ request('kapasitas') == '2' ? 'selected' : '' }}>2 Orang</option>
                            <option value="4" {{ request('kapasitas') == '4' ? 'selected' : '' }}>4 Orang</option>
                            <option value="6" {{ request('kapasitas') == '6' ? 'selected' : '' }}>6 Orang</option>
                        </select>
                    </div>

                    <!-- Minimum Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga Minimal</label>
                        <input type="number" id="hargaMin" name="harga_min" value="{{ request('harga_min') }}"
                            placeholder="Rp 0" min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>

                    <!-- Maximum Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga Maksimal</label>
                        <input type="number" id="hargaMax" name="harga_max" value="{{ request('harga_max') }}"
                            placeholder="Rp 999999" min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>

                    <!-- Facilities -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas</label>
                        <select id="filterFasilitas" name="fasilitas"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Semua Fasilitas</option>
                            <option value="dapur" {{ request('fasilitas') == 'dapur' ? 'selected' : '' }}>Dengan Dapur
                            </option>
                            <option value="teras" {{ request('fasilitas') == 'teras' ? 'selected' : '' }}>Dengan Teras
                            </option>
                            <option value="lemari" {{ request('fasilitas') == 'lemari' ? 'selected' : '' }}>Dengan Lemari
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Filter Buttons -->
                <div class="flex flex-wrap gap-3 mt-6">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition-colors duration-200 font-medium">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari Cottage
                    </button>
                    <button type="button" onclick="resetFilter()"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors duration-200 font-medium">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Reset Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Filter Results Info -->
        @if (request()->hasAny(['check_in', 'check_out', 'kapasitas', 'harga_min', 'harga_max', 'fasilitas']))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <p class="text-green-800 font-medium">Filter Aktif:</p>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @if (request('check_in'))
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                    Check-in: {{ date('d/m/Y', strtotime(request('check_in'))) }}
                                </span>
                            @endif
                            @if (request('check_out'))
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                    Check-out: {{ date('d/m/Y', strtotime(request('check_out'))) }}
                                </span>
                            @endif
                            @if (request('kapasitas'))
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                    Kapasitas: {{ request('kapasitas') }} orang
                                </span>
                            @endif
                            @if (request('harga_min'))
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                    Min: Rp {{ number_format(request('harga_min'), 0, ',', '.') }}
                                </span>
                            @endif
                            @if (request('harga_max'))
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                    Max: Rp {{ number_format(request('harga_max'), 0, ',', '.') }}
                                </span>
                            @endif
                            @if (request('fasilitas'))
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                    Fasilitas: {{ ucfirst(request('fasilitas')) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div id="cottageGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($cottages as $cottage)
                <div
                    class="cottage-card bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300 hover:shadow-2xl">
                    <div
                        class="relative h-48 bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center">
                        <div class="text-white text-center">
                            <svg class="w-16 h-16 mx-auto mb-2 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            <span class="text-lg font-semibold">{{ $cottage->nomor }}</span>
                        </div>
                        <span
                            class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Tersedia
                        </span>
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-xl font-bold text-gray-800">Cottage {{ $cottage->nomor }}</h3>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-green-600">
                                    Rp {{ number_format($cottage->harga_per_malam, 0, ',', '.') }}
                                </p>
                                <p class="text-sm text-gray-500">per malam</p>
                            </div>
                        </div>

                        <div class="flex items-center mb-3 text-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM5 8a2 2 0 11-4 0 2 2 0 014 0zM19 8a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="font-medium">{{ $cottage->kapasitas }} Orang</span>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm text-gray-600 font-medium mb-2">Fasilitas:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach (explode(',', $cottage->fasilitas) as $fasilitas)
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">
                                        {{ trim($fasilitas) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('cottage.show', $cottage->id) }}"
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center py-3 px-4 rounded-lg transition-colors duration-200 font-medium">
                                Lihat Detail
                            </a>
                            <a href="{{ route('cottage.reserve', $cottage->id) }}{{ request('check_in') || request('check_out')
                                ? '?' .
                                    http_build_query(
                                        array_filter([
                                            'check_in' => request('check_in'),
                                            'check_out' => request('check_out'),
                                        ]),
                                    )
                                : '' }}"
                                class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white text-center py-3 px-4 rounded-lg transition-colors duration-200 font-medium">
                                Reservasi
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($cottages->isEmpty())
            <div class="text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 5a2 2 0 012-2h4a2 2 0 012 2v0a2 2 0 012 2v0H6v0a2 2 0 012-2v0z"></path>
                </svg>
                <h3 class="text-xl font-medium text-gray-700 mb-2">
                    @if (request()->hasAny(['check_in', 'check_out', 'kapasitas', 'harga_min', 'harga_max', 'fasilitas']))
                        Tidak ada cottage yang sesuai dengan filter
                    @else
                        Tidak ada cottage tersedia
                    @endif
                </h3>
                <p class="text-gray-500">
                    @if (request()->hasAny(['check_in', 'check_out', 'kapasitas', 'harga_min', 'harga_max', 'fasilitas']))
                        Coba ubah filter pencarian Anda untuk melihat cottage lainnya.
                    @else
                        Maaf, saat ini belum ada cottage yang tersedia untuk dipesan.
                    @endif
                </p>
            </div>
        @endif
    </div>

    <div class="bg-gradient-to-r from-green-600 to-emerald-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Sudah Punya Reservasi?</h2>
            <p class="text-xl mb-8 opacity-90">Cek status reservasi Anda atau lihat riwayat pemesanan</p>
            <a href="{{ route('cottage.reservasi.riwayat') }}"
                class="inline-block bg-white text-green-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition-colors duration-200">
                Lihat Riwayat Reservasi
            </a>
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

        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }

        .animate-slide-up {
            animation: slide-up 1s ease-out 0.3s both;
        }

        .cottage-card {
            animation: slide-up 0.6s ease-out both;
        }

        .cottage-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .cottage-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .cottage-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .cottage-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .cottage-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .cottage-card:nth-child(6) {
            animation-delay: 0.6s;
        }

        /* Date input styling */
        input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            filter: invert(0.5);
        }

        input[type="date"]::-webkit-calendar-picker-indicator:hover {
            filter: invert(0.3);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkInInput = document.getElementById('checkIn');
            const checkOutInput = document.getElementById('checkOut');

            // Update minimum check-out date when check-in changes
            checkInInput.addEventListener('change', function() {
                if (this.value) {
                    const checkInDate = new Date(this.value);
                    const nextDay = new Date(checkInDate);
                    nextDay.setDate(checkInDate.getDate() + 1);

                    const minCheckOut = nextDay.toISOString().split('T')[0];
                    checkOutInput.min = minCheckOut;

                    // Clear check-out if it's before the new minimum
                    if (checkOutInput.value && checkOutInput.value <= this.value) {
                        checkOutInput.value = minCheckOut;
                    }
                }
            });

            // Validate check-out date
            checkOutInput.addEventListener('change', function() {
                if (checkInInput.value && this.value <= checkInInput.value) {
                    alert('Tanggal check-out harus setelah tanggal check-in');
                    this.value = '';
                }
            });
        });

        function resetFilter() {
            // Reset all form fields
            document.getElementById('filterForm').reset();

            // Reset date minimums
            const today = new Date().toISOString().split('T')[0];
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const tomorrowStr = tomorrow.toISOString().split('T')[0];

            document.getElementById('checkIn').min = today;
            document.getElementById('checkOut').min = tomorrowStr;

            // Redirect to clean URL
            window.location.href = "{{ route('cottage.index') }}";
        }
    </script>
@endsection
