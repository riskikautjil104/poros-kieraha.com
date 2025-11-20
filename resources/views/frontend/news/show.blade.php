{{-- @extends('frontend.layout')

@section('title', $news->title)
@section('description', $news->excerpt ?? Str::limit($news->content, 150))

@section('content')
<div class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <article class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                    <!-- Breadcrumb -->
                    <div class="px-6 py-3 bg-gray-50 border-b text-sm text-gray-600">
                        <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
                        <span class="mx-2">›</span>
                        <a href="{{ route('news.category', $news->category->slug) }}" class="hover:text-indigo-600">
                            {{ $news->category->name }}
                        </a>
                        <span class="mx-2">›</span>
                        <span class="text-gray-900">{{ Str::limit($news->title, 30) }}</span>
                    </div>

                    <!-- Article Header -->
                    <div class="p-6 md:p-8">
                        <div class="mb-4">
                            <span
                                class="inline-block px-3 py-1 bg-indigo-600 text-white text-sm font-bold rounded-full">
                                {{ $news->category->name }}
                            </span>
                        </div>

                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            {{ $news->title }}
                        </h1>

                        <!-- Meta Info -->
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6 pb-6 border-b">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold mr-2">
                                    {{ substr($news->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">{{ $news->user->name }}</div>
                                    <div class="text-xs">Penulis</div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                📅 {{ $news->published_at->format('d M Y, H:i') }}
                            </div>
                            <div class="flex items-center">
                                👁️ {{ number_format($news->views) }} views
                            </div>
                            <div class="flex items-center">
                                ⏱️ {{ $news->reading_time }} min read
                            </div>
                        </div>

                        <!-- Featured Image -->
                        @if($news->image)
                        <div class="mb-6 rounded-lg overflow-hidden">
                            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}"
                                class="w-full h-auto object-cover">
                        </div>
                        @endif

                        <!-- Excerpt -->
                        @if($news->excerpt)
                        <div class="mb-6 p-4 bg-indigo-50 border-l-4 border-indigo-600 rounded">
                            <p class="text-lg text-gray-700 italic">{{ $news->excerpt }}</p>
                        </div>
                        @endif

                        <!-- Content -->
                        <div class="prose prose-lg max-w-none">
                            {!! nl2br(e($news->content)) !!}
                        </div>

                        <!-- Tags -->
                        @if($news->tags->count() > 0)
                        <div class="mt-8 pt-6 border-t">
                            <h3 class="text-sm font-bold text-gray-900 mb-3">🏷️ Tags:</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($news->tags as $tag)
                                <a href="#"
                                    class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-indigo-600 hover:text-white transition">
                                    #{{ $tag->name }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Share Buttons -->
                        <div class="mt-8 pt-6 border-t">
                            <h3 class="text-sm font-bold text-gray-900 mb-3">📤 Bagikan:</h3>
                            <div class="flex gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $news->slug)) }}"
                                    target="_blank"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                    target="_blank"
                                    class="px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition">
                                    Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . route('news.show', $news->slug)) }}"
                                    target="_blank"
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="bg-white rounded-lg shadow-lg p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">
                        💬 Komentar ({{ $news->comments->count() }})
                    </h3>

                    @auth
                    <!-- Comment Form -->
                    <form action="{{ route('news.comment', $news) }}" method="POST" class="mb-8">
                        @csrf
                        <textarea name="content" rows="4" required placeholder="Tulis komentar Anda..."
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                        @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <button type="submit"
                            class="mt-3 px-6 py-2 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition">
                            Kirim Komentar
                        </button>
                    </form>
                    @else
                    <div class="mb-8 p-4 bg-gray-50 rounded-lg text-center">
                        <p class="text-gray-600 mb-3">Anda harus login untuk berkomentar</p>
                        <a href="{{ route('login') }}"
                            class="inline-block px-6 py-2 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition">
                            Login
                        </a>
                    </div>
                    @endauth

                    <!-- Comments List -->
                    @if($news->comments->count() > 0)
                    <div class="space-y-4">
                        @foreach($news->comments as $comment)
                        <div class="flex gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr($comment->user->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <h4 class="font-bold text-gray-900">{{ $comment->user->name }}</h4>
                                    <span class="text-xs text-gray-500">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-gray-700">{{ $comment->content }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8 text-gray-500">
                        <div class="text-4xl mb-2">💭</div>
                        <p>Belum ada komentar. Jadilah yang pertama!</p>
                    </div>
                    @endif
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <!-- Related News -->
                @if($relatedNews->count() > 0)
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">📌 Berita Terkait</h3>
                    <div class="space-y-4">
                        @foreach($relatedNews as $related)
                        <a href="{{ route('news.show', $related->slug) }}" class="block group">
                            <div class="flex gap-3">
                                @if($related->image)
                                <img src="{{ Storage::url($related->image) }}" alt="{{ $related->title }}"
                                    class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                                @endif
                                <div class="flex-1">
                                    <h4
                                        class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 mb-1">
                                        {{ $related->title }}
                                    </h4>
                                    <p class="text-xs text-gray-500">
                                        {{ $related->formatted_date }}
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- CTA Box -->
                <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <h3 class="text-xl font-bold mb-2">📬 Newsletter</h3>
                    <p class="text-sm opacity-90 mb-4">Dapatkan berita terbaru langsung di email Anda!</p>
                    <form class="space-y-2">
                        <input type="email" placeholder="Email Anda"
                            class="w-full px-4 py-2 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-white">
                        <button type="submit"
                            class="w-full bg-white text-indigo-600 font-bold py-2 rounded-lg hover:bg-gray-100 transition">
                            Berlangganan
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection --}}
{{-- @extends('frontend.layout')

@section('title', $news->title)
@section('description', $news->excerpt ?? Str::limit($news->content, 150))

@section('content')

<!--================Blog Area =================-->
<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post">
                    <!-- Featured Image -->
                    <div class="feature-img">
                        @if($news->image)
                        <img class="img-fluid" src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}">
                        @else
                        <img class="img-fluid" src="{{ asset('assets/img/blog/single_blog_1.png') }}"
                            alt="{{ $news->title }}">
                        @endif
                    </div>

                    <!-- Blog Details -->
                    <div class="blog_details">
                        <h2>{{ $news->title }}</h2>

                        <ul class="blog-info-link mt-3 mb-4">
                            <li><a href="{{ route('news.category', $news->category->slug) }}">
                                    <i class="fa fa-user"></i> {{ $news->category->name }}
                                </a></li>
                            <li><a href="#comments">
                                    <i class="fa fa-comments"></i> {{ $news->comments->count() }} Comments
                                </a></li>
                            <li><i class="fa fa-calendar"></i> {{ $news->published_at->format('F d, Y') }}</li>
                            <li><i class="fa fa-eye"></i> {{ number_format($news->views) }} Views</li>
                        </ul>

                        <!-- Excerpt -->
                        @if($news->excerpt)
                        <p class="excert">
                            {{ $news->excerpt }}
                        </p>
                        @endif

                        <!-- Content -->
                        <div class="news-content">
                            {!! nl2br(e($news->content)) !!}
                        </div>

                        <!-- Tags -->
                        @if($news->tags->count() > 0)
                        <div class="tag-widget post-tag-container mb-5 mt-5">
                            <div class="tagcloud">
                                @foreach($news->tags as $tag)
                                <a href="#" class="tag-cloud-link">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Navigation (Prev/Next Post) -->
                <div class="navigation-top">
                    <div class="d-sm-flex justify-content-between text-center">
                        <p class="like-info">
                            <span class="align-middle"><i class="fa fa-heart"></i></span>
                            {{ $news->views }} people viewed this
                        </p>
                        <div class="col-sm-4 text-center my-2 my-sm-0">
                        </div>
                        <ul class="social-icons">
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $news->slug)) }}"
                                    target="_blank" title="Share on Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                    target="_blank" title="Share on Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . route('news.show', $news->slug)) }}"
                                    target="_blank" title="Share on WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('news.show', $news->slug)) }}&title={{ urlencode($news->title) }}"
                                    target="_blank" title="Share on LinkedIn">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Previous/Next Navigation -->
                    @php
                    $prevNews = \App\Models\News::published()
                    ->where('id', '<', $news->id)
                        ->orderBy('id', 'desc')
                        ->first();

                        $nextNews = \App\Models\News::published()
                        ->where('id', '>', $news->id)
                        ->orderBy('id', 'asc')
                        ->first();
                        @endphp

                        <div class="navigation-area">
                            <div class="row">
                                @if($prevNews)
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    <div class="thumb">
                                        <a href="{{ route('news.show', $prevNews->slug) }}">
                                            @if($prevNews->image)
                                            <img class="img-fluid" src="{{ Storage::url($prevNews->image) }}"
                                                alt="{{ $prevNews->title }}">
                                            @else
                                            <img class="img-fluid" src="{{ asset('assets/img/post/preview.png') }}"
                                                alt="{{ $prevNews->title }}">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="{{ route('news.show', $prevNews->slug) }}">
                                            <span class="lnr text-white ti-arrow-left"></span>
                                        </a>
                                    </div>
                                    <div class="detials">
                                        <p>Prev Post</p>
                                        <a href="{{ route('news.show', $prevNews->slug) }}">
                                            <h4>{{ Str::limit($prevNews->title, 30) }}</h4>
                                        </a>
                                    </div>
                                </div>
                                @endif

                                @if($nextNews)
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    <div class="detials">
                                        <p>Next Post</p>
                                        <a href="{{ route('news.show', $nextNews->slug) }}">
                                            <h4>{{ Str::limit($nextNews->title, 30) }}</h4>
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="{{ route('news.show', $nextNews->slug) }}">
                                            <span class="lnr text-white ti-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="thumb">
                                        <a href="{{ route('news.show', $nextNews->slug) }}">
                                            @if($nextNews->image)
                                            <img class="img-fluid" src="{{ Storage::url($nextNews->image) }}"
                                                alt="{{ $nextNews->title }}">
                                            @else
                                            <img class="img-fluid" src="{{ asset('assets/img/post/next.png') }}"
                                                alt="{{ $nextNews->title }}">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                </div>

                <!-- Blog Author -->
                <div class="blog-author">
                    <div class="media align-items-center">
                        @if($news->user->avatar)
                        <img src="{{ Storage::url($news->user->avatar) }}" alt="{{ $news->user->name }}">
                        @else
                        <img src="{{ asset('assets/img/blog/author.png') }}" alt="{{ $news->user->name }}">
                        @endif
                        <div class="media-body">
                            <a href="#">
                                <h4>{{ $news->user->name }}</h4>
                            </a>
                            <p>{{ $news->user->bio ?? 'Penulis berita di Portal KieRaha. Menyajikan informasi terkini
                                dan terpercaya.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Comments Area -->
                <div class="comments-area" id="comments">
                    <h4>{{ $news->comments->count() }} Comments</h4>

                    @foreach($news->comments as $comment)
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    @if($comment->user->avatar)
                                    <img src="{{ Storage::url($comment->user->avatar) }}"
                                        alt="{{ $comment->user->name }}">
                                    @else
                                    <img src="{{ asset('assets/img/comment/comment_1.png') }}"
                                        alt="{{ $comment->user->name }}">
                                    @endif
                                </div>
                                <div class="desc">
                                    <p class="comment">
                                        {{ $comment->content }}
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <h5>
                                                <a href="#">{{ $comment->user->name }}</a>
                                            </h5>
                                            <p class="date">{{ $comment->created_at->format('F d, Y \a\t g:i a') }}</p>
                                        </div>
                                        <div class="reply-btn">
                                            <a href="#" class="btn-reply text-uppercase">reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Comment Form -->
                <div class="comment-form">
                    <h4>Leave a Reply</h4>

                    @auth
                    <form class="form-contact comment_form" action="{{ route('news.comment', $news) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="content" id="comment" cols="30" rows="9"
                                        placeholder="Write Comment" required></textarea>
                                    @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="button button-contactForm btn_1 boxed-btn">Post
                                Comment</button>
                        </div>
                    </form>
                    @else
                    <div class="alert alert-info">
                        <p class="mb-0">You must <a href="{{ route('login') }}" class="alert-link">login</a> to post a
                            comment.</p>
                    </div>
                    @endauth
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <!-- Search Widget -->
                    <aside class="single_sidebar_widget search_widget">
                        <form action="{{ route('news.search') }}" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" name="q" class="form-control" placeholder='Search Keyword'
                                        value="{{ request('q') }}" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Search Keyword'">
                                    <div class="input-group-append">
                                        <button class="btns" type="submit"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                type="submit">Search</button>
                        </form>
                    </aside>

                    <!-- Category Widget -->
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Category</h4>
                        <ul class="list cat-list">
                            @foreach($categories ?? [] as $category)
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
                        <h3 class="widget_title">Recent Post</h3>
                        @foreach($popularNews ?? [] as $popular)
                        <div class="media post_item">
                            @if($popular->image)
                            <img src="{{ Storage::url($popular->image) }}" alt="{{ $popular->title }}"
                                style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                            <img src="{{ asset('assets/img/post/post_1.png') }}" alt="{{ $popular->title }}">
                            @endif
                            <div class="media-body">
                                <a href="{{ route('news.show', $popular->slug) }}">
                                    <h3>{{ Str::limit($popular->title, 50) }}</h3>
                                </a>
                                <p>{{ $popular->published_at->format('F d, Y') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </aside>

                    <!-- Tag Clouds Widget -->
                    @if($news->tags->count() > 0)
                    <aside class="single_sidebar_widget tag_cloud_widget">
                        <h4 class="widget_title">Tag Clouds</h4>
                        <ul class="list">
                            @foreach($news->tags as $tag)
                            <li>
                                <a href="#">{{ $tag->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </aside>
                    @endif

                    <!-- Instagram Feeds -->
                    <aside class="single_sidebar_widget instagram_feeds">
                        <h4 class="widget_title">Instagram Feeds</h4>
                        <ul class="instagram_row flex-wrap">
                            @for($i = 1; $i <= 6; $i++) <li>
                                <a href="#">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/img/post/post_' . ($i + 4) . '.png') }}" alt="">
                                </a>
                                </li>
                                @endfor
                        </ul>
                    </aside>

                    <!-- Newsletter Widget -->
                    <aside class="single_sidebar_widget newsletter_widget">
                        <h4 class="widget_title">Newsletter</h4>
                        <form action="#">
                            <div class="form-group">
                                <input type="email" class="form-control" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                type="submit">Subscribe</button>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ Blog Area end =================-->

@endsection --}}

@extends('frontend.layout')

@section('title', $news->title)
@section('description', $news->excerpt ?? Str::limit($news->content, 150))

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
<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post">
                    <!-- Featured Image -->
                    <div class="feature-img">
                        @if($news->image)
                        <img class="img-fluid" src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}">
                        @else
                        <img class="img-fluid" src="{{ asset('assets/img/blog/single_blog_1.png') }}"
                            alt="{{ $news->title }}">
                        @endif
                    </div>

                    <!-- Blog Details -->
                    <div class="blog_details">
                        <h2>{{ $news->title }}</h2>

                        <ul class="blog-info-link mt-3 mb-4">
                            <li><a href="{{ route('news.category', $news->category->slug) }}">
                                    <i class="fa fa-user"></i> {{ $news->category->name }}
                                </a></li>
                            <li><a href="#comments">
                                    <i class="fa fa-comments"></i> {{ $news->comments->count() }} Comments
                                </a></li>
                            <li><i class="fa fa-calendar"></i> {{ $news->published_at->format('F d, Y') }}</li>
                            <li><i class="fa fa-eye"></i> {{ number_format($news->views) }} Views</li>
                        </ul>

                        <!-- Excerpt -->
                        @if($news->excerpt)
                        <p class="excert">
                            {{ $news->excerpt }}
                        </p>
                        @endif

                        <!-- Content -->
                        <div class="news-content">
                            {!! $news->content !!}
                        </div>
                        

                        <!-- Tags -->
                        @if($news->tags->count() > 0)
                        <div class="tag-widget post-tag-container mb-5 mt-5">
                            <div class="tagcloud">
                                @foreach($news->tags as $tag)
                                <a href="#" class="tag-cloud-link">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- SHARE SECTION - ENHANCED -->
                {{-- <div class="share-section-wrapper">
                    <div class="share-section">
                        <div class="share-header">
                            <h4><i class="fas fa-share-alt"></i> Bagikan Berita Ini</h4>
                            <p>Bantu sebarkan informasi ini ke teman dan keluarga Anda</p>
                        </div>

                        <!-- Social Media Share Buttons -->
                        <div class="social-share-buttons">
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $news->slug)) }}"
                                target="_blank" class="share-btn facebook" title="Share on Facebook">
                                <i class="fab fa-facebook-f"></i>
                                <span>Facebook</span>
                            </a>

                            <!-- Twitter/X -->
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                target="_blank" class="share-btn twitter" title="Share on Twitter">
                                <i class="fab fa-twitter"></i>
                                <span>Twitter</span>
                            </a>

                            <!-- WhatsApp -->
                            <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . route('news.show', $news->slug)) }}"
                                target="_blank" class="share-btn whatsapp" title="Share on WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                                <span>WhatsApp</span>
                            </a>

                            <!-- Telegram -->
                            <a href="https://t.me/share/url?url={{ urlencode(route('news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                target="_blank" class="share-btn telegram" title="Share on Telegram">
                                <i class="fab fa-telegram-plane"></i>
                                <span>Telegram</span>
                            </a>

                            <!-- LinkedIn -->
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('news.show', $news->slug)) }}&title={{ urlencode($news->title) }}"
                                target="_blank" class="share-btn linkedin" title="Share on LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                                <span>LinkedIn</span>
                            </a>

                            <!-- Email -->
                            <a href="mailto:?subject={{ urlencode($news->title) }}&body={{ urlencode('Baca berita ini: ' . route('news.show', $news->slug)) }}"
                                class="share-btn email" title="Share via Email">
                                <i class="fas fa-envelope"></i>
                                <span>Email</span>
                            </a>
                        </div>

                        <!-- Copy Link Section -->
                        <div class="copy-link-section">
                            <div class="copy-link-wrapper">
                                <input type="text" id="shareLink" value="{{ route('news.show', $news->slug) }}" readonly
                                    class="form-control">
                                <button onclick="copyLink()" class="btn-copy" id="copyBtn">
                                    <i class="fas fa-copy"></i> Copy Link
                                </button>
                            </div>
                            <small class="text-muted">Atau salin link di atas dan bagikan manual</small>
                        </div>
                    </div>
                </div> --}}

                <!-- Navigation (Prev/Next Post) -->
                <div class="navigation-top">
                    <div class="d-sm-flex justify-content-between text-center">
                        <p class="like-info">
                            <span class="align-middle"><i class="fa fa-heart"></i></span>
                            {{ $news->views }} people viewed this
                        </p>
                        <div class="col-sm-4 text-center my-2 my-sm-0">
                        </div>
                        <ul class="social-icons">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $news->slug)) }}"
                                    target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                    target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://wa.me/?text={{ urlencode($news->title . ' ' . route('news.show', $news->slug)) }}"
                                    target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('news.show', $news->slug)) }}&title={{ urlencode($news->title) }}"
                                    target="_blank"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>

                    <!-- Previous/Next Navigation -->
                    @php
                    $prevNews = \App\Models\News::published()
                    ->where('id', '<', $news->id)
                        ->orderBy('id', 'desc')
                        ->first();

                        $nextNews = \App\Models\News::published()
                        ->where('id', '>', $news->id)
                        ->orderBy('id', 'asc')
                        ->first();
                        @endphp

                        <div class="navigation-area">
                            <div class="row">
                                @if($prevNews)
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    <div class="thumb">
                                        <a href="{{ route('news.show', $prevNews->slug) }}">
                                            @if($prevNews->image)
                                            <img class="img-fluid" src="{{ Storage::url($prevNews->image) }}"
                                                alt="{{ $prevNews->title }}">
                                            @else
                                            <img class="img-fluid" src="{{ asset('assets/img/post/preview.png') }}"
                                                alt="{{ $prevNews->title }}">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="{{ route('news.show', $prevNews->slug) }}">
                                            <span class="lnr text-white ti-arrow-left"></span>
                                        </a>
                                    </div>
                                    <div class="detials">
                                        <p>Prev Post</p>
                                        <a href="{{ route('news.show', $prevNews->slug) }}">
                                            <h4>{{ Str::limit($prevNews->title, 30) }}</h4>
                                        </a>
                                    </div>
                                </div>
                                @endif

                                @if($nextNews)
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    <div class="detials">
                                        <p>Next Post</p>
                                        <a href="{{ route('news.show', $nextNews->slug) }}">
                                            <h4>{{ Str::limit($nextNews->title, 30) }}</h4>
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="{{ route('news.show', $nextNews->slug) }}">
                                            <span class="lnr text-white ti-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="thumb">
                                        <a href="{{ route('news.show', $nextNews->slug) }}">
                                            @if($nextNews->image)
                                            <img class="img-fluid" src="{{ Storage::url($nextNews->image) }}"
                                                alt="{{ $nextNews->title }}">
                                            @else
                                            <img class="img-fluid" src="{{ asset('assets/img/post/next.png') }}"
                                                alt="{{ $nextNews->title }}">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                </div>

                <!-- Blog Author -->
                <div class="blog-author">
                    <div class="media align-items-center">
                        <img src="{{ $news->user->avatar_url }}" alt="{{ $news->user->name }}">
                        <div class="media-body">
                            <a href="#">
                                <h4>{{ $news->user->name }}</h4>
                            </a>
                            <p>{{ $news->user->bio ?? 'Penulis berita di Portal KieRaha. Menyajikan informasi terkini
                                dan terpercaya.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Comments Area -->
                <div class="comments-area" id="comments">
                    <h4>{{ $news->comments->count() }} Comments</h4>

                    @foreach($news->comments as $comment)
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    @if($comment->user->avatar)
                                    <img src="{{ Storage::url($comment->user->avatar) }}" alt="{{ $comment->user->name }}">
                                    @else
                                    <img src="{{ asset('assets/img/comment/comment_1.png') }}" alt="{{ $comment->user->name }}">
                                    @endif
                                </div>
                                <div class="desc">
                                    <p class="comment">
                                        {{ $comment->content }}
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <h5>
                                                <a href="#">{{ $comment->user->name }}</a>
                                            </h5>
                                            <p class="date">{{ $comment->created_at->format('F d, Y \a\t g:i a') }}</p>
                                        </div>
                                        <div class="reply-btn">
                                            <a href="#" class="btn-reply text-uppercase">reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Comment Form -->
                <div class="comment-form">
                    <h4>Leave a Reply</h4>

                    @auth
                    <form class="form-contact comment_form" action="{{ route('news.comment', $news) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="content" id="comment" cols="30" rows="9"
                                        placeholder="Write Comment" required></textarea>
                                    @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="button button-contactForm btn_1 boxed-btn">Post
                                Comment</button>
                        </div>
                    </form>
                    @else
                    <div class="alert alert-info">
                        <p class="mb-0">You must <a href="{{ route('login') }}" class="alert-link">login</a> to post a
                            comment.</p>
                    </div>
                    @endauth
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <!-- QUICK SHARE WIDGET -->
                    <aside class="single_sidebar_widget share_widget">
                        <h4 class="widget_title">📤 Quick Share</h4>
                        <div class="quick-share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $news->slug)) }}"
                                target="_blank" class="quick-share-btn fb"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                target="_blank" class="quick-share-btn tw"><i class="fab fa-twitter"></i></a>
                            <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . route('news.show', $news->slug)) }}"
                                target="_blank" class="quick-share-btn wa"><i class="fab fa-whatsapp"></i></a>
                            <a href="https://t.me/share/url?url={{ urlencode(route('news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                target="_blank" class="quick-share-btn tg"><i class="fab fa-telegram-plane"></i></a>
                        </div>
                        
                        {{-- <button onclick="copyLink()" class="btn-quick-copy mt-3">
                            <i class="fas fa-link"></i> Copy Link
                        </button> --}}
                        <div class="copy-link-section">
                            <div class="copy-link-wrapper">
                                <input type="text" id="shareLink" value="{{ route('news.show', $news->slug) }}" readonly
                                    class="form-control">
                                    <button onclick="copyLink()" class="btn-quick-copy mt-3">
                                        <i class="fas fa-link"></i> Copy Link
                                    </button>
                                {{-- <button onclick="copyLink()" class="btn-copy" id="copyBtn">
                                    <i class="fas fa-copy"></i> Copy Link
                                </button> --}}
                            </div>
                            <small class="text-muted">Atau salin link di atas dan bagikan manual</small>
                        </div>
                    </aside>

                    <!-- Search Widget -->
                    <aside class="single_sidebar_widget search_widget">
                        <form action="{{ route('news.search') }}" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" name="q" class="form-control" placeholder='Search Keyword'
                                        value="{{ request('q') }}" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Search Keyword'">
                                    <div class="input-group-append">
                                        <button class="btns" type="submit"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                type="submit">Search</button>
                        </form>
                    </aside>

                    <!-- Category Widget -->
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Category</h4>
                        <ul class="list cat-list">
                            @foreach($categories ?? [] as $category)
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
                        <h3 class="widget_title">Recent Post</h3>
                        @foreach($popularNews ?? [] as $popular)
                        <div class="media post_item">
                            @if($popular->image)
                            <img src="{{ Storage::url($popular->image) }}" alt="{{ $popular->title }}"
                                style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                            <img src="{{ asset('assets/img/post/post_1.png') }}" alt="{{ $popular->title }}">
                            @endif
                            <div class="media-body">
                                <a href="{{ route('news.show', $popular->slug) }}">
                                    <h3>{{ Str::limit($popular->title, 50) }}</h3>
                                </a>
                                <p>{{ $popular->published_at->format('F d, Y') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </aside>

                    <!-- Tag Clouds Widget -->
                    @if($news->tags->count() > 0)
                    <aside class="single_sidebar_widget tag_cloud_widget">
                        <h4 class="widget_title">Tag Clouds</h4>
                        <ul class="list">
                            @foreach($news->tags as $tag)
                            <li>
                                <a href="#">{{ $tag->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </aside>
                    @endif

                    <!-- Newsletter Widget -->
                    <aside class="single_sidebar_widget newsletter_widget">
                        <h4 class="widget_title">Newsletter</h4>
                        <form action="#">
                            <div class="form-group">
                                <input type="email" class="form-control" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                type="submit">Subscribe</button>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ Blog Area end =================-->

<style>
    /* Share Section Styles */
    .share-section-wrapper {
        margin: 40px 0;
    }

    .share-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 35px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .share-header {
        text-align: center;
        margin-bottom: 30px;
        color: white;
    }

    .share-header h4 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
        color: white;
    }

    .share-header p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }

    .social-share-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 15px;
        margin-bottom: 25px;
    }

    .share-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 20px;
        border-radius: 10px;
        text-decoration: none;
        color: white;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .share-btn i {
        font-size: 18px;
    }

    .share-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        color: white;
    }

    .share-btn.facebook {
        background: #1877f2;
    }

    .share-btn.twitter {
        background: #1da1f2;
    }

    .share-btn.whatsapp {
        background: #25d366;
    }

    .share-btn.telegram {
        background: #0088cc;
    }

    .share-btn.linkedin {
        background: #0077b5;
    }

    .share-btn.email {
        background: #ea4335;
    }

    /* Copy Link Section */
    .copy-link-section {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 10px;
        padding: 20px;
    }

    .copy-link-wrapper {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }

    .copy-link-wrapper input {
        flex: 1;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        background: white;
    }

    .btn-copy {
        padding: 12px 25px;
        background: #ff0055;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .btn-copy:hover {
        background: #d6003d;
        transform: scale(1.05);
    }

    .btn-copy i {
        margin-right: 5px;
    }

    /* Quick Share Widget in Sidebar */
    .share_widget {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }

    .quick-share-buttons {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        margin-bottom: 15px;
    }

    .quick-share-btn {
        width: 100%;
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: white;
        font-size: 20px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .quick-share-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .quick-share-btn.fb {
        background: #1877f2;
    }

    .quick-share-btn.tw {
        background: #1da1f2;
    }

    .quick-share-btn.wa {
        background: #25d366;
    }

    .quick-share-btn.tg {
        background: #0088cc;
    }

    .btn-quick-copy {
        width: 100%;
        padding: 12px;
        background: #2c234d;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-quick-copy:hover {
        background: #ff0055;
        transform: scale(1.02);
    }

    /* Success Message */
    .copy-success {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #10b981;
        color: white;
        padding: 15px 25px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .social-share-buttons {
            grid-template-columns: repeat(2, 1fr);
        }

        .share-section {
            padding: 25px 20px;
        }

        .copy-link-wrapper {
            flex-direction: column;
        }

        .btn-copy {
            width: 100%;
        }

        .quick-share-buttons {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 480px) {
        .share-btn span {
            display: none;
        }

        .share-btn {
            padding: 14px;
            justify-content: center;
        }

        .share-btn i {
            margin: 0;
            font-size: 20px;
        }
    }
</style>

<script>
    function copyLink() {
    const linkInput = document.getElementById('shareLink');
    linkInput.select();
    linkInput.setSelectionRange(0, 99999); // For mobile devices
    
    // Copy to clipboard
    navigator.clipboard.writeText(linkInput.value).then(function() {
        // Show success message
        const successMsg = document.createElement('div');
        successMsg.className = 'copy-success';
        successMsg.innerHTML = '<i class="fas fa-check-circle"></i> Link berhasil disalin!';
        document.body.appendChild(successMsg);
        
        // Change button text temporarily
        const copyBtn = document.getElementById('copyBtn');
        const originalText = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
        copyBtn.style.background = '#10b981';
        
        // Remove success message and reset button after 2 seconds
        setTimeout(function() {
            successMsg.remove();
            copyBtn.innerHTML = originalText;
            copyBtn.style.background = '';
        }, 2000);
    }, function() {
        alert('Gagal menyalin link. Silakan salin secara manual.');
    });
}
</script>

@endsection