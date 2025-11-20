@extends('frontend.layout')

@section('title', 'Hasil Pencarian: ' . $query)

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-2">🔍 Hasil Pencarian</h1>
        <p class="text-lg opacity-90">
            @if($query)
                Menampilkan hasil untuk: <span class="font-bold">"{{ $query }}"</span>
            @else
                Semua berita
            @endif
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Advanced Search -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">🎯 Pencarian Lanjutan</h3>
                <form action="{{ route('news.search') }}" method="GET" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kata Kunci</label>
                        <input type="text" 
                               name="q" 
                               value="{{ $query }}"
                               placeholder="Cari berita..." 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded-lg hover:bg-indigo-700 transition">
                        🔍 Cari
                    </button>
                </form>
            </div>

            <!-- Results Count -->
            <div class="bg-white rounded-lg shadow-md p-4 mb-6">
                <p class="text-gray-600">
                    Ditemukan <span class="font-bold text-indigo-600">{{ $news->total() }}</span> berita
                    @if($query)
                        untuk "<span class="font-bold text-gray-900">{{ $query }}</span>"
                    @endif
                </p>
            </div>

            <!-- Results -->
            @if($news->count() > 0)
                <div class="space-y-6 mb-8">
                    @foreach($news as $item)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition group">
                            <div class="md:flex">
                                @if($item->image)
                                    <div class="md:w-48 md:flex-shrink-0">
                                        <img src="{{ Storage::url($item->image) }}" 
                                             alt="{{ $item->title }}"
                                             class="w-full h-48 md:h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @endif
                                <div class="p-6 flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs font-semibold rounded">
                                            {{ $item->category->name }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            📅 {{ $item->formatted_date }}
                                        </span>
                                    </div>
                                    
                                    <a href="{{ route('news.show', $item->slug) }}" class="group">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition">
                                            {{ $item->title }}
                                        </h3>
                                    </a>
                                    
                                    @if($item->excerpt)
                                        <p class="text-gray-600 mb-3 line-clamp-2">
                                            {{ $item->excerpt }}
                                        </p>
                                    @endif
                                    
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center space-x-3">
                                            <span>👤 {{ $item->user->name }}</span>
                                            <span>👁️ {{ number_format($item->views) }} views</span>
                                        </div>
                                        <a href="{{ route('news.show', $item->slug) }}" 
                                           class="text-indigo-600 hover:text-indigo-800 font-medium">
                                            Baca Selengkapnya →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    {{ $news->appends(['q' => $query, 'category' => $categoryId])->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <div class="text-6xl mb-4">🔍</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak Ada Hasil</h3>
                    <p class="text-gray-600 mb-6">
                        Maaf, kami tidak menemukan berita yang sesuai dengan pencarian Anda.
                    </p>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p>💡 Tips pencarian:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Periksa ejaan kata kunci</li>
                            <li>Gunakan kata kunci yang lebih umum</li>
                            <li>Coba cari di kategori lain</li>
                        </ul>
                    </div>
                    <a href="{{ route('news.index') }}" class="inline-block mt-6 px-6 py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition">
                        Lihat Semua Berita
                    </a>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Quick Search -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">🔍 Cari Cepat</h3>
                <form action="{{ route('news.search') }}" method="GET">
                    <input type="text" 
                           name="q" 
                           placeholder="Ketik kata kunci..." 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 mb-2">
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded-lg hover:bg-indigo-700 transition">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Categories -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">📂 Cari Berdasarkan Kategori</h3>
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

            <!-- Popular Keywords -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">🔥 Kata Kunci Populer</h3>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('news.search', ['q' => 'trending']) }}" 
                       class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-indigo-600 hover:text-white transition">
                        #trending
                    </a>
                    <a href="{{ route('news.search', ['q' => 'terkini']) }}" 
                       class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-indigo-600 hover:text-white transition">
                        #terkini
                    </a>
                    <a href="{{ route('news.search', ['q' => 'viral']) }}" 
                       class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-indigo-600 hover:text-white transition">
                        #viral
                    </a>
                    <a href="{{ route('news.search', ['q' => 'breaking']) }}" 
                       class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-indigo-600 hover:text-white transition">
                        #breaking
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection