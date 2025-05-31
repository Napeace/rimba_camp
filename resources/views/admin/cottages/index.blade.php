@extends('admin.layouts.app')

@section('title', 'Manajemen Cottages - Rimba Camp')

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
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-800 transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Dashboard
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
        <!-- Alert Messages -->
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        </div>
        @endif

        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Manajemen Cottages</h2>
                    <p class="text-gray-600">Kelola data cottage dan fasilitas Rimba Camp</p>
                </div>
                <a href="{{ route('admin.cottages.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Tambah Cottage
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Total Cottage</h3>
                        <p class="text-3xl font-bold">{{ $cottages->total() }}</p>
                    </div>
                    <div class="bg-blue-400 p-3 rounded-full">
                        <i class="fas fa-home text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Harga Terendah</h3>
                        <p class="text-2xl font-bold" id="min-price">Loading...</p>
                    </div>
                    <div class="bg-green-400 p-3 rounded-full">
                        <i class="fas fa-tag text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Harga Tertinggi</h3>
                        <p class="text-2xl font-bold" id="max-price">Loading...</p>
                    </div>
                    <div class="bg-purple-400 p-3 rounded-full">
                        <i class="fas fa-gem text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Rata-rata Kapasitas</h3>
                        <p class="text-3xl font-bold" id="avg-capacity">Loading...</p>
                    </div>
                    <div class="bg-orange-400 p-3 rounded-full">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <form method="GET" action="{{ route('admin.cottages.index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Nomor atau fasilitas..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kapasitas Min</label>
                    <input type="number" name="capacity" value="{{ request('capacity') }}"
                           placeholder="Min orang"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga Min</label>
                    <input type="number" name="min_price" value="{{ request('min_price') }}"
                           placeholder="Rp"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga Max</label>
                    <input type="number" name="max_price" value="{{ request('max_price') }}"
                           placeholder="Rp"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="flex items-end space-x-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                    <a href="{{ route('admin.cottages.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-undo mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Cottages Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Cottage</h3>
            </div>

            @if($cottages->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'nomor', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                                   class="hover:text-gray-700">
                                    Nomor
                                    @if(request('sort_by') === 'nomor')
                                        <i class="fas fa-sort-{{ request('sort_order') === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'kapasitas', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                                   class="hover:text-gray-700">
                                    Kapasitas
                                    @if(request('sort_by') === 'kapasitas')
                                        <i class="fas fa-sort-{{ request('sort_order') === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fasilitas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'harga_per_malam', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                                   class="hover:text-gray-700">
                                    Harga/Malam
                                    @if(request('sort_by') === 'harga_per_malam')
                                        <i class="fas fa-sort-{{ request('sort_order') === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'status', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}"
                                   class="hover:text-gray-700">
                                    Status
                                    @if(request('sort_by') === 'status')
                                        <i class="fas fa-sort-{{ request('sort_order') === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($cottages as $cottage)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-blue-100 p-2 rounded-full mr-3">
                                        <i class="fas fa-home text-blue-600"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">{{ $cottage->nomor }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-users text-gray-400 mr-2"></i>
                                    <span class="text-sm text-gray-900">{{ $cottage->kapasitas }} orang</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs">
                                    @php
                                        $fasilitas = explode(', ', $cottage->fasilitas);
                                        $displayFasilitas = array_slice($fasilitas, 0, 3);
                                        $remainingCount = count($fasilitas) - 3;
                                    @endphp
                                    @foreach($displayFasilitas as $item)
                                        <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ $item }}</span>
                                    @endforeach
                                    @if($remainingCount > 0)
                                        <span class="text-xs text-gray-500">+{{ $remainingCount }} lainnya</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-green-600">{{ $cottage->formatted_price }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($cottage->status === 'aktif')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.cottages.show', $cottage) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition duration-200"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.cottages.edit', $cottage) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition duration-200"
                                       title="Edit Cottage">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.cottages.toggle-status', $cottage) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin {{ $cottage->status === 'aktif' ? 'menonaktifkan' : 'mengaktifkan' }} cottage ini?')">
                                        @csrf
                                        @method('PATCH')
                                        @if($cottage->status === 'aktif')
                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition duration-200"
                                                    title="Nonaktifkan Cottage">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        @else
                                            <button type="submit"
                                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition duration-200"
                                                    title="Aktifkan Cottage">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $cottages->links() }}
            </div>
            @else
            <div class="text-center py-12">
                <i class="fas fa-home text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-600 mb-2">Tidak ada cottage ditemukan</h3>
                <p class="text-gray-500 mb-4">Belum ada data cottage atau hasil pencarian tidak ditemukan</p>
                <a href="{{ route('admin.cottages.create') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Tambah Cottage Pertama
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Load statistics
        async function loadStatistics() {
            try {
                const response = await fetch('{{ route("admin.cottages.statistics") }}');
                const data = await response.json();

                document.getElementById('min-price').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.min_price);
                document.getElementById('max-price').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.max_price);
                document.getElementById('avg-capacity').textContent = Math.round(data.avg_capacity) + ' orang';
            } catch (error) {
                console.error('Error loading statistics:', error);
            }
        }

        // Load statistics when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadStatistics();
        });
    </script>
</body>
@endsection
