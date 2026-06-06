{{-- =====================================================
     news-index.blade.php
     ===================================================== --}}
@extends('frontend.layout')
@section('title', 'Semua Berita')

@section('content')
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

<div class="pkr-page-header">
    <div class="container">
        <nav class="pkr-page-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <span>Semua Berita</span>
        </nav>
        <h1>Semua Berita</h1>
        <p>Jelajahi berita terbaru dari berbagai kategori</p>
        <div class="pkr-page-header-meta">
            <span><i class="fas fa-newspaper"></i> {{ $news->total() }} berita tersedia</span>
        </div>
    </div>
</div>
<div class="pkr-page-header-accent"></div>

<section class="pkr-list-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if($news->count() > 0)
                    @foreach($news as $item)
                    <article class="pkr-list-item">
                        <a href="{{ route('news.show', $item->slug) }}" class="pkr-list-img">
                            @if($item->image)
                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}">
                            @else
                                <img src="assets/img/blog/single_blog_1.png" alt="{{ $item->title }}">
                            @endif
                        </a>
                        <div class="pkr-list-body">
                            <span class="pkr-badge">{{ $item->category->name }}</span>
                            <h3><a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a></h3>
                            @if($item->excerpt)
                                <p>{{ Str::limit($item->excerpt, 150) }}</p>
                            @else
                                <p>{{ Str::limit(strip_tags($item->content), 150) }}</p>
                            @endif
                            <div class="pkr-list-meta">
                                <span><i class="far fa-calendar"></i> {{ $item->created_at->format('d M Y') }}</span>
                                <span><i class="far fa-eye"></i> {{ number_format($item->views) }} views</span>
                            </div>
                        </div>
                    </article>
                    @endforeach

                    <div class="pkr-pagination">
                        {{ $news->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <div class="pkr-empty-state">
                        <i class="fas fa-newspaper"></i>
                        <h3>Belum Ada Berita</h3>
                        <p>Berita akan segera ditampilkan di sini.</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="pkr-detail-sidebar">
                    <div class="pkr-sidebar-widget">
                        <div class="pkr-sw-title"><i class="fas fa-search"></i> Cari Berita</div>
                        <div class="pkr-sw-body">
                            <form action="{{ route('news.search') }}" method="GET" class="pkr-sw-search">
                                <input type="text" name="q" placeholder="Kata kunci..." value="{{ request('q') }}">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="pkr-sidebar-widget">
                        <div class="pkr-sw-title"><i class="fas fa-folder-open"></i> Kategori</div>
                        <div class="pkr-sw-body pkr-sw-cats">
                            @foreach($categories as $category)
                            <a href="{{ route('news.category', $category->slug) }}" class="pkr-sw-cat-item">
                                <span>{{ $category->name }}</span>
                                <span class="pkr-sw-cat-count">{{ $category->news_count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="pkr-sidebar-widget">
                        <div class="pkr-sw-title"><i class="fas fa-clock"></i> Berita Terbaru</div>
                        <div class="pkr-sw-body">
                            @php $recentNews = \App\Models\News::latest()->take(5)->get(); @endphp
                            @foreach($recentNews as $recent)
                            <a href="{{ route('news.show', $recent->slug) }}" class="pkr-sw-post">
                                @if($recent->image)
                                    <img src="{{ Storage::url($recent->image) }}" alt="{{ $recent->title }}">
                                @else
                                    <img src="assets/img/post/post_1.png" alt="{{ $recent->title }}">
                                @endif
                                <div>
                                    <p>{{ Str::limit($recent->title, 55) }}</p>
                                    <small>{{ $recent->created_at->diffForHumans() }}</small>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="pkr-sidebar-widget">
                        <div class="pkr-sw-title"><i class="fas fa-tags"></i> Tag Populer</div>
                        <div class="pkr-sw-body pkr-sw-tags">
                            <a href="#" class="pkr-tag">#trending</a>
                            <a href="#" class="pkr-tag">#terkini</a>
                            <a href="#" class="pkr-tag">#viral</a>
                            <a href="#" class="pkr-tag">#berita</a>
                            <a href="#" class="pkr-tag">#teknologi</a>
                        </div>
                    </div>

                    <div class="pkr-sidebar-widget pkr-sw-newsletter">
                        <div class="pkr-sw-title"><i class="fas fa-envelope"></i> Newsletter</div>
                        <div class="pkr-sw-body">
                            <p>Dapatkan berita terbaru langsung di inbox Anda.</p>
                            <input type="email" placeholder="Masukkan email Anda...">
                            <button class="btn-pkr-primary w-100 mt-2">Langganan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
@include('frontend._shared_list_styles')
@endpush


{{-- =====================================================
     search.blade.php
     ===================================================== --}}
{{-- @SAVE AS: resources/views/frontend/search.blade.php --}}