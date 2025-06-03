@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - Rimba Camp')

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

                <div class="flex justify-center mt-4">
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button
                            type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200"
                        >
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="max-w-7xl mx-auto py-8 px-4">
        <!-- Alert Success -->
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
        @endif

        <!-- Dashboard Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Dashboard Admin</h2>
            <p class="text-gray-600">Kelola Sistem Informasi Reservasi Cottage dan Edukasi Wisata Alam Rimba Camp</p>
        </div>

        <!-- Management Cards - Dipindah ke atas -->
        <div class="mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Menu Manajemen</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                <!-- Card Artikel -->
                <a href="{{ route('admin.artikel.index') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <div class="text-center">
                        <div class="bg-blue-100 p-4 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-newspaper text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Artikel</h3>
                        <p class="text-gray-600 text-sm">Kelola konten edukasi</p>
                    </div>
                </a>

                <!-- Card Cottages -->
                <a href="{{ route('admin.cottages.index') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <div class="text-center">
                        <div class="bg-green-100 p-4 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-home text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Cottages</h3>
                        <p class="text-gray-600 text-sm">Kelola data cottage</p>
                    </div>
                </a>

                <!-- Card Galeri -->
                <a href="#" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <div class="text-center">
                        <div class="bg-purple-100 p-4 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-images text-purple-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Galeri</h3>
                        <p class="text-gray-600 text-sm">Kelola foto wisata</p>
                    </div>
                </a>

                <!-- Card Testimoni -->
                <a href="{{ route('admin.testimoni.index') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <div class="text-center">
                        <div class="bg-yellow-100 p-4 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-comments text-yellow-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Testimoni</h3>
                        <p class="text-gray-600 text-sm">Moderasi ulasan</p>
                    </div>
                </a>

                <!-- Card Reservasi -->
                <a href="#" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <div class="text-center">
                        <div class="bg-orange-100 p-4 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-calendar-check text-orange-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Reservasi</h3>
                        <p class="text-gray-600 text-sm">Kelola pemesanan</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Statistik Pengunjung -->
        <div class="mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Statistik Pengunjung</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Pengunjung Hari Ini -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold">Hari Ini</h3>
                            <p class="text-3xl font-bold" id="pengunjung-hari-ini">-</p>
                            <p class="text-blue-100 text-sm">Pengunjung</p>
                        </div>
                        <div class="bg-blue-400 p-3 rounded-full">
                            <i class="fas fa-eye text-white text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Pengunjung Minggu Ini -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold">Minggu Ini</h3>
                            <p class="text-3xl font-bold" id="pengunjung-minggu-ini">-</p>
                            <p class="text-green-100 text-sm">Pengunjung</p>
                        </div>
                        <div class="bg-green-400 p-3 rounded-full">
                            <i class="fas fa-calendar-week text-white text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Pengunjung Bulan Ini -->
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold">Bulan Ini</h3>
                            <p class="text-3xl font-bold" id="pengunjung-bulan-ini">-</p>
                            <p class="text-purple-100 text-sm">Pengunjung</p>
                        </div>
                        <div class="bg-purple-400 p-3 rounded-full">
                            <i class="fas fa-calendar-alt text-white text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Pengunjung -->
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold">Total</h3>
                            <p class="text-3xl font-bold" id="total-pengunjung">-</p>
                            <p class="text-orange-100 text-sm">Pengunjung</p>
                        </div>
                        <div class="bg-orange-400 p-3 rounded-full">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Statistik -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Grafik Pengunjung</h3>
                <div class="flex space-x-2">
                    <button
                        id="filter-7-days"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 active-filter"
                    >
                        7 Hari
                    </button>
                    <button
                        id="filter-30-days"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200"
                    >
                        30 Hari
                    </button>
                </div>
            </div>
            <div class="relative">
                <canvas id="visitorChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- CSS untuk styling filter buttons -->
    <style>
        .active-filter {
            background-color: #3b82f6 !important;
            color: white !important;
        }
    </style>

    <!-- Script untuk Chart dan AJAX -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        let currentFilter = '7';

        // Load statistik data
        async function loadStatistik() {
            try {
                const response = await fetch('{{ route("admin.statistik.index") }}');
                const data = await response.json();

                // Update cards
                document.getElementById('pengunjung-hari-ini').textContent = data.pengunjung_hari_ini || 0;
                document.getElementById('pengunjung-minggu-ini').textContent = data.pengunjung_minggu_ini || 0;
                document.getElementById('pengunjung-bulan-ini').textContent = data.pengunjung_bulan_ini || 0;
                document.getElementById('total-pengunjung').textContent = data.total_pengunjung || 0;

                // Update chart berdasarkan filter yang aktif
                await loadChartData(currentFilter);
            } catch (error) {
                console.error('Error loading statistik:', error);
            }
        }

        // Load chart data berdasarkan filter
        async function loadChartData(days) {
            try {
                const response = await fetch(`{{ route("admin.statistik.chart") }}?days=${days}`);
                const chartData = await response.json();
                updateChart(chartData);
            } catch (error) {
                console.error('Error loading chart data:', error);
            }
        }

        // Initialize Chart
        let visitorChart;
        function updateChart(chartData) {
            const ctx = document.getElementById('visitorChart').getContext('2d');

            if (visitorChart) {
                visitorChart.destroy();
            }

            visitorChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Pengunjung',
                        data: chartData.data,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }

        // Handle filter button clicks
        document.getElementById('filter-7-days').addEventListener('click', function() {
            currentFilter = '7';
            setActiveFilter(this);
            loadChartData('7');
        });

        document.getElementById('filter-30-days').addEventListener('click', function() {
            currentFilter = '30';
            setActiveFilter(this);
            loadChartData('30');
        });

        // Set active filter styling
        function setActiveFilter(activeButton) {
            // Remove active class from all buttons
            document.querySelectorAll('#filter-7-days, #filter-30-days').forEach(btn => {
                btn.classList.remove('active-filter');
                btn.classList.add('bg-gray-300', 'text-gray-700');
                btn.classList.remove('bg-blue-500', 'text-white');
            });

            // Add active class to clicked button
            activeButton.classList.add('active-filter');
            activeButton.classList.remove('bg-gray-300', 'text-gray-700');
            activeButton.classList.add('bg-blue-500', 'text-white');
        }

        // Load data when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadStatistik();

            // Refresh data every 5 minutes
            setInterval(loadStatistik, 300000);
        });
    </script>
</body>
@endsection
