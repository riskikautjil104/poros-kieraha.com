<!doctype html>
<html class="no-js" lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="-J57x5J8VBv3H-yEytMuyW3OoC7Uj3SoZjVIyRjkdRU" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Basic SEO --}}
    <title>@yield('title', 'Berita Ternate & Maluku Utara Terkini') - {{ config('app.name', 'Poros Kie Raha') }}</title>
    <meta name="description" content="@yield('meta_description', 'Portal berita terpercaya Ternate, Tidore, dan Maluku Utara. Informasi terkini seputar politik, ekonomi, sosial, budaya, dan olahraga.')">
    <meta name="keywords" content="@yield('meta_keywords', 'berita ternate, berita maluku utara, berita tidore, poros kie raha, berita malut, berita halmahera')">
    <meta name="author" content="Poros Kie Raha">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Berita Ternate & Maluku Utara') - Poros Kie Raha">
    <meta property="og:description" content="@yield('meta_description', 'Portal berita terpercaya Ternate, Tidore, dan Maluku Utara.')">
    <meta property="og:image" content="@yield('og_image', asset('assets/img/logo/poros fix.PNG'))">
    <meta property="og:site_name" content="Poros Kie Raha">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Berita Ternate & Maluku Utara') - Poros Kie Raha">
    <meta name="twitter:description" content="@yield('meta_description', 'Portal berita terpercaya Ternate dan Maluku Utara.')">
    <meta name="twitter:image" content="@yield('og_image', asset('assets/img/logo/poros fix.PNG'))">

    {{-- Geo Tags --}}
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate, Maluku Utara">
    <meta name="geo.position" content="0.7833;127.3667">
    <meta name="ICBM" content="0.7833, 127.3667">

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/logo/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/logo/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('assets/img/logo/favicon/site.webmanifest') }}" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ticker-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('styles')

    <style>
        /* ============================================
           DESIGN SYSTEM — MERAH PUTIH BIRU CORPORATE
           ============================================ */
        :root {
            --red:        #C0392B;
            --red-dark:   #922B21;
            --red-light:  #E8D5D3;
            --blue:       #1A3A5C;
            --blue-mid:   #2563A8;
            --blue-light: #D6E4F0;
            --white:      #FFFFFF;
            --off-white:  #F5F7FA;
            --gray-100:   #F0F2F5;
            --gray-200:   #E2E6EA;
            --gray-400:   #9BA3AC;
            --gray-600:   #555E6B;
            --gray-800:   #2C3340;
            --text-main:  #1C2330;
            --text-soft:  #5A6375;

            --font-display: 'Source Serif 4', Georgia, serif;
            --font-body:    'Inter', sans-serif;

            --radius-sm:  4px;
            --radius-md:  8px;
            --radius-lg:  14px;
            --shadow-sm:  0 1px 4px rgba(0,0,0,0.08);
            --shadow-md:  0 4px 16px rgba(0,0,0,0.10);
            --shadow-lg:  0 8px 32px rgba(0,0,0,0.13);
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: var(--font-body);
            color: var(--text-main);
            background: var(--off-white);
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-display);
            color: var(--text-main);
        }

        a { color: inherit; text-decoration: none; transition: color .2s; }
        a:hover { color: var(--red); }

        /* ---- TOP BAR ---- */
        .pkr-topbar {
            background: var(--blue);
            color: rgba(255,255,255,0.85);
            font-size: 12.5px;
            font-family: var(--font-body);
            padding: 8px 0;
            border-bottom: 3px solid var(--red);
        }

        .pkr-topbar .date-text {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            letter-spacing: .02em;
        }

        .pkr-topbar .date-text i {
            color: var(--red);
            font-size: 11px;
        }

        /* ---- NEWS TICKER ---- */
        .news-ticker {
            display: flex;
            align-items: center;
            max-width: 600px;
        }

        .ticker-label {
            background: var(--red);
            color: #fff;
            font-weight: 700;
            font-size: 10.5px;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: var(--radius-sm);
            white-space: nowrap;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .ticker-content { flex: 1; overflow: hidden; position: relative; }

        .ticker-wrapper {
            display: flex;
            animation: ticker-scroll 20s linear infinite;
            white-space: nowrap;
        }

        .ticker-item {
            color: rgba(255,255,255,0.85);
            font-size: 12.5px;
            padding: 0 18px;
            white-space: nowrap;
            transition: color .2s;
        }

        .ticker-item:hover { color: #fff; }

        .ticker-item:not(:last-child)::after {
            content: "·";
            color: var(--red);
            margin-left: 18px;
        }

        @keyframes ticker-scroll {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .ticker-wrapper:hover { animation-play-state: paused; }

        /* ---- HEADER MID ---- */
        .pkr-header-mid {
            background: var(--white);
            padding: 18px 0;
            border-bottom: 1px solid var(--gray-200);
        }

        .pkr-logo img { height: 64px; }

        /* ---- NAVIGATION ---- */
        .pkr-nav {
            background: var(--blue);
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 8px rgba(26,58,92,0.18);
        }

        .pkr-nav .container {
            display: flex;
            align-items: center;
            gap: 0;
        }

        .pkr-nav-logo {
            display: none;
            align-items: center;
            padding: 10px 20px 10px 0;
            border-right: 1px solid rgba(255,255,255,0.12);
            margin-right: 8px;
        }

        .pkr-nav-logo img { height: 40px; }

        .pkr-nav-logo.sticky-show { display: flex; }

        /* Nav links */
        .pkr-nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .pkr-nav ul li { position: relative; }

        .pkr-nav ul li > a {
            display: block;
            color: rgba(255,255,255,0.88);
            font-family: var(--font-body);
            font-size: 13.5px;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
            padding: 18px 18px;
            transition: all .2s;
            position: relative;
        }

        .pkr-nav ul li > a::after {
            content: '';
            position: absolute;
            bottom: 0; left: 50%; right: 50%;
            height: 3px;
            background: var(--red);
            transition: left .25s, right .25s;
        }

        .pkr-nav ul li > a:hover,
        .pkr-nav ul li > a.active {
            color: #fff;
        }

        .pkr-nav ul li > a:hover::after,
        .pkr-nav ul li > a.active::after {
            left: 0; right: 0;
        }

        /* Submenu */
        .pkr-nav ul li .submenu {
            position: absolute;
            top: calc(100% + 0px);
            left: 0;
            background: var(--white);
            min-width: 200px;
            border-top: 3px solid var(--red);
            border-radius: 0 0 var(--radius-md) var(--radius-md);
            box-shadow: var(--shadow-lg);
            display: none;
            flex-direction: column;
            z-index: 1000;
        }

        .pkr-nav ul li:hover .submenu { display: flex; }

        .pkr-nav ul li .submenu li a {
            color: var(--text-main);
            font-size: 13px;
            font-weight: 500;
            padding: 11px 18px;
            border-bottom: 1px solid var(--gray-100);
            text-transform: none;
            letter-spacing: 0;
        }

        .pkr-nav ul li .submenu li a::after { display: none; }

        .pkr-nav ul li .submenu li a:hover {
            background: var(--off-white);
            color: var(--red);
            padding-left: 24px;
        }

        /* Search in nav */
        .pkr-nav-search {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 0;
        }

        .pkr-nav-search form {
            display: flex;
            align-items: center;
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 20px;
            overflow: hidden;
            transition: background .2s;
        }

        .pkr-nav-search form:focus-within {
            background: rgba(255,255,255,0.18);
        }

        .pkr-nav-search input {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 13px;
            padding: 7px 14px;
            width: 160px;
            outline: none;
        }

        .pkr-nav-search input::placeholder { color: rgba(255,255,255,0.55); }

        .pkr-nav-search button {
            background: var(--red);
            border: none;
            color: #fff;
            padding: 7px 14px;
            cursor: pointer;
            transition: background .2s;
        }

        .pkr-nav-search button:hover { background: var(--red-dark); }

        /* ---- SECTION TITLES ---- */
        .pkr-section-title {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
            padding-bottom: 14px;
            border-bottom: 2px solid var(--gray-200);
        }

        .pkr-section-title h3 {
            font-family: var(--font-display);
            font-size: 22px;
            font-weight: 700;
            color: var(--blue);
            margin: 0;
            letter-spacing: -.01em;
        }

        .pkr-section-title::before {
            content: '';
            display: block;
            width: 5px;
            height: 26px;
            background: var(--red);
            border-radius: 3px;
            flex-shrink: 0;
        }

        /* ---- CATEGORY BADGE ---- */
        .pkr-badge {
            display: inline-block;
            background: var(--red);
            color: #fff;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: var(--radius-sm);
        }

        .pkr-badge.blue { background: var(--blue-mid); }
        .pkr-badge.outline-red {
            background: transparent;
            color: var(--red);
            border: 1px solid var(--red);
        }

        /* ---- CARDS ---- */
        .pkr-card {
            background: var(--white);
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: box-shadow .25s, transform .25s;
            border: 1px solid var(--gray-200);
        }

        .pkr-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-4px);
        }

        .pkr-card-img {
            position: relative;
            overflow: hidden;
            height: 210px;
        }

        .pkr-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .45s ease;
        }

        .pkr-card:hover .pkr-card-img img { transform: scale(1.06); }

        .pkr-card-img .pkr-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 2;
        }

        .pkr-card-body { padding: 18px; }

        .pkr-card-title {
            font-family: var(--font-display);
            font-size: 16px;
            font-weight: 600;
            line-height: 1.45;
            color: var(--text-main);
            margin: 8px 0 12px;
            transition: color .2s;
        }

        .pkr-card:hover .pkr-card-title { color: var(--red); }

        .pkr-card-meta {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--gray-400);
            border-top: 1px solid var(--gray-100);
            padding-top: 10px;
        }

        .pkr-card-meta span { display: flex; align-items: center; gap: 5px; }
        .pkr-card-meta i { color: var(--blue-mid); font-size: 11px; }

        /* ---- FOOTER ---- */
        .pkr-footer {
            background: var(--blue);
            color: rgba(255,255,255,0.80);
            padding: 60px 0 0;
            margin-top: 60px;
        }

        .pkr-footer-logo img { height: 56px; margin-bottom: 18px; }

        .pkr-footer p {
            font-size: 14px;
            line-height: 1.7;
            color: rgba(255,255,255,0.65);
            max-width: 340px;
        }

        .pkr-footer-social {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .pkr-footer-social a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.75);
            font-size: 14px;
            transition: all .2s;
        }

        .pkr-footer-social a:hover {
            background: var(--red);
            border-color: var(--red);
            color: #fff;
            transform: translateY(-2px);
        }

        .pkr-footer h4 {
            font-family: var(--font-body);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--red);
        }

        .pkr-footer ul { list-style: none; padding: 0; margin: 0; }

        .pkr-footer ul li { margin-bottom: 10px; }

        .pkr-footer ul li a {
            color: rgba(255,255,255,0.65);
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all .2s;
        }

        .pkr-footer ul li a:hover {
            color: #fff;
            gap: 12px;
        }

        .pkr-footer ul li a::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--red);
            flex-shrink: 0;
        }

        .pkr-footer-bottom {
            margin-top: 48px;
            background: var(--blue-dark, #142d47);
            border-top: 1px solid rgba(255,255,255,0.10);
            padding: 18px 0;
        }

        .pkr-footer-bottom p {
            margin: 0;
            font-size: 12.5px;
            color: rgba(255,255,255,0.45);
            max-width: 100%;
        }

        /* ---- BOTTOM MOBILE NAV ---- */
        .pkr-bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--white);
            border-top: 2px solid var(--gray-200);
            z-index: 9999;
            padding: 8px 0 6px;
            box-shadow: 0 -4px 16px rgba(0,0,0,0.10);
        }

        .pkr-bottom-nav-inner {
            display: flex;
            justify-content: space-around;
        }

        .pkr-bottom-nav a {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 10.5px;
            font-weight: 600;
            color: var(--gray-400);
            gap: 3px;
            padding: 4px 12px;
            border-radius: var(--radius-sm);
            transition: color .2s;
        }

        .pkr-bottom-nav a i { font-size: 20px; }

        .pkr-bottom-nav a.active,
        .pkr-bottom-nav a:hover {
            color: var(--red);
        }

        /* ---- CATEGORY SLIDE-UP MENU ---- */
        .pkr-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 10000;
        }

        .pkr-cat-menu {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            background: var(--white);
            border-radius: 18px 18px 0 0;
            max-height: 70vh;
            overflow-y: auto;
            transform: translateY(100%);
            transition: transform .3s ease;
            z-index: 10001;
            box-shadow: 0 -6px 30px rgba(0,0,0,0.15);
        }

        .pkr-cat-menu.open { transform: translateY(0); }

        .pkr-cat-menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid var(--gray-200);
            position: sticky;
            top: 0;
            background: var(--white);
        }

        .pkr-cat-menu-header h3 {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
            color: var(--blue);
        }

        .pkr-cat-menu-header button {
            background: none;
            border: none;
            font-size: 22px;
            color: var(--gray-400);
            cursor: pointer;
        }

        .pkr-cat-menu a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 20px;
            color: var(--text-main);
            font-size: 14.5px;
            font-weight: 500;
            border-bottom: 1px solid var(--gray-100);
            transition: all .2s;
        }

        .pkr-cat-menu a:hover {
            background: var(--off-white);
            color: var(--red);
            padding-left: 28px;
        }

        .pkr-cat-menu a span {
            font-size: 12px;
            color: var(--gray-400);
            background: var(--gray-100);
            padding: 2px 10px;
            border-radius: 12px;
        }

        /* ---- MOBILE SEARCH ---- */
        .pkr-mobile-search-wrap { padding: 12px 0 0; }

        .pkr-mobile-search-form {
            display: flex;
            background: var(--white);
            border: 1.5px solid var(--blue-mid);
            border-radius: 24px;
            overflow: hidden;
        }

        .pkr-mobile-search-form input {
            flex: 1;
            border: none;
            padding: 10px 16px;
            font-size: 13.5px;
            outline: none;
            color: var(--text-main);
        }

        .pkr-mobile-search-form button {
            background: var(--blue-mid);
            border: none;
            color: #fff;
            padding: 10px 18px;
            cursor: pointer;
        }

        /* ---- BANNER ROTATOR ---- */
        .banner-rotator { position: relative; width: 100%; overflow: hidden; }

        .banner-slide {
            display: none;
            opacity: 0;
            transition: opacity .5s ease;
        }

        .banner-slide.active {
            display: block;
            opacity: 1;
        }

        .banner-slide img { width: 100%; height: auto; display: block; }

        /* ---- UTILITIES ---- */
        .section-sep {
            border: none;
            border-top: 2px solid var(--gray-200);
            margin: 40px 0;
        }

        .btn-pkr-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--red);
            color: #fff;
            font-family: var(--font-body);
            font-size: 13px;
            font-weight: 600;
            padding: 10px 22px;
            border-radius: var(--radius-sm);
            border: none;
            cursor: pointer;
            transition: background .2s, transform .15s;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .btn-pkr-primary:hover {
            background: var(--red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-pkr-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: var(--blue);
            border: 1.5px solid var(--blue);
            font-size: 13px;
            font-weight: 600;
            padding: 9px 20px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all .2s;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .btn-pkr-outline:hover {
            background: var(--blue);
            color: #fff;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .pkr-nav ul li > a { padding: 16px 12px; font-size: 12.5px; }
            .pkr-nav-search input { width: 120px; }
        }

        @media (max-width: 768px) {
            body { padding-bottom: 68px; }
            .pkr-bottom-nav { display: block; }
            .pkr-nav-search { display: none; }
            .d-none-mobile { display: none !important; }
        }

        @media (max-width: 576px) {
            .pkr-section-title h3 { font-size: 18px; }
        }
    </style>
</head>

<body>

<!-- ======== HEADER ======== -->
<header>
    <!-- Top Bar -->
    <div class="pkr-topbar d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="date-text">
                        <i class="far fa-calendar-alt"></i>
                        {{ \Carbon\Carbon::now('Asia/Jayapura')->translatedFormat('l, d F Y') }}
                    </div>
                </div>
                <div class="col-md-8 d-flex justify-content-end">
                    <div class="news-ticker">
                        <span class="ticker-label">Breaking</span>
                        <div class="ticker-content">
                            <div class="ticker-wrapper">
                                @php
                                    $latestNews = \App\Models\News::published()
                                        ->where('published_at', '>=', now()->subDays(7))
                                        ->orderBy('published_at', 'desc')
                                        ->limit(10)
                                        ->get();
                                @endphp
                                @if($latestNews->count() > 0)
                                    @foreach($latestNews as $newsItem)
                                        <a href="{{ route('news.show', $newsItem->slug) }}" class="ticker-item">
                                            {{ Str::limit($newsItem->title, 60) }}
                                        </a>
                                    @endforeach
                                    @foreach($latestNews as $newsItem)
                                        <a href="{{ route('news.show', $newsItem->slug) }}" class="ticker-item">
                                            {{ Str::limit($newsItem->title, 60) }}
                                        </a>
                                    @endforeach
                                @else
                                    <span class="ticker-item">Selamat datang di Poros Kie Raha</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Mid (Logo + Banner) -->
    <div class="pkr-header-mid d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="pkr-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/img/logo/poros fix.PNG') }}" alt="Poros Kie Raha">
                        </a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="f-right">
                        @php $activeBanners = \App\Models\Banner::active()->ordered()->get(); @endphp
                        @if($activeBanners->count() > 0)
                            <div class="banner-rotator" id="banner-rotator">
                                @foreach($activeBanners as $index => $banner)
                                    <div class="banner-slide {{ $index === 0 ? 'active' : '' }}">
                                        @if($banner->link)
                                            <a href="{{ $banner->link }}" target="_blank">
                                                <img src="{{ $banner->image_url }}" alt="{{ $banner->title ?? 'Banner' }}">
                                            </a>
                                        @else
                                            <img src="{{ $banner->image_url }}" alt="{{ $banner->title ?? 'Banner' }}">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="pkr-nav" id="pkr-nav">
        <div class="container">
            <!-- Sticky logo (hidden until scroll) -->
            <div class="pkr-nav-logo" id="nav-sticky-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/logo/poros fix.PNG') }}" alt="Logo">
                </a>
            </div>

            <!-- Desktop menu -->
            <ul class="d-none d-md-flex" id="pkr-menu">
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('news.index') }}" class="{{ request()->routeIs('news.index') ? 'active' : '' }}">Semua Berita</a>
                </li>
                @if($globalCategories->count() > 0)
                <li>
                    <a href="#">Kategori</a>
                    <ul class="submenu">
                        @foreach($globalCategories as $category)
                            <li><a href="{{ route('news.category', $category->slug) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endif
                @auth
                    @if(auth()->user()->isAdmin() || auth()->user()->isPenulis())
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endif
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>

            <!-- Search -->
            <div class="pkr-nav-search d-none d-md-flex">
                <form action="{{ route('news.search') }}" method="GET">
                    <input type="text" name="q" placeholder="Cari berita..." value="{{ request('q') }}">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <!-- Mobile: logo + hamburger row -->
            <div class="d-flex d-md-none align-items-center justify-content-between w-100 py-2">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/logo/poros fix.PNG') }}" alt="Logo" style="height:40px;">
                </a>
                <div class="mobile_menu"></div>
            </div>
        </div>
    </nav>
