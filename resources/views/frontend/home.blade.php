

@extends('frontend.layout')

@section('title', 'Home')

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
<!-- Trending Area Start -->
<div class="trending-area fix">
    <div class="container">
        <div class="trending-main">
            <!-- Trending Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending-tittle">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <strong>Trending now</strong>
                         <!-- Mobile Search Button (hanya muncul di mobile) -->
                            <div class="mobile-search-trigger d-md-none">
                                <button class="search-toggle-btn" id="mobileSearchBtn">
                                    <i class="fas fa-search"></i>
                                    <span>Search</span>
                                </button>
                            </div>
                            </div>
                       
                        
                        <!-- Mobile Search Box (slide down) -->
                        <div class="mobile-search-container d-md-none" id="mobileSearchBox" style="display: none;">
                            <form action="{{ route('news.search') }}" method="GET" class="mobile-search-form">
                                <div class="search-input-wrapper">
                                    <input type="text" 
                                           name="q" 
                                           placeholder="Cari berita..." 
                                           value="{{ request('q') }}"
                                           class="mobile-search-input">
                                    <button type="submit" class="mobile-search-submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="trending-animated">
                            <ul id="js-news" class="js-hidden">
                                @foreach($trendingNews as $trending)
                                <li class="news-item">
                                    <a href="{{ route('news.show', $trending->slug) }}">{{ $trending->title }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div> --}}
                        {{-- <div class="trending-animated" style="background-color: transparent">
                            <ul id="js-news" class="js-hidden">
                                <li class="news-item">Selamat Datang diWebsite Portal KieRaha</li>
                                <li class="news-item">Portal Berita Terpecaya</li>
                                <li class="news-item">Berita ter tajam</li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <!-- Trending Top (Berita Utama) -->
                    @if($featuredNews->count() > 0)
                    @php $mainNews = $featuredNews->first(); @endphp
                    <div class="trending-top mb-30">
                        <div class="trend-top-img">
                            @if($mainNews->image)
                            <img src="{{ Storage::url($mainNews->image) }}" alt="{{ $mainNews->title }}">
                            @else
                            <img src="{{ asset('assets/img/trending/trending_top.jpg') }}" alt="{{ $mainNews->title }}">
                            @endif
                            <div class="trend-top-cap">
                                <span>{{ $mainNews->category->name }}</span>
                                <h2>
                                    <a href="{{ route('news.show', $mainNews->slug) }}">
                                        {{ $mainNews->title }}
                                    </a>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <!-- Trending Bottom (3 berita berikutnya) -->
                    <div class="trending-bottom">
                        <div class="row">
                            @foreach($featuredNews->slice(1, 3) as $news)
                            <div class="col-lg-4">
                                <div class="single-bottom mb-35">
                                    <div class="trend-bottom-img mb-30">
                                        @if($news->image)
                                        <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}">
                                        @else
                                        <img src="{{ asset('assets/img/trending/trending_bottom1.jpg') }}"
                                            alt="{{ $news->title }}">
                                        @endif
                                    </div>
                                    <div class="trend-bottom-cap">
                                        <span class="color{{ ($loop->index % 3) + 1 }}">{{ $news->category->name
                                            }}</span>
                                        <h4>
                                            <a href="{{ route('news.show', $news->slug) }}">
                                                {{ Str::limit($news->title, 60) }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right content (Sidebar kanan) -->
                <div class="col-lg-4">
                    @foreach($sidebarNews as $news)
                    <div class="trand-right-single d-flex">
                        <div class="trand-right-img">
                            @if($news->image)
                            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}"
                                style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                            <img src="{{ asset('assets/img/trending/right1.jpg') }}" alt="{{ $news->title }}">
                            @endif
                        </div>
                        <div class="trand-right-cap">
                            <span class="color{{ ($loop->index % 4) + 1 }}">{{ $news->category->name }}</span>
                            <h4>
                                <a href="{{ route('news.show', $news->slug) }}">
                                    {{ Str::limit($news->title, 50) }}
                                </a>
                            </h4>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Trending Area End -->

<!-- Weekly-News start -->
<!--<div class="weekly-news-area pt-50">-->
<!--    <div class="container">-->
<!--        <div class="weekly-wrapper">-->
<!--            <div class="row">-->
<!--                <div class="col-lg-12">-->
<!--                    <div class="section-tittle mb-30">-->
<!--                        <h3>Berita Populer Minggu Ini</h3>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col-12">-->
<!--                    <div class="weekly-news-active dot-style d-flex dot-style">-->
<!--                        @foreach($weeklyNews as $news)-->
<!--                        <div class="weekly-single">-->
<!--                            <div class="weekly-img">-->
<!--                                @if($news->image)-->
<!--                                <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}">-->
<!--                                @else-->
<!--                                <img src="{{ asset('assets/img/news/weeklyNews1.jpg') }}" alt="{{ $news->title }}">-->
<!--                                @endif-->
<!--                            </div>-->
<!--                            <div class="weekly-caption">-->
<!--                                <span class="color1">{{ $news->category->name }}</span>-->
<!--                                <h4>-->
<!--                                    <a href="{{ route('news.show', $news->slug) }}">-->
<!--                                        {{ Str::limit($news->title, 50) }}-->
<!--                                    </a>-->
<!--                                </h4>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        @endforeach-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!-- End Weekly-News -->
<!-- Weekly-News start -->
<div class="weekly-news-area pt-50 pb-20">
    <div class="container">
        <div class="weekly-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle mb-30">
                        <h3>Berita Populer Minggu Ini</h3>
                    </div>
                </div>
            </div>
            
            <div class="row">
                @foreach($weeklyNews as $news)
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="weekly-card">
                        <div class="weekly-img-wrapper">
                            @if($news->image)
                            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}">
                            @else
                            <img src="{{ asset('assets/img/news/weeklyNews1.jpg') }}" alt="{{ $news->title }}">
                            @endif
                            <div class="overlay">
                                <a href="{{ route('news.show', $news->slug) }}" class="read-more-btn">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="weekly-caption">
                            <span class="category-badge">{{ $news->category->name }}</span>
                            <h4>
                                <a href="{{ route('news.show', $news->slug) }}">
                                    {{ Str::limit($news->title, 60) }}
                                </a>
                            </h4>
                            <div class="meta-info">
                                <span><i class="far fa-calendar"></i> {{ $news->created_at->diffForHumans() }}</span>
                                <span><i class="far fa-eye"></i> {{ number_format($news->views) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- End Weekly-News -->

{{-- ============ IKLAN CONTENT (di antara section) ============ --}}
@php
    $contentAds = \App\Models\Ad::active()->content()->ordered()->get();
@endphp
@if($contentAds->count() > 0)
<div class="content-ads-wrap py-3">
    <div class="container">
        <div class="content-ads-inner">
            @foreach($contentAds as $cAd)
            <div class="content-ad-item">
                <small class="ad-label">Iklan</small>
                @if($cAd->link)
                    <a href="{{ route('ad.click', $cAd) }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ $cAd->image_url }}" alt="{{ $cAd->title ?? 'Iklan' }}">
                    </a>
                @else
                    <img src="{{ $cAd->image_url }}" alt="{{ $cAd->title ?? 'Iklan' }}">
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
<style>
.content-ads-wrap { background: #f8f9fa; border-top: 1px solid #e2e6ea; border-bottom: 1px solid #e2e6ea; }
.content-ads-inner { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; align-items: center; }
.content-ad-item { position: relative; text-align: center; }
.content-ad-item .ad-label {
    display: block;
    font-size: 10px;
    color: #aaa;
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-bottom: 4px;
}
.content-ad-item img {
    max-height: 100px;
    max-width: 728px;
    width: 100%;
    object-fit: cover;
    border-radius: 6px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    transition: transform .25s, box-shadow .25s;
}
.content-ad-item img:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(0,0,0,0.13); }
</style>
@endif
{{-- ============ /IKLAN CONTENT ============ --}}

<!-- Whats New Start -->
<section class="whats-news-area pt-50 pb-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-3">
                        <div class="section-tittle mb-30">
                            <h3>Berita Terbaru</h3>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="properties__button">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                        href="#nav-home" role="tab">
                                        Semua
                                    </a>
                                    @foreach($categories->take(5) as $category)
                                    <a class="nav-item nav-link" id="nav-{{ $category->slug }}-tab" data-toggle="tab"
                                        href="#nav-{{ $category->slug }}" role="tab">
                                        {{ $category->name }}
                                    </a>
                                    @endforeach
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="nav-tabContent">
                            <!-- Tab Semua -->
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        @foreach($latestNews->take(4) as $news)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    @if($news->image)
                                                    <img src="{{ Storage::url($news->image) }}"
                                                        alt="{{ $news->title }}">
                                                    @else
                                                    <img src="{{ asset('assets/img/news/whatNews1.jpg') }}"
                                                        alt="{{ $news->title }}">
                                                    @endif
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">{{ $news->category->name }}</span>
                                                    <h4>
                                                        <a href="{{ route('news.show', $news->slug) }}">
                                                            {{ Str::limit($news->title, 60) }}
                                                        </a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Tab per Kategori -->
                            @foreach($categories->take(5) as $category)
                            <div class="tab-pane fade" id="nav-{{ $category->slug }}" role="tabpanel">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        @foreach($category->news()->published()->latest()->limit(4)->get() as $news)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    @if($news->image)
                                                    <img src="{{ Storage::url($news->image) }}"
                                                        alt="{{ $news->title }}">
                                                    @else
                                                    <img src="{{ asset('assets/img/news/whatNews1.jpg') }}"
                                                        alt="{{ $news->title }}">
                                                    @endif
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">{{ $news->category->name }}</span>
                                                    <h4>
                                                        <a href="{{ route('news.show', $news->slug) }}">
                                                            {{ Str::limit($news->title, 60) }}
                                                        </a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
<!-- Sidebar -->
    <div class="col-lg-4">
    <!-- YouTube Video -->
    <div class="section-tittle mb-30">
        <h3><i class="fab fa-youtube"></i> Video Terbaru</h3>
    </div>

    <div class="youtube-video-wrapper mb-45">
        @if(isset($youtubeVideos) && $youtubeVideos->count() > 0)
            @foreach($youtubeVideos as $video)
                <div class="single-video mb-30">
                    <div class="video-frame">
                        @if($video->embed_url)
                            <iframe
                                src="{{ $video->embed_url }}"
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        @endif
                    </div>
                    <div class="video-caption">
                        <h5>{{ $video->title }}</h5>
                        <p class="video-desc">{{ $video->description ? Str::limit($video->description, 90) : '-' }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-sm text-gray-500">Belum ada video YouTube.</p>
        @endif
    </div>

    <!-- News Poster / Iklan -->
    <div class="news-poster">
        @php
            $sidebarAds = \App\Models\Ad::active()
                ->sidebar()
                ->ordered()
                ->get();
        @endphp

        @if($sidebarAds->count() > 0)
            @foreach($sidebarAds as $ad)
            <div class="mb-4">
                @if($ad->link)
                <a href="{{ route('ad.click', $ad) }}" target="_blank">
                    <img src="{{ $ad->image_url }}" alt="{{ $ad->title ?? 'Iklan' }}" class="w-100">
                </a>
                @else
                <img src="{{ $ad->image_url }}" alt="{{ $ad->title ?? 'Iklan' }}" class="w-100">
                @endif
            </div>
            @endforeach
        @endif
    </div>
</div>
  
        </div>
    </div>
</section>
<!-- Whats New End -->

<!-- Recent Articles start -->
<div class="recent-articles pt-50 pb-50" style="background: #f8f9fa;">
    <div class="container">
        <div class="recent-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle mb-30">
                        <h3>Artikel Terbaru</h3>
                    </div>
                </div>
            </div>
            
            <div class="row">
                @foreach($recentArticles as $article)
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="recent-card">
                        <div class="recent-img-wrapper">
                            @if($article->image)
                            <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}">
                            @else
                            <img src="{{ asset('assets/img/news/recent1.jpg') }}" alt="{{ $article->title }}">
                            @endif
                            <div class="overlay">
                                <a href="{{ route('news.show', $article->slug) }}" class="read-more-btn">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="recent-caption">
                            <span class="category-badge">{{ $article->category->name }}</span>
                            <h4>
                                <a href="{{ route('news.show', $article->slug) }}">
                                    {{ Str::limit($article->title, 60) }}
                                </a>
                            </h4>
                            <div class="meta-info">
                                <span><i class="far fa-calendar"></i> {{ $article->created_at->diffForHumans() }}</span>
                                <span><i class="far fa-eye"></i> {{ number_format($article->views) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Recent Articles End -->
<!-- Partners Section Start -->
<div class="partners-area pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center mb-50">
                    <h3>Partner Of</h3>
                    <p>Mitra terpercaya yang mendukung kami</p>
                </div>
            </div>
        </div>

        <!-- Partners Carousel -->
        <div class="partners-carousel-wrapper">
            <div class="swiper partners-swiper">
                <div class="swiper-wrapper">
                    <!-- Partner 1 -->
                    <div class="swiper-slide">
                        <div class="partner-card">
                            <div class="partner-logo">
                                <img src="https://poros-kieraha.com/assets/img/logo/hr.png" alt="Partner 1">
                            </div>
                            <div class="partner-overlay">
                                <h4>HeartWare Digital</h4>
                                <p>Kategori: Media Partner</p>
                                <a href="#" class="partner-link">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Partner 2 -->
                    <div class="swiper-slide">
                        <div class="partner-card">
                            <div class="partner-logo">
                                <img src="https://i.pinimg.com/736x/6e/1f/75/6e1f7515e2a7e0bc6bd0fb74e64a94ae.jpg" alt="Partner 2">
                            </div>
                            <div class="partner-overlay">
                                <h4>Partner Name 2</h4>
                                <p>Kategori: Technology</p>
                                <a href="#" class="partner-link">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Partner 3 -->
                    <div class="swiper-slide">
                        <div class="partner-card">
                            <div class="partner-logo">
                                <img src="https://poros-kieraha.com/assets/img/logo/hr.png" alt="Partner 3">
                            </div>
                            <div class="partner-overlay">
                                <h4>Partner Name 3</h4>
                                <p>Kategori: Business</p>
                                <a href="#" class="partner-link">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Partner 4 -->
                    <div class="swiper-slide">
                        <div class="partner-card">
                            <div class="partner-logo">
                                <img src="https://i.pinimg.com/736x/6e/1f/75/6e1f7515e2a7e0bc6bd0fb74e64a94ae.jpg" alt="Partner 4">
                            </div>
                            <div class="partner-overlay">
                                <h4>Partner Name 4</h4>
                                <p>Kategori: Education</p>
                                <a href="#" class="partner-link">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Partner 5 -->
                    <div class="swiper-slide">
                        <div class="partner-card">
                            <div class="partner-logo">
                                <img src="https://poros-kieraha.com/assets/img/logo/hr.png" alt="Partner 5">
                            </div>
                            <div class="partner-overlay">
                                <h4>Partner Name 5</h4>
                                <p>Kategori: Healthcare</p>
                                <a href="#" class="partner-link">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Partner 6 -->
                    <div class="swiper-slide">
                        <div class="partner-card">
                            <div class="partner-logo">
                                <img src="https://i.pinimg.com/736x/6e/1f/75/6e1f7515e2a7e0bc6bd0fb74e64a94ae.jpg" alt="Partner 6">
                            </div>
                            <div class="partner-overlay">
                                <h4>Partner Name 6</h4>
                                <p>Kategori: Finance</p>
                                <a href="#" class="partner-link">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="swiper-button-next partners-next">
                    <i class="fas fa-chevron-right"></i>
                </div>
                <div class="swiper-button-prev partners-prev">
                    <i class="fas fa-chevron-left"></i>
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination partners-pagination"></div>
            </div>
        </div>
    </div>
</div>
<!-- Partners Section End -->


<style>
/* Weekly News Cards */
.weekly-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
}

.weekly-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.15);
}

.weekly-img-wrapper {
    position: relative;
    overflow: hidden;
    height: 220px;
}

.weekly-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.weekly-card:hover .weekly-img-wrapper img {
    transform: scale(1.1);
}

.weekly-img-wrapper .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255,0,85,0.9), rgba(139,0,139,0.9));
    opacity: 0;
    transition: opacity 0.4s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.weekly-card:hover .weekly-img-wrapper .overlay {
    opacity: 1;
}

