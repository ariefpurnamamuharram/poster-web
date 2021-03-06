<?php

namespace App\Http\Controllers;

use App\Models\Poster;

class DisplayController extends Controller
{
    public function showPoster($posterID)
    {
        $poster = Poster::where('id', $posterID)->first();

        return view('poster.main', [
            'poster' => $poster,
        ]);
    }
}
