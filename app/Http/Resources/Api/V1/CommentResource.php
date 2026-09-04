<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'created_at' => $this->created_at->toIso8601String(),
            'formatted_date' => $this->created_at->translatedFormat('d F Y, H:i'),
            'user' => [
                'id' => $this->user?->id,
                'name' => $this->user?->name ?? 'Anonim',
                'avatar_url' => $this->user?->avatar_url,
            ],
        ];
    }
}
