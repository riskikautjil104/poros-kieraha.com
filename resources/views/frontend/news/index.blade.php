@extends('frontend.layout')

@section('title', 'Home')

@section('content')

<!-- Preloader -->
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

<!-- ============================================================
     TRENDING / HERO AREA
     ============================================================ -->
<div class="pkr-trending-area">
    <div class="container">

        <!-- Trending bar -->
        <div class="pkr-trending-bar">
            <span class="pkr-trending-label">
                <i class="fas fa-bolt"></i> Trending
            </span>
            <span class="pkr-trending-divider"></span>
            <!-- Mobile search trigger -->
            <button class="pkr-mobile-search-btn d-md-none" id="mobileSearchBtn">
                <i class="fas fa-search"></i> Cari
            </button>
        </div>

        <!-- Mobile search box -->
        <div class="pkr-mobile-search-wrap d-md-none" id="mobileSearchBox" style="display:none;">
            <form action="{{ route('news.search') }}" method="GET" class="pkr-mobile-search-form">
                <input type="text" name="q" placeholder="Cari berita..." value="{{ request('q') }}">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <!-- Hero grid -->
        @if($featuredNews->count() > 0)
        @php $mainNews = $featuredNews->first(); @endphp
        <div class="pkr-hero-grid">

            <!-- Main hero card -->
            <div class="pkr-hero-main">
                <a href="{{ route('news.show', $mainNews->slug) }}" class="pkr-hero-link">
                    <div class="pkr-hero-img">
                        @if($mainNews->image)
                            <img src="{{ Storage::url($mainNews->image) }}" alt="{{ $mainNews->title }}">
                        @else
                            <img src="{{ asset('assets/img/trending/trending_top.jpg') }}" alt="{{ $mainNews->title }}">
                        @endif
                        <div class="pkr-hero-gradient"></div>
                    </div>
                    <div class="pkr-hero-caption">
                        <span class="pkr-badge">{{ $mainNews->category->name }}</span>
                        <h2 class="pkr-hero-title">{{ $mainNews->title }}</h2>
                    </div>
                </a>
            </div>

            <!-- Side cards -->
            <div class="pkr-hero-side">
                @foreach($featuredNews->slice(1, 3) as $news)
                <div class="pkr-hero-side-item">
                    <a href="{{ route('news.show', $news->slug) }}" class="d-flex gap-3">
                        <div class="pkr-hero-side-img">
                            @if($news->image)
                                <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}">
                            @else
                                <img src="{{ asset('assets/img/trending/trending_bottom1.jpg') }}" alt="{{ $news->title }}">
                            @endif
                        </div>
                        <div class="pkr-hero-side-cap">
                            <span class="pkr-badge {{ $loop->index == 1 ? 'blue' : '' }}">{{ $news->category->name }}</span>
                            <h4>{{ Str::limit($news->title, 70) }}</h4>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <!-- Right sidebar list -->
            <div class="pkr-hero-right">
                <div class="pkr-sidebar-title">Berita Lainnya</div>
                @foreach($sidebarNews as $news)
                <div class="pkr-sidebar-item">
                    <a href="{{ route('news.show', $news->slug) }}" class="d-flex gap-3 align-items-center">
                        <div class="pkr-sidebar-thumb">
                            @if($news->image)
                                <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}">
                            @else
                                <img src="{{ asset('assets/img/trending/right1.jpg') }}" alt="{{ $news->title }}">
                            @endif
                        </div>
                        <div class="pkr-sidebar-cap">
                            <span class="pkr-badge {{ $loop->index % 2 == 0 ? '' : 'blue' }}">{{ $news->category->name }}</span>
                            <p>{{ Str::limit($news->title, 55) }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

        </div>
        @endif
    </div>
</div>

<!-- ============================================================
     BERITA POPULER MINGGU INI
     ============================================================ -->
<section class="pkr-section pt-55 pb-40">
    <div class="container">
        <div class="pkr-section-title">
            <h3>Populer Minggu Ini</h3>
        </div>
        <div class="row">
            @foreach($weeklyNews as $news)
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="pkr-card h-100">
                    <div class="pkr-card-img">
                        @if($news->image)
                            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}">
                        @else
                            <img src="{{ asset('assets/img/news/weeklyNews1.jpg') }}" alt="{{ $news->title }}">
                        @endif
                        <span class="pkr-badge">{{ $news->category->name }}</span>
                    </div>
                    <div class="pkr-card-body">
                        <h4 class="pkr-card-title">
                            <a href="{{ route('news.show', $news->slug) }}">{{ Str::limit($news->title, 70) }}</a>
                        </h4>
                        <div class="pkr-card-meta">
                            <span><i class="far fa-clock"></i> {{ $news->created_at->diffForHumans() }}</span>
                            <span><i class="far fa-eye"></i> {{ number_format($news->views) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============================================================
     BERITA TERBARU + SIDEBAR
     ============================================================ -->
<section class="pkr-section pb-50" style="background:var(--white); border-top:1px solid var(--gray-200); border-bottom:1px solid var(--gray-200);">
    <div class="container pt-50">
        <div class="row">
            <!-- Main: Berita Terbaru -->
            <div class="col-lg-8">
                <div class="pkr-section-title">
                    <h3>Berita Terbaru</h3>
                </div>

                <!-- Category tabs -->
                <div class="pkr-tabs mb-30">
                    <a class="pkr-tab active" data-toggle="tab" href="#tab-all">Semua</a>
                    @foreach($categories->take(5) as $category)
                        <a class="pkr-tab" data-toggle="tab" href="#tab-{{ $category->slug }}">{{ $category->name }}</a>
                    @endforeach
                </div>

                <div class="tab-content">
                    <!-- Tab Semua -->
                    <div class="tab-pane fade show active" id="tab-all">
                        <div class="row">
                            @foreach($latestNews->take(4) as $news)
                            <div class="col-lg-6 col-md-6 mb-4">
                                <div class="pkr-card h-100">
                                    <div class="pkr-card-img" style="height:200px;">
                                        @if($news->image)
                                            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}">
                                        @else
                                            <img src="{{ asset('assets/img/news/whatNews1.jpg') }}" alt="{{ $news->title }}">
                                        @endif
                                        <span class="pkr-badge">{{ $news->category->name }}</span>
                                    </div>
                                    <div class="pkr-card-body">
                                        <h4 class="pkr-card-title">
                                            <a href="{{ route('news.show', $news->slug) }}">{{ Str::limit($news->title, 70) }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tab per Kategori -->
                    @foreach($categories->take(5) as $category)
                    <div class="tab-pane fade" id="tab-{{ $category->slug }}">
                        <div class="row">
                            @foreach($category->news()->published()->latest()->limit(4)->get() as $news)
                            <div class="col-lg-6 col-md-6 mb-4">
                                <div class="pkr-card h-100">
                                    <div class="pkr-card-img" style="height:200px;">
                                        @if($news->image)
                                            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}">
                                        @else
                                            <img src="{{ asset('assets/img/news/whatNews1.jpg') }}" alt="{{ $news->title }}">
                                        @endif
                                        <span class="pkr-badge">{{ $news->category->name }}</span>
                                    </div>
                                    <div class="pkr-card-body">
                                        <h4 class="pkr-card-title">
                                            <a href="{{ route('news.show', $news->slug) }}">{{ Str::limit($news->title, 70) }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- YouTube Videos -->
                <div class="pkr-section-title">
                    <h3>Video Terbaru</h3>
                </div>
                <div class="pkr-video-list mb-35">
                    <div class="pkr-video-item mb-3">
                        <div class="pkr-video-frame">
                            <iframe src="https://www.youtube.com/embed/VIDEO_ID_1"
                                title="YouTube video" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        <div class="pkr-video-cap">
                            <h5>Launching Website Poros Kie Raha</h5>
                            <p>Deskripsi singkat Poros Kieraha..</p>
                        </div>
                    </div>
                    <div class="pkr-video-item">
                        <div class="pkr-video-frame">
                            <iframe src="https://www.youtube.com/embed/VIDEO_ID_2"
                                title="YouTube video" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        <div class="pkr-video-cap">
                            <h5>Podcast Terbaru</h5>
                            <p>Podcast Terbaik...</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Ads -->
                <div class="pkr-ads-wrap">
                    @php
                        $sidebarAds = \App\Models\Ad::active()->sidebar()->ordered()->get();
                    @endphp
                    @foreach($sidebarAds as $ad)
                    <div class="pkr-ad-item mb-3">
                        @if($ad->link)
                            <a href="{{ route('ad.click', $ad) }}" target="_blank">
                                <img src="{{ $ad->image_url }}" alt="{{ $ad->title ?? 'Iklan' }}" class="w-100">
                            </a>
                        @else
                            <img src="{{ $ad->image_url }}" alt="{{ $ad->title ?? 'Iklan' }}" class="w-100">
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     ARTIKEL TERBARU
     ============================================================ -->
<section class="pkr-section pt-55 pb-50">
    <div class="container">
        <div class="pkr-section-title">
            <h3>Artikel Terbaru</h3>
        </div>
        <div class="row">
            @foreach($recentArticles as $article)
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="pkr-card h-100">
                    <div class="pkr-card-img">
                        @if($article->image)
                            <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}">
                        @else
                            <img src="{{ asset('assets/img/news/recent1.jpg') }}" alt="{{ $article->title }}">
                        @endif
                        <span class="pkr-badge blue">{{ $article->category->name }}</span>
                    </div>
                    <div class="pkr-card-body">
                        <h4 class="pkr-card-title">
                            <a href="{{ route('news.show', $article->slug) }}">{{ Str::limit($article->title, 70) }}</a>
                        </h4>
                        <div class="pkr-card-meta">
                            <span><i class="far fa-calendar"></i> {{ $article->created_at->diffForHumans() }}</span>
                            <span><i class="far fa-eye"></i> {{ number_format($article->views) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============================================================
     PARTNERS
     ============================================================ -->
<section class="pkr-partners-section">
    <div class="container">
        <div class="pkr-section-title justify-content-center text-center" style="flex-direction:column; align-items:center;">
            <div style="display:flex;align-items:center;gap:14px;margin-bottom:6px;">
                <span style="width:5px;height:26px;background:var(--red);border-radius:3px;display:block;"></span>
                <h3 style="margin:0;">Partner Of</h3>
                <span style="width:5px;height:26px;background:var(--blue-mid);border-radius:3px;display:block;"></span>
            </div>
            <p style="color:var(--text-soft);font-size:14px;margin:0 0 30px;">Mitra terpercaya yang mendukung kami</p>
        </div>

        <div class="swiper partners-swiper">
            <div class="swiper-wrapper">
                @php
                $partners = [
                    ['img' => 'https://poros-kieraha.com/assets/img/logo/hr.png', 'name' => 'HeartWare Digital', 'cat' => 'Media Partner'],
                    ['img' => 'https://i.pinimg.com/736x/6e/1f/75/6e1f7515e2a7e0bc6bd0fb74e64a94ae.jpg', 'name' => 'Partner Name 2', 'cat' => 'Technology'],
                    ['img' => 'https://poros-kieraha.com/assets/img/logo/hr.png', 'name' => 'Partner Name 3', 'cat' => 'Business'],
                    ['img' => 'https://i.pinimg.com/736x/6e/1f/75/6e1f7515e2a7e0bc6bd0fb74e64a94ae.jpg', 'name' => 'Partner Name 4', 'cat' => 'Education'],
                    ['img' => 'https://poros-kieraha.com/assets/img/logo/hr.png', 'name' => 'Partner Name 5', 'cat' => 'Healthcare'],
                    ['img' => 'https://i.pinimg.com/736x/6e/1f/75/6e1f7515e2a7e0bc6bd0fb74e64a94ae.jpg', 'name' => 'Partner Name 6', 'cat' => 'Finance'],
                ];
                @endphp
                @foreach($partners as $p)
                <div class="swiper-slide">
                    <div class="pkr-partner-card">
                        <div class="pkr-partner-logo">
                            <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}">
                        </div>
                        <div class="pkr-partner-info">
                            <strong>{{ $p['name'] }}</strong>
                            <span>{{ $p['cat'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next pkr-partners-next"><i class="fas fa-chevron-right"></i></div>
            <div class="swiper-button-prev pkr-partners-prev"><i class="fas fa-chevron-left"></i></div>
            <div class="swiper-pagination pkr-partners-pag"></div>
        </div>
    </div>
</section>

<!-- ============================================================
     PAGE STYLES
     ============================================================ -->
<style>
/* === TRENDING / HERO === */
.pkr-trending-area {
    background: var(--white);
    padding: 28px 0 40px;
    border-bottom: 1px solid var(--gray-200);
}

.pkr-trending-bar {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 20px;
}

.pkr-trending-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: var(--red);
    color: #fff;
    font-family: var(--font-body);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    padding: 6px 16px;
    border-radius: 3px;
}

.pkr-trending-divider {
    flex: 1;
    height: 1px;
    background: var(--gray-200);
}

.pkr-mobile-search-btn {
    display: flex;
    align-items: center;
    gap: 7px;
    background: var(--blue);
    color: #fff;
    border: none;
    font-size: 12.5px;
    font-weight: 700;
    padding: 7px 18px;
    border-radius: 3px;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: .05em;
    white-space: nowrap;
}

/* Hero grid */
.pkr-hero-grid {
    display: grid;
    grid-template-columns: 1fr 320px 280px;
    grid-template-rows: auto;
    gap: 20px;
    align-items: start;
}

@media (max-width: 1199px) {
    .pkr-hero-grid { grid-template-columns: 1fr 280px; }
    .pkr-hero-right { display: none; }
}

@media (max-width: 767px) {
    .pkr-hero-grid { grid-template-columns: 1fr; }
    .pkr-hero-side, .pkr-hero-right { display: none; }
}

/* Main hero */
.pkr-hero-main {
    border-radius: var(--radius-md);
    overflow: hidden;
    position: relative;
    box-shadow: var(--shadow-md);
}

.pkr-hero-link { display: block; }

.pkr-hero-img {
    position: relative;
    height: 420px;
    overflow: hidden;
}

.pkr-hero-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .5s ease;
}

.pkr-hero-main:hover .pkr-hero-img img { transform: scale(1.04); }

.pkr-hero-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(26,58,92,0.90) 0%, rgba(26,58,92,0.20) 55%, transparent 100%);
}

.pkr-hero-caption {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 28px;
}

.pkr-hero-title {
    font-family: var(--font-display);
    font-size: 26px;
    font-weight: 700;
    color: #fff;
    line-height: 1.35;
    margin: 10px 0 0;
    text-shadow: 0 1px 4px rgba(0,0,0,0.3);
}

/* Hero side */
.pkr-hero-side {
    display: flex;
    flex-direction: column;
    gap: 0;
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.pkr-hero-side-item {
    padding: 14px 16px;
    border-bottom: 1px solid var(--gray-100);
    transition: background .2s;
}

.pkr-hero-side-item:last-child { border-bottom: none; }

.pkr-hero-side-item:hover { background: var(--off-white); }

.pkr-hero-side-img {
    width: 80px;
    height: 60px;
    flex-shrink: 0;
    border-radius: var(--radius-sm);
    overflow: hidden;
}

.pkr-hero-side-img img { width: 100%; height: 100%; object-fit: cover; }

.pkr-hero-side-cap h4 {
    font-size: 13.5px;
    font-weight: 600;
    line-height: 1.4;
    color: var(--text-main);
    margin: 6px 0 0;
    transition: color .2s;
}

.pkr-hero-side-item:hover .pkr-hero-side-cap h4 { color: var(--red); }

/* Hero right sidebar */
.pkr-hero-right {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.pkr-sidebar-title {
    background: var(--blue);
    color: #fff;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    padding: 10px 16px;
}

.pkr-sidebar-item {
    padding: 12px 16px;
    border-bottom: 1px solid var(--gray-100);
    transition: background .2s;
}

.pkr-sidebar-item:last-child { border-bottom: none; }
.pkr-sidebar-item:hover { background: var(--off-white); }

.pkr-sidebar-thumb {
    width: 68px;
    height: 52px;
    flex-shrink: 0;
    border-radius: var(--radius-sm);
    overflow: hidden;
}

.pkr-sidebar-thumb img { width: 100%; height: 100%; object-fit: cover; }

.pkr-sidebar-cap p {
    font-size: 12.5px;
    font-weight: 600;
    line-height: 1.4;
    color: var(--text-main);
    margin: 5px 0 0;
    transition: color .2s;
}

.pkr-sidebar-item:hover .pkr-sidebar-cap p { color: var(--red); }

/* === SECTION SPACING === */
.pkr-section { }
.pt-55 { padding-top: 55px; }
.pb-40 { padding-bottom: 40px; }
.pb-50 { padding-bottom: 50px; }

/* === TABS === */
.pkr-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    border-bottom: 2px solid var(--gray-200);
    padding-bottom: 0;
}

.pkr-tab {
    display: inline-block;
    font-family: var(--font-body);
    font-size: 12.5px;
    font-weight: 600;
    letter-spacing: .04em;
    text-transform: uppercase;
    color: var(--gray-600);
    padding: 8px 16px;
    border-radius: var(--radius-sm) var(--radius-sm) 0 0;
    border: 1px solid transparent;
    border-bottom: 2px solid transparent;
    margin-bottom: -2px;
    cursor: pointer;
    transition: all .2s;
}

.pkr-tab:hover { color: var(--red); }

.pkr-tab.active,
.pkr-tab.show {
    color: var(--red);
    background: var(--white);
    border-color: var(--gray-200) var(--gray-200) var(--white);
    border-bottom-color: var(--white);
}

/* === VIDEO === */
.pkr-video-list {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    overflow: hidden;
    padding: 16px;
}

.pkr-video-frame {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    border-radius: var(--radius-sm);
    background: var(--blue);
}

.pkr-video-frame iframe {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    border: none;
}

.pkr-video-cap {
    padding: 10px 4px 4px;
}

.pkr-video-cap h5 {
    font-size: 14px;
    font-weight: 700;
    color: var(--text-main);
    margin: 0 0 4px;
}

.pkr-video-cap p {
    font-size: 12.5px;
    color: var(--text-soft);
    margin: 0;
}

/* === ADS === */
.pkr-ad-item img {
    border-radius: var(--radius-sm);
    width: 100%;
}

/* === PARTNERS === */
.pkr-partners-section {
    background: var(--off-white);
    border-top: 1px solid var(--gray-200);
    padding: 55px 0 70px;
}

.pkr-partner-card {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: 24px 16px 18px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 14px;
    transition: all .25s;
    height: 160px;
    justify-content: center;
}

.pkr-partner-card:hover {
    border-color: var(--red);
    box-shadow: var(--shadow-md);
    transform: translateY(-4px);
}

.pkr-partner-logo img {
    max-width: 110px;
    max-height: 60px;
    object-fit: contain;
    filter: grayscale(1);
    transition: filter .3s;
}

.pkr-partner-card:hover .pkr-partner-logo img { filter: grayscale(0); }

.pkr-partner-info {
    text-align: center;
    display: none;
}

.pkr-partner-card:hover .pkr-partner-info { display: flex; flex-direction: column; }

.pkr-partner-info strong {
    font-size: 13px;
    font-weight: 700;
    color: var(--blue);
}

.pkr-partner-info span {
    font-size: 11.5px;
    color: var(--gray-400);
}

/* Partner swiper nav */
.pkr-partners-next,
.pkr-partners-prev {
    width: 38px !important;
    height: 38px !important;
    background: var(--blue) !important;
    border-radius: 50% !important;
    color: #fff !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.pkr-partners-next::after,
.pkr-partners-prev::after { display: none; }

.pkr-partners-next { right: -14px !important; }
.pkr-partners-prev { left: -14px !important; }

.pkr-partners-pag .swiper-pagination-bullet-active {
    background: var(--red) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .pkr-hero-img { height: 260px; }
    .pkr-hero-title { font-size: 18px; }
    .pkr-hero-caption { padding: 18px; }
    .pkr-partners-section { padding: 40px 0 55px; }
}
</style>

@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
$(document).ready(function () {
    /* Partners Swiper */
    new Swiper('.partners-swiper', {
        slidesPerView: 2,
        spaceBetween: 20,
        loop: true,
        autoplay: { delay: 3500, disableOnInteraction: false },
        pagination: { el: '.pkr-partners-pag', clickable: true },
        navigation: { nextEl: '.pkr-partners-next', prevEl: '.pkr-partners-prev' },
        breakpoints: {
            576:  { slidesPerView: 3 },
            768:  { slidesPerView: 4 },
            1024: { slidesPerView: 5 },
        }
    });

    /* Tab toggle */
    $('.pkr-tab').on('click', function (e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $('.pkr-tab').removeClass('active show');
        $(this).addClass('active show');
        $('.tab-pane').removeClass('show active');
        $(target).addClass('show active');
    });
});
</script>
@endpush