.read-more-btn {
    width: 50px;
    height: 50px;
    background: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ff0055;
    font-size: 18px;
    transform: scale(0);
    transition: transform 0.3s ease;
}

.weekly-card:hover .read-more-btn {
    transform: scale(1);
}

.weekly-caption {
    padding: 20px;
}

.category-badge {
    display: inline-block;
    background: linear-gradient(135deg, #ff0055, #8b008b);
    color: #fff;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
}

.weekly-caption h4 {
    font-size: 16px;
    line-height: 1.5;
    margin-bottom: 12px;
    min-height: 48px;
}

.weekly-caption h4 a {
    color: #2c234d;
    transition: color 0.3s ease;
}

.weekly-caption h4 a:hover {
    color: #ff0055;
}

.meta-info {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    color: #888;
    border-top: 1px solid #eee;
    padding-top: 12px;
}

.meta-info span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.meta-info i {
    color: #ff0055;
}

/* Recent Articles Cards (slight variation) */
.recent-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    border: 2px solid transparent;
}

.recent-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 15px 40px rgba(255,0,85,0.2);
    border-color: #ff0055;
}

.recent-img-wrapper {
    position: relative;
    overflow: hidden;
    height: 220px;
}

.recent-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s ease;
    filter: brightness(1);
}

.recent-card:hover .recent-img-wrapper img {
    transform: scale(1.15) rotate(2deg);
    filter: brightness(1.1);
}

