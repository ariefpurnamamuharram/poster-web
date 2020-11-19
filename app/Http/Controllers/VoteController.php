<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use App\Models\PosterVoteIP;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function like(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'posterID' => 'required|numeric',
        ]);

        if(empty(PosterVoteIP::where(['poster_id' => $request->posterID, 'user_ip' => $request->ip()])->first())) {
            $poster = Poster::where('id', $request->posterID)->first();

            $currentLikes = $poster->total_likes;

            $poster->update([
                'total_likes' => $currentLikes + 1,
            ]);

            PosterVoteIP::create([
                'poster_id' => $poster->id,
                'user_ip' => $request->ip(),
            ]);

            return redirect()
                ->back()
                ->with('message', 'Thank you for your appreciation!');
        } else {
            return redirect()
                ->back()
                ->with('message', 'You have already appreciated this poster!');
        }
    }

    public function dislike(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'posterID' => 'required|numeric',
        ]);

        if(empty(PosterVoteIP::where(['poster_id' => $request->posterID, 'user_ip' => $request->ip()])->first())) {
            $poster = Poster::where('id', $request->posterID)->first();

            $currentDislikes = $poster->total_dislikes;

            $poster->update([
                'total_dislikes' => $currentDislikes + 1,
            ]);

            PosterVoteIP::create([
                'poster_id' => $poster->id,
                'user_ip' => $request->ip(),
            ]);

            return redirect()
                ->back()
                ->with('message', 'Thank you for your appreciation!');
        } else {
            return redirect()
                ->back()
                ->with('message', 'You have already appreciated this poster!');
        }
    }
}
