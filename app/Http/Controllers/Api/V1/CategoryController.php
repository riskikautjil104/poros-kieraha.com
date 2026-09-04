<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\CategoryResource;
use App\Http\Resources\Api\V1\NewsResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends BaseApiController
{
    /**
     * Display a listing of all categories with active news count.
     */
    public function index(): JsonResponse
    {
        $categories = Category::withCount([
            'news' => function ($query) {
                $query->published();
            }
        ])
            ->orderBy('name', 'asc')
            ->get();

        return $this->sendResponse(CategoryResource::collection($categories), 'Daftar kategori berhasil diambil');
    }

    /**
     * Display specific category and its paginated news.
     */
    public function show(Request $request, string $slug): JsonResponse
    {
        $category = Category::where('slug', $slug)
            ->withCount([
                'news' => function ($query) {
                    $query->published();
                }
            ])
            ->first();

        if (!$category) {
            return $this->sendError('Kategori tidak ditemukan', 404);
        }

        $limit = min(max((int) $request->input('limit', 10), 1), 50);

        $news = $category->news()
            ->published()
            ->with(['category', 'user'])
            ->latest('published_at')
            ->paginate($limit);

        return response()->json([
            'success' => true,
            'message' => "Daftar berita kategori {$category->name} berhasil diambil",
            'category' => new CategoryResource($category),
            'data' => NewsResource::collection($news->items()),
            'pagination' => [
                'current_page' => $news->currentPage(),
                'last_page'    => $news->lastPage(),
                'per_page'     => $news->perPage(),
                'total'        => $news->total(),
                'has_more'     => $news->hasMorePages(),
            ],
        ]);
    }
}
