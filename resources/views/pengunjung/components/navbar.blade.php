{{-- resources/views/pengunjung/components/navbar.blade.php --}}
<nav id="navbar"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white backdrop-blur-md shadow-lg border-b border-green-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            {{-- Logo --}}
            <div class="flex-shrink-0 flex items-center">
                <a href="/"
                    class="flex items-center space-x-2 text-green-800 hover:text-green-600 transition-colors duration-200">
                    <div
                        class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center floating">
                        <i class="fas fa-tree text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold hidden sm:block">RimbaCamp</span>
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="/"
                        class="nav-link text-green-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 hover:bg-green-600">
                        <i class="fas fa-home mr-1"></i>
                        Beranda
                    </a>
                    <a href="{{ route('cottage.index') }}"
                        class="nav-link text-green-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 hover:bg-green-600">
                        <i class="fas fa-campground mr-1"></i>
                        Cottage
                    </a>
                    <a href="{{ route('galeri.index') }}"
                        class="nav-link text-green-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 hover:bg-green-600">
                        <i class="fas fa-images mr-1"></i>
                        Galeri
                    </a>
                    <a href="{{ route('artikel.index') }}"
                        class="nav-link text-green-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 hover:bg-green-600">
                        <i class="fas fa-newspaper mr-1"></i>
                        Artikel
                    </a>
                    <a href="#footer"
                        class="nav-link text-green-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 hover:bg-green-600">
                        <i class="fas fa-envelope mr-1"></i>
                        Kontak
                    </a>
                </div>
            </div>

            {{-- User Menu / Auth Buttons --}}
            <div class="hidden md:block">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-2 text-green-700 hover:text-green-500 focus:outline-none">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-xs"></i>
                            </div>
                            <span class="text-sm font-medium">{{ auth()->user()->name ?? 'User' }}</span>
                            <i class="fas fa-chevron-down text-xs" :class="open ? 'rotate-180' : ''"
                                style="transition: transform 0.2s;"></i>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-green-100">
                            <a href="{{ route('pengunjung.profile') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-150">
                                <i class="fas fa-user mr-2 text-green-600"></i>
                                Profil
                            </a>
                            <a href="{{ route('cottage.reservasi.riwayat') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-150">
                                <i class="fas fa-calendar mr-2 text-green-600"></i>
                                Reservasi Saya
                            </a>
                            <a href="{{ route('pengunjung.testimoni.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-150">
                                <i class="fas fa-message mr-2 text-green-600"></i>
                                Testimoni
                            </a>
                            <div class="border-t border-green-100"></div>
                            <form method="POST" action="{{ route('pengunjung.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150">
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="text-green-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 hover:bg-green-600 flex items-center space-x-1">
                                <i class="fas fa-sign-in-alt mr-1"></i>
                                <span>Masuk</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-green-100">
                                <a href="{{ route('pengunjung.login') }}"
                                    class="block px-4 py-2 text-sm text-green-700 hover:bg-green-600 hover:text-white transition-colors duration-150">
                                    Login sebagai Pengunjung
                                </a>
                                <a href="{{ route('admin.login') }}"
                                    class="block px-4 py-2 text-sm text-green-700 hover:bg-green-600 hover:text-white transition-colors duration-150">
                                    Login sebagai Admin
                                </a>
                            </div>
                        </div>
                        <a href="{{ route('pengunjung.register') }}"
                            class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:from-green-600 hover:to-emerald-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-user-plus mr-1"></i>
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>

            {{-- Mobile menu button --}}
            <div class="md:hidden">
                <button onclick="toggleMobileMenu()"
                    class="hamburger text-green-700 hover:text-green-500 focus:outline-none focus:text-green-500 transition-colors duration-200">
                    <div class="hamburger-line w-6 h-0.5 bg-current mb-1 transition-all duration-300"></div>
                    <div class="hamburger-line w-6 h-0.5 bg-current mb-1 transition-all duration-300"></div>
                    <div class="hamburger-line w-6 h-0.5 bg-current transition-all duration-300"></div>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Navigation Menu --}}
    <div id="mobile-menu" class="md:hidden hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white/95 backdrop-blur-md shadow-lg border-t border-green-100">
            <a href="/"
                class="text-green-700 hover:bg-green-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-all duration-200">
                <i class="fas fa-home mr-2"></i>
                Beranda
            </a>
            <a href="{{ route('cottage.index') }}"
                class="text-green-700 hover:bg-green-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-all duration-200">
                <i class="fas fa-campground mr-2"></i>
                Cottage
            </a>
            <a href="#gallery"
                class="text-green-700 hover:bg-green-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-all duration-200">
                <i class="fas fa-images mr-2"></i>
                Galeri
            </a>
            <a href="#articles"
                class="text-green-700 hover:bg-green-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-all duration-200">
                <i class="fas fa-newspaper mr-2"></i>
                Artikel
            </a>
            <a href="#contact"
                class="text-green-700 hover:bg-green-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-all duration-200">
                <i class="fas fa-envelope mr-2"></i>
                Kontak
            </a>

            {{-- Mobile Auth Section --}}
            <div class="border-t border-green-200 pt-4">
                @auth
                    <div class="flex items-center px-3 py-2">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div>
                            <div class="text-base font-medium text-green-800">{{ auth()->user()->name ?? 'User' }}
                            </div>
                            <div class="text-sm text-green-600">{{ auth()->user()->email ?? 'user@example.com' }}
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('pengunjung.profile') }}"
                        class="text-green-700 hover:bg-green-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-all duration-200">
                        <i class="fas fa-user mr-2"></i>
                        Profil
                    </a>
                    <a href="{{ route('cottage.reservasi.riwayat') }}"
                        class="text-green-700 hover:bg-green-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-all duration-200">
                        <i class="fas fa-calendar mr-2"></i>
                        Reservasi Saya
                    </a>
                    <a href="{{ route('pengunjung.testimoni.index') }}"
                        class="text-green-700 hover:bg-green-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-all duration-200">
                        <i class="fas fa-message mr-2"></i>
                        Testimoni
                    </a>
                    <form method="POST" action="{{ route('pengunjung.logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left text-red-600 hover:bg-red-50 block px-3 py-2 rounded-md text-base font-medium transition-all duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('pengunjung.login') }}"
                        class="text-green-700 hover:bg-green-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-all duration-200">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Masuk
                    </a>
                    <a href="{{ route('pengunjung.register') }}"
                        class="text-green-700 hover:bg-green-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-all duration-200">
                        <i class="fas fa-user-plus mr-2"></i>
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- Alpine.js untuk dropdown --}}
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>
    .hamburger.active .hamburger-line:nth-child(1) {
        transform: rotate(45deg) translate(4px, 4px);
        transform-origin: center;
    }

    .hamburger.active .hamburger-line:nth-child(2) {
        opacity: 0;
    }

    .hamburger.active .hamburger-line:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -4px);
        transform-origin: center;
    }

    /* Floating animation untuk logo */
    .floating {
        animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
        0% {
            transform: translate(0, 0px);
        }

        50% {
            transform: translate(0, -5px);
        }

        100% {
            transform: translate(0, 0px);
        }
    }

    /* Navbar scrolled state */
    .navbar-scrolled {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    // JavaScript untuk mengubah navbar saat scroll
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            // Keep navbar-scrolled class to maintain background visibility at top
            navbar.classList.add('navbar-scrolled');
        }
    });

    // Toggle mobile menu visibility and hamburger animation
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const hamburger = document.querySelector('.hamburger');
        menu.classList.toggle('hidden');
        hamburger.classList.toggle('active');
    }
</script>
