@extends('admin.layouts.app')

@section('title', 'Detail Testimoni')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-6">
        <div class="mb-4 lg:mb-0">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Detail Testimoni</h1>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('admin.testimoni.index') }}" class="ml-1 md:ml-2 text-blue-600 hover:text-blue-800 transition-colors">
                                Testimoni
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 md:ml-2 text-gray-500 font-medium">Detail</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.testimoni.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Testimoni Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-white">Isi Testimoni</h2>
                    @if($testimoni->status == 'aktif')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Aktif
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            Nonaktif
                        </span>
                    @endif
                </div>
                <div class="p-6">
                    <blockquote class="border-l-4 border-blue-500 pl-6 py-4">
                        <p class="text-gray-700 text-lg leading-relaxed italic">
                            "{{ $testimoni->isi }}"
                        </p>
                    </blockquote>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <!-- User Info -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">Informasi Pengunjung</h3>
                </div>
                <div class="p-6">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-3">
                            {{ strtoupper(substr($testimoni->user->name, 0, 1)) }}
                        </div>
                        <h4 class="text-xl font-semibold text-gray-800 mb-1">{{ $testimoni->user->name }}</h4>
                        <p class="text-gray-600">{{ $testimoni->user->email }}</p>
                    </div>

                    <div class="border-t pt-4">
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="border-r">
                                <div class="text-2xl font-bold text-blue-600">
                                    {{ $testimoni->user->testimonis->count() }}
                                </div>
                                <p class="text-sm text-gray-600">Total Testimoni</p>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-green-600">
                                    {{ $testimoni->user->testimonis->where('status', 'aktif')->count() }}
                                </div>
                                <p class="text-sm text-gray-600">Testimoni Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimoni Info -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">Detail Testimoni</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-700">ID Testimoni:</span>
                        <span class="text-gray-600">#{{ $testimoni->id }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-700">Status:</span>
                        <div>
                            @if($testimoni->status == 'aktif')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Nonaktif
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-700">Tanggal Dibuat:</span>
                        <span class="text-gray-600 text-sm">{{ $testimoni->created_at->format('d F Y, H:i') }} WIB</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-700">Terakhir Update:</span>
                        <span class="text-gray-600 text-sm">{{ $testimoni->updated_at->format('d F Y, H:i') }} WIB</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-700">Jumlah Karakter:</span>
                        <span class="text-gray-600">{{ strlen($testimoni->isi) }} karakter</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">Aksi Moderasi</h3>
                </div>
                <div class="p-6">
                    @if($testimoni->status == 'nonaktif')
                        <form action="{{ route('admin.testimoni.updateStatus', $testimoni) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="aktif">
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center"
                                    onclick="return confirm('Aktifkan testimoni ini untuk ditampilkan di website?')">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Aktifkan Testimoni
                            </button>
                        </form>
                        <p class="text-sm text-gray-600 mt-2">
                            Testimoni akan tampil di halaman website setelah diaktifkan
                        </p>
                    @else
                        <form action="{{ route('admin.testimoni.updateStatus', $testimoni) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="nonaktif">
                            <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center"
                                    onclick="return confirm('Nonaktifkan testimoni ini? Testimoni tidak akan tampil di website.')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <line x1="6" y1="6" x2="18" y2="18" stroke-linecap="round"/>
                                <line x1="6" y1="18" x2="18" y2="6" stroke-linecap="round"/>
                                </svg>
                                Nonaktifkan Testimoni
                            </button>
                        </form>
                        <p class="text-sm text-gray-600 mt-2">
                            Testimoni saat ini aktif dan tampil di website
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
