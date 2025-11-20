<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
//     public function index()
//     {
//         // Ambil berita terbaru yang published
//         $featuredNews = News::with(['category', 'user'])
//             ->where('status', 'published')
//             ->latest('published_at')
//             ->take(5)
//             ->get();
        
//         // Berita populer (berdasarkan views)
//         $popularNews = News::with(['category', 'user'])
//             ->where('status', 'published')
//             ->orderBy('views', 'desc')
//             ->take(5)
//             ->get();
        
//         // Semua kategori dengan jumlah berita
//         $categories = Category::withCount([
//             'news' => function($query) {
//                 $query->where('status', 'published');
//             }
//         ])->get();
        
//         return view('frontend.home', compact('featuredNews', 'popularNews', 'categories'));
//     }
// }
 /**
     * Homepage
     */
    public function index()
    {
        // Berita Featured (4 berita terbaru dengan views tertinggi)
        $featuredNews = News::published()
            ->with(['category', 'user'])
            ->orderBy('views', 'desc')
            ->limit(4)
            ->get();

        // Trending News (untuk ticker)
        $trendingNews = News::published()
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get(['id', 'title', 'slug']);

        // Sidebar News (5 berita untuk sidebar kanan)
        $sidebarNews = News::published()
            ->with('category')
            ->latest('published_at')
            ->limit(5)
            ->get();

        // Weekly Popular News (berita populer minggu ini)
        $weeklyNews = News::published()
            ->with('category')
            ->where('created_at', '>=', now()->subWeek())
            ->orderBy('views', 'desc')
            ->limit(8)
            ->get();

        // Latest News (berita terbaru)
        $latestNews = News::published()
            ->with('category')
            ->latest('published_at')
            ->limit(8)
            ->get();

        // Categories with news count
        $categories = Category::withCount([
            'news' => function($query) {
                $query->published();
            }
        ])
            ->having('news_count', '>', 0)
            ->orderBy('news_count', 'desc')
            ->get();

        // Recent Articles (untuk carousel)
        $recentArticles = News::published()
            ->with('category')
            ->latest('published_at')
            ->limit(6)
            ->get();

        return view('frontend.home', compact(
            'featuredNews',
            'trendingNews',
            'sidebarNews',
            'weeklyNews',
            'latestNews',
            'categories',
            'recentArticles'
        ));
    }

    /**
     * All News List
     */
    public function newsIndex(Request $request)
    {
        $query = News::published()->with(['category', 'user', 'tags']);

        // Search
        if ($request->has('q') && $request->q != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('content', 'like', '%' . $request->q . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->q . '%');
            });
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'oldest':
                $query->oldest('published_at');
                break;
            default:
                $query->latest('published_at');
        }

        $news = $query->paginate(12);
        $categories = Category::withCount([
            'news' => function($query) {
                $query->published();
            }
        ])->get();

        return view('frontend.news.index', compact('news', 'categories'));
    }
/**
 * News Detail
 */
public function newsShow($slug)
{
    $news = News::where('slug', $slug)
        ->where('status', 'published')
        ->with(['category', 'user', 'tags', 'comments.user'])
        ->firstOrFail();

    // Increment views
    $news->incrementViews();

    // Related News (berita serupa berdasarkan kategori)
    $relatedNews = News::published()
        ->where('category_id', $news->category_id)
        ->where('id', '!=', $news->id)
        ->limit(4)
        ->get();

    // Popular News
    $popularNews = News::published()
        ->orderBy('views', 'desc')
        ->limit(5)
        ->get();

    // Categories with count
    $categories = Category::withCount('news')
        ->having('news_count', '>', 0)
        ->orderBy('news_count', 'desc')
        ->get();

    return view('frontend.news.show', compact('news', 'relatedNews', 'popularNews', 'categories'));
}
    // /**
    //  * News Detail
    //  */
    // public function newsShow($slug)
    // {
    //     $news = News::where('slug', $slug)
    //         ->where('status', 'published')
    //         ->with(['category', 'user', 'tags'])
    //         ->firstOrFail();

    //     // Increment views
    //     $news->incrementViews();

    //     // Related News (berita serupa berdasarkan kategori)
    //     $relatedNews = News::published()
    //         ->where('category_id', $news->category_id)
    //         ->where('id', '!=', $news->id)
    //         ->limit(4)
    //         ->get();

    //     // Popular News
    //     $popularNews = News::published()
    //         ->orderBy('views', 'desc')
    //         ->limit(5)
    //         ->get();

    //     return view('frontend.news.show', compact('news', 'relatedNews', 'popularNews'));
    // }

    /**
     * News by Category
     */
    public function newsByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $news = News::published()
            ->where('category_id', $category->id)
            ->with(['user', 'tags'])
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::withCount([
            'news' => function($query) {
                $query->published();
            }
        ])->get();

        return view('frontend.news.category', compact('category', 'news', 'categories'));
    }

    /**
     * Search News
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        $news = News::published()
            ->with(['category', 'user'])
            ->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('content', 'like', '%' . $query . '%')
                  ->orWhere('excerpt', 'like', '%' . $query . '%');
            })
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::withCount([
            'news' => function($query) {
                $query->published();
            }
        ])->get();

        return view('frontend.news.search', compact('news', 'query', 'categories'));
    }
}