</header>
<!-- ======== /HEADER ======== -->

<main>
    @yield('content')
</main>

<!-- ======== FOOTER ======== -->
<footer class="pkr-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-7 mb-5">
                <div class="pkr-footer-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/img/logo/poros fix.PNG') }}" alt="Logo">
                    </a>
                </div>
                <p>Portal berita terpercaya yang memberikan informasi terkini dan akurat untuk Anda. Kami berkomitmen menyajikan berita berkualitas setiap hari.</p>
                <div class="pkr-footer-social">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-5 offset-lg-1 mb-5">
                <h4>Kategori Populer</h4>
                <ul>
                    @foreach($globalCategories->take(6) as $category)
                        <li>
                            <a href="{{ route('news.category', $category->slug) }}">
                                {{ $category->name }}
                                <em style="color:var(--gray-400);font-style:normal;margin-left:4px;">({{ $category->news_count }})</em>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-3 col-md-5 mb-5">
                <h4>Tautan Cepat</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('news.index') }}">Semua Berita</a></li>
                    <li><a href="{{ route('news.search') }}">Pencarian</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="pkr-footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> poros-kieraha.com — All rights reserved</p>
                </div>
                <div class="col-md-6 text-md-right">
                    <p>Developed by Heartware Digital</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ======== /FOOTER ======== -->

