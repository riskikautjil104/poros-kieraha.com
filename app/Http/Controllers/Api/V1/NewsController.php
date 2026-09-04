<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\NewsDetailResource;
use App\Http\Resources\Api\V1\NewsResource;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends BaseApiController
{
    /**
     * Display a listing of published news articles with pagination & filters.
     */
    public function index(Request $request): JsonResponse
    {
        $query = News::published()->with(['category', 'user']);

        // Filter by Category slug
        if ($request->filled('category')) {
            $categorySlug = $request->input('category');
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Filter by Tag slug
        if ($request->filled('tag')) {
            $tagSlug = $request->input('tag');
            $query->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        }

        // Search Keyword
        if ($request->filled('q')) {
            $keyword = $request->input('q');
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('excerpt', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        // Sorting
        $sort = $request->input('sort', 'latest');
        if ($sort === 'popular') {
            $query->orderBy('views', 'desc')->latest('published_at');
        } elseif ($sort === 'oldest') {
            $query->oldest('published_at');
        } else {
            $query->latest('published_at');
        }

        // Pagination limit
        $limit = min(max((int) $request->input('limit', 10), 1), 50);
        $paginated = $query->paginate($limit);

        return $this->sendPaginatedResponse($paginated, NewsResource::class, 'Daftar berita berhasil diambil');
    }

    /**
     * Display the specified news article.
     */
    public function show(string $slug): JsonResponse
    {
        $news = News::published()
            ->with(['category', 'user', 'tags'])
            ->where('slug', $slug)
            ->first();

        if (!$news) {
            return $this->sendError('Berita tidak ditemukan', 404);
        }

        // Increment views count silently
        $news->incrementViews();

        // Fetch related news (same category, excluding current)
        $relatedNews = News::published()
            ->with(['category', 'user'])
            ->where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->latest('published_at')
            ->limit(4)
            ->get();

        // Previous & Next News
        $prevNews = News::published()
            ->where('id', '<', $news->id)
            ->orderBy('id', 'desc')
            ->first(['id', 'title', 'slug']);

        $nextNews = News::published()
            ->where('id', '>', $news->id)
            ->orderBy('id', 'asc')
            ->first(['id', 'title', 'slug']);

        $resource = (new NewsDetailResource($news))->withExtra([
            'related_news' => NewsResource::collection($relatedNews),
            'prev_news' => $prevNews ? ['title' => $prevNews->title, 'slug' => $prevNews->slug] : null,
            'next_news' => $nextNews ? ['title' => $nextNews->title, 'slug' => $nextNews->slug] : null,
        ]);

        return $this->sendResponse($resource, 'Detail berita berhasil diambil');
    }
}
