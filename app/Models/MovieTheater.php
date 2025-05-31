<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class MovieTheater extends Model
{
    protected $table = 'movie_theater';

    public function theater(): BelongsTo
    {
        return $this->belongsTo(Theaters::class);
    }

    public static function getShowDates(string $start, string $end): array
    {
        return static::distinct()
            ->whereBetween('show_date', [$start, $end])
            ->orderBy('show_date')
            ->get(['show_date'])
            ->pluck('show_date')
            ->all();
    }

    public static function getHighestSalesMovieTheater(string $date)
    {
        return static::with('theater')
            ->where('show_date', $date)
            ->select('theater_id', DB::raw('sum(sales) as sales'))
            ->groupBy('theater_id')
            ->orderByDesc('sales')
            ->limit(1)
            ->first();
    }
}
