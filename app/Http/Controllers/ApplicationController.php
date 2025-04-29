<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request, $jobId)
    {
        $request->validate([
            'cover_letter' => 'required|string',
        ]);

        $job = Job::findOrFail($jobId);

        // Prevent duplicate applications
        if ($job->applications()->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'You already applied to this job.');
        }

        $application = new Application();
        $application->job_id = $job->id;
        $application->user_id = Auth::id();
        $application->cover_letter = $request->cover_letter;
        $application->save();

        return back()->with('success', 'Application submitted successfully!');
    }
}
