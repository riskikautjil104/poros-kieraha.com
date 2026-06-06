@extends('frontend.layout')

@section('title', $news->title)
@section('meta_description', Str::limit(strip_tags($news->content), 160))
@section('meta_keywords', $news->tags->pluck('name')->join(', ') ?: 'berita ternate, maluku utara')
@section('og_type', 'article')
@section('og_title', $news->title)
@section('og_description', $news->excerpt ?: Str::limit(strip_tags($news->content), 200))
@if($news->image)
    @section('og_image', url(Storage::url($news->image)))
    @section('twitter_image', url(Storage::url($news->image)))
@else
    @section('og_image', url(asset('assets/img/logo/poros fix.PNG')))
    @section('twitter_image', url(asset('assets/img/logo/poros fix.PNG')))
@endif

@section('content')
<!-- Preloader -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="{{ asset('assets/img/logo/favicon/favicon-96x96.png') }}" alt="">
            </div>
        </div>
    </div>
</div>

<!-- Breadcrumb -->
<div class="pkr-breadcrumb">
    <div class="container">
        <nav>
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <a href="{{ route('news.category', $news->category->slug) }}">{{ $news->category->name }}</a>
            <span>/</span>
            <span>{{ Str::limit($news->title, 50) }}</span>
        </nav>
    </div>
</div>

