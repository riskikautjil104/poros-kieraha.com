<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsPublicController extends Controller
{
    // List semua berita
    public function index()
    {
        $news = News::with(['category', 'user'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::withCount(['news' => function($query) {
            $query->where('status', 'published');
        }])->get();

        return view('frontend.news.index', compact('news', 'categories'));
    }
    
    // Detail berita + view counter
    // public function show(News $news)
    // {
    //     // Hanya tampilkan berita yang published
    //     if ($news->status !== 'published') {
    //         abort(404);
    //     }
        
    //     // Increment view counter
    //     $news->increment('views');
        
    //     // Load relasi
    //     $news->load(['category', 'user', 'tags', 'comments.user']);
        
    //     // Berita terkait (kategori sama)
    //     $relatedNews = News::where('category_id', $news->category_id)
    //         ->where('id', '!=', $news->id)
    //         ->where('status', 'published')
    //         ->latest('published_at')
    //         ->take(4)
    //         ->get();
        
    //     return view('frontend.news.show', compact('news', 'relatedNews'));
    // }
    public function show(News $news)
{
    // Hanya tampilkan berita yang published
    if ($news->status !== 'published') {
        abort(404);
    }
    
    // Increment view counter
    $news->incrementViews();
    
    // Load relasi
    $news->load(['category', 'user', 'tags', 'comments.user']);
    
    // Berita terkait (kategori sama)
    $relatedNews = News::with(['category', 'user'])
        ->where('category_id', $news->category_id)
        ->where('id', '!=', $news->id)
        ->where('status', 'published')
        ->latest('published_at')
        ->take(4)
        ->get();

    // Popular News (TAMBAHKAN INI)
    $popularNews = News::with(['category', 'user'])
        ->where('status', 'published')
        ->orderBy('views', 'desc')
        ->take(5)
        ->get();
    
    // Categories with count (TAMBAHKAN INI)
    $categories = Category::withCount(['news' => function($query) {
            $query->where('status', 'published');
        }])
        ->having('news_count', '>', 0)
        ->orderBy('news_count', 'desc')
        ->get();
    
    return view('frontend.news.show', compact('news', 'relatedNews', 'popularNews', 'categories'));
}
    
    // Berita by kategori
    public function category(Category $category)
    {
        $news = News::with(['category', 'user'])
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::withCount(['news' => function($query) {
            $query->where('status', 'published');
        }])->get();

        return view('frontend.news.category', compact('news', 'category', 'categories'));
    }
    
    // Search berita
    public function search(Request $request)
    {
        $query = $request->input('q');
        $categoryId = $request->input('category');
        
        $news = News::with(['category', 'user'])
            ->where('status', 'published')
            ->when($query, function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->when($categoryId, function($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->latest('published_at')
            ->paginate(12);
        
        $categories = Category::withCount('news')->get();
        
        return view('frontend.news.search', compact('news', 'categories', 'query', 'categoryId'));
    }
    
    // Store comment
    public function storeComment(Request $request, News $news)
    {
        $request->validate([
            'content' => 'required|min:3|max:1000'
        ]);

        Comment::create([
            'news_id' => $news->id,
            'user_id' => auth()->id(),
            'content' => $request->input('content')
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan! 💬');
    }
}