<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\ActivityLog;

class ProfileController extends Controller
{
    /**
     * SHOW PROFILE PAGE
     */
    public function index()
    {
        $user = Auth::user();

        return view('member.profile', compact('user'));
    }

    /**
     * UPDATE PROFILE
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        // IMAGE UPLOAD
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            $user->profile_image = $filename;
        }

        // UPDATE USER
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();

        // LOG ACTIVITY
        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'Profile Updated',
            'description' => 'User updated profile information'
        ]);

        return Redirect::back()->with('success', 'Profile updated successfully');
    }
}