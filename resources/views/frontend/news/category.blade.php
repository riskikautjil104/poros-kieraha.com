{{-- =====================================================
     category.blade.php  —  PKR Corporate Theme
     ===================================================== --}}
{{-- @SAVE AS: resources/views/frontend/category.blade.php --}}
@extends('frontend.layout')

@section('title', $category->name . ' - Berita')

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

<!-- Category Header -->
<div class="pkr-page-header">
    <div class="container">
        <nav class="pkr-page-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <span>{{ $category->name }}</span>
        </nav>
        <h1>{{ $category->name }}</h1>
        @if($category->description)
            <p>{{ $category->description }}</p>
        @endif
        <div class="pkr-page-header-meta">
            <span><i class="fas fa-newspaper"></i> {{ $news->total() }} berita ditemukan</span>
        </div>
    </div>
</div>

<!-- Content -->
<section class="pkr-list-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @forelse($news as $item)
                <article class="pkr-list-item">
                    <a href="{{ route('news.show', $item->slug) }}" class="pkr-list-img">
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}">
                        @else
                            <img src="{{ asset('assets/img/news/whatNews1.jpg') }}" alt="{{ $item->title }}">
                        @endif
                    </a>
                    <div class="pkr-list-body">
                        <span class="pkr-badge">{{ $item->category->name }}</span>
                        <h3>
                            <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                        </h3>
                        @if($item->excerpt)
                            <p>{{ Str::limit($item->excerpt, 140) }}</p>
                        @endif
                        <div class="pkr-list-meta">
                            <span><i class="far fa-calendar"></i> {{ $item->published_at->format('d M Y') }}</span>
                            <span><i class="far fa-eye"></i> {{ number_format($item->views) }}</span>
                        </div>
                    </div>
                </article>
                @empty
                <div class="pkr-empty-state">
                    <i class="fas fa-newspaper"></i>
                    <h3>Belum Ada Berita</h3>
                    <p>Belum ada berita dalam kategori <strong>{{ $category->name }}</strong>.</p>
                    <a href="{{ route('news.index') }}" class="btn-pkr-primary">Lihat Semua Berita</a>
                </div>
                @endforelse

                <!-- Pagination -->
                @if($news->hasPages())
                <div class="pkr-pagination">
                    <nav>
                        <ul class="pkr-pag-list">
                            @if($news->onFirstPage())
                                <li class="disabled"><span><i class="fas fa-chevron-left"></i></span></li>
                            @else
                                <li><a href="{{ $news->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a></li>
                            @endif

                            @foreach($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                                <li class="{{ $page == $news->currentPage() ? 'active' : '' }}">
                                    @if($page == $news->currentPage())
                                        <span>{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    @endif
                                </li>
                            @endforeach

                            @if($news->hasMorePages())
                                <li><a href="{{ $news->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a></li>
                            @else
                                <li class="disabled"><span><i class="fas fa-chevron-right"></i></span></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="pkr-detail-sidebar">
                    <!-- Kategori Lain -->
                    <div class="pkr-sidebar-widget">
                        <div class="pkr-sw-title"><i class="fas fa-folder-open"></i> Kategori Lainnya</div>
                        <div class="pkr-sw-body pkr-sw-cats">
                            @foreach($categories as $cat)
                            <a href="{{ route('news.category', $cat->slug) }}"
                               class="pkr-sw-cat-item {{ $cat->id == $category->id ? 'pkr-sw-cat-active' : '' }}">
                                <span>{{ $cat->name }}</span>
                                <span class="pkr-sw-cat-count">{{ $cat->news_count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Follow Us -->
                    <div class="pkr-sidebar-widget">
                        <div class="pkr-sw-title"><i class="fas fa-users"></i> Ikuti Kami</div>
                        <div class="pkr-sw-body pkr-follow-grid">
                            <a href="#" class="pkr-follow-item pkr-follow-fb">
                                <i class="fab fa-facebook-f"></i>
                                <div><strong>8,045</strong><span>Pengikut</span></div>
                            </a>
                            <a href="#" class="pkr-follow-item pkr-follow-ig">
                                <i class="fab fa-instagram"></i>
                                <div><strong>5,210</strong><span>Pengikut</span></div>
                            </a>
                            <a href="#" class="pkr-follow-item pkr-follow-yt">
                                <i class="fab fa-youtube"></i>
                                <div><strong>3,100</strong><span>Subscriber</span></div>
                            </a>
                            <a href="#" class="pkr-follow-item pkr-follow-tw">
                                <i class="fab fa-twitter"></i>
                                <div><strong>2,800</strong><span>Pengikut</span></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


{{-- =====================================================
     SHARED STYLES for list pages (category, news index, search)
     Put this inside the @section('content') of each, or better:
     add to layout via @push('styles')
     ===================================================== --}}
@push('styles')
<style>
/* Page Header */
.pkr-page-header {
    background: var(--blue);
    padding: 40px 0 32px;
    position: relative;
    overflow: hidden;
}

.pkr-page-header::before {
    content: '';
    position: absolute;
    top: 0; right: 0;
    width: 300px; height: 100%;
    background: rgba(255,255,255,0.04);
    clip-path: polygon(30% 0, 100% 0, 100% 100%, 0% 100%);
}

.pkr-page-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: rgba(255,255,255,0.55);
    margin-bottom: 14px;
}

.pkr-page-breadcrumb a { color: rgba(255,255,255,0.75); }
.pkr-page-breadcrumb a:hover { color: #fff; }

.pkr-page-header h1 {
    font-family: var(--font-display);
    font-size: 32px;
    font-weight: 700;
    color: #fff;
    margin: 0 0 8px;
}

.pkr-page-header p {
    color: rgba(255,255,255,0.70);
    font-size: 15px;
    margin: 0 0 14px;
}

.pkr-page-header-meta {
    display: flex;
    gap: 18px;
    font-size: 13px;
    color: rgba(255,255,255,0.55);
}

.pkr-page-header-meta span {
    display: flex;
    align-items: center;
    gap: 6px;
}

.pkr-page-header-meta i { color: rgba(255,255,255,0.4); }

/* Accent line */
.pkr-page-header-accent {
    height: 4px;
    background: linear-gradient(90deg, var(--red) 0%, var(--blue-mid) 100%);
}

/* List Section */
.pkr-list-section { padding: 50px 0 60px; background: var(--off-white); }

/* List Item */
.pkr-list-item {
    display: flex;
    gap: 20px;
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    overflow: hidden;
    margin-bottom: 20px;
    box-shadow: var(--shadow-sm);
    transition: box-shadow .25s, transform .25s;
}

.pkr-list-item:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-3px);
}

.pkr-list-img {
    flex-shrink: 0;
    width: 220px;
    overflow: hidden;
    display: block;
}

.pkr-list-img img {
    width: 100%;
    height: 100%;
    min-height: 160px;
    object-fit: cover;
    transition: transform .4s ease;
}

.pkr-list-item:hover .pkr-list-img img { transform: scale(1.06); }

.pkr-list-body {
    padding: 20px 20px 20px 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.pkr-list-body h3 {
    font-family: var(--font-display);
    font-size: 19px;
    font-weight: 600;
    line-height: 1.4;
    color: var(--text-main);
    margin: 8px 0 10px;
    transition: color .2s;
}

.pkr-list-item:hover .pkr-list-body h3 { color: var(--red); }

.pkr-list-body p {
    font-size: 13.5px;
    color: var(--text-soft);
    line-height: 1.6;
    margin-bottom: 12px;
}

.pkr-list-meta {
    display: flex;
    gap: 16px;
    font-size: 12.5px;
    color: var(--gray-400);
}

.pkr-list-meta span { display: flex; align-items: center; gap: 5px; }
.pkr-list-meta i { color: var(--blue-mid); font-size: 11.5px; }

/* Pagination */
.pkr-pagination { margin-top: 30px; display: flex; justify-content: center; }

.pkr-pag-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 6px;
}

.pkr-pag-list li a,
.pkr-pag-list li span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-sm);
    font-size: 13.5px;
    font-weight: 600;
    color: var(--text-main);
    background: var(--white);
    transition: all .2s;
}