.recent-img-wrapper .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(59,130,246,0.9), rgba(147,51,234,0.9));
    opacity: 0;
    transition: opacity 0.4s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.recent-card:hover .recent-img-wrapper .overlay {
    opacity: 1;
}

.recent-caption {
    padding: 20px;
}

.recent-caption h4 {
    font-size: 16px;
    line-height: 1.5;
    margin-bottom: 12px;
    min-height: 48px;
}

.recent-caption h4 a {
    color: #2c234d;
    transition: color 0.3s ease;
}

.recent-caption h4 a:hover {
    color: #3b82f6;
}

/* Animation entrance */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.weekly-card,
.recent-card {
    animation: fadeInUp 0.6s ease backwards;
}

.weekly-card:nth-child(1) { animation-delay: 0.1s; }
.weekly-card:nth-child(2) { animation-delay: 0.2s; }
.weekly-card:nth-child(3) { animation-delay: 0.3s; }
.weekly-card:nth-child(4) { animation-delay: 0.4s; }

.recent-card:nth-child(1) { animation-delay: 0.1s; }
.recent-card:nth-child(2) { animation-delay: 0.2s; }
.recent-card:nth-child(3) { animation-delay: 0.3s; }
.recent-card:nth-child(4) { animation-delay: 0.4s; }

