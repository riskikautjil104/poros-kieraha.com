<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\CommentResource;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends BaseApiController
{
    /**
     * Get paginated comments for a news article.
     */
    public function index(Request $request, string $slug): JsonResponse
    {
        $news = News::published()->where('slug', $slug)->first();

        if (!$news) {
            return $this->sendError('Berita tidak ditemukan', 404);
        }

        $limit = min(max((int) $request->input('limit', 15), 1), 50);

        $comments = $news->comments()
            ->with('user')
            ->where('is_approved', true)
            ->latest()
            ->paginate($limit);

        return $this->sendPaginatedResponse($comments, CommentResource::class, 'Daftar komentar berhasil diambil');
    }

    /**
     * Store a comment on a news article.
     */
    public function store(Request $request, string $slug): JsonResponse
    {
        $news = News::published()->where('slug', $slug)->first();

        if (!$news) {
            return $this->sendError('Berita tidak ditemukan', 404);
        }

        $validator = Validator::make($request->all(), [
            'content' => 'required|string|min:3|max:1000',
            'user_id' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi komentar gagal', 422, $validator->errors()->toArray());
        }

        // Determine user (from Bearer token, session, or explicit user_id)
        $user = $this->getAuthenticatedUser($request);
        $userId = $user?->id;

        if (!$userId) {
            return $this->sendError('Harap login terlebih dahulu untuk mengirim komentar', 401);
        }

        $comment = Comment::create([
            'news_id'     => $news->id,
            'user_id'     => $userId,
            'content'     => $request->input('content'),
            'is_approved' => true,
        ]);

        $comment->load('user');

        return $this->sendResponse(new CommentResource($comment), 'Komentar berhasil dikirim! 💬', 201);
    }
}
