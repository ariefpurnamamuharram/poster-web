<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use App\Models\PosterComment;
use App\Models\PosterCommentReply;
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

        // Update total comments number.
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

    public function replyPoster(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'replyPosterID' => 'required|numeric',
            'replyCommentID' => 'required|numeric',
            'replyName' => 'required|string|max:180',
            'replyEmail' => 'required|email:rfc,dns|max:180',
            'replyComment' => 'required|string|max:2048',
        ]);

        // Update total comments number.
        $poster = Poster::where('id', $request->replyPosterID)->first();
        $totalComments = $poster->total_comments;
        $poster->update([
            'total_comments' => $totalComments + 1,
        ]);

        PosterCommentReply::create([
            'poster_id' => $request->replyPosterID,
            'comment_id' => $request->replyCommentID,
            'name' => $request->replyName,
            'email' => $request->replyEmail,
            'comment' => $request->replyComment,
        ]);

        return redirect()
            ->back()
            ->with('message', 'Comment posted successfully!');
    }
}
