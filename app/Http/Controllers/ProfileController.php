<?php
// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new \App\Models\Profile();
        $tags = Tag::all();
        $selectedTagIds = $user->tags->pluck('id')->toArray();
    
        return view('jobseeker.profile.edit', compact('profile', 'tags', 'selectedTagIds'));
    }
    
    

    public function update(Request $request)
    {
        $data = $request->validate([
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'bio' => 'nullable|string',
            'linkedin' => 'nullable|url',
            'website' => 'nullable|url',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);
    
        // Save or update profile
        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );
    
        // Handle tags manually (without $user->tags())
        $userId = Auth::id();
        $tagIds = $request->input('tags', []);
    
        // Delete existing tags
        DB::table('user_tag')->where('user_id', $userId)->delete();
    
        // Insert new tag relationships
        foreach ($tagIds as $tagId) {
            DB::table('user_tag')->insert([
                'user_id' => $userId,
                'tag_id'   => $tagId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        return back()->with('success', 'Profile updated successfully!');
    }
}
