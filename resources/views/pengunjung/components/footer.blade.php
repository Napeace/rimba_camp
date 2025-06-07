<footer id="footer" class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- About Section --}}
            <div class="col-span-1 lg:col-span-2">
                <div class="flex items-center space-x-2 mb-4">
                    <div
                        class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-tree text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold">RimbaCamp</span>
                </div>
                <p class="text-gray-300 mb-4 max-w-md">
                    Nikmati pengalaman menginap yang tak terlupakan di resort paradise kami.
                    Dengan pemandangan alam yang menakjubkan dan fasilitas terbaik untuk kenyamanan Anda.
                </p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors duration-200">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors duration-200">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors duration-200">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center hover:bg-green-700 transition-colors duration-200">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="/"
                            class="text-gray-300 hover:text-white transition-colors duration-200">Beranda</a></li>
                    <li><a href="{{ route('cottage.index') }}"
                            class="text-gray-300 hover:text-white transition-colors duration-200">Cottage</a></li>
                    <li><a href="{{ route('galeri.index') }}"
                            class="text-gray-300 hover:text-white transition-colors duration-200">Galeri</a></li>
                    <li><a href="{{ route('artikel.index') }}"
                            class="text-gray-300 hover:text-white transition-colors duration-200">Artikel</a></li>
                    <li><a href="#footer"
                            class="text-gray-300 hover:text-white transition-colors duration-200">Kontak</a></li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div>
                <h3 class="text-lg font-semibold mb-4">Kontak Kami</h3>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-map-marker-alt text-green-400"></i>
                        <span class="text-gray-300 text-sm">WJ6C+VRF, Area Pegunungan Argop, Suci, Kec. Panti, Kabupaten
                            Jember, Jawa Timur 68153</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-phone text-green-400"></i>
                        <span class="text-gray-300 text-sm">+62 812-3456-7890</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-green-400"></i>
                        <span class="text-gray-300 text-sm">rimbacamp@gmail.com</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-clock text-green-400"></i>
                        <span class="text-gray-300 text-sm">Customer Service</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Section --}}
        <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-400 text-sm">
                © {{ date('Y') }} RimbaCamp. All rights reserved.
            </p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Privacy
                    Policy</a>
                <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Terms of
                    Service</a>
                <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Cookie
                    Policy</a>
            </div>
        </div>
    </div>
</footer>
