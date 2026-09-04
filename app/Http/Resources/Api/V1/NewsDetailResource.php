<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsDetailResource extends JsonResource
{
    /**
     * Additional data to be injected by controller
     */
    protected $extra = [];

    public function withExtra(array $extra): self
    {
        $this->extra = $extra;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $imageUrl = asset('assets/img/logo/poros fix.PNG');
        if ($this->image) {
            $imageUrl = Str::startsWith($this->image, ['http://', 'https://'])
                ? $this->image
                : url(Storage::url($this->image));
        }

        $webUrl = route('news.show', $this->slug);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt ?: Str::limit(strip_tags($this->content), 150),
            'content' => $this->content,
            'image_url' => $imageUrl,
            'views' => (int) $this->views,
            'status' => $this->status,
            'published_at' => $this->published_at ? $this->published_at->toIso8601String() : $this->created_at->toIso8601String(),
            'formatted_date' => $this->published_at ? $this->published_at->translatedFormat('d F Y, H:i') : $this->created_at->translatedFormat('d F Y, H:i'),
            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
                'slug' => $this->category?->slug,
            ],
            'author' => [
                'id' => $this->user?->id,
                'name' => $this->user?->name,
                'bio' => $this->user?->bio ?? 'Penulis di Poros Kie Raha',
                'avatar_url' => $this->user?->avatar_url,
            ],
            'tags' => $this->tags->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                    'slug' => $tag->slug,
                ];
            }),
            'comments_count' => $this->comments()->count(),
            'web_url' => $webUrl,
            'share_links' => [
                'whatsapp' => 'https://wa.me/?text=' . urlencode($this->title . ' ' . $webUrl),
                'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($webUrl),
                'twitter' => 'https://twitter.com/intent/tweet?url=' . urlencode($webUrl) . '&text=' . urlencode($this->title),
                'telegram' => 'https://t.me/share/url?url=' . urlencode($webUrl) . '&text=' . urlencode($this->title),
            ],
            'prev_news' => $this->extra['prev_news'] ?? null,
            'next_news' => $this->extra['next_news'] ?? null,
            'related_news' => $this->extra['related_news'] ?? [],
        ];
    }
}
