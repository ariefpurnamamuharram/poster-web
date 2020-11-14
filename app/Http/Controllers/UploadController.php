<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function poster()
    {
        return view('uploads.poster');
    }

    public function uploadPoster(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required|string|min:12|max:180',
            'authors' => 'required|string|min:6|max:180',
            'affiliations' => 'required|string|min:12|max:360',
            'category' => 'required|numeric',
            'poster' => 'required|image|max:2000',
            'abstract' => 'nullable|min:54|max:2048',
            'keywords' => 'nullable|min:8|max:180',
        ]);

        $uploadedPoster = $request->file('poster');
        $pathPoster = $uploadedPoster->store('public/files/posters');

        Poster::create([
            'poster_title' => $request->title,
            'poster_authors' => $request->authors,
            'author_affiliations' => $request->affiliations,
            'poster_category' => $request->category,
            'poster_filename' => $pathPoster,
            'poster_abstract' => $request->abstract,
            'poster_keywords' => $request->keywords,
            'posted_by_id' => Auth::user()->id,
            'posted_by_name' => Auth::user()->name,
            'posted_by_email' => Auth::user()->email,
        ]);

        return redirect()
            ->back()
            ->with('message', 'Poster uploaded successfully!');
    }
}