<!-- Article Area -->
<section class="pkr-article-section">
    <div class="container">
        <div class="row">

            <!-- ===== Main Article ===== -->
            <div class="col-lg-8">
                <article class="pkr-article">

                    <!-- Category + Meta -->
                    <div class="pkr-article-top">
                        <a href="{{ route('news.category', $news->category->slug) }}" class="pkr-badge">
                            {{ $news->category->name }}
                        </a>
                    </div>

                    <!-- Title -->
                    <h1 class="pkr-article-title">{{ $news->title }}</h1>

                    <!-- Meta row -->
                    <div class="pkr-article-meta">
                        <span><i class="far fa-user"></i> {{ $news->user->name }}</span>
                        <span><i class="far fa-calendar"></i> {{ $news->published_at->format('d F Y') }}</span>
                        <span><i class="far fa-eye"></i> {{ number_format($news->views) }} views</span>
                        <span><i class="far fa-comments"></i> {{ $news->comments->count() }} komentar</span>
                    </div>

                    <!-- Divider -->
                    <hr class="pkr-article-divider">

                    <!-- Featured Image -->
                    @if($news->image)
                    <div class="pkr-article-img">
                        <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}">
                    </div>
                    @endif

                    <!-- Excerpt -->
                    @if($news->excerpt)
                    <p class="pkr-article-excerpt">{{ $news->excerpt }}</p>
                    @endif

                    <!-- Content -->
                    <div class="pkr-article-content">
                        {!! $news->content !!}
                    </div>

                    <!-- Tags -->
                    @if($news->tags->count() > 0)
                    <div class="pkr-article-tags">
                        <span class="pkr-tags-label"><i class="fas fa-tags"></i> Tags:</span>
                        @foreach($news->tags as $tag)
                            <a href="#" class="pkr-tag">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                    @endif

                    <!-- Share Row -->
                    <div class="pkr-share-row">
                        <span class="pkr-share-label">Bagikan:</span>
                        <div class="pkr-share-btns">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $news->slug)) }}"
                               target="_blank" class="pkr-share-btn pkr-share-fb" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                               target="_blank" class="pkr-share-btn pkr-share-tw" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . route('news.show', $news->slug)) }}"
                               target="_blank" class="pkr-share-btn pkr-share-wa" title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://t.me/share/url?url={{ urlencode(route('news.show', $news->slug)) }}"
                               target="_blank" class="pkr-share-btn pkr-share-tg" title="Telegram">
                                <i class="fab fa-telegram-plane"></i>
                            </a>
                        </div>
                        <div class="pkr-copy-link">
                            <input type="text" id="shareLink" value="{{ route('news.show', $news->slug) }}" readonly>
                            <button onclick="copyLink()" id="copyBtn"><i class="fas fa-copy"></i> Copy</button>
                        </div>
                    </div>

                    <!-- Prev / Next Navigation -->
                    @php
                        $prevNews = \App\Models\News::published()->where('id', '<', $news->id)->orderBy('id', 'desc')->first();
                        $nextNews = \App\Models\News::published()->where('id', '>', $news->id)->orderBy('id', 'asc')->first();
                    @endphp

                    <div class="pkr-prevnext">
                        @if($prevNews)
                        <a href="{{ route('news.show', $prevNews->slug) }}" class="pkr-prevnext-item">
                            <span class="pkr-prevnext-dir"><i class="fas fa-arrow-left"></i> Sebelumnya</span>
                            <span class="pkr-prevnext-title">{{ Str::limit($prevNews->title, 55) }}</span>
                        </a>
                        @else
                        <div></div>
                        @endif

                        @if($nextNews)
                        <a href="{{ route('news.show', $nextNews->slug) }}" class="pkr-prevnext-item pkr-prevnext-right">
                            <span class="pkr-prevnext-dir">Berikutnya <i class="fas fa-arrow-right"></i></span>
                            <span class="pkr-prevnext-title">{{ Str::limit($nextNews->title, 55) }}</span>
                        </a>
                        @endif
                    </div>

                    <!-- Author Box -->
                    <div class="pkr-author-box">
                        <img src="{{ asset('assets/img/blog/author.png') }}" alt="{{ $news->user->name }}">
                        <div class="pkr-author-info">
                            <h4>{{ $news->user->name }}</h4>
                            <p>{{ $news->user->bio ?? 'Penulis berita di Poros KieRaha. Menyajikan informasi terkini dan terpercaya.' }}</p>
                        </div>
                    </div>

                    <!-- Comments -->
                    <div class="pkr-comments-area" id="comments">
                        <h3 class="pkr-comments-title">{{ $news->comments->count() }} Komentar</h3>

                        @foreach($news->comments as $comment)
                        <div class="pkr-comment">
                            <img src="{{ asset('assets/img/blog/author.png') }}" alt="{{ $comment->user->name }}">
                            <div class="pkr-comment-body">
                                <div class="pkr-comment-header">
                                    <strong>{{ $comment->user->name }}</strong>
                                    <span>{{ $comment->created_at->format('d F Y, H:i') }}</span>
                                </div>
                                <p>{{ $comment->content }}</p>
                            </div>
                        </div>
                        @endforeach

                        <!-- Comment Form -->
                        <div class="pkr-comment-form">
                            <h4>Tinggalkan Komentar</h4>
                            @auth
                            <form action="{{ route('news.comment', $news) }}" method="POST">
                                @csrf
                                <textarea name="content" rows="5" placeholder="Tulis komentar Anda..." required>{{ old('content') }}</textarea>
                                @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <button type="submit" class="btn-pkr-primary mt-3">
                                    <i class="fas fa-paper-plane"></i> Kirim Komentar
                                </button>
                            </form>
                            @else
                            <div class="pkr-login-notice">
                                <i class="fas fa-info-circle"></i>
                                Anda harus <a href="{{ route('login') }}">login</a> untuk memberikan komentar.
                            </div>
                            @endauth
                        </div>
                    </div>

                </article>
            </div>

            <!-- ===== Sidebar ===== -->
            <div class="col-lg-4">
                <div class="pkr-detail-sidebar">

                    <!-- Quick Share -->
                    <div class="pkr-sidebar-widget">
                        <div class="pkr-sw-title"><i class="fas fa-share-alt"></i> Bagikan Berita</div>
                        <div class="pkr-sw-body">
                            <div class="pkr-share-grid">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $news->slug)) }}"
                                   target="_blank" class="pkr-share-btn pkr-share-fb">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $news->slug)) }}"
                                   target="_blank" class="pkr-share-btn pkr-share-tw">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . route('news.show', $news->slug)) }}"
                                   target="_blank" class="pkr-share-btn pkr-share-wa">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                                <a href="https://t.me/share/url?url={{ urlencode(route('news.show', $news->slug)) }}"
                                   target="_blank" class="pkr-share-btn pkr-share-tg">
                                    <i class="fab fa-telegram-plane"></i> Telegram
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="pkr-sidebar-widget">
                        <div class="pkr-sw-title"><i class="fas fa-search"></i> Cari Berita</div>
                        <div class="pkr-sw-body">
                            <form action="{{ route('news.search') }}" method="GET" class="pkr-sw-search">
                                <input type="text" name="q" placeholder="Kata kunci..." value="{{ request('q') }}">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="pkr-sidebar-widget">
                        <div class="pkr-sw-title"><i class="fas fa-folder-open"></i> Kategori</div>
                        <div class="pkr-sw-body pkr-sw-cats">
                            @foreach($categories ?? [] as $category)
                            <a href="{{ route('news.category', $category->slug) }}" class="pkr-sw-cat-item">
                                <span>{{ $category->name }}</span>
                                <span class="pkr-sw-cat-count">{{ $category->news_count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recent Posts -->
                    <div class="pkr-sidebar-widget">
                        <div class="pkr-sw-title"><i class="fas fa-clock"></i> Berita Terkini</div>
                        <div class="pkr-sw-body">
                            @foreach($popularNews ?? [] as $popular)
                            <a href="{{ route('news.show', $popular->slug) }}" class="pkr-sw-post">
                                @if($popular->image)
                                    <img src="{{ Storage::url($popular->image) }}" alt="{{ $popular->title }}">
                                @else
                                    <img src="{{ asset('assets/img/post/post_1.png') }}" alt="{{ $popular->title }}">
                                @endif
                                <div>
                                    <p>{{ Str::limit($popular->title, 55) }}</p>
                                    <small>{{ $popular->published_at->format('d M Y') }}</small>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tags -->
                    @if($news->tags->count() > 0)
                    <div class="pkr-sidebar-widget">
                        <div class="pkr-sw-title"><i class="fas fa-tags"></i> Tag</div>
                        <div class="pkr-sw-body pkr-sw-tags">
                            @foreach($news->tags as $tag)
                                <a href="#" class="pkr-tag">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Newsletter -->
                    <div class="pkr-sidebar-widget pkr-sw-newsletter">
                        <div class="pkr-sw-title"><i class="fas fa-envelope"></i> Newsletter</div>
                        <div class="pkr-sw-body">
                            <p>Dapatkan berita terbaru langsung di inbox Anda.</p>
                            <form action="#">
                                <input type="email" placeholder="Masukkan email Anda...">
                                <button type="submit" class="btn-pkr-primary w-100 mt-2">Langganan</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<style>
/* === BREADCRUMB === */
.pkr-breadcrumb {
    background: var(--white);
    border-bottom: 1px solid var(--gray-200);
    padding: 12px 0;
}

.pkr-breadcrumb nav {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;
    font-size: 13px;
    color: var(--gray-400);
}

.pkr-breadcrumb nav a {
    color: var(--blue-mid);
    font-weight: 500;
}

.pkr-breadcrumb nav a:hover { color: var(--red); }

.pkr-breadcrumb nav span:not(.slash) { color: var(--gray-600); }

/* === ARTICLE SECTION === */
.pkr-article-section {
    padding: 50px 0 60px;
    background: var(--off-white);
}

/* === ARTICLE === */
.pkr-article {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    padding: 40px;
    box-shadow: var(--shadow-sm);
}

.pkr-article-top { margin-bottom: 16px; }

.pkr-article-title {
    font-family: var(--font-display);
    font-size: 30px;
    font-weight: 700;
    line-height: 1.35;
    color: var(--blue);
    margin-bottom: 18px;
}

.pkr-article-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    font-size: 13px;
    color: var(--gray-400);
    margin-bottom: 20px;
}

.pkr-article-meta span {
    display: flex;
    align-items: center;
    gap: 6px;
}

.pkr-article-meta i { color: var(--blue-mid); }

.pkr-article-divider {
    border: none;
    border-top: 2px solid var(--gray-100);
    margin: 20px 0;
}

.pkr-article-img {
    border-radius: var(--radius-md);
    overflow: hidden;
    margin-bottom: 28px;
    box-shadow: var(--shadow-sm);
}

.pkr-article-img img { width: 100%; height: auto; display: block; }

.pkr-article-excerpt {
    font-size: 16px;
    font-style: italic;
    color: var(--text-soft);
    border-left: 4px solid var(--red);
    padding: 12px 20px;
    background: var(--off-white);
    border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
    margin-bottom: 24px;
    line-height: 1.65;
}

.pkr-article-content {
    font-family: var(--font-display);
    font-size: 17px;
    line-height: 1.8;
    color: var(--text-main);
    margin-bottom: 30px;
}

.pkr-article-content p { margin-bottom: 18px; }
.pkr-article-content img { max-width: 100%; border-radius: var(--radius-sm); }
.pkr-article-content h2, .pkr-article-content h3 { color: var(--blue); margin: 28px 0 14px; }

/* Tags */
.pkr-article-tags {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;
    margin-bottom: 28px;
    padding: 16px;
    background: var(--off-white);
    border-radius: var(--radius-sm);
    border: 1px solid var(--gray-200);
}

.pkr-tags-label {
    font-size: 12.5px;
    font-weight: 700;
    color: var(--blue);
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-right: 4px;
}

.pkr-tag {
    display: inline-block;
    background: var(--white);
    color: var(--blue-mid);
    border: 1px solid var(--blue-light);
    font-size: 12px;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 3px;
    transition: all .2s;
}

.pkr-tag:hover {
    background: var(--blue-mid);
    color: #fff;
    border-color: var(--blue-mid);
}

/* Share row */
.pkr-share-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    padding: 20px 0;
    border-top: 1px solid var(--gray-200);
    border-bottom: 1px solid var(--gray-200);
    margin-bottom: 30px;
}

