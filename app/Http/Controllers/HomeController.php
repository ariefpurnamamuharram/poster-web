<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use App\Models\PosterComment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        // Posters
        $posters = Poster::orderBy('total_likes', 'DESC')
            ->orderBy('total_comments', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->simplePaginate(9);

        // Posters comments
        $postersComments = PosterComment::orderBy('created_at', 'DESC')->get()->take(5);

        return view('welcome', [
            'posters' => $posters,
            'postersComments' => $postersComments,
        ]);
    }

    public function category($category)
    {
        // Posters
        $posters = Poster::where('poster_category', $category)
            ->orderBy('total_likes', 'DESC')
            ->orderBy('total_comments', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->simplePaginate(9);

        // Poster comments
        $postersComments = PosterComment::orderBy('created_at', 'DESC')->get()->take(5);

        return view('welcome', [
            'posters' => $posters,
            'postersComments' => $postersComments,
        ]);
    }
}
