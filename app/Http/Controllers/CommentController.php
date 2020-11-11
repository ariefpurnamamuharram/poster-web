<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use App\Models\PosterComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function commentPoster(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'posterID' => 'required|numeric',
            'name' => 'required|string|max:180',
            'email' => 'required|email:rfc,dns|max:180',
            'comment' => 'required|string|max:2048',
        ]);

        $poster = Poster::where('id', $request->posterID)->first();

        $totalComments = $poster->total_comments;

        $poster->update([
            'total_comments' => $totalComments + 1,
        ]);

        PosterComment::create([
            'poster_id' => $request->posterID,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
        ]);

        return redirect()
            ->back()
            ->with('message', 'Comment posted successfully!');
    }
}