.pkr-share-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--blue);
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-right: 6px;
}

.pkr-share-btns { display: flex; gap: 8px; flex-wrap: wrap; }

.pkr-share-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    color: #fff;
    font-size: 15px;
    transition: all .2s;
    text-decoration: none;
}

.pkr-share-btn:hover { transform: translateY(-2px); color: #fff; }
.pkr-share-fb { background: #1877f2; }
.pkr-share-tw { background: #1da1f2; }
.pkr-share-wa { background: #25d366; }
.pkr-share-tg { background: #0088cc; }

.pkr-copy-link {
    display: flex;
    margin-left: auto;
}

.pkr-copy-link input {
    border: 1px solid var(--gray-200);
    padding: 6px 12px;
    font-size: 12.5px;
    outline: none;
    color: var(--text-soft);
    width: 180px;
    border-radius: var(--radius-sm) 0 0 var(--radius-sm);
}

.pkr-copy-link button {
    background: var(--blue-mid);
    color: #fff;
    border: none;
    padding: 6px 14px;
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
    border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
    transition: background .2s;
}

.pkr-copy-link button:hover { background: var(--blue); }

/* Prev / Next */
.pkr-prevnext {
    display: flex;
    gap: 16px;
    margin-bottom: 30px;
}

.pkr-prevnext-item {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 5px;
    padding: 14px 16px;
    background: var(--off-white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    transition: all .2s;
}

.pkr-prevnext-item:hover {
    border-color: var(--blue-mid);
    background: var(--blue-light);
}

.pkr-prevnext-right { text-align: right; }

.pkr-prevnext-dir {
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .06em;
    color: var(--red);
}

.pkr-prevnext-title {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--blue);
    line-height: 1.4;
}

/* Author box */
.pkr-author-box {
    display: flex;
    gap: 18px;
    align-items: flex-start;
    padding: 24px;
    background: var(--off-white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    margin-bottom: 36px;
    border-left: 4px solid var(--blue-mid);
}

.pkr-author-box > img {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
    border: 2px solid var(--blue-light);
}

.pkr-author-info h4 {
    font-size: 16px;
    font-weight: 700;
    color: var(--blue);
    margin-bottom: 6px;
}

.pkr-author-info p {
    font-size: 13.5px;
    color: var(--text-soft);
    margin: 0;
    line-height: 1.6;
}

/* Comments */
.pkr-comments-area { margin-top: 8px; }

.pkr-comments-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--blue);
    margin-bottom: 24px;
    padding-bottom: 14px;
    border-bottom: 2px solid var(--gray-200);
}

.pkr-comment {
    display: flex;
    gap: 14px;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--gray-100);
}

.pkr-comment > img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
    border: 2px solid var(--blue-light);
}

.pkr-comment-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 6px;
}

.pkr-comment-header strong {
    font-size: 14px;
    font-weight: 700;
    color: var(--blue);
}

.pkr-comment-header span {
    font-size: 12px;
    color: var(--gray-400);
}

.pkr-comment-body p {
    font-size: 14.5px;
    color: var(--text-soft);
    margin: 0;
    line-height: 1.6;
}

/* Comment form */
.pkr-comment-form { margin-top: 30px; }

.pkr-comment-form h4 {
    font-size: 18px;
    font-weight: 700;
    color: var(--blue);
    margin-bottom: 18px;
}

.pkr-comment-form textarea {
    width: 100%;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-sm);
    padding: 14px 16px;
    font-size: 14px;
    font-family: var(--font-body);
    color: var(--text-main);
    outline: none;
    resize: vertical;
    transition: border-color .2s;
}

