<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
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
            'title' => $this->title,
            'image_url' => $this->image_url,
            'link' => $this->link,
            'click_url' => route('ad.click', $this->id),
            'position' => $this->position,
            'is_premium' => (bool) $this->is_premium,
            'click_count' => (int) $this->click_count,
        ];
    }
}
