<?php

namespace App\Http\Controllers;

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
                ->with('message', 'Password changes successfully!');
        } else {
            return redirect()
                ->back()
                ->with('message', 'Password wrong!');
        }
    }
}
