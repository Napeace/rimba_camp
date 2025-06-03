@extends('admin.layouts.app')

@section('title', $artikel->judul . ' - Rimba Camp')

@section('body-class', 'bg-gray-50')

@section('content')
<div class="min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-4xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.artikel.index') }}"
                       class="text-gray-600 hover:text-gray-900 transition duration-200">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Detail Artikel</h1>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.artikel.edit', $artikel) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>
                    <form action="{{ route('admin.artikel.destroy', $artikel) }}"
                          method="POST"
                          class="inline"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                            <i class="fas fa-trash"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 py-6">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Article Content -->
        <div class="bg-white rounded-lg shadow-sm border">
            <!-- Meta Information -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Dibuat: {{ $artikel->created_at->format('d F Y, H:i') }}</span>
                    </div>
                    @if($artikel->updated_at != $artikel->created_at)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-edit"></i>
                            <span>Diperbarui: {{ $artikel->updated_at->format('d F Y, H:i') }}</span>
                        </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <i class="fas fa-link"></i>
                        <span class="font-mono bg-gray-200 px-2 py-1 rounded">{{ $artikel->slug }}</span>
                    </div>
                </div>
            </div>

            <!-- Article Header -->
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ $artikel->judul }}</h1>

                <!-- Featured Image -->
                @if($artikel->gambar)
                    <div class="mb-8">
                        <img src="{{ Storage::url($artikel->gambar) }}"
                             alt="{{ $artikel->judul }}"
                             class="w-full max-w-2xl mx-auto rounded-lg shadow-lg">
                    </div>
                @endif

                <!-- Article Content -->
                <div class="prose prose-lg max-w-none">
                    <div class="article-content">
                        {!! $artikel->isi !!}
                    </div>
                </div>
            </div>

            <!-- Article Stats -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-lg border">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-font text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Jumlah Karakter</p>
                                <p class="text-lg font-semibold text-gray-900">{{ strlen(strip_tags($artikel->isi)) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-lg border">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-align-left text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Jumlah Kata</p>
                                <p class="text-lg font-semibold text-gray-900">{{ str_word_count(strip_tags($artikel->isi)) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.article-content {
    line-height: 1.8;
}

/* Headings */
.article-content h1,
.article-content h2,
.article-content h3,
.article-content h4,
.article-content h5,
.article-content h6 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: 600;
    color: #1f2937;
}

.article-content h1 { font-size: 2rem; }
.article-content h2 { font-size: 1.5rem; }
.article-content h3 { font-size: 1.25rem; }

/* Paragraphs */
.article-content p {
    margin-bottom: 1rem;
    color: #374151;
}

/* Lists - FIXED SECTION */
.article-content ul,
.article-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
    color: #374151;
}

/* Ordered List (Numbered) */
.article-content ol {
    list-style-type: decimal;
    counter-reset: item;
}

.article-content ol li {
    display: list-item;
    margin-bottom: 0.75rem;
    padding-left: 0.5rem;
}

/* Unordered List (Bullets) */
.article-content ul {
    list-style-type: disc;
}

.article-content ul li {
    display: list-item;
    margin-bottom: 0.75rem;
    padding-left: 0.5rem;
}

/* Nested Lists */
.article-content ul ul,
.article-content ol ol,
.article-content ul ol,
.article-content ol ul {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
    padding-left: 1.5rem;
}

.article-content ul ul {
    list-style-type: circle;
}

.article-content ul ul ul {
    list-style-type: square;
}

.article-content ol ol {
    list-style-type: lower-alpha;
}

.article-content ol ol ol {
    list-style-type: lower-roman;
}

/* Blockquotes */
.article-content blockquote {
    border-left: 4px solid #3b82f6;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    background-color: #f8fafc;
    padding: 1rem;
    border-radius: 0.5rem;
}

/* Images */
.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin: 1.5rem 0;
}

/* Links */
.article-content a {
    color: #3b82f6;
    text-decoration: underline;
}

.article-content a:hover {
    color: #1d4ed8;
}

/* Tables */
.article-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
}

.article-content table th,
.article-content table td {
    border: 1px solid #d1d5db;
    padding: 0.75rem;
    text-align: left;
}

.article-content table th {
    background-color: #f9fafb;
    font-weight: 600;
}

/* Code */
.article-content code {
    background-color: #f3f4f6;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-family: 'Courier New', monospace;
    font-size: 0.875rem;
}

.article-content pre {
    background-color: #1f2937;
    color: #f9fafb;
    padding: 1rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.article-content pre code {
    background-color: transparent;
    padding: 0;
    color: inherit;
}
</style>
@endpush
