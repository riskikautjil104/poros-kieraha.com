{{-- @extends('frontend.layout')

@section('title', 'Semua Berita')

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-2">📰 Semua Berita</h1>
        <p class="text-lg opacity-90">Jelajahi berita terbaru dari berbagai kategori</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            @if($news->count() > 0)
                <!-- Filter & Sort -->
                <div class="bg-white rounded-lg shadow-md p-4 mb-6 flex flex-wrap items-center justify-between gap-4">
                    <div class="text-gray-600">
                        Menampilkan <span class="font-bold text-gray-900">{{ $news->total() }}</span> berita
                    </div>
                    <form action="{{ route('news.search') }}" method="GET" class="flex gap-2">
                        <select name="category" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            Filter
                        </button>
                    </form>
                </div>

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
                                        <div class="absolute top-3 left-3">
                                            <span class="px-3 py-1 bg-indigo-600 text-white text-xs font-bold rounded-full">
                                                {{ $item->category->name }}
                                            </span>
                                        </div>
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
                    <p class="text-gray-600">Berita akan segera ditampilkan di sini.</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Search -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">🔍 Cari Berita</h3>
                <form action="{{ route('news.search') }}" method="GET">
                    <input type="text" 
                           name="q" 
                           placeholder="Ketik kata kunci..." 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 mb-2"
                           value="{{ request('q') }}">
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded-lg hover:bg-indigo-700 transition">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Categories -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">📂 Kategori</h3>
                <div class="space-y-2">
                    @foreach($categories as $category)
                        <a href="{{ route('news.category', $category->slug) }}" 
                           class="flex items-center justify-between p-3 rounded-lg hover:bg-indigo-50 transition group">
                            <span class="text-gray-700 group-hover:text-indigo-600 font-medium">
                                {{ $category->name }}
                            </span>
                            <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full group-hover:bg-indigo-600 group-hover:text-white">
                                {{ $category->news_count }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Popular Tags (if you have tags) -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">🏷️ Tag Populer</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-indigo-600 hover:text-white transition cursor-pointer">
                        #trending
                    </span>
                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-indigo-600 hover:text-white transition cursor-pointer">
                        #terkini
                    </span>
                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-indigo-600 hover:text-white transition cursor-pointer">
                        #viral
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('frontend.layout')

@section('title', 'Semua Berita')

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

<!--================Blog Area =================-->
<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    @if($news->count() > 0)
                        @foreach($news as $item)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    @if($item->image)
                                        <img class="card-img rounded-0" src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}">
                                    @else
                                        <img class="card-img rounded-0" src="assets/img/blog/single_blog_1.png" alt="{{ $item->title }}">
                                    @endif
                                    <a href="{{ route('news.show', $item->slug) }}" class="blog_item_date">
                                        <h3>{{ $item->created_at->format('d') }}</h3>
                                        <p>{{ $item->created_at->format('M') }}</p>
                                    </a>
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="{{ route('news.show', $item->slug) }}">
                                        <h2>{{ $item->title }}</h2>
                                    </a>
                                    @if($item->excerpt)
                                        <p>{{ Str::limit($item->excerpt, 150) }}</p>
                                    @else
                                        <p>{{ Str::limit(strip_tags($item->content), 150) }}</p>
                                    @endif
                                    <ul class="blog-info-link">
                                        <li><a href="{{ route('news.category', $item->category->slug) }}"><i class="fa fa-user"></i> {{ $item->category->name }}</a></li>
                                        <li><a href="{{ route('news.show', $item->slug) }}"><i class="fa fa-eye"></i> {{ number_format($item->views) }} Views</a></li>
                                    </ul>
                                </div>
                            </article>
                        @endforeach

                        <!-- Pagination -->
                        <nav class="blog-pagination justify-content-center d-flex">
                            {{ $news->links('pagination::bootstrap-4') }}
                        </nav>
                    @else
                        <div class="text-center py-5">
                            <h3>Belum Ada Berita</h3>
                            <p>Berita akan segera ditampilkan di sini.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <!-- Search Widget -->
                    <aside class="single_sidebar_widget search_widget">
                        <form action="{{ route('news.search') }}" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" 
                                           name="q" 
                                           class="form-control" 
                                           placeholder='Cari Berita...'
                                           value="{{ request('q') }}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = 'Cari Berita...'">
                                    <div class="input-group-append">
                                        <button class="btns" type="submit"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Search</button>
                        </form>
                    </aside>

                    <!-- Category Widget -->
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Kategori</h4>
                        <ul class="list cat-list">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('news.category', $category->slug) }}" class="d-flex">
                                        <p>{{ $category->name }}</p>
                                        <p>({{ $category->news_count }})</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </aside>

                    <!-- Recent Post Widget -->
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Berita Terbaru</h3>
                        @php
                            $recentNews = \App\Models\News::latest()->take(4)->get();
                        @endphp
                        @foreach($recentNews as $recent)
                            <div class="media post_item">
                                @if($recent->image)
                                    <img src="{{ Storage::url($recent->image) }}" alt="{{ $recent->title }}" style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <img src="assets/img/post/post_1.png" alt="{{ $recent->title }}">
                                @endif
                                <div class="media-body">
                                    <a href="{{ route('news.show', $recent->slug) }}">
                                        <h3>{{ Str::limit($recent->title, 50) }}</h3>
                                    </a>
                                    <p>{{ $recent->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </aside>

                    <!-- Tag Cloud Widget -->
                    <aside class="single_sidebar_widget tag_cloud_widget">
                        <h4 class="widget_title">Tag Populer</h4>
                        <ul class="list">
                            <li><a href="#">trending</a></li>
                            <li><a href="#">terkini</a></li>
                            <li><a href="#">viral</a></li>
                            <li><a href="#">berita</a></li>
                            <li><a href="#">update</a></li>
                            <li><a href="#">teknologi</a></li>
                        </ul>
                    </aside>

                    <!-- Newsletter Widget -->
                    <aside class="single_sidebar_widget newsletter_widget">
                        <h4 class="widget_title">Newsletter</h4>
                        <form action="#" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="email" 
                                       name="email"
                                       class="form-control" 
                                       placeholder='Masukkan Email'
                                       onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Masukkan Email'" 
                                       required>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Subscribe</button>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Area =================-->

<style>
/* Blog Area Styles */
.section-padding {
    padding: 100px 0;
}

.blog_item {
    margin-bottom: 50px;
    background: #fff;
    box-shadow: 0px 10px 30px 0px rgba(0, 0, 0, 0.1);
}

.blog_item_img {
    position: relative;
}

.blog_item_img img {
    width: 100%;
    height: 400px;
    object-fit: cover;
}

.blog_item_date {
    position: absolute;
    bottom: 0;
    left: 30px;
    background: #ff0055;
    color: #fff;
    text-align: center;
    padding: 15px 20px;
    text-decoration: none;
}

.blog_item_date h3 {
    font-size: 30px;
    font-weight: 700;
    margin: 0;
    color: #fff;
}

.blog_item_date p {
    margin: 0;
    font-size: 14px;
    text-transform: uppercase;
    color: #fff;
}

.blog_details {
    padding: 30px;
}

.blog_details h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #2c234d;
    transition: all 0.3s ease;
}

.blog_details h2:hover {
    color: #ff0055;
}

.blog_details p {
    color: #777;
    line-height: 28px;
    margin-bottom: 20px;
}

.blog-info-link {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 20px;
}

.blog-info-link li {
    display: inline-block;
}

.blog-info-link li a {
    color: #777;
    font-size: 14px;
    text-decoration: none;
}

.blog-info-link li a i {
    margin-right: 5px;
    color: #ff0055;
}

/* Sidebar Styles */
.single_sidebar_widget {
    margin-bottom: 50px;
}

.widget_title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 30px;
    color: #2c234d;
    text-transform: uppercase;
}

