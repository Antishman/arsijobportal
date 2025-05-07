<?php
// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Auth::user()->profile ?? new Profile();
        return view('jobseeker.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'bio' => 'nullable|string',
            'linkedin' => 'nullable|url',
            'website' => 'nullable|url',
        ]);

        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

        return back()->with('success', 'Profile updated successfully!');
    }
}
