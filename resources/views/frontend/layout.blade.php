{{--
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'News Portal') - Berita Terkini</title>
    <meta name="description" content="@yield('description', 'Portal berita terpercaya untuk informasi terkini')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600">
                        📰 News Portal
                    </a>
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="{{ route('home') }}"
                            class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">
                            Home
                        </a>
                        <a href="{{ route('news.index') }}"
                            class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">
                            Semua Berita
                        </a>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="flex items-center space-x-4">
                    <form action="{{ route('news.search') }}" method="GET" class="hidden md:block">
                        <input type="text" name="q" placeholder="Cari berita..."
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            value="{{ request('q') }}">
                    </form>

                    @auth
                    @if(auth()->user()->isAdmin() || auth()->user()->isPenulis())
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 text-sm font-medium">
                        Dashboard
                    </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-indigo-600 text-sm font-medium">
                            Logout
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 text-sm font-medium">
                        Login
                    </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile Search -->
        <div class="md:hidden px-4 pb-3">
            <form action="{{ route('news.search') }}" method="GET">
                <input type="text" name="q" placeholder="Cari berita..."
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    value="{{ request('q') }}">
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">📰 News Portal</h3>
                    <p class="text-gray-400">Portal berita terpercaya untuk informasi terkini dan akurat.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Kategori</h4>
                    <ul class="space-y-2">
                        @foreach(App\Models\Category::take(5)->get() as $cat)
                        <li>
                            <a href="{{ route('news.category', $cat->slug) }}" class="text-gray-400 hover:text-white">
                                {{ $cat->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Informasi</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Tentang Kami</li>
                        <li>Kontak</li>
                        <li>Kebijakan Privasi</li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} News Portal. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html> --}}

