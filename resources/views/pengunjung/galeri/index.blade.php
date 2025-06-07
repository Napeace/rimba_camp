@extends('pengunjung.layouts.app')

@section('title', 'Galeri Wisata - Rimbacamp')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-green-50 to-teal-50">
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-green-600 to-teal-600 text-white">
            <div class="absolute inset-0 bg-black opacity-30"></div>
            <div class="relative container mx-auto px-4 py-24">
                <div class="text-center max-w-4xl mx-auto">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 animate-fade-in-up">
                        Galeri Wisata
                    </h1>
                    <p class="text-xl md:text-2xl opacity-90 animate-fade-in-up-delay">
                        Jelajahi keindahan alam dan momen tak terlupakan di Rimbacamp melalui koleksi foto dan video kami
                    </p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0">
                <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"
                        fill="white" />
                </svg>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 border border-gray-100">
                    <div class="flex">
                        <input type="text" id="searchInput" placeholder="Cari foto..."
                            class="search-input flex-1 px-4 py-3 border border-gray-300 rounded-l-xl transition-all duration-300">
                        <button id="searchBtn"
                            class="search-btn px-4 py-3 bg-green-500 text-white rounded-r-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-search text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 pb-16">
            @if ($galeri->count() > 0)
                <div class="masonry-grid" id="galleryGrid">
                    @foreach ($galeri as $item)
                        <div class="gallery-item mb-6 group" data-category="{{ $item->kategori ?? 'alam' }}">
                            <div
                                class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
                                <div class="relative overflow-hidden cursor-pointer"
                                    onclick="openModal('{{ asset('storage/' . $item->gambar) }}', '{{ $item->judul }}', '{{ $item->deskripsi ?? '' }}')">
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                            class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-700"
                                            loading="lazy">
                                    @else
                                        <div
                                            class="w-full h-64 bg-gradient-to-br from-blue-400 to-green-500 flex items-center justify-center">
                                            <i class="fas fa-image text-white text-4xl"></i>
                                        </div>
                                    @endif
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                        <div
                                            class="transform scale-0 group-hover:scale-100 transition-transform duration-300">
                                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                                <i class="fas fa-search-plus text-white text-2xl"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">
                                        {{ $item->judul }}
                                    </h3>

                                    @if ($item->deskripsi)
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                            {{ $item->deskripsi }}
                                        </p>
                                    @endif

                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-alt mr-2"></i>
                                            <span>{{ $item->created_at->format('d M Y') }}</span>
                                        </div>
                                        <button onclick="likeImage({{ $item->id }})"
                                            class="flex items-center hover:text-red-500 transition-colors">
                                            <i class="fas fa-heart mr-1"></i>
                                            <span id="likes-{{ $item->id }}">{{ $item->likes ?? 0 }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    <div class="bg-white rounded-2xl shadow-lg p-4">
                        {{ $galeri->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-16">
                    <div class="bg-white rounded-2xl shadow-lg p-12 max-w-md mx-auto">
                        <i class="fas fa-images text-6xl text-gray-300 mb-6"></i>
                        <h3 class="text-2xl font-bold text-gray-700 mb-4">Belum Ada Galeri</h3>
                        <p class="text-gray-500">Foto dan video wisata akan segera hadir untuk Anda!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeModal()"
                class="absolute -top-12 right-0 text-white text-2xl hover:text-gray-300 transition-colors">
                <i class="fas fa-times"></i>
            </button>

            <div class="bg-white rounded-2xl overflow-hidden">
                <img id="modalImage" src="" alt="" class="w-full h-auto max-h-[70vh] object-contain">
                <div class="p-6">
                    <h3 id="modalTitle" class="text-xl font-bold text-gray-800 mb-2"></h3>
                    <p id="modalDescription" class="text-gray-600"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .masonry-grid {
            columns: 1;
            column-gap: 1.5rem;
        }

        @media (min-width: 640px) {
            .masonry-grid {
                columns: 2;
            }
        }

        @media (min-width: 1024px) {
            .masonry-grid {
                columns: 3;
            }
        }

        @media (min-width: 1280px) {
            .masonry-grid {
                columns: 4;
            }
        }

        .gallery-item {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out;
        }

        .animate-fade-in-up-delay {
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        /* Search container styling */
        .search-container {
            position: relative;
        }

        .search-btn:hover {
            transform: scale(1.05);
        }


        .search-input:focus {
            outline: none;
            box-shadow: none;
        }
    </style>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const searchBtn = document.getElementById('searchBtn');
            const galleryItems = document.querySelectorAll('.gallery-item');

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase();

                if (searchTerm.trim()) {
                    // Add search animation
                    searchBtn.innerHTML = '<i class="fas fa-spinner fa-spin text-lg"></i>';

                    setTimeout(() => {
                        searchBtn.innerHTML = '<i class="fas fa-search text-lg"></i>';

                        galleryItems.forEach(item => {
                            const title = item.querySelector('h3').textContent.toLowerCase();
                            const description = item.querySelector('p') ? item.querySelector('p')
                                .textContent.toLowerCase() : '';

                            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                                item.style.display = 'block';
                                item.style.animation = 'fadeIn 0.5s ease-out';
                            } else {
                                item.style.display = 'none';
                            }
                        });
                    }, 800);
                } else {
                    // Show all items if search is empty
                    galleryItems.forEach(item => {
                        item.style.display = 'block';
                        item.style.animation = 'fadeIn 0.5s ease-out';
                    });
                }
            }

            // Search button click
            searchBtn.addEventListener('click', performSearch);

            // Enter key press
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });

            // Real-time search (optional)
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                galleryItems.forEach(item => {
                    const title = item.querySelector('h3').textContent.toLowerCase();
                    const description = item.querySelector('p') ? item.querySelector('p')
                        .textContent.toLowerCase() : '';

                    if (title.includes(searchTerm) || description.includes(searchTerm)) {
                        item.style.display = 'block';
                        item.style.animation = 'fadeIn 0.5s ease-out';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });

            // Lazy loading animation
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'slideInUp 0.6s ease-out';
                    }
                });
            }, observerOptions);

            galleryItems.forEach(item => {
                observer.observe(item);
            });
        });

        // Modal functions
        function openModal(imageSrc, title, description) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            const modalDescription = document.getElementById('modalDescription');

            modalImage.src = imageSrc;
            modalImage.alt = title;
            modalTitle.textContent = title;
            modalDescription.textContent = description;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Like functionality
        function likeImage(id) {
            const likesElement = document.getElementById(`likes-${id}`);
            const currentLikes = parseInt(likesElement.textContent);

            // Simple client-side increment (you can implement server-side logic later)
            likesElement.textContent = currentLikes + 1;

            // Add animation
            likesElement.parentElement.style.animation = 'pulse 0.3s ease-out';
            setTimeout(() => {
                likesElement.parentElement.style.animation = '';
            }, 300);

            // Here you can add AJAX call to update likes in database
            // fetch(`/galeri/${id}/like`, { method: 'POST' })...
        }

        // Close modal when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Additional animations
        const style = document.createElement('style');
        style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
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
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    `;
        document.head.appendChild(style);
    </script>
@endsection
