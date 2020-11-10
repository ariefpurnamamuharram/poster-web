<?php

namespace App\Http\Controllers;

use App\Models\Poster;
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

        $poster = Poster::where('id', $request->posterID)->first();

        Storage::delete($poster->poster_filename);

        $poster->delete();

        return redirect()
            ->back()
            ->with('message', 'Poster berhasil dihapus!');
    }
}
