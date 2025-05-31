<?php

namespace App\Http\Controllers;

use App\Models\MovieTheater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MoviesController
{
    public function index()
    {
        // Get dates within a range to lower db pressure
        $dates = MovieTheater::getShowDates('2025-06-01', '2025-06-30');

        return view('movies', compact('dates'));
    }

    public function getHighestSalesTheater(Request $request): array
    {
        $date = $request->get('date');

        $rules = [
            'date' => 'required|date|date_format:Y-m-d|after-or-equal:2025-06-01',
        ];

        $validator = Validator::make(compact('date'), $rules);
        if ($validator->fails()) {
            abort(400, $validator->errors());
        }

        $movieTheater = MovieTheater::getHighestSalesMovieTheater($date);
        if (!$movieTheater) {
            abort(404, 'No date found for this date');
        }

        return [
            'theaterName' => $movieTheater->theater->theater_name,
        ];
    }
}
