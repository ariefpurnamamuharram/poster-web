<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use App\Models\PosterComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deletePoster(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'posterID' => 'required',
        ]);

        // Get poster file.
        $poster = Poster::where('id', $request->posterID)->first();

        // Delete poster file.
        Storage::delete($poster->poster_filename);

        // Delete poster comments.
        $posterComments = PosterComment::where('poster_id', $poster->id)->get();
        if (count($posterComments) != 0) {
            foreach ($posterComments as $posterComment) {
                $posterComment->delete();
            }
        }

        // Delete poster record.
        $poster->delete();

        return redirect()
            ->back()
            ->with('message', 'Poster deleted successfully!');
    }
}