<!doctype html>
<html class="no-js" lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Home') - {{ config('app.name', 'Poros-KieRaha') }}</title>
    <meta name="description" content="@yield('meta_description', 'Portal berita terpercaya')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}"> --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/logo/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/logo/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('assets/img/logo/favicon/site.webmanifest') }}" />

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

    <!-- Banner Rotation Styles -->
    <style>
        .banner-rotator {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
    
        .banner-slide {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
    
        .banner-slide.active {
            display: block;
            position: relative;
            opacity: 1;
        }
    
        .banner-slide img {
            width: 100%;
            height: auto;
            display: block;
        }
    </style>

    <!-- News Ticker Styles -->
    <style>
        .news-ticker {
            display: flex;
            align-items: center;
            max-width: 600px;
        }

        .ticker-label {
            color: #ffcc00;
            font-weight: bold;
            font-size: 12px;
            margin-right: 10px;
            white-space: nowrap;
        }

        .ticker-content {
            flex: 1;
            overflow: hidden;
            position: relative;
        }

        .ticker-wrapper {
            display: flex;
            animation: ticker-scroll 20s linear infinite;
            white-space: nowrap;
        }

        .ticker-item {
            color: white;
            text-decoration: none;
            font-size: 12px;
            padding: 0 15px;
            white-space: nowrap;
            transition: color 0.3s ease;
        }

        .ticker-item:hover {
            color: #ffcc00;
        }

        .ticker-item:not(:last-child)::after {
            content: "●";
            color: #ffcc00;
            margin-left: 15px;
        }

        @keyframes ticker-scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* Pause animation on hover */
        .ticker-wrapper:hover {
            animation-play-state: paused;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .news-ticker {
                max-width: 400px;
            }

            .ticker-label {
                font-size: 11px;
            }

            .ticker-item {
                font-size: 11px;
                padding: 0 10px;
            }
        }

        @media (max-width: 576px) {
            .news-ticker {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- Header Start -->
    <header>
        <div class="header-area">
            <div class="main-header">
                <!-- Header Top -->
                <div class="header-top black-bg d-none d-md-block">
                    <div class="container">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                        <li><img src="{{ asset('assets/img/icon/header_icon1.png') }}" alt="">
                                            {{ \Carbon\Carbon::now('Asia/Jayapura')->translatedFormat('l, d F Y') }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <!-- News Ticker -->
                                    <div class="news-ticker">
                                        <span class="ticker-label">BERITA TERBARU:</span>
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
                                                <!-- First set of news -->
                                                @foreach($latestNews as $newsItem)
                                                <a href="{{ route('news.show', $newsItem->slug) }}" class="ticker-item">
                                                    {{ Str::limit($newsItem->title, 60) }}
                                                </a>
                                                @endforeach
                                                <!-- Duplicate set for seamless scrolling -->
                                                @foreach($latestNews as $newsItem)
                                                <a href="{{ route('news.show', $newsItem->slug) }}" class="ticker-item">
                                                    {{ Str::limit($newsItem->title, 60) }}
                                                </a>
                                                @endforeach
                                                @else
                                                <span class="ticker-item">Belum ada berita terbaru</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Header Mid -->
                <div class="header-mid d-none d-md-block">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('assets/img/logo/poros fix.PNG') }}" alt="Logo"
                                            style="height: 70px;">

                                        {{-- <h4>Poros kieraha.com</h4> --}}
                                    </a>
                                </div>
                            </div>
                            {{-- <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-banner f-right">
                                    @php
                                    $activeBanners = \App\Models\Banner::active()->ordered()->get();
                                    @endphp

                                    @if($activeBanners->count() > 0)
                                    <div class="banner-rotator" id="banner-rotator">
                                        @foreach($activeBanners as $index => $banner)
                                        <div class="banner-slide {{ $index === 0 ? 'active' : '' }}"
                                            data-banner-id="{{ $banner->id }}">
                                            @if($banner->link)
                                            <a href="{{ $banner->link }}" target="_blank">
                                                <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
                                                    style="max-width: 100%; height: auto;">
                                            </a>

                                            @else
                                            {{-- <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
                                                style="max-width: 100%; height: auto;"> --}}
                                            {{-- @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <!-- Default banner if no active banner -->
                                    <img src="{{ asset('assets/img/hero/header_card.jpg') }}" alt="Default Banner">
                                    @endif
                                </div> --}}
                            {{-- </div>  --}}
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-banner f-right">
                                    @php
                                        $activeBanners = \App\Models\Banner::active()->ordered()->get();
                                    @endphp
                            
                                    @if($activeBanners->count() > 0)
                                    <div class="banner-rotator" id="banner-rotator">
                                        @foreach($activeBanners as $index => $banner)
                                        <div class="banner-slide {{ $index === 0 ? 'active' : '' }}"
                                            data-banner-id="{{ $banner->id }}">
                                            @if($banner->link)
                                            <a href="{{ $banner->link }}" target="_blank">
                                                <img src="{{ $banner->image_url }}" 
                                                     alt="{{ $banner->title ?? 'Banner' }}"
                                                     style="max-width: 100%; height: auto;">
                                            </a>
                                            @else
                                            <img src="{{ $banner->image_url }}" 
                                                 alt="{{ $banner->title ?? 'Banner' }}"
                                                 style="max-width: 100%; height: auto;">
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <!-- Default banner if no active banner -->
                                    <img src="{{ asset('assets/img/hero/header_card.jpg') }}" alt="Default Banner">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Header Bottom (Navigation) -->
                <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                <div class="sticky-logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('assets/img/logo/poros fix.PNG') }}" alt="Logo"
                                            style="height: 50px;">
                                    </a>
                                </div>

                                <!-- Main Menu -->
                                <div class="main-menu d-none d-md-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ route('home') }}">Home</a></li>
                                            <li><a href="{{ route('news.index') }}">Semua Berita</a></li>

                                            @if($globalCategories->count() > 0)
                                            <li><a href="#">Kategori</a>
                                                <ul class="submenu">
                                                    @foreach($globalCategories as $category)
                                                    <li><a href="{{ route('news.category', $category->slug) }}">{{
                                                            $category->name }}</a></li>
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
                                    </nav>
                                </div>
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-4">
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <i class="fas fa-search special-tag"></i>
                                    <div class="search-box">
                                        <form action="{{ route('news.search') }}" method="GET">
                                            <input type="text" name="q" placeholder="Search" value="{{ request('q') }}">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <main>
        @yield('content')
    </main>

    <!-- Footer Start -->
    <footer>
        <div class="footer-area footer-padding fix">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-5 col-lg-5 col-md-7 col-sm-12">
                        <div class="single-footer-caption">
                            <div class="footer-logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('assets/img/logo/poros fix.PNG') }}" alt="Logo"
                                    style="height: 70px;">
                                </a>
                            </div>
                            <div class="footer-tittle">
                                <div class="footer-pera">
                                    <p>Portal berita terpercaya yang memberikan informasi terkini dan akurat untuk Anda.
                                        Kami berkomitmen menyajikan berita berkualitas setiap hari.</p>
                                </div>
                            </div>
                            <div class="footer-social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-footer-caption mt-60">
                            <div class="footer-tittle">
                                <h4>Newsletter</h4>
                                <p>Dapatkan berita terbaru langsung di email Anda</p>
                                <div class="footer-form">
                                    <div id="mc_embed_signup">
                                        <form action="#" method="post" class="subscribe_form relative mail_part">
                                            @csrf
                                            <input type="email" name="email" placeholder="Email Address"
                                                class="placeholder hide-on-focus">
                                            <div class="form-icon">
                                                <button type="submit"
                                                    class="email_icon newsletter-submit button-contactForm">
                                                    <img src="{{ asset('assets/img/logo/form-iocn.png') }}" alt="">
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <div class="single-footer-caption mb-50 mt-60">
                            <div class="footer-tittle">
                                <h4>Kategori Populer</h4>
                            </div>
                            <ul class="list-unstyled">
                                @foreach($globalCategories->take(5) as $category)
                                <li class="mb-2">
                                    <a href="{{ route('news.category', $category->slug) }}"
                                        class="text-white-50 hover:text-white">
                                        {{ $category->name }} ({{ $category->news_count }})
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-lg-6">
                            <div class="footer-copy-right">
                                <p>Copyright &copy; <script>
                                        document.write(new Date().getFullYear());
                                    </script> poros kieraha.com All rights reserved</p>
                                <p>Developer <script>
                                        document.write(new Date().getFullYear());
                                    </script> Heartware Digital</p>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="footer-menu f-right">
                                <ul>
                                    <li><a href="#">Terms of use</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- JS here -->
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

    <!-- Banner Rotation Script -->
    {{-- <script>
        $(document).ready(function() {
            const $bannerRotator = $('#banner-rotator');
            if ($bannerRotator.length > 0) {
                const $slides = $bannerRotator.find('.banner-slide');
                let currentIndex = 0;

                function showNextBanner() {
                    $slides.removeClass('active');
                    $slides.eq(currentIndex).addClass('active');
                    currentIndex = (currentIndex + 1) % $slides.length;
                }

                // Show first banner initially
                showNextBanner();

                // Rotate banners every 1 second only if there are more than 2 active banners
                if ($slides.length > 2) {
                    setInterval(showNextBanner, 1000);
                }
            }
        });
    </script> --}}
    <!-- Banner Rotation Script -->
<script>
    $(document).ready(function() {
        const $bannerRotator = $('#banner-rotator');
        if ($bannerRotator.length > 0) {
            const $slides = $bannerRotator.find('.banner-slide');
            let currentIndex = 0;

            function showNextBanner() {
                $slides.removeClass('active');
                currentIndex = (currentIndex + 1) % $slides.length;
                $slides.eq(currentIndex).addClass('active');
            }

            // Rotate banners every 3 seconds if there are more than 1 banner
            if ($slides.length > 1) {
                setInterval(showNextBanner, 3000); // 3 detik per banner
            }
        }
    });
</script>
</body>

</html>