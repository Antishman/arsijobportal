<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function create()
    {
        return view('employer.jobs.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'location' => 'required|string',
        'type' => 'required|string',
        'salary' => 'nullable|string',
    ]);

    $job = new Job();
    $job->user_id = Auth::id(); // Assign employer ID manually
    $job->title = $request->title;
    $job->description = $request->description;
    $job->location = $request->location;
    $job->type = $request->type;
    $job->salary = $request->salary;
    $job->save();

    return redirect('/employer/dashboard')->with('success', 'Job posted successfully!');
}

    public function index()
    {
        $jobs = Job::latest()->get();
        return view('jobseeker.jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        return view('jobseeker.jobs.show', compact('job'));
    }

    public function destroy(Job $job)
    {
        if (auth()->id() !== $job->user_id) {
            abort(403, 'Unauthorized');
        }

        $job->delete();
        return redirect('/employer/dashboard')->with('success', 'Job deleted.');
    }

}