.pkr-comment-form textarea:focus { border-color: var(--blue-mid); }

.pkr-login-notice {
    background: var(--blue-light);
    border: 1px solid var(--blue-mid);
    border-radius: var(--radius-sm);
    padding: 14px 18px;
    font-size: 14px;
    color: var(--blue);
}

.pkr-login-notice a { color: var(--red); font-weight: 600; }

/* ===== SIDEBAR ===== */
.pkr-detail-sidebar { display: flex; flex-direction: column; gap: 22px; }

.pkr-sidebar-widget {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.pkr-sw-title {
    background: var(--blue);
    color: #fff;
    font-family: var(--font-body);
    font-size: 12.5px;
    font-weight: 700;
    letter-spacing: .07em;
    text-transform: uppercase;
    padding: 12px 18px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.pkr-sw-title i { color: rgba(255,255,255,0.65); font-size: 13px; }

.pkr-sw-body { padding: 16px 18px; }

/* Search */
.pkr-sw-search {
    display: flex;
}

.pkr-sw-search input {
    flex: 1;
    border: 1.5px solid var(--gray-200);
    border-right: none;
    padding: 9px 14px;
    font-size: 13.5px;
    outline: none;
    border-radius: var(--radius-sm) 0 0 var(--radius-sm);
    transition: border-color .2s;
}

.pkr-sw-search input:focus { border-color: var(--blue-mid); }

.pkr-sw-search button {
    background: var(--red);
    border: none;
    color: #fff;
    padding: 9px 16px;
    cursor: pointer;
    border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
    transition: background .2s;
}

.pkr-sw-search button:hover { background: var(--red-dark); }

/* Categories */
.pkr-sw-cats { padding: 0; }

.pkr-sw-cat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 11px 18px;
    font-size: 13.5px;
    color: var(--text-main);
    font-weight: 500;
    border-bottom: 1px solid var(--gray-100);
    transition: all .2s;
}

.pkr-sw-cat-item:last-child { border-bottom: none; }

.pkr-sw-cat-item:hover {
    background: var(--off-white);
    color: var(--red);
    padding-left: 24px;
}

.pkr-sw-cat-count {
    background: var(--blue-light);
    color: var(--blue-mid);
    font-size: 11.5px;
    font-weight: 700;
    padding: 2px 9px;
    border-radius: 12px;
}

/* Posts */
.pkr-sw-post {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    padding-bottom: 14px;
    margin-bottom: 14px;
    border-bottom: 1px solid var(--gray-100);
    transition: opacity .2s;
}

.pkr-sw-post:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }

