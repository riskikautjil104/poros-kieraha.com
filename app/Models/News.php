<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
            
            if ($news->status == 'published' && empty($news->published_at)) {
                $news->published_at = now();
            }
        });

        static::updating(function ($news) {
            $news->slug = Str::slug($news->title);
            
            if ($news->status == 'published' && empty($news->published_at)) {
                $news->published_at = now();
            }
        });
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 🔥 TAMBAHAN BARU: Relasi many-to-many ke Tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tag')
                    ->withTimestamps();
    }

    // Scope untuk published news
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk draft news
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
    // Relasi ke Comments
public function comments()
{
    return $this->hasMany(Comment::class)->latest();
}

    // Method untuk increment views
    public function incrementViews()
    {
        $this->increment('views');
    }
}

// namespace App\Models;

// use App\Models\User;
// use App\Models\Category;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Container\Attributes\Tag;
// use Egulias\EmailValidator\Warning\Comment;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Models\Tag;  
// use App\Models\Comment;

// class News extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'user_id',
//         'category_id',
//         'title',
//         'slug',
//         'content',
//         'excerpt',
//         'image',
//         'status',
//         'published_at',
//         'views' // View counter
//     ];

//     protected $casts = [
//         'published_at' => 'datetime',
//         'views' => 'integer'
//     ];

//     // Relasi ke User (Penulis)
//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }

//     // Relasi ke Category
//     public function category()
//     {
//         return $this->belongsTo(Category::class);
//     }

//     // Relasi ke Tags
//     public function tags()
//     {
//         return $this->belongsToMany(Tag::class, 'news_tag');
//     }

//     // Relasi ke Comments
//     public function comments()
//     {
//         return $this->hasMany(Comment::class)->latest();
//     }

//     // Scope untuk berita published
//     public function scopePublished($query)
//     {
//         return $query->where('status', 'published')
//                     ->whereNotNull('published_at');
//     }

//     // Accessor untuk format tanggal
//     public function getFormattedDateAttribute()
//     {
//         return $this->published_at?->format('d M Y');
//     }

//     // Accessor untuk reading time (estimasi waktu baca)
//     public function getReadingTimeAttribute()
//     {
//         $words = str_word_count(strip_tags($this->content));
//         $minutes = ceil($words / 200); // Asumsi 200 kata/menit
//         return $minutes;
//     }
// }

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use App\Helpers\HtmlPurifier;

// class News extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'user_id',
//         'category_id',
//         'title',
//         'slug',
//         'excerpt',
//         'content',
//         'image',
//         'status',
//         'published_at'
//     ];

//     protected $casts = [
//         'published_at' => 'datetime',
//     ];

//     // Relationships
//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }

//     public function category()
//     {
//         return $this->belongsTo(Category::class);
//     }

//     // Mutator: Auto clean HTML saat set content
//     public function setContentAttribute($value)
//     {
//         $this->attributes['content'] = HtmlPurifier::clean($value);
//     }

//     // Scopes
//     public function scopePublished($query)
//     {
//         return $query->where('status', 'published');
//     }

//     public function scopeDraft($query)
//     {
//         return $query->where('status', 'draft');
//     }
// }

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Str;

// class News extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'user_id',
//         'category_id',
//         'title',
//         'slug',
//         'excerpt',
//         'content',
//         'image',
//         'status',
//         'published_at'
//     ];

//     protected $casts = [
//         'published_at' => 'datetime'
//     ];

//     // Auto generate slug
//     protected static function boot()
//     {
//         parent::boot();
        
//         static::creating(function ($news) {
//             if (empty($news->slug)) {
//                 $news->slug = Str::slug($news->title);
//             }
//         });
//     }

//     // Relationships
//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }

//     public function category()
//     {
//         return $this->belongsTo(Category::class);
//     }
// }