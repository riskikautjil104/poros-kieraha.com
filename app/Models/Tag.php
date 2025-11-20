<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * 🔥 TAMBAH INI: Boot method untuk auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        // Auto create slug saat create tag baru
        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });

        // Auto update slug saat update nama tag
        static::updating(function ($tag) {
            $tag->slug = Str::slug($tag->name);
        });
    }

    /**
     * Relasi ke News (Many to Many)
     */
    public function news()
    {
        return $this->belongsToMany(News::class, 'news_tag')
                    ->withTimestamps(); // 🔥 TAMBAH INI: biar ada created_at/updated_at di pivot table
    }

    /**
     * 🔥 TAMBAH INI: Accessor untuk count jumlah berita
     * Bisa dipake: $tag->news_count
     */
    public function getNewsCountAttribute()
    {
        return $this->news()->count();
    }

    /**
     * 🔥 TAMBAH INI: Scope untuk tag populer (berdasarkan jumlah berita)
     * Cara pakai: Tag::popular()->get();
     */
    public function scopePopular($query, $limit = 10)
    {
        return $query->withCount('news')
                    ->orderBy('news_count', 'desc')
                    ->limit($limit);
    }
}