<!-- Mobile Bottom Nav -->
<nav class="pkr-bottom-nav">
    <div class="pkr-bottom-nav-inner">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="fas fa-home"></i><span>Home</span>
        </a>
        <a href="{{ route('news.index') }}" class="{{ request()->routeIs('news.index') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i><span>Berita</span>
        </a>
        <a href="#" id="pkr-cat-btn">
            <i class="fas fa-th-large"></i><span>Kategori</span>
        </a>
        <a href="{{ route('news.search') }}" class="{{ request()->routeIs('news.search') ? 'active' : '' }}">
            <i class="fas fa-search"></i><span>Cari</span>
        </a>
        @auth
            @if(auth()->user()->isAdmin() || auth()->user()->isPenulis())
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard*') ? 'active' : '' }}">
                    <i class="fas fa-user"></i><span>Akun</span>
                </a>
            @else
                <a href="#"><i class="fas fa-user"></i><span>Akun</span></a>
            @endif
        @else
            <a href="#"><i class="fas fa-sign-in-alt"></i><span>Poros</span></a>
        @endauth
    </div>
</nav>

<!-- Category Slide-up (Mobile) -->
<div class="pkr-overlay" id="pkr-overlay"></div>
<div class="pkr-cat-menu" id="pkr-cat-menu">
    <div class="pkr-cat-menu-header">
        <h3>Kategori Berita</h3>
        <button id="pkr-cat-close"><i class="fas fa-times"></i></button>
    </div>
    @foreach($globalCategories as $category)
        <a href="{{ route('news.category', $category->slug) }}">
            {{ $category->name }}
            <span>{{ $category->news_count }}</span>
        </a>
    @endforeach
