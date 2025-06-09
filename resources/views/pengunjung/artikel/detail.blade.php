@extends('pengunjung.layouts.app')

@section('title', $artikel->judul . ' - Rimbacamp')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="relative h-96 md:h-[500px] overflow-hidden">
            @if ($artikel->gambar)
                <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}"
                    class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-br from-green-600 to-teal-600 flex items-center justify-center">
                    <i class="fas fa-mountain text-white text-8xl"></i>
                </div>
            @endif
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>

            <div class="absolute top-6 left-6 z-10">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('pengunjung.landing') }}"
                                class="text-white hover:text-green-300 transition-colors">
                                <i class="fas fa-home mr-2"></i>Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-white mx-2"></i>
                                <a href="{{ route('artikel.index') }}"
                                    class="text-white hover:text-green-300 transition-colors">Artikel</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-white mx-2"></i>
                                <span class="text-green-300">Detail</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="absolute top-6 right-6 z-10">
                <a href="{{ route('artikel.index') }}"
                    class="bg-white bg-opacity-20 backdrop-blur-sm text-white px-4 py-2 rounded-full hover:bg-opacity-30 transition-all duration-300 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="container mx-auto px-4 py-12">
            <div class="max-w-4xl mx-auto">

                <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 -mt-32 relative z-10">
                    <div class="mb-6">
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span>{{ $artikel->created_at->format('d F Y') }}</span>
                            </div>
                        </div>

                        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 leading-tight mb-4">
                            {{ $artikel->judul }}
                        </h1>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-700 leading-relaxed text-justify">
                            {!! nl2br(e($artikel->isi)) !!}
                        </div>
                    </div>
                </div>

                @if (isset($artikel->tags) && $artikel->tags)
                    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach (explode(',', $artikel->tags) as $tag)
                                <span
                                    class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-green-100 hover:text-green-700 transition-colors cursor-pointer">
                                    #{{ trim($tag) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Related Articles -->
                @if ($relatedArticles->count() > 0)
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Artikel Terkait</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach ($relatedArticles as $related)
                                <article class="group cursor-pointer">
                                    <a href="{{ route('detail.artikel', $related->id) }}" class="block">
                                        <div class="relative overflow-hidden rounded-xl mb-4">
                                            @if ($related->gambar)
                                                <img src="{{ asset('storage/' . $related->gambar) }}"
                                                    alt="{{ $related->judul }}"
                                                    class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                                            @else
                                                <div
                                                    class="w-full h-40 bg-gradient-to-br from-green-400 to-teal-500 flex items-center justify-center">
                                                    <i class="fas fa-mountain text-white text-2xl"></i>
                                                </div>
                                            @endif
                                            <div
                                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300">
                                            </div>
                                        </div>
                                        <h4
                                            class="font-semibold text-gray-800 group-hover:text-green-600 transition-colors duration-300 line-clamp-2 mb-2">
                                            {{ $related->judul }}
                                        </h4>
                                        <p class="text-sm text-gray-500">
                                            {{ $related->created_at->format('d M Y') }}
                                        </p>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
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

        .prose {
            max-width: none;
        }

        .prose p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4 {
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #374151;
        }

        .prose h1 {
            font-size: 2rem;
        }

        .prose h2 {
            font-size: 1.75rem;
        }

        .prose h3 {
            font-size: 1.5rem;
        }

        .prose h4 {
            font-size: 1.25rem;
        }

        .prose ul,
        .prose ol {
            margin: 1.5rem 0;
            padding-left: 2rem;
        }

        .prose li {
            margin-bottom: 0.5rem;
        }

        .prose blockquote {
            border-left: 4px solid #10b981;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: #6b7280;
            background: #f9fafb;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
        }
    </style>

    <!-- JavaScript -->
    <script>
        // Social sharing functions
        function shareToFacebook() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('{{ $artikel->judul }}');
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&t=${title}`, '_blank', 'width=600,height=400');
        }

        function shareToTwitter() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('{{ $artikel->judul }}');
            window.open(`https://twitter.com/intent/tweet?url=${url}&text=${title}`, '_blank', 'width=600,height=400');
        }

        function shareToWhatsApp() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('{{ $artikel->judul }}');
            window.open(`https://wa.me/?text=${title} ${url}`, '_blank');
        }

        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(function() {
                // Show success message
                const button = event.target.closest('button');
                const originalContent = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i>';
                button.classList.add('bg-green-500');
                button.classList.remove('bg-gray-600');

                setTimeout(() => {
                    button.innerHTML = originalContent;
                    button.classList.remove('bg-green-500');
                    button.classList.add('bg-gray-600');
                }, 2000);
            });
        }

        // Smooth scroll for internal links
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scrolling to all internal links
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
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

            // Reading progress indicator
            const article = document.querySelector('.prose');
            if (article) {
                const progressBar = document.createElement('div');
                progressBar.className =
                    'fixed top-0 left-0 w-full h-1 bg-green-500 z-50 transform scale-x-0 origin-left transition-transform duration-300';
                document.body.appendChild(progressBar);

                window.addEventListener('scroll', function() {
                    const articleTop = article.offsetTop;
                    const articleHeight = article.offsetHeight;
                    const windowHeight = window.innerHeight;
                    const scrollTop = window.pageYOffset;

                    const progress = Math.min(Math.max((scrollTop - articleTop + windowHeight) /
                        articleHeight, 0), 1);
                    progressBar.style.transform = `scaleX(${progress})`;
                });
            }
        });
    </script>
@endsection
