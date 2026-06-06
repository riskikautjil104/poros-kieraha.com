<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\SiteVisit;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Basic Stats
        $totalNews = News::count();
        $publishedNews = News::published()->count();
        $draftNews = News::draft()->count();
        $totalUsers = User::count();
        $totalCategories = Category::count();
        $totalTags = Tag::count();
        $totalViews = News::sum('views');

        // Role-based stats for writers
        if ($user->isPenulis()) {
            $totalNews = News::where('user_id', $user->id)->count();
            $publishedNews = News::where('user_id', $user->id)->published()->count();
            $draftNews = News::where('user_id', $user->id)->draft()->count();
            $totalViews = News::where('user_id', $user->id)->sum('views');
        }

        // 📊 ANALYTICS DATA

        // 1. News by Status (untuk pie chart)
        $newsByStatus = [
            'published' => $publishedNews,
            'draft' => $draftNews,
        ];

        // 2. Top 5 Most Viewed News
        $topNewsQuery = News::published()->orderBy('views', 'desc');
        if (auth()->user()->isPenulis()) {
            $topNewsQuery->where('user_id', auth()->id());
        }
        $topNews = $topNewsQuery->limit(5)->get(['id', 'title', 'views', 'published_at']);

        // 3. Recent News (Latest 10)
        $recentNewsQuery = News::with(['category', 'user'])->latest();
        if ($user->isPenulis()) {
            $recentNewsQuery->where('user_id', $user->id);
        }
        $recentNews = $recentNewsQuery->limit(10)->get();

        // 4. News by Category (untuk bar chart)
        $newsByCategory = Category::withCount('news')
            ->having('news_count', '>', 0)
            ->orderBy('news_count', 'desc')
            ->limit(10)
            ->get(['name', 'news_count']);

        // 5. Top 10 Tags (Most Used)
        $topTags = Tag::withCount('news')
            ->having('news_count', '>', 0)
            ->orderBy('news_count', 'desc')
            ->limit(10)
            ->get(['name', 'news_count']);

        // 6. News per Month (Last 6 Months) - untuk line chart
        $newsPerMonthQuery = News::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(6));
        if ($user->isPenulis()) {
            $newsPerMonthQuery->where('user_id', $user->id);
        }
        $newsPerMonth = $newsPerMonthQuery->groupBy('month')->orderBy('month', 'asc')->get();

        // 7. Top 5 Most Active Writers
        $topWriters = User::withCount('news')
            ->having('news_count', '>', 0)
            ->orderBy('news_count', 'desc')
            ->limit(5)
            ->get(['id', 'name', 'news_count']);

        // 8. Stats Comparison (This Month vs Last Month)
        $thisMonthQuery = News::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
        $lastMonthQuery = News::whereMonth('created_at', now()->subMonth()->month)->whereYear('created_at', now()->subMonth()->year);
        if ($user->isPenulis()) {
            $thisMonthQuery->where('user_id', $user->id);
            $lastMonthQuery->where('user_id', $user->id);
        }
        $thisMonth = $thisMonthQuery->count();
        $lastMonth = $lastMonthQuery->count();

        $monthlyGrowth = $lastMonth > 0
            ? round((($thisMonth - $lastMonth) / $lastMonth) * 100, 1)
            : 0;

        // Recent Comments
        $commentsQuery = \App\Models\Comment::with(['user', 'news'])->latest();
        if ($user->isPenulis()) {
            $commentsQuery->whereHas('news', function($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }
        $recentComments = $commentsQuery->limit(10)->get();

        // Visitor Statistics
        $visitorToday   = SiteVisit::countToday();
        $visitorWeek    = SiteVisit::countWeek();
        $visitorMonth   = SiteVisit::countMonth();
        $visitorYear    = SiteVisit::countYear();
        $visitorTotal   = SiteVisit::countTotal();
        $visitorChart   = SiteVisit::dailyLast30Days();

        return view('admin.dashboard', compact(
            // Basic stats
            'totalNews',
            'publishedNews',
            'draftNews',
            'totalUsers',
            'totalCategories',
            'totalTags',
            'totalViews',

            // Analytics data
            'newsByStatus',
            'topNews',
            'recentNews',
            'newsByCategory',
            'topTags',
            'newsPerMonth',
            'topWriters',
            'thisMonth',
            'lastMonth',
            'monthlyGrowth',
            'recentComments',

            // Visitor stats
            'visitorToday',
            'visitorWeek',
            'visitorMonth',
            'visitorYear',
            'visitorTotal',
            'visitorChart'
        ));
    }
}