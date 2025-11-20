{{-- @extends('frontend.layout')

@section('title', 'Kategori: ' . $category->name)

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center mb-4">
            <a href="{{ route('news.index') }}" class="text-white/80 hover:text-white mr-3">
                ← Kembali
            </a>
        </div>
        <h1 class="text-4xl font-bold mb-2">📂 {{ $category->name }}</h1>
        <p class="text-lg opacity-90">
            Menampilkan {{ $news->total() }} berita dalam kategori ini
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            @if($news->count() > 0)
                <!-- News Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    @foreach($news as $item)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                            <a href="{{ route('news.show', $item->slug) }}">
                                @if($item->image)
                                    <div class="relative overflow-hidden">
                                        <img src="{{ Storage::url($item->image) }}" 
                                             alt="{{ $item->title }}"
                                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                        
                                        <!-- Trending Badge (if views > 1000) -->
                                        @if($item->views > 1000)
                                            <div class="absolute top-3 right-3">
                                                <span class="px-2 py-1 bg-red-600 text-white text-xs font-bold rounded-full animate-pulse">
                                                    🔥 Trending
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-indigo-400 to-purple-400 flex items-center justify-center">
                                        <span class="text-white text-5xl">📰</span>
                                    </div>
                                @endif
                                
                                <div class="p-5">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition line-clamp-2">
                                        {{ $item->title }}
                                    </h3>
                                    
                                    @if($item->excerpt)
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                                            {{ $item->excerpt }}
                                        </p>
                                    @endif
                                    
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <div class="flex items-center space-x-3">
                                            <span>👤 {{ $item->user->name }}</span>
                                            <span>📅 {{ $item->formatted_date }}</span>
                                        </div>
                                        <span class="flex items-center">
                                            👁️ {{ number_format($item->views) }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    {{ $news->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <div class="text-6xl mb-4">📭</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Berita</h3>
                    <p class="text-gray-600 mb-6">
                        Belum ada berita dalam kategori <strong>{{ $category->name }}</strong>.
                    </p>
                    <a href="{{ route('news.index') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition">
                        Lihat Semua Berita
                    </a>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Category Info -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 mb-3">ℹ️ Tentang Kategori</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nama:</span>
                        <span class="font-bold text-gray-900">{{ $category->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Berita:</span>
                        <span class="font-bold text-indigo-600">{{ $news->total() }}</span>
                    </div>
                </div>
            </div>

            <!-- Other Categories -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">📂 Kategori Lainnya</h3>
                <div class="space-y-2">
                    @foreach($categories as $cat)
                        @if($cat->id !== $category->id)
                            <a href="{{ route('news.category', $cat->slug) }}" 
                               class="flex items-center justify-between p-3 rounded-lg hover:bg-indigo-50 transition group">
                                <span class="text-gray-700 group-hover:text-indigo-600 font-medium">
                                    {{ $cat->name }}
                                </span>
                                <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full group-hover:bg-indigo-600 group-hover:text-white">
                                    {{ $cat->news_count }}
                                </span>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Popular in Category -->
            @php
                $popularInCategory = App\Models\News::where('category_id', $category->id)
                    ->where('status', 'published')
                    ->orderBy('views', 'desc')
                    ->take(5)
                    ->get();
            @endphp

            @if($popularInCategory->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">🔥 Populer di {{ $category->name }}</h3>
                    <div class="space-y-3">
                        @foreach($popularInCategory as $index => $popular)
                            <a href="{{ route('news.show', $popular->slug) }}" class="flex gap-3 group">
                                <div class="flex-shrink-0 w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 mb-1">
                                        {{ $popular->title }}
                                    </h4>
                                    <p class="text-xs text-gray-500">
                                        👁️ {{ number_format($popular->views) }} views
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Search in Category -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">🔍 Cari di {{ $category->name }}</h3>
                <form action="{{ route('news.search') }}" method="GET">
                    <input type="hidden" name="category" value="{{ $category->id }}">
                    <input type="text" 
                           name="q" 
                           placeholder="Ketik kata kunci..." 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 mb-2">
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded-lg hover:bg-indigo-700 transition">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('frontend.layout')

@section('title', $category->name . ' - Berita')

@section('content')
<!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="assets/img/logo/favicon/favicon-96x96.png" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Preloader End -->

<main>
    <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-12 col-md-12">
                            <div class="section-tittle mb-30">
                                <h3>{{ $category->name }}</h3>
                                @if($category->description)
                                    <p>{{ $category->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <!-- News Content -->
                            <div class="whats-news-caption">
                                <div class="row">
                                    @forelse($news as $item)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    @if($item->image)
                                                        <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}">
                                                    @else
                                                        <img src="{{ asset('assets/img/news/whatNews1.jpg') }}" alt="{{ $item->title }}">
                                                    @endif
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">{{ $item->category->name }}</span>
                                                    <h4>
                                                        <a href="{{ route('news.show', $item->slug) }}">
                                                            {{ Str::limit($item->title, 60) }}
                                                        </a>
                                                    </h4>
                                                    <p>{{ Str::limit($item->excerpt, 100) }}</p>
                                                    <small class="text-muted">
                                                        <i class="far fa-calendar"></i> {{ $item->published_at->format('d M Y') }}
                                                        <i class="far fa-eye ml-2"></i> {{ $item->views }} views
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-info">
                                                Belum ada berita di kategori ini.
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <!-- End News Content -->
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Section Tittle -->
                    <div class="section-tittle mb-40">
                        <h3>Follow Us</h3>
                    </div>
                    
                    <!-- Flow Social -->
                    <div class="single-follow mb-45">
                        <div class="single-box">
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="{{ asset('assets/img/news/icon-fb.png') }}" alt=""></a>
                                </div>
                                <div class="follow-count">  
                                    <span>8,045</span>
                                    <p>Fans</p>
                                </div>
                            </div> 
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="{{ asset('assets/img/news/icon-tw.png') }}" alt=""></a>
                                </div>
                                <div class="follow-count">
                                    <span>8,045</span>
                                    <p>Fans</p>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="{{ asset('assets/img/news/icon-ins.png') }}" alt=""></a>
                                </div>
                                <div class="follow-count">
                                    <span>8,045</span>
                                    <p>Fans</p>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="{{ asset('assets/img/news/icon-yo.png') }}" alt=""></a>
                                </div>
                                <div class="follow-count">
                                    <span>8,045</span>
                                    <p>Fans</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="section-tittle mb-40">
                        <h3>Kategori Lainnya</h3>
                    </div>
                    <div class="single-follow mb-45">
                        <div class="single-box">
                            @foreach($categories as $cat)
                                <div class="follow-us d-flex align-items-center justify-content-between mb-3">
                                    <a href="{{ route('news.category', $cat->slug) }}" 
                                       class="{{ $cat->id == $category->id ? 'font-weight-bold text-primary' : 'text-dark' }}">
                                        {{ $cat->name }}
                                    </a>
                                    <span class="badge badge-secondary">{{ $cat->news_count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- News Poster -->
                    <div class="news-poster d-none d-lg-block">
                        <img src="{{ asset('assets/img/news/news_card.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Whats New End -->

    <!-- Start pagination -->
    @if($news->hasPages())
        <div class="pagination-area pb-45 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-wrap d-flex justify-content-center">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-start">
                                    {{-- Previous Page Link --}}
                                    @if ($news->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <span class="flaticon-arrow roted"></span>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $news->previousPageUrl() }}">
                                                <span class="flaticon-arrow roted"></span>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                                        @if ($page == $news->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($news->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $news->nextPageUrl() }}">
                                                <span class="flaticon-arrow right-arrow"></span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <span class="flaticon-arrow right-arrow"></span>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- End pagination  -->
</main>

@endsection