/* Responsive */
@media (max-width: 768px) {
    .weekly-img-wrapper,
    .recent-img-wrapper {
        height: 180px;
    }
    
    .weekly-caption h4,
    .recent-caption h4 {
        min-height: auto;
        font-size: 15px;
    }
}
/* Mobile Search Button - Style seperti Trending Now */
.mobile-search-trigger {
    margin-left: 15px;
}

.search-toggle-btn {
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    color: #fff;
    border: none;
    padding: 8px 20px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 8, 68, 0.3);
}

.search-toggle-btn:hover,
.search-toggle-btn:active {
    background: linear-gradient(135deg, #ff3366 0%, #ff0844 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 8, 68, 0.4);
}

.search-toggle-btn i {
    font-size: 14px;
}

/* Mobile Search Container */
.mobile-search-container {
    margin-top: 15px;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.mobile-search-form {
    width: 100%;
}

.search-input-wrapper {
    position: relative;
    display: flex;
    background: #fff;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.mobile-search-input {
    flex: 1;
    padding: 12px 20px;
    border: 2px solid #ff0844;
    border-right: none;
    font-size: 14px;
    outline: none;
    border-radius: 25px 0 0 25px;
}

.mobile-search-input::placeholder {
    color: #999;
}

.mobile-search-submit {
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    color: #fff;
    border: none;
    padding: 12px 25px;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 0 25px 25px 0;
}

.mobile-search-submit:active {
    background: linear-gradient(135deg, #ff3366 0%, #ff0844 100%);
}

.mobile-search-submit i {
    font-size: 16px;
}

/* Responsive - pastikan tampil bagus di semua ukuran mobile */
@media (max-width: 576px) {
    .trending-tittle strong {
        font-size: 18px;
    }
    
    .search-toggle-btn {
        padding: 6px 15px;
        font-size: 12px;
    }
    
    .mobile-search-input {
        padding: 10px 15px;
        font-size: 13px;
    }
    
    .mobile-search-submit {
        padding: 10px 20px;
    }
}
/* YouTube Video Section */
.youtube-video-wrapper {
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

.section-tittle h3 i {
    color: #ff0844;
    margin-right: 8px;
}

.single-video {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.single-video:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(255, 8, 68, 0.15);
}

.video-frame {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
    height: 0;
    overflow: hidden;
    border-radius: 8px 8px 0 0;
    background: #000;
}

.video-frame iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}

.video-caption {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 0 0 8px 8px;
}

.video-caption h5 {
    font-size: 15px;
    font-weight: 700;
    color: #2c234d;
    margin-bottom: 8px;
    line-height: 1.4;
}

.video-caption h5:hover {
    color: #ff0844;
}

.video-desc {
    font-size: 13px;
    color: #666;
    margin: 0;
    line-height: 1.5;
}

/* Responsive */
@media (max-width: 991px) {
    .youtube-video-wrapper {
        margin-top: 30px;
    }
}

/* Partners Section */
.partners-area {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    position: relative;
}

.partners-area .section-tittle h3 {
    font-size: 32px;
    font-weight: 700;
    color: #2c234d;
    margin-bottom: 10px;
    position: relative;
    display: inline-block;
}

.partners-area .section-tittle h3::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    border-radius: 2px;
}

.partners-area .section-tittle p {
    color: #666;
    font-size: 16px;
}

.partners-carousel-wrapper {
    position: relative;
    padding: 20px 60px;
}

/* Partner Card */
.partner-card {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    border: 3px solid transparent;
}

.partner-card:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 15px 40px rgba(255, 8, 68, 0.25);
    border-color: #ff0844;
}

/* Active state saat di-klik */
.partner-card.active {
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    border-color: #ff0844;
    transform: scale(1.1);
}

.partner-card.active .partner-logo {
    opacity: 0.3;
    filter: brightness(0) invert(1);
}

.partner-card.active .partner-overlay {
    opacity: 1;
    transform: translateY(0);
}

/* Partner Logo */
.partner-logo {
    position: relative;
    z-index: 1;
    transition: all 0.4s ease;
}

.partner-logo img {
    max-width: 150px;
    max-height: 100px;
    object-fit: contain;
    filter: grayscale(100%);
    transition: all 0.4s ease;
}

.partner-card:hover .partner-logo img,
.partner-card.active .partner-logo img {
    filter: grayscale(0%);
}

/* Partner Overlay */
.partner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s ease;
    z-index: 2;
}

