<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function updatePoster(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'posterID' => 'required|numeric',
            'title' => 'required|string|min:12|max:180',
            'authors' => 'required|string|min:6|max:180',
            'affiliations' => 'required|string|min:12|max:360',
            'category' => 'required|numeric',
            'poster' => 'nullable|image|max:24000',
            'abstract' => 'nullable|min:54|max:2048',
            'keywords' => 'nullable|min:8|max:180',
        ]);

        $poster = Poster::where('id', $request->posterID)->first();

        $poster->update([
            'poster_title' => $request->title,
            'poster_authors' => $request->authors,
            'author_affiliations' => $request->affiliations,
            'poster_category' => $request->category,
            'poster_abstract' => $request->abstract,
            'poster_keywords' => $request->keywords,
        ]);

        if (!empty($request->poster)) {
            Storage::delete($poster->poster_filename);

            $uploadedPoster = $request->file('poster');
            $pathPoster = $uploadedPoster->store('public/files/posters');

            $poster->update([
                'poster_filename' => $pathPoster,
            ]);
        }

        return redirect()
            ->back()
            ->with('message', 'Poster updated successfully!');
    }
}
