<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changeProfile(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'username' => 'required|string|min:6|max:64',
            'email' => 'required|email:rfc,dns|min:6|max:64|unique:users,email',
        ]);

        // Users table.
        User::where('id', Auth::user()->id)->first()->update([
            'name' => $request->username,
            'email' => $request->email,
        ]);

        // Posters table.
        foreach (Poster::where('posted_by_id', Auth::user()->id)->get() as $poster) {
            $poster->update([
                'posted_by_name' => $request->username,
                'posted_by_email' => $request->email,
            ]);
        }

        return redirect()
            ->back()
            ->with('message', 'User profile changed successfully!');
    }

    public function changePassword(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|confirmed|min:8',
        ]);

        if (Hash::check($request->oldPassword, Auth::user()->password)) {
            User::where('id', Auth::user()->id)->first()->update([
                'password' => Hash::make($request->newPassword),
            ]);

            return redirect()
                ->back()
                ->with('message', 'Password changed successfully!');
        } else {
            return redirect()
                ->back()
                ->with('message', 'Password wrong!');
        }
    }
}
