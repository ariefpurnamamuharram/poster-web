<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function poster()
    {
        $posters = Poster::orderBy('total_likes', 'DESC')
            ->orderBy('total_comments', 'DESC')
            ->paginate(16);

        return view('managers.poster', [
            'posters' => $posters,
        ]);
    }
}
