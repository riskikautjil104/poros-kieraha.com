@extends('frontend.layout')

@section('title', 'Hasil Pencarian: ' . $query)

@section('content')

<!-- Search Header -->
<div class="search-header-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="search-header-content">
                    <h1><i class="fas fa-search"></i> Hasil Pencarian</h1>
                    @if($query)
                        <p>Menampilkan hasil untuk: <strong>"{{ $query }}"</strong></p>
                    @else
                        <p>Semua berita</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Results Area -->
<section class="search-results-area pt-50 pb-50">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Advanced Search Box -->
                <div class="advanced-search-box mb-30">
                    <h3 class="search-box-title"><i class="fas fa-filter"></i> Pencarian Lanjutan</h3>
                    <form action="{{ route('news.search') }}" method="GET">
                        <div class="row">
                            <div class="col-md-7 mb-3">
                                <input type="text" 
                                       name="q" 
                                       value="{{ $query }}"
                                       placeholder="Masukkan kata kunci..." 
                                       class="search-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <select name="category" class="search-select">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <button type="submit" class="search-btn">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Results Count -->
                <div class="results-count mb-30">
                    <p>
                        <i class="fas fa-check-circle"></i> 
                        Ditemukan <strong>{{ $news->total() }}</strong> berita
                        @if($query)
                            untuk "<strong>{{ $query }}</strong>"
                        @endif
                    </p>
                </div>

                <!-- Results List -->
                @if($news->count() > 0)
                    <div class="search-results-list">
                        @foreach($news as $item)
                            <article class="search-result-item mb-30">
                                <div class="row">
                                    @if($item->image)
                                        <div class="col-md-4">
                                            <div class="result-img">
                                                <a href="{{ route('news.show', $item->slug) }}">
                                                    <img src="{{ Storage::url($item->image) }}" 
                                                         alt="{{ $item->title }}">
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-{{ $item->image ? '8' : '12' }}">
                                        <div class="result-content">
                                            <div class="result-meta mb-2">
                                                <span class="category-badge">{{ $item->category->name }}</span>
                                                <span class="date-badge">
                                                    <i class="far fa-calendar"></i> {{ $item->formatted_date }}
                                                </span>
                                            </div>
                                            
                                            <h3 class="result-title">
                                                <a href="{{ route('news.show', $item->slug) }}">
                                                    {{ $item->title }}
                                                </a>
                                            </h3>
                                            
                                            @if($item->excerpt)
                                                <p class="result-excerpt">
                                                    {{ Str::limit($item->excerpt, 150) }}
                                                </p>
                                            @endif
                                            
                                            <div class="result-footer">
                                                <span class="author">
                                                    <i class="far fa-user"></i> {{ $item->user->name }}
                                                </span>
                                                <span class="views">
                                                    <i class="far fa-eye"></i> {{ number_format($item->views) }}
                                                </span>
                                                <a href="{{ route('news.show', $item->slug) }}" class="read-more">
                                                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $news->appends(['q' => $query, 'category' => $categoryId])->links() }}
                    </div>
                @else
                    <!-- No Results -->
                    <div class="no-results">
                        <div class="no-results-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>Tidak Ada Hasil Ditemukan</h3>
                        <p>Maaf, kami tidak menemukan berita yang sesuai dengan pencarian Anda.</p>
                        
                        <div class="search-tips">
                            <h4><i class="fas fa-lightbulb"></i> Tips Pencarian:</h4>
                            <ul>
                                <li>Periksa ejaan kata kunci</li>
                                <li>Gunakan kata kunci yang lebih umum</li>
                                <li>Coba cari dengan kategori berbeda</li>
                            </ul>
                        </div>
                        
                        <a href="{{ route('news.index') }}" class="btn-back-home">
                            <i class="fas fa-home"></i> Lihat Semua Berita
                        </a>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Search -->
                <div class="sidebar-widget mb-30">
                    <h3 class="widget-title"><i class="fas fa-search"></i> Cari Cepat</h3>
                    <div class="widget-content">
                        <form action="{{ route('news.search') }}" method="GET" class="quick-search-form">
                            <div class="input-group">
                                <input type="text" 
                                       name="q" 
                                       placeholder="Ketik kata kunci..." 
                                       value="{{ request('q') }}"
                                       class="form-control">
                                <button type="submit" class="btn-search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="sidebar-widget mb-30">
                    <h3 class="widget-title"><i class="fas fa-folder"></i> Kategori</h3>
                    <div class="widget-content">
                        <ul class="category-list">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('news.category', $category->slug) }}">
                                        {{ $category->name }}
                                        <span class="count">{{ $category->news_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Popular Tags -->
                <div class="sidebar-widget">
                    <h3 class="widget-title"><i class="fas fa-tags"></i> Kata Kunci Populer</h3>
                    <div class="widget-content">
                        <div class="tags-cloud">
                            <a href="{{ route('news.search', ['q' => 'trending']) }}" class="tag">#trending</a>
                            <a href="{{ route('news.search', ['q' => 'terkini']) }}" class="tag">#terkini</a>
                            <a href="{{ route('news.search', ['q' => 'viral']) }}" class="tag">#viral</a>
                            <a href="{{ route('news.search', ['q' => 'breaking']) }}" class="tag">#breaking</a>
                            <a href="{{ route('news.search', ['q' => 'populer']) }}" class="tag">#populer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
/* Search Header */
.search-header-area {
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    padding: 40px 0;
    margin-bottom: 50px;
}

.search-header-content {
    text-align: center;
    color: #fff;
}

.search-header-content h1 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 10px;
}

.search-header-content h1 i {
    margin-right: 10px;
}

.search-header-content p {
    font-size: 16px;
    opacity: 0.9;
}

/* Advanced Search Box */
.advanced-search-box {
    background: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

.search-box-title {
    font-size: 18px;
    font-weight: 700;
    color: #2c234d;
    margin-bottom: 20px;
}

.search-box-title i {
    color: #ff0844;
    margin-right: 8px;
}

.search-input,
.search-select {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e0e0e0;
    border-radius: 5px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.search-input:focus,
.search-select:focus {
    border-color: #ff0844;
    outline: none;
}

.search-btn {
    width: 100%;
    padding: 12px 20px;
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    color: #fff;
    border: none;
    border-radius: 5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 8, 68, 0.4);
}

/* Results Count */
.results-count {
    background: #fff5f7;
    padding: 15px 20px;
    border-radius: 5px;
    border-left: 4px solid #ff0844;
}

.results-count p {
    margin: 0;
    color: #555;
    font-size: 15px;
}

.results-count i {
    color: #ff0844;
    margin-right: 5px;
}

.results-count strong {
    color: #ff0844;
    font-weight: 700;
}

/* Search Result Item */
.search-result-item {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.search-result-item:hover {
    box-shadow: 0 5px 25px rgba(255, 8, 68, 0.15);
    transform: translateY(-3px);
}

.result-img {
    overflow: hidden;
    border-radius: 5px;
    height: 200px;
}

.result-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.search-result-item:hover .result-img img {
    transform: scale(1.05);
}

.result-content {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.result-meta {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.category-badge {
    display: inline-block;
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    color: #fff;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}

.date-badge {
    color: #999;
    font-size: 13px;
}

.result-title {
    font-size: 20px;
    font-weight: 700;
    margin: 10px 0;
    line-height: 1.4;
}

.result-title a {
    color: #2c234d;
    transition: color 0.3s ease;
}

.result-title a:hover {
    color: #ff0844;
}

.result-excerpt {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 15px;
}

.result-footer {
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid #f0f0f0;
    font-size: 13px;
    color: #999;
}

.result-footer i {
    margin-right: 5px;
    color: #ff0844;
}

.read-more {
    color: #ff0844;
    font-weight: 600;
    margin-left: auto;
    transition: all 0.3s ease;
}

.read-more:hover {
    color: #ff3366;
}

/* No Results */
.no-results {
    background: #fff;
    padding: 60px 30px;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    text-align: center;
}

.no-results-icon {
    font-size: 80px;
    color: #ffd1dc;
    margin-bottom: 20px;
}

.no-results h3 {
    font-size: 24px;
    font-weight: 700;
    color: #2c234d;
    margin-bottom: 10px;
}

.no-results > p {
    color: #666;
    margin-bottom: 30px;
}

.search-tips {
    background: #fff5f7;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 30px;
    text-align: left;
    display: inline-block;
    border-left: 3px solid #ff0844;
}

.search-tips h4 {
    font-size: 16px;
    font-weight: 600;
    color: #ff0844;
    margin-bottom: 15px;
}

.search-tips h4 i {
    margin-right: 8px;
}

.search-tips ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.search-tips li {
    padding: 5px 0;
    color: #666;
}

.search-tips li:before {
    content: "✓";
    color: #ff0844;
    font-weight: bold;
    margin-right: 10px;
}

.btn-back-home {
    display: inline-block;
    padding: 12px 30px;
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    color: #fff;
    border-radius: 5px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-back-home:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 8, 68, 0.4);
    color: #fff;
}

/* Sidebar Widgets */
.sidebar-widget {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

.widget-title {
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    color: #fff;
    padding: 15px 20px;
    font-size: 16px;
    font-weight: 700;
    margin: 0;
}

.widget-title i {
    margin-right: 8px;
}

.widget-content {
    padding: 20px;
}

/* Quick Search Form */
.quick-search-form .input-group {
    display: flex;
}

.quick-search-form .form-control {
    flex: 1;
    padding: 12px 15px;
    border: 2px solid #e0e0e0;
    border-right: none;
    border-radius: 5px 0 0 5px;
    font-size: 14px;
}

.quick-search-form .form-control:focus {
    border-color: #ff0844;
    outline: none;
}

.quick-search-form .btn-search {
    padding: 12px 20px;
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    color: #fff;
    border: none;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    transition: all 0.3s ease;
}

.quick-search-form .btn-search:hover {
    background: linear-gradient(135deg, #ff3366 0%, #ff0844 100%);
}

/* Category List */
.category-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.category-list li {
    border-bottom: 1px solid #f0f0f0;
}

.category-list li:last-child {
    border-bottom: none;
}

.category-list a {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    color: #555;
    transition: all 0.3s ease;
}

.category-list a:hover {
    color: #ff0844;
    padding-left: 5px;
}

.category-list .count {
    background: #fff5f7;
    color: #ff0844;
    padding: 2px 10px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.category-list a:hover .count {
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    color: #fff;
}

/* Tags Cloud */
.tags-cloud {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.tags-cloud .tag {
    display: inline-block;
    padding: 6px 15px;
    background: #fff5f7;
    color: #ff0844;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 1px solid #ffd1dc;
}

.tags-cloud .tag:hover {
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 8, 68, 0.3);
}

/* Pagination */
.pagination-wrapper {
    margin-top: 30px;
    display: flex;
    justify-content: center;
}

.pagination-wrapper .pagination {
    display: flex;
    gap: 5px;
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(135deg, #ff0844 0%, #ff3366 100%);
    border-color: #ff0844;
    color: #fff;
}

.pagination-wrapper .page-link {
    color: #ff0844;
    border: 1px solid #ffd1dc;
}

.pagination-wrapper .page-link:hover {
    background: #fff5f7;
    border-color: #ff0844;
    color: #ff0844;
}

/* Responsive */
@media (max-width: 768px) {
    .search-header-content h1 {
        font-size: 24px;
    }
    
    .result-img {
        height: 180px;
        margin-bottom: 15px;
    }
    
    .result-title {
        font-size: 18px;
    }
    
    .result-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .read-more {
        margin-left: 0;
    }
    
    .search-tips {
        width: 100%;
    }
}
</style>

@endsection