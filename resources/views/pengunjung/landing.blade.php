{{-- resources/views/pengunjung/landing.blade.php --}}
@extends('pengunjung.layouts.app')

@section('title', 'RimbaCamp')

@section('content')
    {{-- Hero Section --}}
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        {{-- Background with Forest Theme --}}
        <div class="absolute inset-0 z-0">
            <div class="w-full h-full bg-gradient-to-br from-emerald-600 via-green-700 to-forest-800"
                style="background: linear-gradient(135deg, #059669 0%, #047857 50%, #064e3b 100%);"></div>
            {{-- Overlay --}}
            <div class="absolute inset-0 bg-black opacity-20"></div>
        </div>

        {{-- Floating Forest Elements --}}
        <div class="absolute top-20 left-20 w-32 h-32 bg-green-400 bg-opacity-10 rounded-full animate-bounce"
            style="animation-delay: 0s; animation-duration: 3s;"></div>
        <div class="absolute top-40 right-32 w-24 h-24 bg-emerald-300 bg-opacity-15 rounded-full animate-bounce"
            style="animation-delay: 1s; animation-duration: 4s;"></div>
        <div class="absolute bottom-32 left-40 w-20 h-20 bg-lime-400 bg-opacity-10 rounded-full animate-bounce"
            style="animation-delay: 2s; animation-duration: 3.5s;"></div>

        {{-- Hero Content --}}
        <div class="relative z-10 text-center text-white px-4 max-w-5xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
                Selamat Datang di
                <span class="bg-gradient-to-r from-lime-400 to-green-500 bg-clip-text text-transparent">RimbaCamp</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-green-100 animate-slide-up max-w-3xl mx-auto">
                Nikmati pengalaman camping yang tak terlupakan di tengah rimba hijau dengan fasilitas cottage terbaik
                dan suasana alam yang menyegarkan
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-slide-up" style="animation-delay: 0.5s;">
                <a href="#cottages"
                    class="bg-gradient-to-r from-emerald-500 to-green-600 text-white px-8 py-4 rounded-full font-semibold hover:from-emerald-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-2xl">
                    <i class="fas fa-campground mr-2"></i>
                    Jelajahi Cottage
                </a>
                <a href="#gallery"
                    class="border-2 border-lime-400 text-lime-400 px-8 py-4 rounded-full font-semibold hover:bg-lime-400 hover:text-green-900 transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-images mr-2"></i>
                    Lihat Galeri
                </a>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-lime-400 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-lime-400 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>

    {{-- Features Section - Fixed Layout --}}
    <section id="features" class="pt-32 pb-20 bg-gradient-to-br from-lime-100 via-green-100 to-emerald-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl font-bold text-green-900 mb-4">Mengapa Memilih RimbaCamp?</h2>
                <p class="text-xl text-green-700 max-w-3xl mx-auto">
                    Kami menyediakan pengalaman cottage terbaik dengan fasilitas lengkap di tengah keindahan alam rimba
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Feature 1 --}}
                <div
                    class="text-center group hover-lift animate-on-scroll bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-lime-400 to-green-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-tree text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-green-900 mb-4">Suasana Rimba Asri</h3>
                    <p class="text-green-700">
                        Nikmati udara segar dan pemandangan hutan hijau yang menenangkan langsung dari tenda cottage Anda
                    </p>
                </div>

                {{-- Feature 2 --}}
                <div
                    class="text-center group hover-lift animate-on-scroll bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-lime-400 to-green-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-campground text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-green-900 mb-4">Cottage Mewah</h3>
                    <p class="text-green-700">
                        Tenda berkualitas tinggi dengan fasilitas modern seperti kasur nyaman, listrik, dan kamar mandi
                        pribadi
                    </p>
                </div>

                {{-- Feature 3 --}}
                <div
                    class="text-center group hover-lift animate-on-scroll bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-lime-400 to-green-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-fire text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-green-900 mb-4">Aktivitas Seru</h3>
                    <p class="text-green-700">
                        Api unggun, hiking, bird watching, dan berbagai aktivitas outdoor yang menyenangkan
                    </p>
                </div>

                {{-- Feature 4 --}}
                <div
                    class="text-center group hover-lift animate-on-scroll bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-lime-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-utensils text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-green-900 mb-4">Kuliner Alam</h3>
                    <p class="text-green-700">
                        Menu makanan segar dan sehat dengan cita rasa lokal yang diolah dari bahan-bahan alami
                    </p>
                </div>

                {{-- Feature 5 --}}
                <div
                    class="text-center group hover-lift animate-on-scroll bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-lime-400 to-green-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-green-900 mb-4">Keamanan Terjamin</h3>
                    <p class="text-green-700">
                        Area camping yang aman dengan penjagaan 24 jam dan fasilitas keamanan yang memadai
                    </p>
                </div>

                {{-- Feature 6 --}}
                <div
                    class="text-center group hover-lift animate-on-scroll bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-lime-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-leaf text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-green-900 mb-4">Eco-Friendly</h3>
                    <p class="text-green-700">
                        Konsep ramah lingkungan dengan penggunaan energi terbarukan dan pengelolaan limbah yang baik
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- cottage Options Section --}}
    <section id="cottages" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl font-bold text-green-900 mb-4">Pilihan Cottage Kami</h2>
                <p class="text-xl text-green-700 max-w-3xl mx-auto">
                    Berbagai tipe cottage dengan fasilitas dan suasana yang berbeda sesuai kebutuhan Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($cottages as $cottage)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift animate-on-scroll border border-green-100 cursor-pointer group transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl"
                        tabindex="0" role="button" aria-label="Lihat detail {{ $cottage->name }}">
                        <div class="h-48 bg-gradient-to-br from-emerald-400 to-green-500 relative">
                            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                            <div
                                class="absolute top-4 left-4 bg-white bg-opacity-90 px-3 py-1 rounded-full text-sm font-semibold text-green-700">
                                tersedia
                            </div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-xl font-bold">{{ $cottage->name }}</h3>
                                <p class="text-sm opacity-90">{{ $cottage->capacity }} Orang • {{ $cottage->view }}</p>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-1">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < floor($cottage->rating))
                                            <i class="fas fa-star text-yellow-400"></i>
                                        @elseif ($i < ceil($cottage->rating))
                                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                                        @else
                                            <i class="fas fa-star text-gray-300"></i>
                                        @endif
                                    @endfor
                                    <span
                                        class="text-gray-600 text-sm ml-2">({{ number_format($cottage->rating, 1) }})</span>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-green-600">Rp {{ number_format($cottage->price) }}K
                                    </div>
                                    <div class="text-sm text-gray-500">/malam</div>
                                </div>
                            </div>
                            <div class="space-y-2 mb-6">
                                @if ($cottage->bed_type)
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-bed w-4 text-green-600"></i>
                                        <span class="ml-2">{{ $cottage->bed_type }}</span>
                                    </div>
                                @endif
                                @if ($cottage->bathroom)
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-shower w-4 text-green-600"></i>
                                        <span class="ml-2">{{ $cottage->bathroom }}</span>
                                    </div>
                                @endif
                                @if ($cottage->view)
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-tree w-4 text-green-600"></i>
                                        <span class="ml-2">View {{ $cottage->view }}</span>
                                    </div>
                                @endif

                                {{-- Facilities --}}
                                @if ($cottage->facilities)
                                    @php
                                        $facilities = is_string($cottage->facilities)
                                            ? explode(',', $cottage->facilities)
                                            : $cottage->facilities;
                                    @endphp
                                    @if (count($facilities) > 0)
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            @foreach ($facilities as $facility)
                                                <span
                                                    class="inline-flex items-center bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                    <i class="fas fa-check mr-1"></i>
                                                    {{ is_object($facility) ? $facility->name ?? '' : trim($facility) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <a href="{{ route('cottage.show', $cottage->id) }}"
                                class="w-full bg-gradient-to-r from-emerald-500 to-green-600 text-white py-3 rounded-lg font-semibold hover:from-emerald-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-green-400 focus:ring-opacity-50 flex justify-center items-center"
                                aria-label="Lihat detail {{ $cottage->id }}">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12 animate-on-scroll">
                <a href="{{ route('cottage.index') }}"
                    class="inline-flex items-center bg-gradient-to-r from-emerald-500 to-green-600 text-white px-8 py-4 rounded-full font-semibold hover:from-emerald-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-xl">
                    <span>Lihat Semua cottage</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>


    {{-- Gallery Section --}}
    <section id="gallery"
        class="py-20 bg-gradient-to-br from-green-50 via-emerald-50 to-teal-100 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60"
            xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%2322c55e"
            fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="4" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]
            opacity-30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl font-bold text-green-900 mb-4">
                    Galeri RimbaCamp
                </h2>
                <p class="text-xl text-green-700 max-w-3xl mx-auto leading-relaxed">
                    Lihat keindahan alam dan fasilitas cottage kami melalui koleksi foto-foto terbaik
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-green-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($galeris as $galeri)
                    <div
                        class="group relative overflow-hidden rounded-3xl shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-rotate-1 transition-all duration-700 ease-out bg-white p-2">
                        <div class="relative overflow-hidden rounded-2xl">
                            <img src="{{ asset('storage/galeri/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}"
                                class="h-72 w-full object-cover rounded-2xl brightness-95 group-hover:brightness-110 group-hover:scale-110 transition-all duration-700 ease-out filter group-hover:saturate-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-0 group-hover:opacity-20 transform -skew-x-12 group-hover:animate-pulse transition-opacity duration-500">
                            </div>
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90 group-hover:opacity-70 transition-all duration-500 rounded-2xl">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                                <h3
                                    class="text-2xl font-bold mb-3 drop-shadow-lg group-hover:text-emerald-300 transition-colors duration-300">
                                    {{ $galeri->judul }}
                                </h3>
                                <p
                                    class="text-sm opacity-90 max-w-xs drop-shadow-md leading-relaxed group-hover:opacity-100 transition-opacity duration-300">
                                    {{ $galeri->deskripsi }}
                                </p>
                            </div>
                            <div
                                class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300 delay-200">
                                <button
                                    class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 shadow-xl border border-white/30 hover:scale-110 transition-all duration-300">
                                    <i class="fas fa-expand text-white text-lg"></i>
                                </button>
                            </div>

                            <div
                                class="absolute top-4 left-4 opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300 delay-100">
                                <button
                                    class="w-10 h-10 bg-red-500/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-red-600/90 shadow-lg border border-white/30 hover:scale-110 transition-all duration-300">
                                    <i class="fas fa-heart text-white text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-16 animate-on-scroll">
                <a href="{{ route('galeri.index') }}"
                    class="group inline-flex items-center bg-gradient-to-r from-emerald-500 to-green-600 text-white px-8 py-4 rounded-full font-semibold text-base hover:from-emerald-600 hover:to-green-700 transition-all duration-500 transform hover:scale-105 hover:-translate-y-1 shadow-xl hover:shadow-2xl border-2 border-transparent hover:border-white/20">
                    <span class="mr-2">Lihat Semua Foto</span>
                    <i class="fas fa-images text-lg group-hover:animate-bounce"></i>
                    <div
                        class="absolute inset-0 bg-white/20 rounded-full scale-0 group-hover:scale-100 transition-transform duration-500 -z-10">
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Artikel Section --}}
    <section id="articles" class="py-20 bg-gradient-to-b from-white to-gray-50 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="40" height="40" viewBox="0 0 40 40"
            xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%2316a34a" fill-opacity="0.03"%3E%3Cpath
            d="M20 20L0 0h40v40z" /%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl font-bold text-green-900 mb-4">
                    Artikel Terbaru
                </h2>
                <p class="text-xl text-green-700 max-w-3xl mx-auto leading-relaxed">
                    Temukan tips, cerita, dan informasi menarik seputar cottage dan alam di blog kami
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-green-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($artikels as $artikel)
                    <article
                        class="group bg-white rounded-3xl shadow-xl hover:shadow-2xl p-6 transition-all duration-700 ease-out transform hover:scale-105 hover:-translate-y-2 border border-green-100 hover:border-green-200 relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-100 to-emerald-100 rounded-full transform translate-x-16 -translate-y-16 group-hover:scale-150 transition-transform duration-700">
                        </div>
                        <div class="relative overflow-hidden rounded-2xl mb-6 shadow-lg">
                            <img src="{{ $artikel->image_url ?? 'https://source.unsplash.com/featured/?camping,nature' }}"
                                alt="{{ $artikel->title }}"
                                class="w-full h-48 object-cover rounded-2xl group-hover:scale-110 transition-transform duration-700 filter group-hover:brightness-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl flex items-end justify-start p-4">
                                <span
                                    class="text-white text-sm font-medium bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full border border-white/30">
                                    <i class="fas fa-clock mr-1"></i>Baca 5 menit
                                </span>
                            </div>

                        </div>

                        <div class="relative z-10">
                            <h3
                                class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-700 transition-colors duration-300 leading-tight">
                                {{ $artikel->title }}
                            </h3>
                            <p
                                class="text-gray-600 mb-6 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">
                                {{ Str::limit($artikel->excerpt ?? $artikel->content, 100) }}
                            </p>

                            <div class="flex items-center justify-between mb-4 text-sm text-gray-500">
                                <div class="flex items-center space-x-4">
                                    <span><i class="fas fa-user mr-1"></i>Admin</span>
                                    <span><i class="fas fa-calendar mr-1"></i>{{ date('d M Y') }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-eye text-green-500"></i>
                                    <span>124</span>
                                </div>
                            </div>

                            <a href="{{ route('detail.artikel', ['id' => $artikel->id]) }}"
                                class="group/btn inline-flex items-center text-green-600 font-bold hover:text-green-700 transition-all duration-300 relative">
                                <span class="mr-2">Lihat Detail</span>
                                <i
                                    class="fas fa-arrow-right group-hover/btn:translate-x-2 transition-transform duration-300"></i>
                                <div
                                    class="absolute bottom-0 left-0 w-0 h-0.5 bg-green-600 group-hover/btn:w-full transition-all duration-300">
                                </div>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Location Section --}}
    <section id="location" class="py-20 relative"
        style="background-image: url('/storage/images/location-bg.png'); background-size: cover; background-position: center;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll bg-white bg-opacity-70 p-10 rounded-xl shadow-lg">
                <h2 class="text-4xl font-bold text-green-900 mb-4">Lokasi RimbaCamp</h2>
                <p class="text-xl text-green-700 max-w-3xl mx-auto leading-relaxed">
                    Temukan lokasi RimbaCamp kami yang asri dan mudah diakses. Klik link di bawah ini untuk melihat lokasi
                    secara langsung di Google Maps.
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-green-600 mx-auto mt-6 rounded-full"></div>
                <a href="https://maps.app.goo.gl/tYxpiNdahiSqqDxQ8" target="_blank" rel="noopener noreferrer"
                    class="inline-block mt-8 px-8 py-4 bg-gradient-to-r from-emerald-500 to-green-600 text-white rounded-full font-semibold hover:from-emerald-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-xl">
                    Lihat di Google Maps
                </a>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-20 bg-gradient-to-br from-lime-100 via-green-100 to-emerald-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl font-bold text-green-900 mb-4">Apa Kata Tamu Kami</h2>
                <p class="text-xl text-green-700 max-w-3xl mx-auto">
                    Testimoni dari tamu-tamu yang telah merasakan pengalaman tak terlupakan di RimbaCamp
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-green-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($testimonials as $testimonial)
                    <div class="bg-white rounded-2xl shadow-lg p-8 hover-lift animate-on-scroll">
                        <blockquote class="text-gray-600 mb-6 italic">
                            {{ $testimonial->isi }}
                        </blockquote>
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mr-4">
                                <span
                                    class="text-white font-semibold">{{ strtoupper(substr($testimonial->user->name ?? 'User', 0, 2)) }}</span>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">{{ $testimonial->user->name ?? 'User' }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Statistics Section --}}
    <section class="py-20 bg-gradient-to-br from-green-50 to-emerald-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                @foreach ($statistiks as $statistik)
                    @if ($statistik->value)
                        <div
                            class="animate-on-scroll bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="text-4xl md:text-5xl font-bold text-green-600 mb-2 counter"
                                data-target="{{ $statistik->value }}">0</div>
                            <div class="text-green-700 text-lg font-medium">{{ $statistik->label }}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="relative py-20 bg-gradient-to-br from-green-600 to-emerald-800 overflow-hidden">
        {{-- Background pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute inset-0 bg-[url('https://tailwindui.com/img/components/abstract-blur-1-dark.svg')] bg-no-repeat bg-center bg-cover">
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Siap untuk Pengalaman
                    <span class="bg-gradient-to-r from-lime-300 to-green-300 bg-clip-text text-transparent">Tak
                        Terlupakan?</span>
                </h2>
                <p class="text-xl text-green-100 mb-8 max-w-2xl mx-auto">
                    Jangan tunggu lagi! Pesan cottage impian Anda sekarang dan nikmati liburan yang sempurna di RimbaCamp
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#cottages"
                        class="bg-gradient-to-r from-lime-300 to-green-400 text-white px-8 py-4 rounded-full font-semibold hover:from-lime-400 hover:to-green-500 transition-all duration-300 transform hover:scale-105 shadow-xl">
                        <i class="fas fa-calendar-check mr-2"></i>
                        Pesan Sekarang
                    </a>
                    <a href="tel:+62123456789"
                        class="border-2 border-lime-300 text-lime-300 px-8 py-4 rounded-full font-semibold hover:bg-lime-300 hover:text-green-800 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-phone mr-2"></i>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Floating Action Button --}}
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/62123456789" target="_blank"
            class="w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-110 animate-bounce">
            <i class="fab fa-whatsapp text-white text-2xl"></i>
        </a>
    </div>

    {{-- Back to Top Button --}}
    <button id="backToTop"
        class="fixed bottom-6 left-6 z-50 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-110 opacity-0 invisible">
        <i class="fas fa-chevron-up text-white"></i>
    </button>
