<?php

namespace App\Http\Controllers;

use App\Models\MovieTheater;
use Illuminate\Http\Request;

class MoviesController
{
    public function index()
    {
        $dates = MovieTheater::getShowDates('2025-01-01', '2025-06-01');

        return view('movies', compact('dates'));
    }

    public function getHighestSalesTheater(Request $request): array
    {
        $date = $request->get('date');

        $movieTheater = MovieTheater::getHighestSalesMovieTheater($date);

        return [
            'theaterName' => $movieTheater->theater->theater_name,
        ];
    }
}