</div>

<!-- JS -->
<script src="{{ asset('assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/animated.headline.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('assets/js/jquery.ticker.js') }}"></script>
<script src="{{ asset('assets/js/site.js') }}"></script>
<script src="{{ asset('assets/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
<script src="{{ asset('assets/js/contact.js') }}"></script>
<script src="{{ asset('assets/js/jquery.form.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/mail-script.js') }}"></script>
<script src="{{ asset('assets/js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

@stack('scripts')

<script>
$(document).ready(function () {

    /* --- Banner rotation --- */
    var $slides = $('#banner-rotator .banner-slide');
    var idx = 0;
    if ($slides.length > 1) {
        setInterval(function () {
            $slides.removeClass('active');
            idx = (idx + 1) % $slides.length;
            $slides.eq(idx).addClass('active');
        }, 3500);
    }

    /* --- Sticky nav logo --- */
    var $navLogo = $('#nav-sticky-logo');
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 80) {
            $navLogo.addClass('sticky-show');
        } else {
            $navLogo.removeClass('sticky-show');
        }
    });

    /* --- Mobile category menu --- */
    $('#pkr-cat-btn').on('click', function (e) {
        e.preventDefault();
        $('#pkr-overlay').fadeIn(200);
        $('#pkr-cat-menu').addClass('open');
        $('body').css('overflow', 'hidden');
    });

    function closeCat() {
        $('#pkr-cat-menu').removeClass('open');
        $('#pkr-overlay').fadeOut(200);
        $('body').css('overflow', '');
    }

    $('#pkr-cat-close, #pkr-overlay').on('click', closeCat);

    /* --- Mobile search toggle --- */
    $('#mobileSearchBtn').on('click', function () {
        $('#mobileSearchBox').slideToggle(280);
    });
});
</script>
</body>
</html>