<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $posters = Poster::orderBy('total_likes', 'DESC')
            ->orderBy('total_comments', 'DESC')
            ->simplePaginate(9);

        return view('welcome', [
            'posters' => $posters,
        ]);
    }
}
