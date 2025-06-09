@extends('pengunjung.layouts.app')

@section('title', 'Detail Reservasi - RimbaCamp')

@section('content')
    <!-- Hero Section with Nature Background -->
    <div class="relative bg-cover bg-center text-white pt-32 pb-20"
        style="background-image: url('{{ asset('images/.jpg') }}')">
        <div class="absolute inset-0 bg-gradient-to-t from-green-900 to-emerald-800 opacity-80"></div>
        <div class="relative container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 animate-fade-in-up">
                    Detail Reservasi
                </h1>
                <p class="text-xl opacity-90 animate-fade-in-up delay-100">
                    <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd" />
                    </svg>
                    Informasi lengkap reservasi cottage Anda di RimbaCamp
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Status Card -->
        <div class="max-w-6xl mx-auto mb-8 animate-slide-in-down">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-green-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="p-6 md:p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Status Reservasi</h2>
                        <p class="text-gray-600 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Reservasi dibuat pada
                            {{ \Carbon\Carbon::parse($reservasi->created_at)->timezone('Asia/Jakarta')->format('d F Y, H:i') }}
                        </p>
                        <p class="text-gray-600 flex items-center mt-2">
                            <span
                                class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $reservasi->status_badge_class ?? '' }}">
                                {{ $reservasi->status_label ?? ucfirst(str_replace('_', ' ', $reservasi->status)) }}
                            </span>
                        </p>
                    </div>
                    <div class="px-6 pb-6 md:px-8 md:pb-0">
                        @if ($reservasi->status === 'menunggu_konfirmasi')
                            <div
                                class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-6 py-3 rounded-lg font-semibold flex items-center animate-pulse">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                Menunggu Konfirmasi
                            </div>
                        @elseif($reservasi->status === 'disetujui')
                            <div
                                class="bg-green-50 border border-green-200 text-green-800 px-6 py-3 rounded-lg font-semibold flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                Disetujui
                            </div>
                        @elseif($reservasi->status === 'ditolak')
                            <div
                                class="bg-red-50 border border-red-200 text-red-800 px-6 py-3 rounded-lg font-semibold flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                Ditolak
                            </div>
                        @else
                            <div
                                class="bg-gray-50 border border-gray-200 text-gray-800 px-6 py-3 rounded-lg font-semibold flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ ucfirst(str_replace('_', ' ', $reservasi->status)) }}
                            </div>
                        @endif
                    </div>
                </div>

                @if ($reservasi->status === 'menunggu_konfirmasi')
                    <div class="bg-yellow-50 border-t border-yellow-100 px-6 py-4 text-sm text-yellow-700">
                        <div class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Reservasi Anda sedang dalam proses verifikasi. Silakan upload bukti pembayaran jika belum
                                melakukannya.</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Grid Layout -->
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cottage Card -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-green-100 animate-slide-in-left">
                    <div
                        class="relative h-56 bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                        <div class="absolute inset-0 bg-black opacity-20"></div>
                        <div class="relative z-10 text-white text-center p-4">
                            <svg class="w-16 h-16 mx-auto mb-3 opacity-90" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            <span class="text-2xl font-bold tracking-wide">Cottage {{ $reservasi->cottage->nomor }}</span>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Cottage {{ $reservasi->cottage->nomor }}</h3>
                                <p class="text-sm text-gray-500 mt-1">Tipe: {{ $reservasi->cottage->tipe }}</p>
                            </div>
                            <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $reservasi->cottage->kategori }}
                            </div>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-green-600 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                                <span>Kapasitas: <strong>{{ $reservasi->cottage->kapasitas }} Orang</strong></span>
                            </div>

                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-green-600 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Harga: <strong class="text-green-600">Rp
                                        {{ number_format($reservasi->cottage->harga_per_malam, 0, ',', '.') }}</strong> /
                                    malam</span>
                            </div>

                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-green-600 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Check-in: <strong>08:00 WIB</strong> • Check-out: <strong>12:00 WIB</strong></span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                        clip-rule="evenodd" />
                                </svg>
                                Fasilitas:
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach (explode(',', $reservasi->cottage->fasilitas) as $fasilitas)
                                    <span
                                        class="bg-green-50 text-green-800 px-3 py-1 rounded-full text-xs font-medium flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ trim($fasilitas) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        @if ($reservasi->cottage->deskripsi)
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <h4 class="font-semibold text-gray-800 mb-2">Deskripsi Cottage:</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $reservasi->cottage->deskripsi }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-green-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd" />
                        </svg>
                        Akses Cepat
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('pengunjung.dashboard') }}"
                            class="block w-full flex items-center justify-between px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            <span class="font-medium text-gray-700">Kembali ke Dashboard</span>
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Booking Information -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-green-100 animate-slide-in-right">
                    <div class="border-b border-gray-200 px-6 py-5">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Detail Reservasi
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Check-in</label>
                                <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-blue-600 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="font-semibold text-blue-800">
                                        {{ \Carbon\Carbon::parse($reservasi->tanggal_checkin)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Check-out</label>
                                <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-blue-600 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="font-semibold text-blue-800">
                                        {{ \Carbon\Carbon::parse($reservasi->tanggal_checkout)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Lama Menginap</label>
                                <div class="bg-green-50 border border-green-100 rounded-lg p-4 flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-green-600 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="font-semibold text-green-800">
                                        {{ \Carbon\Carbon::parse($reservasi->tanggal_checkin)->diffInDays(\Carbon\Carbon::parse($reservasi->tanggal_checkout)) }}
                                        Malam
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if ($reservasi->catatan)
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-500 mb-2">Catatan Khusus</label>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <p class="text-gray-700">{{ $reservasi->catatan }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Payment Information -->
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden border border-green-100 animate-slide-in-right delay-100">
                    <div class="border-b border-gray-200 px-6 py-5">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zM14 6a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h8zM6 10a2 2 0 012 2H6v-2z" />
                            </svg>
                            Rincian Pembayaran
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Harga per malam:</span>
                                <span class="font-semibold">Rp
                                    {{ number_format($reservasi->cottage->harga_per_malam, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Jumlah malam:</span>
                                <span
                                    class="font-semibold">{{ \Carbon\Carbon::parse($reservasi->tanggal_checkin)->diffInDays(\Carbon\Carbon::parse($reservasi->tanggal_checkout)) }}
                                    malam</span>
                            </div>

                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="font-semibold">Rp
                                    {{ number_format($reservasi->total_harga, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div
                            class="flex justify-between items-center py-4 bg-green-50 rounded-lg px-4 border border-green-100">
                            <span class="text-lg font-bold text-green-800">Total Pembayaran:</span>
                            <span class="text-2xl font-bold text-green-600">Rp
                                {{ number_format($reservasi->total_harga, 0, ',', '.') }}</span>
                        </div>

                        @if ($reservasi->bukti_pembayaran)
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-500 mb-2">Bukti Pembayaran</label>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <svg class="w-10 h-10 text-blue-600 mr-3" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <div>
                                                <p class="font-medium text-gray-800">Bukti Transfer</p>
                                                <p class="text-sm text-gray-500">Diupload pada
                                                    {{ \Carbon\Carbon::parse($reservasi->created_at)->timezone('Asia/Jakarta')->format('d F Y, H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                        <button onclick="viewPaymentProof()"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Lihat
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>


                <!-- Action Buttons -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 animate-slide-in-up delay-100">


                    @if ($reservasi->status === 'menunggu_konfirmasi')
                        <button onclick="cancelReservation()"
                            class="bg-red-600 hover:bg-red-700 text-white py-3 px-6 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Batalkan Reservasi
                        </button>
                    @else
                        <a href="{{ route('cottage.index') }}"
                            class="bg-green-600 hover:bg-green-700 text-white text-center py-3 px-6 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            Pesan Cottage Lain
                        </a>
                        <a href="{{ route('cottage.reservasi.riwayat') }}"
                            class="bg-gray-600 hover:bg-gray-700 text-white text-center py-3 px-6 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm14-7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4Z" />
                            </svg>
                            Lihat Riwayat Reservasi
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Proof Modal -->
    <div id="paymentModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4 transition-opacity duration-300">
        <div
            class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-auto transform transition-all duration-300 scale-95 opacity-0">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Bukti Pembayaran</h3>
                    <button onclick="closePaymentModal()"
                        class="text-gray-500 hover:text-gray-700 rounded-full p-1 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" alt="Bukti Pembayaran"
                        class="w-full h-auto object-contain">
                </div>
                <div class="mt-4 flex justify-end">
                    <button onclick="closePaymentModal()"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        /* Animations */
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-slide-in-down {
            animation: slideInDown 0.6s ease-out forwards;
        }

        .animate-slide-in-left {
            animation: slideInLeft 0.6s ease-out forwards;
        }

        .animate-slide-in-right {
            animation: slideInRight 0.6s ease-out forwards;
        }

        .animate-slide-in-up {
            animation: slideInUp 0.6s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
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

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- JavaScript -->
    <script>
        // Payment Modal Functions
        function viewPaymentProof() {
            const modal = document.getElementById('paymentModal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.querySelector('.bg-white').classList.remove('scale-95', 'opacity-0');
                modal.querySelector('.bg-white').classList.add('scale-100', 'opacity-100');
            }, 10);

            // Prevent scrolling when modal is open
            document.body.style.overflow = 'hidden';
        }

        function closePaymentModal() {
            const modal = document.getElementById('paymentModal');
            modal.querySelector('.bg-white').classList.remove('scale-100', 'opacity-100');
            modal.querySelector('.bg-white').classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        }

        // Cancel Reservation Function
        function cancelReservation() {
            // Create confirmation modal
            const confirmModal = document.createElement('div');
            confirmModal.id = 'confirmModal';
            confirmModal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4';
            confirmModal.innerHTML = `
                <div class="bg-white rounded-xl max-w-md w-full p-6 transform transition-all duration-300 scale-95 opacity-0">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Batalkan Reservasi?</h3>
                        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin membatalkan reservasi ini? Tindakan ini tidak dapat dibatalkan.</p>
                        <div class="flex gap-3">
                            <button onclick="closeConfirmModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 px-4 rounded-lg font-medium transition-colors duration-200">
                                Batal
                            </button>
                            <button onclick="confirmCancelReservation()" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg font-medium transition-colors duration-200">
                                Ya, Batalkan
                            </button>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(confirmModal);
            document.body.style.overflow = 'hidden';

            // Animate modal in
            setTimeout(() => {
                confirmModal.querySelector('.bg-white').classList.remove('scale-95', 'opacity-0');
                confirmModal.querySelector('.bg-white').classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeConfirmModal() {
            const modal = document.getElementById('confirmModal');
            if (modal) {
                modal.querySelector('.bg-white').classList.remove('scale-100', 'opacity-100');
                modal.querySelector('.bg-white').classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    document.body.removeChild(modal);
                    document.body.style.overflow = '';
                }, 300);
            }
        }

        function confirmCancelReservation() {
            const confirmBtn = document.querySelector('#confirmModal button[onclick="confirmCancelReservation()"]');
            confirmBtn.disabled = true;
            confirmBtn.innerHTML = `
                <svg class="animate-spin w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            `;

            // In a real app, you would make an AJAX call here
            setTimeout(() => {
                showNotification('Reservasi berhasil dibatalkan!', 'success');
                closeConfirmModal();

                // Update UI to show cancelled status
                const statusBadge = document.querySelector('.bg-yellow-100, .bg-green-100, .bg-red-100');
                if (statusBadge) {
                    statusBadge.className =
                        'bg-gray-100 text-gray-800 px-6 py-3 rounded-lg font-semibold flex items-center';
                    statusBadge.innerHTML = `
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        Dibatalkan
                    `;
                }

                // Redirect after delay
                setTimeout(() => {
                    window.location.href = "{{ route('cottage.reservasi.riwayat') }}";
                }, 1500);
            }, 1500);
        }

        // Notification function
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-600' : type === 'error' ? 'bg-red-600' : 'bg-blue-600';

            notification.className =
                `fixed top-4 right-4 z-50 transform translate-x-full transition-transform duration-300 ease-out`;
            notification.innerHTML = `
                <div class="${bgColor} text-white px-6 py-4 rounded-lg shadow-lg flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        ${type === 'success' ? 
                          '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>' : 
                          '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>'}
                    </svg>
                    <span class="font-medium">${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
                notification.classList.add('translate-x-0');
            }, 100);

            // Auto remove
            setTimeout(() => {
                notification.classList.remove('translate-x-0');
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        // Print reservation
        function printReservation() {
            window.print();
        }


        // Copy to clipboard
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                showNotification('Link berhasil disalin ke clipboard!', 'success');
            }).catch(() => {
                // Fallback for older browsers
                const textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                showNotification('Link berhasil disalin ke clipboard!', 'success');
            });
        }

        // Initialize animations when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Close modals when clicking outside
            document.addEventListener('click', function(e) {
                const paymentModal = document.getElementById('paymentModal');
                if (paymentModal && !paymentModal.classList.contains('hidden') && e.target ===
                    paymentModal) {
                    closePaymentModal();
                }

                const confirmModal = document.getElementById('confirmModal');
                if (confirmModal && e.target === confirmModal) {
                    closeConfirmModal();
                }
            });

            // Close modals with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const paymentModal = document.getElementById('paymentModal');
                    if (paymentModal && !paymentModal.classList.contains('hidden')) {
                        closePaymentModal();
                    }

                    const confirmModal = document.getElementById('confirmModal');
                    if (confirmModal) {
                        closeConfirmModal();
                    }
                }
            });
        });
    </script>
@endsection
