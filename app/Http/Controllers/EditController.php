<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editPoster($posterID)
    {
        $poster = Poster::where('id', $posterID)->first();

        return view('managers.posters.edit', [
            'poster' => $poster,
        ]);
    }
}
