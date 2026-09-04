<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\AdResource;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Http\Resources\Api\V1\NewsResource;
use App\Models\Ad;
use App\Models\Category;
use App\Models\News;
use App\Models\Partner;
use App\Models\YoutubeVideo;
use Illuminate\Http\JsonResponse;

class HomeController extends BaseApiController
{
    /**
     * Get all-in-one home feed for mobile application.
     */
    public function index(): JsonResponse
    {
        // 1. Trending / Ticker News
        $tickers = News::published()
            ->latest('published_at')
            ->limit(5)
            ->get(['id', 'title', 'slug']);

        // 2. Featured News (4 top viewed published news)
        $featuredNews = News::published()
            ->with(['category', 'user'])
            ->orderBy('views', 'desc')
            ->limit(4)
            ->get();

        // 3. Weekly Popular News (past 7 days, top views)
        $weeklyPopular = News::published()
            ->with(['category', 'user'])
            ->where('created_at', '>=', now()->subWeek())
            ->orderBy('views', 'desc')
            ->limit(8)
            ->get();

        // If weekly popular has less than 4, fallback to all-time top views
        if ($weeklyPopular->count() < 4) {
            $weeklyPopular = News::published()
                ->with(['category', 'user'])
                ->orderBy('views', 'desc')
                ->limit(8)
                ->get();
        }

        // 4. Latest News
        $latestNews = News::published()
            ->with(['category', 'user'])
            ->latest('published_at')
            ->limit(8)
            ->get();

        // 5. Active Categories with News Count
        $categories = Category::withCount([
            'news' => function ($query) {
                $query->published();
            }
        ])
            ->having('news_count', '>', 0)
            ->orderBy('news_count', 'desc')
            ->get();

        // 6. YouTube Videos
        $videos = YoutubeVideo::active()
            ->ordered()
            ->limit(6)
            ->get()
            ->map(function ($video) {
                return [
                    'id' => $video->id,
                    'title' => $video->title,
                    'youtube_url' => $video->youtube_url,
                    'embed_url' => $video->embed_url,
                    'description' => $video->description,
                    'thumbnail' => $video->thumbnail ? asset('storage/' . $video->thumbnail) : null,
                ];
            });

        // 7. Partners
        $partners = Partner::active()
            ->orderBy('sort_order')
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'category' => $p->category,
                    'image_url' => $p->image_url,
                    'link' => $p->link,
                ];
            });

        // 8. Ads grouped by position
        $premiumPopupAd = Ad::active()->premium()->ordered()->first();
        $contentAds     = Ad::active()->content()->ordered()->get();
        $sidebarAds     = Ad::active()->sidebar()->ordered()->get();
        $footerAds      = Ad::active()->footer()->ordered()->get();

        $data = [
            'tickers' => $tickers,
            'featured_news' => NewsResource::collection($featuredNews),
            'weekly_popular' => NewsResource::collection($weeklyPopular),
            'latest_news' => NewsResource::collection($latestNews),
            'categories' => CategoryResource::collection($categories),
            'videos' => $videos,
            'partners' => $partners,
            'ads' => [
                'popup' => $premiumPopupAd ? new AdResource($premiumPopupAd) : null,
                'content' => AdResource::collection($contentAds),
                'sidebar' => AdResource::collection($sidebarAds),
                'footer' => AdResource::collection($footerAds),
            ],
        ];

        return $this->sendResponse($data, 'Data beranda berhasil dimuat');
    }
}