.partner-card:hover .partner-overlay {
    opacity: 1;
    transform: translateY(0);
}

.partner-overlay h4 {
    color: #fff;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 8px;
    text-align: center;
}

.partner-overlay p {
    color: rgba(255,255,255,0.9);
    font-size: 14px;
    margin-bottom: 15px;
}

.partner-link {
    width: 40px;
    height: 40px;
    background: #fff;
    color: #ff0844;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.partner-link:hover {
    transform: scale(1.2) rotate(360deg);
    box-shadow: 0 5px 15px rgba(255,255,255,0.5);
}

/* Navigation Buttons */
.partners-next,
.partners-prev {
    width: 45px !important;
    height: 45px !important;
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%) !important;
    border-radius: 50% !important;
    color: #fff !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-shadow: 0 4px 15px rgba(255, 8, 68, 0.3);
    transition: all 0.3s ease;
}

.partners-next::after,
.partners-prev::after {
    display: none;
}

.partners-next:hover,
.partners-prev:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(255, 8, 68, 0.5);
}

.partners-next {
    right: 10px !important;
}

.partners-prev {
    left: 10px !important;
}

/* Pagination */
.partners-pagination {
    bottom: -30px !important;
}

.partners-pagination .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    background: #ddd;
    opacity: 1;
    transition: all 0.3s ease;
}

