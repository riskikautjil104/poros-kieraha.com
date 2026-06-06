<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{
    protected $fillable = [
        'title',
        'youtube_url',
        'description',
        'thumbnail',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    /**
     * Embed URL for YouTube iframe.
     * Supports:
     * - https://www.youtube.com/watch?v=VIDEO_ID
     * - https://youtu.be/VIDEO_ID
     * - https://www.youtube.com/embed/VIDEO_ID
     * - watch?v=VIDEO_ID (no scheme/domain)
     */
    public function getEmbedUrlAttribute()
    {
        $url = trim((string) $this->youtube_url);
        if ($url === '') {
            return null;
        }

        // If user provides watch?v=... without scheme/domain
        if (!preg_match('#^https?://#i', $url)) {
            $url = 'https://www.youtube.com/' . ltrim($url, '/');
        }

        $parts = parse_url($url);
        $path = $parts['path'] ?? '';
        $query = $parts['query'] ?? '';

        // watch?v=VIDEO_ID
        if (isset($query)) {
            parse_str($query, $qs);
            if (!empty($qs['v'])) {
                return 'https://www.youtube.com/embed/' . $qs['v'];
            }
        }

        // youtu.be/VIDEO_ID
        if (preg_match('#^/([A-Za-z0-9_-]{6,})$#', $path, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // youtube.com/embed/VIDEO_ID
        if (preg_match('#/embed/([A-Za-z0-9_-]{6,})#', $path, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        return null;
    }
}

