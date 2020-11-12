<?php

namespace App\Http\Controllers;

use App\Models\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function settingsPage()
    {
        return view('settings.main');
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'checkLoginLink' => 'nullable|numeric|max:1',
        ]);

        SiteSettings::where('key', SiteSettings::SETTING_LOGIN_LINK)->first()->update([
            'value' => $request->checkLoginLink,
        ]);

        return redirect()
            ->back()
            ->with('message', 'Settings saved successfully!');
    }
}
