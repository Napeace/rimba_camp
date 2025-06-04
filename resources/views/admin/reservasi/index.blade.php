@extends('admin.layouts.app')

@section('title', 'Manajemen Reservasi')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Manajemen Reservasi</h1>
                    <p class="mt-2 text-gray-600">Kelola semua reservasi cottage dari dashboard ini</p>
                </div>
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Reservasi</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $statistics['total'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Menunggu</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $statistics['menunggu_konfirmasi'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Disetujui</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $statistics['disetujui'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Ditolak</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $statistics['ditolak'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Filter Reservasi</h3>
                <form method="GET" action="{{ route('admin.reservasi.index') }}" class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <div class="flex-1 w-full">
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Status</option>
                            @foreach($statusList as $key => $label)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2 w-full sm:w-auto">
                        <button type="submit" class="flex-1 sm:flex-none px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Filter
                        </button>
                        <a href="{{ route('admin.reservasi.index') }}" class="flex-1 sm:flex-none px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 text-center">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Reservations Cards -->
        <div class="space-y-4">
            @forelse($reservasis as $reservasi)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition-shadow duration-200">
                    <div class="p-6">
                        <!-- Header Card dengan Status -->
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-4">
                            <div class="flex items-center space-x-3 mb-3 sm:mb-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $reservasi->user?->name ?? 'User tidak ditemukan' }}</h3>
                                    <p class="text-sm text-gray-500">{{ $reservasi->user?->email ?? 'Email tidak tersedia' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between sm:justify-end space-x-3">
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $reservasi->status_badge_class }}">
                                    {{ $reservasi->status_label }}
                                </span>
                            </div>
                        </div>

                        <!-- Content Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                            <!-- Cottage Info -->
                            <div class="space-y-2">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Cottage</h4>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    <span class="text-gray-900 font-medium">Cottage {{ $reservasi->cottage?->nomor ?? 'N/A' }}</span>
                                </div>
                                <p class="text-sm text-gray-600">{{ $reservasi->durasi_menginap }} hari menginap</p>
                            </div>

                            <!-- Date Info -->
                            <div class="space-y-2">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Tanggal</h4>
                                <div class="space-y-1">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span class="text-sm text-gray-900">Check-in: {{ $reservasi->tanggal_checkin->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span class="text-sm text-gray-900">Check-out: {{ $reservasi->tanggal_checkout->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Info -->
                            <div class="space-y-2">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Pembayaran</h4>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                    <span class="text-lg font-bold text-gray-900">{{ $reservasi->formatted_total }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between pt-4 border-t border-gray-200 space-y-3 sm:space-y-0 sm:space-x-3">
                            <div class="flex space-x-2 flex-1">
                                <button onclick="showDetail({{ $reservasi->id }})"
                                        class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-md hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Detail
                                </button>
                            </div>

                            <div class="relative">
                                <button onclick="toggleStatusDropdown({{ $reservasi->id }})"
                                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-md hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Ubah Status
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div id="status-dropdown-{{ $reservasi->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 border dropdown-menu">
                                    @foreach($statusList as $statusKey => $statusLabel)
                                        @if($statusKey !== $reservasi->status_reservasi)
                                        <button onclick="updateStatus({{ $reservasi->id }}, '{{ $statusKey }}')"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                            {{ $statusLabel }}
                                        </button>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada reservasi</h3>
                    <p class="text-gray-500">Belum ada data reservasi yang ditemukan untuk filter yang dipilih.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($reservasis->hasPages())
            <div class="mt-8 bg-white rounded-lg shadow p-4">
                {{ $reservasis->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-4 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white my-8">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Detail Reservasi</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="modalContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-40">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex items-center">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            <span class="ml-3 text-gray-700">Memproses...</span>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('[id^="status-dropdown-"]');
        dropdowns.forEach(dropdown => {
            if (!dropdown.contains(event.target) && !event.target.closest(`button[onclick*="toggleStatusDropdown"]`)) {
                dropdown.classList.add('hidden');
            }
        });
    });

    function toggleStatusDropdown(id) {
        // Tutup semua dropdown yang lain terlebih dahulu
        const allDropdowns = document.querySelectorAll('[id^="status-dropdown-"]');
        allDropdowns.forEach(dropdown => {
            if (dropdown.id !== `status-dropdown-${id}`) {
                dropdown.classList.add('hidden');
            }
        });

        const dropdown = document.getElementById(`status-dropdown-${id}`);

        // Toggle dropdown - sederhana saja
        dropdown.classList.toggle('hidden');

        // Jika dropdown terbuka, pastikan posisinya benar
        if (!dropdown.classList.contains('hidden')) {
            const button = dropdown.previousElementSibling;
            const buttonRect = button.getBoundingClientRect();
            const dropdownHeight = 120;
            const viewportHeight = window.innerHeight;

            // Reset classes
            dropdown.classList.remove('mt-2', 'mb-2', 'bottom-full');

            // Jika tidak cukup ruang di bawah, tampilkan di atas
            if (buttonRect.bottom + dropdownHeight > viewportHeight - 20) {
                dropdown.classList.add('mb-2', 'bottom-full');
            } else {
                dropdown.classList.add('mt-2');
            }
        }
    }

    function showDetail(id) {
        showLoading();

        fetch(`/admin/reservasi/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const reservation = data.data;
                    document.getElementById('modalContent').innerHTML = `
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium text-gray-900 mb-3">Informasi Tamu</h4>
                                <div class="space-y-2 text-sm">
                                    <div><strong>Nama:</strong> ${reservation.user?.name || 'User tidak ditemukan'}</div>
                                    <div><strong>Email:</strong> ${reservation.user?.email || 'Email tidak tersedia'}</div>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-medium text-gray-900 mb-3">Informasi Cottage</h4>
                                <div class="space-y-2 text-sm">
                                    <div><strong>Nomor:</strong> ${reservation.cottage.nomor}</div>
                                    <div><strong>Kapasitas:</strong> ${reservation.cottage.kapasitas} orang</div>
                                    <div><strong>Harga per malam:</strong> Rp ${new Intl.NumberFormat('id-ID').format(reservation.cottage.harga_per_malam)}</div>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-medium text-gray-900 mb-3">Detail Reservasi</h4>
                                <div class="space-y-2 text-sm">
                                    <div><strong>Check-in:</strong> ${reservation.tanggal_checkin}</div>
                                    <div><strong>Check-out:</strong> ${reservation.tanggal_checkout}</div>
                                    <div><strong>Durasi:</strong> ${reservation.durasi_menginap} hari</div>
                                    <div><strong>Status:</strong> <span class="px-2 py-1 text-xs rounded-full bg-gray-100">${reservation.status_label}</span></div>
                                    <div><strong>Dibuat pada:</strong> ${reservation.created_at}</div>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-medium text-gray-900 mb-3">Bukti Pembayaran</h4>
                                ${reservation.bukti_pembayaran ?
                                    `<img src="/storage/${reservation.bukti_pembayaran}" alt="Bukti Pembayaran" class="w-full h-48 object-cover rounded border">` :
                                    '<p class="text-gray-500 text-sm">Belum ada bukti pembayaran</p>'
                                }
                            </div>
                        </div>
                    `;

                    hideLoading();
                    document.getElementById('detailModal').classList.remove('hidden');
                }
            })
            .catch(error => {
                hideLoading();
                alert('Gagal memuat detail reservasi');
                console.error('Error:', error);
            });
    }

    function updateStatus(id, status) {
        if (!confirm('Apakah Anda yakin ingin mengubah status reservasi ini?')) {
            return;
        }

        showLoading();

        fetch(`/admin/reservasi/${id}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            hideLoading();

            if (data.success) {
                // Update status badge in the card
                const card = document.querySelector(`button[onclick*="toggleStatusDropdown(${id})"]`).closest('.bg-white');
                const statusBadge = card.querySelector('span[class*="inline-flex"]');
                statusBadge.textContent = data.data.status_label;
                statusBadge.className = `inline-flex px-3 py-1 text-sm font-semibold rounded-full ${data.data.status_badge_class}`;

                // Hide dropdown
                document.getElementById(`status-dropdown-${id}`).classList.add('hidden');
                alert(data.message);
            } else {
                alert(data.message || 'Gagal mengubah status reservasi');
            }
        })
        .catch(error => {
            hideLoading();
            console.error('Error details:', error);
            alert('Terjadi kesalahan saat mengubah status: ' + error.message);
        });
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    function showLoading() {
        document.getElementById('loadingOverlay').classList.remove('hidden');
    }

    function hideLoading() {
        document.getElementById('loadingOverlay').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('detailModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal();
        }
    });
</script>
@endpush