.pkr-pag-list li a:hover {
    background: var(--blue-light);
    border-color: var(--blue-mid);
    color: var(--blue);
}

.pkr-pag-list li.active span {
    background: var(--red);
    border-color: var(--red);
    color: #fff;
}

.pkr-pag-list li.disabled span { opacity: .4; }

/* Empty state */
.pkr-empty-state {
    text-align: center;
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    padding: 60px 30px;
}

.pkr-empty-state i {
    font-size: 56px;
    color: var(--gray-200);
    margin-bottom: 18px;
}

.pkr-empty-state h3 {
    font-size: 22px;
    font-weight: 700;
    color: var(--blue);
    margin-bottom: 10px;
}

.pkr-empty-state p {
    color: var(--text-soft);
    margin-bottom: 24px;
}

/* Active category */
.pkr-sw-cat-active {
    background: var(--blue-light) !important;
    color: var(--blue) !important;
    font-weight: 700 !important;
    border-left: 3px solid var(--red);
}

/* Follow grid */
.pkr-follow-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.pkr-follow-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border-radius: var(--radius-sm);
    color: #fff;
    transition: all .2s;
    text-decoration: none;
}

.pkr-follow-item:hover { transform: translateY(-2px); color: #fff; }

.pkr-follow-item i { font-size: 20px; }

.pkr-follow-item div { display: flex; flex-direction: column; }
.pkr-follow-item strong { font-size: 14px; font-weight: 700; }
.pkr-follow-item span { font-size: 11px; opacity: .85; }

.pkr-follow-fb { background: #1877f2; }
.pkr-follow-ig { background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
.pkr-follow-yt { background: #ff0000; }
.pkr-follow-tw { background: #1da1f2; }

/* Responsive */
@media (max-width: 768px) {
    .pkr-list-item { flex-direction: column; }
    .pkr-list-img { width: 100%; height: 200px; }
    .pkr-list-body { padding: 16px; }
    .pkr-page-header h1 { font-size: 24px; }
}
</style>
@endpush