<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsResource extends JsonResource
{
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

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt ?: Str::limit(strip_tags($this->content), 120),
            'image_url' => $imageUrl,
            'views' => (int) $this->views,
            'status' => $this->status,
            'published_at' => $this->published_at ? $this->published_at->toIso8601String() : $this->created_at->toIso8601String(),
            'formatted_date' => $this->published_at ? $this->published_at->translatedFormat('d F Y') : $this->created_at->translatedFormat('d F Y'),
            'category' => $this->whenLoaded('category', function () {
                return [
                    'id' => $this->category->id,
                    'name' => $this->category->name,
                    'slug' => $this->category->slug,
                ];
            }),
            'author' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'avatar_url' => $this->user->avatar_url,
                ];
            }),
            'web_url' => route('news.show', $this->slug),
        ];
    }
}
