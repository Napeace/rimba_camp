@extends('pengunjung.layouts.app')

@section('title', 'Artikel Wisata - Rimbacamp')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-teal-50">
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-gradient-to-r from-green-600 via-teal-600 to-blue-600 text-white">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="relative container mx-auto px-4 py-24">
                <div class="text-center max-w-4xl mx-auto">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 animate-fade-in-up">
                        Artikel Wisata
                    </h1>
                    <p class="text-xl md:text-2xl opacity-90 animate-fade-in-up-delay">
                        Temukan tips, panduan, dan cerita menarik seputar wisata alam dan petualangan di Rimbacamp
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
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" id="searchInput" placeholder="Cari artikel..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300">
                        </div>
                        <button
                            class="bg-gradient-to-r from-green-500 to-teal-500 text-white px-6 py-3 rounded-xl hover:from-green-600 hover:to-teal-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-search mr-2"></i>Cari
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-4 pb-16">
            @if ($artikel->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="articlesGrid">
                    @foreach ($artikel as $item)
                        <article
                            class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 group article-card">
                            <div class="relative overflow-hidden">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                        class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div
                                        class="w-full h-56 bg-gradient-to-br from-green-400 to-teal-500 flex items-center justify-center">
                                        <i class="fas fa-mountain text-white text-4xl"></i>
                                    </div>
                                @endif
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300">
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>{{ $item->created_at->format('d M Y') }}</span>
                                </div>

                                <h3
                                    class="text-xl font-bold text-gray-800 mb-3 group-hover:text-green-600 transition-colors duration-300 line-clamp-2">
                                    {{ $item->judul }}
                                </h3>

                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ Str::limit(strip_tags($item->konten), 120) }}
                                </p>

                                <a href="{{ route('detail.artikel', $item->id) }}"
                                    class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors duration-300 group/link">
                                    Baca Selengkapnya
                                    <i
                                        class="fas fa-arrow-right ml-2 group-hover/link:translate-x-1 transition-transform duration-300"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    <div class="bg-white rounded-2xl shadow-lg p-4">
                        {{ $artikel->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-16">
                    <div class="bg-white rounded-2xl shadow-lg p-12 max-w-md mx-auto">
                        <i class="fas fa-newspaper text-6xl text-gray-300 mb-6"></i>
                        <h3 class="text-2xl font-bold text-gray-700 mb-4">Belum Ada Artikel</h3>
                        <p class="text-gray-500">Artikel wisata akan segera hadir untuk Anda!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
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
    </style>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const articleCards = document.querySelectorAll('.article-card');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                articleCards.forEach(card => {
                    const title = card.querySelector('h3').textContent.toLowerCase();
                    const content = card.querySelector('p').textContent.toLowerCase();

                    if (title.includes(searchTerm) || content.includes(searchTerm)) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeIn 0.5s ease-out';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });

            // Smooth scroll animation for cards
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'slideInUp 0.6s ease-out';
                    }
                });
            }, observerOptions);

            articleCards.forEach(card => {
                observer.observe(card);
            });
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
`;
        document.head.appendChild(style);
    </script>
@endsection