.pkr-sw-post:hover { opacity: .8; }

.pkr-sw-post img {
    width: 68px;
    height: 52px;
    object-fit: cover;
    border-radius: var(--radius-sm);
    flex-shrink: 0;
}

.pkr-sw-post p {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-main);
    margin: 0 0 4px;
    line-height: 1.4;
    transition: color .2s;
}

.pkr-sw-post:hover p { color: var(--red); }

.pkr-sw-post small { font-size: 11.5px; color: var(--gray-400); }

/* Tags */
.pkr-sw-tags { display: flex; flex-wrap: wrap; gap: 7px; }

/* Share grid in sidebar */
.pkr-share-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
}

.pkr-share-grid .pkr-share-btn {
    width: 100%;
    height: 40px;
    border-radius: var(--radius-sm);
    gap: 7px;
    font-size: 13px;
    font-weight: 600;
}

/* Newsletter sidebar */
.pkr-sw-newsletter .pkr-sw-body p {
    font-size: 13.5px;
    color: var(--text-soft);
    margin-bottom: 12px;
}

.pkr-sw-newsletter input[type="email"] {
    width: 100%;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-sm);
    padding: 10px 14px;
    font-size: 13.5px;
    outline: none;
    transition: border-color .2s;
}

.pkr-sw-newsletter input[type="email"]:focus { border-color: var(--blue-mid); }

/* Copy notification */
.pkr-copy-toast {
    position: fixed;
    top: 24px;
    right: 24px;
    background: var(--blue);
    color: #fff;
    padding: 12px 22px;
    border-radius: var(--radius-sm);
    font-size: 14px;
    font-weight: 600;
    box-shadow: var(--shadow-lg);
    z-index: 99999;
    animation: toastIn .3s ease;
}

@keyframes toastIn {
    from { transform: translateX(120px); opacity: 0; }
    to   { transform: translateX(0); opacity: 1; }
}

/* Responsive */
@media (max-width: 768px) {
    .pkr-article { padding: 22px 18px; }
    .pkr-article-title { font-size: 22px; }
    .pkr-prevnext { flex-direction: column; }
    .pkr-copy-link { display: none; }
    .pkr-share-row { flex-wrap: wrap; }
}
</style>

<script>
function copyLink() {
    var input = document.getElementById('shareLink');
    input.select();
    navigator.clipboard.writeText(input.value).then(function () {
        var toast = document.createElement('div');
        toast.className = 'pkr-copy-toast';
        toast.innerHTML = '<i class="fas fa-check-circle"></i> Link berhasil disalin!';
        document.body.appendChild(toast);

        var btn = document.getElementById('copyBtn');
        var orig = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Disalin!';
        btn.style.background = '#27ae60';

        setTimeout(function () {
            toast.remove();
            btn.innerHTML = orig;
            btn.style.background = '';
        }, 2200);
    }).catch(function () {
        alert('Gagal menyalin. Salin secara manual.');
    });
}
</script>

@endsection