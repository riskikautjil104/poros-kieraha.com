<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SiteVisit extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'visited_date',
    ];

    protected $casts = [
        'visited_date' => 'date',
    ];

    // ─── Scopes ───────────────────────────────────────────────────────────────

    public function scopeToday($query)
    {
        return $query->where('visited_date', today()->toDateString());
    }

    public function scopeThisWeek($query)
    {
        return $query->where('visited_date', '>=', now()->startOfWeek()->toDateString());
    }

    public function scopeThisMonth($query)
    {
        return $query->where('visited_date', '>=', now()->startOfMonth()->toDateString());
    }

    public function scopeThisYear($query)
    {
        return $query->where('visited_date', '>=', now()->startOfYear()->toDateString());
    }

    // ─── Static helpers ───────────────────────────────────────────────────────

    public static function countToday(): int
    {
        return static::today()->count();
    }

    public static function countWeek(): int
    {
        return static::thisWeek()->count();
    }

    public static function countMonth(): int
    {
        return static::thisMonth()->count();
    }

    public static function countYear(): int
    {
        return static::thisYear()->count();
    }

    public static function countTotal(): int
    {
        return static::count();
    }

    /**
     * Data kunjungan per hari 30 hari terakhir (untuk chart admin)
     */
    public static function dailyLast30Days(): array
    {
        $rows = static::select(
                DB::raw('visited_date'),
                DB::raw('COUNT(*) as total')
            )
            ->where('visited_date', '>=', now()->subDays(29)->toDateString())
            ->groupBy('visited_date')
            ->orderBy('visited_date')
            ->get()
            ->keyBy(fn ($r) => $r->visited_date);

        $result = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $result[] = [
                'date'  => $date,
                'label' => \Carbon\Carbon::parse($date)->format('d M'),
                'total' => $rows->get($date)?->total ?? 0,
            ];
        }

        return $result;
    }
}
