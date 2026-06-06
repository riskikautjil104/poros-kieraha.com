<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
        'image',
        'position',
        'is_active',
        'is_premium',
        'sort_order',
        'click_count'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_premium' => 'boolean',
        'sort_order' => 'integer',
        'click_count' => 'integer'
    ];

    /**
     * Scope for ordering ads
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    /**
     * Scope for active ads
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for sidebar position
     */
    public function scopeSidebar($query)
    {
        return $query->where('position', 'sidebar');
    }

    /**
     * Scope for content position
     */
    public function scopeContent($query)
    {
        return $query->where('position', 'content');
    }

    /**
     * Scope for footer position
     */
    public function scopeFooter($query)
    {
        return $query->where('position', 'footer');
    }

    /**
     * Scope for premium popup ads
     */
    public function scopePremium($query)
    {
        return $query->where('is_premium', true);
    }

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('assets/img/news/news_card.jpg'); // default image
        }

        return asset('assets/img/ads/' . $this->image);
    }

    /**
     * Increment click count
     */
    public function incrementClick()
    {
        $this->increment('click_count');
    }
}
