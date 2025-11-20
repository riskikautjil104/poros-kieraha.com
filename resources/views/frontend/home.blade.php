{{-- @extends('frontend.layout')

@section('title', 'Home')

@section('content')
<!-- Hero Section - Featured News -->
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-2">Berita Terkini</h1>
        <p class="text-xl opacity-90">Informasi terpercaya, update setiap hari</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Featured News (Berita Utama) -->
    @if($featuredNews->count() > 0)
    <section class="mb-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Main Featured -->
            @php $mainNews = $featuredNews->first(); @endphp
            <div class="lg:col-span-2">
                <a href="{{ route('news.show', $mainNews->slug) }}" class="group block">
                    <div class="relative overflow-hidden rounded-xl shadow-lg">
                        @if($mainNews->image)
                        <img src="{{ Storage::url($mainNews->image) }}" alt="{{ $mainNews->title }}"
                            class="w-full h-96 object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                        <div
                            class="w-full h-96 bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                            <span class="text-white text-6xl">📰</span>
                        </div>
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                            <span
                                class="inline-block px-3 py-1 bg-indigo-600 text-white text-xs font-bold rounded-full mb-3">
                                {{ $mainNews->category->name }}
                            </span>
                            <h2 class="text-3xl font-bold text-white mb-2 group-hover:text-indigo-300 transition">
                                {{ $mainNews->title }}
                            </h2>
                            <p class="text-gray-200 mb-2">{{ Str::limit($mainNews->excerpt, 150) }}</p>
                            <div class="flex items-center text-sm text-gray-300 space-x-4">
                                <span>👤 {{ $mainNews->user->name }}</span>
                                <span>📅 {{ $mainNews->formatted_date }}</span>
                                <span>👁️ {{ number_format($mainNews->views) }} views</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Other Featured News -->
            @foreach($featuredNews->slice(1, 4) as $news)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                <a href="{{ route('news.show', $news->slug) }}" class="group">
                    @if($news->image)
                    <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}"
                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                    <div
                        class="w-full h-48 bg-gradient-to-br from-indigo-400 to-purple-400 flex items-center justify-center">
                        <span class="text-white text-4xl">📰</span>
                    </div>
                    @endif
                    <div class="p-5">
                        <span
                            class="inline-block px-2 py-1 bg-indigo-100 text-indigo-800 text-xs font-semibold rounded mb-2">
                            {{ $news->category->name }}
                        </span>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition">
                            {{ Str::limit($news->title, 60) }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($news->excerpt, 100) }}</p>
                        <div class="flex items-center text-xs text-gray-500 space-x-3">
                            <span>👤 {{ $news->user->name }}</span>
                            <span>📅 {{ $news->formatted_date }}</span>
                            <span>👁️ {{ number_format($news->views) }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Popular News (Berita Populer) -->
            <section class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">🔥 Berita Populer</h2>
                    <a href="{{ route('news.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                        Lihat Semua →
                    </a>
                </div>

                <div class="space-y-4">
                    @foreach($popularNews as $news)
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition flex">
                        @if($news->image)
                        <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}"
                            class="w-32 h-24 object-cover rounded-lg mr-4 flex-shrink-0">
                        @endif
                        <div class="flex-1">
                            <a href="{{ route('news.show', $news->slug) }}" class="group">
                                <span
                                    class="inline-block px-2 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded mb-1">
                                    {{ $news->category->name }}
                                </span>
                                <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-indigo-600 transition">
                                    {{ Str::limit($news->title, 80) }}
                                </h3>
                                <div class="flex items-center text-xs text-gray-500 space-x-3">
                                    <span>📅 {{ $news->formatted_date }}</span>
                                    <span>👁️ {{ number_format($news->views) }} views</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Categories -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">📂 Kategori</h3>
                <div class="space-y-2">
                    @foreach($categories as $category)
                    <a href="{{ route('news.category', $category->slug) }}"
                        class="flex items-center justify-between p-3 rounded-lg hover:bg-indigo-50 transition group">
                        <span class="text-gray-700 group-hover:text-indigo-600 font-medium">
                            {{ $category->name }}
                        </span>
                        <span
                            class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full group-hover:bg-indigo-600 group-hover:text-white">
                            {{ $category->news_count }}
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Newsletter -->
            <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg shadow-md p-6 text-white">
                <h3 class="text-xl font-bold mb-2">📬 Newsletter</h3>
                <p class="text-sm opacity-90 mb-4">Dapatkan berita terbaru langsung di email Anda!</p>
                <form id="newsletter-form" class="space-y-2">
                    @csrf
                    <input type="email" name="email" placeholder="Email Anda"
                        class="w-full px-4 py-2 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-white"
                        required>
                    <button type="submit"
                        class="w-full bg-white text-indigo-600 font-bold py-2 rounded-lg hover:bg-gray-100 transition">
                        Berlangganan
                    </button>
                </form>
                <div id="newsletter-message" class="mt-2 text-sm hidden"></div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

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
                        <strong>Trending now</strong>
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
<div class="weekly-news-area pt-50">
    <div class="container">
        <div class="weekly-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle mb-30">
                        <h3>🔥 Berita Populer Minggu Ini</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="weekly-news-active dot-style d-flex dot-style">
                        @foreach($weeklyNews as $news)
                        <div class="weekly-single">
                            <div class="weekly-img">
                                @if($news->image)
                                <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}">
                                @else
                                <img src="{{ asset('assets/img/news/weeklyNews1.jpg') }}" alt="{{ $news->title }}">
                                @endif
                            </div>
                            <div class="weekly-caption">
                                <span class="color1">{{ $news->category->name }}</span>
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
</div>
<!-- End Weekly-News -->

<!-- Whats New Start -->
<section class="whats-news-area pt-50 pb-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-3">
                        <div class="section-tittle mb-30">
                            <h3>📰 Berita Terbaru</h3>
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
                <!-- Follow Us -->
                <div class="section-tittle mb-40">
                    <h3>Follow Us</h3>
                </div>
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

                {{-- <!-- News Poster -->
                <div class="news-poster d-none d-lg-block">
                    <img src="{{ asset('assets/img/news/news_card.jpg') }}" alt="">
                </div> --}}
                <!-- News Poster / Iklan -->
<div class="news-poster d-none d-lg-block">
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
    @else
        <!-- Default jika tidak ada iklan -->
        {{-- <img src="{{ asset('assets/img/news/news_card.jpg') }}" alt="Default Ad"> --}}
    @endif
</div>
            </div>
        </div>
    </div>
</section>
<!-- Whats New End -->

<!-- Recent Articles start -->
<div class="recent-articles">
    <div class="container">
        <div class="recent-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle mb-30">
                        <h3>📄 Artikel Terbaru</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="recent-active dot-style d-flex dot-style">
                        @foreach($recentArticles as $article)
                        <div class="single-recent mb-100">
                            <div class="what-img">
                                @if($article->image)
                                <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}">
                                @else
                                <img src="{{ asset('assets/img/news/recent1.jpg') }}" alt="{{ $article->title }}">
                                @endif
                            </div>
                            <div class="what-cap">
                                <span class="color1">{{ $article->category->name }}</span>
                                <h4>
                                    <a href="{{ route('news.show', $article->slug) }}">
                                        {{ Str::limit($article->title, 50) }}
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
</div>
<!-- Recent Articles End -->

@endsection