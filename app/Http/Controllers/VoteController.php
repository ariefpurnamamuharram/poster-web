<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function like(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'posterID' => 'required|numeric',
        ]);

        $poster = Poster::where('id', $request->posterID)->first();

        $currentLikes = $poster->total_likes;

        $poster->update([
            'total_likes' => $currentLikes + 1,
        ]);

        return redirect()
            ->back()
            ->with('message', 'Thank you for your appreciation!');
    }

    public function dislike(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'posterID' => 'required|numeric',
        ]);

        $poster = Poster::where('id', $request->posterID)->first();

        $currentDislikes = $poster->total_dislikes;

        $poster->update([
            'total_dislikes' => $currentDislikes + 1,
        ]);

        return redirect()
            ->back()
            ->with('message', 'Thank you for your appreciation!');
    }
}