/* Search Widget */
.search_widget .btns {
    border: none;
    background: #ff0055;
    color: #fff;
    padding: 10px 15px;
    cursor: pointer;
}

.search_widget .form-control {
    border: 1px solid #eee;
    padding: 15px;
}

.boxed-btn {
    background: #ff0055;
    color: #fff;
    padding: 15px 30px;
    border: none;
    font-weight: 600;
    text-transform: uppercase;
    transition: all 0.3s ease;
}

.boxed-btn:hover {
    background: #d6003d;
}

/* Category Widget */
.cat-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.cat-list li {
    border-bottom: 1px solid #eee;
}

.cat-list li:last-child {
    border-bottom: none;
}

.cat-list li a {
    padding: 15px 0;
    display: flex;
    justify-content: space-between;
    color: #2c234d;
    text-decoration: none;
    transition: all 0.3s ease;
}

.cat-list li a:hover {
    color: #ff0055;
    padding-left: 10px;
}

/* Recent Post Widget */
.post_item {
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.post_item:last-child {
    border-bottom: none;
}

.post_item img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    margin-right: 15px;
}

.post_item h3 {
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 5px;
    color: #2c234d;
}

.post_item h3:hover {
    color: #ff0055;
}

.post_item p {
    font-size: 13px;
    color: #777;
    margin: 0;
}

/* Tag Cloud Widget */
.tag_cloud_widget .list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tag_cloud_widget .list li a {
    display: inline-block;
    padding: 8px 20px;
    background: #f8f8f8;
    color: #777;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s ease;
}

.tag_cloud_widget .list li a:hover {
    background: #ff0055;
    color: #fff;
}

/* Newsletter Widget */
.newsletter_widget .form-control {
    border: 1px solid #eee;
    padding: 15px;
    margin-bottom: 15px;
}

/* Pagination */
.blog-pagination .pagination {
    display: flex;
    gap: 5px;
}

.blog-pagination .page-item .page-link {
    border: 1px solid #eee;
    color: #2c234d;
    padding: 10px 15px;
    text-decoration: none;
}

.blog-pagination .page-item.active .page-link {
    background: #ff0055;
    border-color: #ff0055;
    color: #fff;
}

.blog-pagination .page-item .page-link:hover {
    background: #ff0055;
    border-color: #ff0055;
    color: #fff;
}

/* Responsive */
@media (max-width: 768px) {
    .blog_item_img img {
        height: 250px;
    }
    
    .section-padding {
        padding: 50px 0;
    }
}
</style>
@endsection