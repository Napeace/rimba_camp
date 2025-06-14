@extends('admin.layouts.app')

@section('title', 'Detail Cottage ' . $cottage->nomor)

@section('body-class', 'bg-gray-100')

@section('content')
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <i class="fas fa-tree text-green-600 text-2xl mr-3"></i>
                    <h1 class="text-xl font-bold text-gray-800">Rimba Camp Admin</h1>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.cottages.index') }}" class="text-gray-600 hover:text-gray-800 transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Cottages
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="max-w-7xl mx-auto py-8 px-4">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Detail Cottage {{ $cottage->nomor }}</h2>
                    <p class="text-gray-600">Informasi lengkap cottage dan riwayat reservasi</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.cottages.edit', $cottage) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-edit mr-2"></i>Edit Cottage
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Cottage Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Cottage Information Card -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-home text-blue-600 mr-2"></i>
                            Informasi Cottage
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-2">Nomor Cottage</label>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <span class="text-2xl font-bold text-blue-600">{{ $cottage->nomor }}</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-2">Kapasitas</label>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <span class="text-xl font-bold text-orange-600 flex items-center">
                                        <i class="fas fa-users mr-2"></i>
                                        {{ $cottage->kapasitas }} orang
                                    </span>
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500 mb-2">Harga per Malam</label>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <span class="text-3xl font-bold text-green-600">
                                        {{ $cottage->formatted_price }}
                                    </span>
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500 mb-2">Fasilitas</label>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    @php
                                        $fasilitas = explode(', ', $cottage->fasilitas);
                                    @endphp
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($fasilitas as $item)
                                            <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                {{ trim($item) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards - BAGIAN YANG DIPERBAIKI -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-md p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold">Total Reservasi</h3>
                                <p class="text-3xl font-bold">{{ $cottage->reservasi->count() }}</p>
                            </div>
                            <div class="bg-blue-400 p-3 rounded-full">
                                <i class="fas fa-calendar-check text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-md p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold">Reservasi Aktif</h3>
                                {{-- PERBAIKAN: Gunakan status bahasa Indonesia yang sesuai dengan database --}}
                                <p class="text-3xl font-bold">{{ $cottage->reservasi->whereIn('status_reservasi', ['menunggu_konfirmasi', 'disetujui'])->count() }}</p>
                            </div>
                            <div class="bg-green-400 p-3 rounded-full">
                                <i class="fas fa-check-circle text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-md p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold">Total Pendapatan</h3>
                                {{-- PERBAIKAN: Hitung pendapatan dari reservasi yang disetujui (karena belum ada status 'completed') --}}
                                <p class="text-xl font-bold">
                                    Rp {{ number_format($cottage->reservasi->where('status_reservasi', 'disetujui')->sum('total_harga'), 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="bg-purple-400 p-3 rounded-full">
                                <i class="fas fa-money-bill-wave text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Availability Checker -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-calendar-alt text-green-600 mr-2"></i>
                            Cek Ketersediaan
                        </h3>
                    </div>
                    <div class="p-6">
                        <form id="availabilityForm" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Check-in</label>
                                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="checkin" required min="{{ date('Y-m-d') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Check-out</label>
                                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="checkout" required>
                            </div>
                            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition duration-200">
                                <i class="fas fa-search mr-2"></i>Cek Ketersediaan
                            </button>
                        </form>
                        <div id="availabilityResult" class="mt-4 hidden"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent reservasi -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mt-6">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-history text-blue-600 mr-2"></i>
                    Riwayat Reservasi Terbaru
                </h3>
            </div>

            @if($cottage->reservasi->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tamu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-out</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Reservasi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($cottage->reservasi as $reservation)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-blue-500 rounded-full flex items-center justify-center w-10 h-10 mr-3">
                                        <span class="text-white font-bold text-sm">
                                            {{ strtoupper(substr($reservation->user->name ?? 'Guest', 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $reservation->user->name ?? 'Guest' }}</div>
                                        <div class="text-sm text-gray-500">{{ $reservation->user->email ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($reservation->tanggal_checkin)->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($reservation->tanggal_checkout)->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $checkin = \Carbon\Carbon::parse($reservation->tanggal_checkin);
                                    $checkout = \Carbon\Carbon::parse($reservation->tanggal_checkout);
                                    $duration = $checkin->diffInDays($checkout);
                                @endphp
                                <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $duration }} malam</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-green-600">
                                    Rp {{ number_format($reservation->total_harga ?? 0, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'confirmed' => 'bg-green-100 text-green-800',
                                        'checked_in' => 'bg-blue-100 text-blue-800',
                                        'completed' => 'bg-purple-100 text-purple-800',
                                        'cancelled' => 'bg-red-100 text-red-800'
                                    ];
                                    $statusLabels = [
                                        'pending' => 'Menunggu',
                                        'confirmed' => 'Dikonfirmasi',
                                        'checked_in' => 'Check-in',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan'
                                    ];
                                @endphp
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$reservation->status_reservasi] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusLabels[$reservation->status_reservasi] ?? ucfirst($reservation->status_reservasi) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $reservation->created_at->format('d M Y H:i') }}</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-12">
                <i class="fas fa-calendar-times text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum Ada Reservasi</h3>
                <p class="text-gray-500">Cottage ini belum memiliki riwayat reservasi.</p>
            </div>
            @endif
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.getElementById('availabilityForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const resultDiv = document.getElementById('availabilityResult');

            // Show loading
            resultDiv.classList.remove('hidden');
            resultDiv.innerHTML = '<div class="text-center text-gray-600 p-4"><i class="fas fa-spinner fa-spin mr-2"></i>Mengecek ketersediaan...</div>';

            // Get form values
            const checkin = formData.get('checkin');
            const checkout = formData.get('checkout');

            // Validasi client-side
            if (!checkin || !checkout) {
                resultDiv.innerHTML = `
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2 text-red-600"></i>
                            <div>
                                <strong>Data Tidak Lengkap</strong>
                                <p class="text-sm mt-1">Silakan pilih tanggal check-in dan check-out</p>
                            </div>
                        </div>
                    </div>
                `;
                return;
            }

            if (new Date(checkout) <= new Date(checkin)) {
                resultDiv.innerHTML = `
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2 text-red-600"></i>
                            <div>
                                <strong>Tanggal Tidak Valid</strong>
                                <p class="text-sm mt-1">Tanggal check-out harus setelah tanggal check-in</p>
                            </div>
                        </div>
                    </div>
                `;
                return;
            }

            // PERBAIKAN: Gunakan POST request dengan CSRF token dan form data
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`{{ route('admin.cottages.availability', $cottage) }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    checkin: checkin,
                    checkout: checkout
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Availability response:', data); // Debug log

                let resultHtml = '';

                if (data.available) {
                    // Cottage tersedia
                    resultHtml = `
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-2 text-green-600"></i>
                                <div>
                                    <strong>Cottage Tersedia!</strong>
                                    <p class="text-sm mt-1">${data.message}</p>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    // Cottage tidak tersedia
                    let conflictInfo = '';
                    if (data.conflicting_reservations && data.conflicting_reservations.length > 0) {
                        conflictInfo = '<div class="mt-3 space-y-2"><p class="text-sm font-medium text-red-700">Reservasi yang bentrok:</p>';
                        data.conflicting_reservations.forEach(reservation => {
                            conflictInfo += `
                                <div class="bg-red-50 border border-red-200 rounded p-2 text-sm">
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium">${reservation.guest}</span>
                                        <span class="text-xs text-red-600">${reservation.status}</span>
                                    </div>
                                    <div class="text-red-600 text-xs mt-1">
                                        ${reservation.checkin} - ${reservation.checkout}
                                    </div>
                                </div>
                            `;
                        });
                        conflictInfo += '</div>';
                    }

                    resultHtml = `
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                            <div class="flex items-start">
                                <i class="fas fa-times-circle mr-2 text-red-600 mt-0.5"></i>
                                <div class="flex-1">
                                    <strong>Cottage Tidak Tersedia</strong>
                                    <p class="text-sm mt-1">${data.message}</p>
                                    ${conflictInfo}
                                </div>
                            </div>
                        </div>
                    `;
                }

                // Tambahkan debug info jika ada
                if (data.debug_info) {
                    resultHtml += `
                        <div class="mt-2 text-xs text-gray-500 bg-gray-50 p-2 rounded">
                            <strong>Debug Info:</strong>
                            Cottage ID: ${data.debug_info.cottage_id},
                            Status: ${data.debug_info.cottage_status},
                            Total Reservasi: ${data.debug_info.total_reservations},
                            Reservasi Aktif: ${data.debug_info.active_reservations}
                        </div>
                    `;
                }

                resultDiv.innerHTML = resultHtml;
            })
            .catch(error => {
                console.error('Error:', error);
                resultDiv.innerHTML = `
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2 text-red-600"></i>
                            <div>
                                <strong>Terjadi Kesalahan</strong>
                                <p class="text-sm mt-1">Tidak dapat mengecek ketersediaan cottage. Error: ${error.message}</p>
                            </div>
                        </div>
                    </div>
                `;
            });
        });
    </script>
</body>
@endsection