.partners-pagination .swiper-pagination-bullet-active {
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    width: 30px;
    border-radius: 6px;
}

/* Responsive */
@media (max-width: 768px) {
    .partners-carousel-wrapper {
        padding: 20px 40px;
    }
    
    .partner-card {
        height: 180px;
        padding: 20px;
    }
    
    .partner-logo img {
        max-width: 120px;
        max-height: 80px;
    }
    
    .partners-next,
    .partners-prev {
        width: 35px !important;
        height: 35px !important;
    }
    
    .partner-overlay h4 {
        font-size: 16px;
    }
    
    .partner-overlay p {
        font-size: 13px;
    }
}

@media (max-width: 576px) {
    .partners-area .section-tittle h3 {
        font-size: 24px;
    }
    
    .partner-card {
        height: 160px;
    }
}
</style>

@endsection

@push('scripts')
<!-- Swiper JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
// Weekly News Swiper
new Swiper('.weekly-swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        640: { slidesPerView: 2 },
        768: { slidesPerView: 3 },
        1024: { slidesPerView: 4 },
    }
});

// Recent Articles Swiper
new Swiper('.recent-swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        640: { slidesPerView: 2 },
        768: { slidesPerView: 3 },
        1024: { slidesPerView: 4 },
    }
});
// Mobile Search Toggle
$(document).ready(function() {
    $('#mobileSearchBtn').click(function() {
        $('#mobileSearchBox').slideToggle(300);
        $(this).toggleClass('active');
    });
    
    // Auto focus pada input saat search box dibuka
    $('#mobileSearchBox').on('shown', function() {
        $('.mobile-search-input').focus();
    });
});
// Partners Swiper
new Swiper('.partners-swiper', {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.partners-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.partners-next',
        prevEl: '.partners-prev',
    },
    breakpoints: {
        576: { slidesPerView: 2, spaceBetween: 20 },
        768: { slidesPerView: 3, spaceBetween: 25 },
        1024: { slidesPerView: 4, spaceBetween: 30 },
        1200: { slidesPerView: 5, spaceBetween: 30 },
    }
});

// Partner Card Click Effect
$(document).ready(function() {
    $('.partner-card').click(function() {
        // Remove active dari semua cards
        $('.partner-card').removeClass('active');
        
        // Tambah active ke card yang diklik
        $(this).addClass('active');
        
        // Optional: Remove active setelah 2 detik
        setTimeout(() => {
            $(this).removeClass('active');
        }, 2000);
    });
});
</script>
@endpush