@endsection

@push('styles')
    <style>
        /* Custom Animations */
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(50px);
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
            animation: slide-up 1s ease-out;
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.6s ease-out;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #e0f2f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #4ade80, #16a34a);
            border-radius: 4px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll Animation Observer
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, observerOptions);

            // Observe all elements with animate-on-scroll class
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });

            // Counter Animation
            function animateCounter(element) {
                const target = parseInt(element.dataset.target);
                const duration = 2000; // 2 seconds
                const step = target / (duration / 16); // 60fps
                let current = 0;

                const updateCounter = () => {
                    current += step;
                    if (current < target) {
                        element.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        element.textContent = target;
                    }
                };

                updateCounter();
            }

            // Counter Observer
            const counterObserver = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        counterObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });

            document.querySelectorAll('.counter').forEach(counter => {
                counterObserver.observe(counter);
            });

            // Back to Top Button
            const backToTopBtn = document.getElementById('backToTop');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopBtn.classList.remove('opacity-0', 'invisible');
                    backToTopBtn.classList.add('opacity-100', 'visible', 'flex');
                } else {
                    backToTopBtn.classList.add('opacity-0', 'invisible');
                    backToTopBtn.classList.remove('opacity-100', 'visible', 'flex');
                }
            });

            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Smooth scroll for anchor links
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

            // Parallax effect for hero section background only
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const heroBackground = document.querySelector(
                    'section:first-child > div.absolute.inset-0.z-0');
                if (heroBackground) {
                    heroBackground.style.transform = `translateY(${scrolled * 0.5}px)`;
                }
            });

            // Add loading animation
            window.addEventListener('load', function() {
                document.body.classList.add('loaded');
            });
        });
    </script>
@endpush
