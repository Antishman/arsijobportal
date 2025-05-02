<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use App\Models\Resume;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request, $jobId)
    {
        $request->validate([
            'cover_letter' => 'required|string',
            'resume' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $job = Job::findOrFail($jobId);

        // Prevent duplicate applications
        if ($job->applications()->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'You already applied to this job.');
        }

        $resumePath = null;

        // If user uploaded a file, use it
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        } else {
            // Otherwise, generate from stored Resume Builder data
            $resume = Resume::where('user_id', Auth::id())->first();

            if ($resume) {
                $pdf = Pdf::loadView('jobseeker.resume.pdf', compact('resume'));
                $resumePath = 'resumes/' . uniqid() . '.pdf';
                Storage::disk('public')->put($resumePath, $pdf->output());
            }
        }

        // Save application
        $application = new Application();
        $application->job_id = $job->id;
        $application->user_id = Auth::id();
        $application->cover_letter = $request->cover_letter;
        $application->resume = $resumePath;
        $application->save();

        return back()->with('success', 'Application submitted successfully!');
    }

    public function myApplications()
    {
        $applications = \App\Models\Application::with('job')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('jobseeker.applications.index', compact('applications'));
    }
        public function edit($id)
    {
        $application = Application::with('job')->where('user_id', auth()->id())->findOrFail($id);

        if ($application->status !== 'pending') {
            return redirect('/applications')->with('error', 'You can only edit pending applications.');
        }

        return view('jobseeker.applications.edit', compact('application'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cover_letter' => 'required|string',
            'resume' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $application = Application::where('user_id', auth()->id())->findOrFail($id);

        if ($application->status !== 'pending') {
            return redirect('/applications')->with('error', 'You can only update pending applications.');
        }

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $application->resume = $resumePath;
        }

        $application->cover_letter = $request->cover_letter;
        $application->save();

        return redirect('/applications')->with('success', 'Application updated.');
    }

    public function destroy($id)
    {
        $application = Application::where('user_id', auth()->id())->findOrFail($id);

        if ($application->status !== 'pending') {
            return redirect('/applications')->with('error', 'You can only withdraw pending applications.');
        }

        $application->delete();

        return redirect('/applications')->with('success', 'Application withdrawn.');
    }

}
