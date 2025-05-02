<?php

namespace App\Http\Controllers;

use App\Models\Job;

use App\Models\User;
use App\Models\Bookmark;
use App\Models\Application;
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
            'deadline' => 'nullable|date|after_or_equal:today',
        ]);

        $job = new Job();
        $job->user_id = Auth::id(); // Assign employer ID manually
        $job->title = $request->title;
        $job->description = $request->description;
        $job->location = $request->location;
        $job->type = $request->type;
        $job->salary = $request->salary;
        $job->deadline = $request->deadline; // ✅ Include deadline
        $job->status = 'pending'; // Optional: default status for moderation
        $job->save();

        return redirect('/employer/dashboard')->with('success', 'Job posted successfully!');
    }

    public function index(Request $request)
    {
        $today = now()->toDateString();
    
        $query = Job::where('status', 'approved')
            ->where(function ($q) use ($today) {
                $q->whereNull('deadline')
                  ->orWhere('deadline', '>=', $today);
            });
    
        // Filters
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
    
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
    
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
    
        // Paginate results
        $jobs = $query->latest()->paginate(10);
    
        // Get bookmarked job IDs for current user
        $savedJobIds = \App\Models\Bookmark::where('user_id', auth()->id())
            ->pluck('job_id')
            ->toArray();
    
        return view('jobseeker.jobs.index', compact('jobs', 'savedJobIds'));
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
    public function applications($jobId)
    {
        $job = Job::with('applications.user')->where('user_id', auth()->id())->findOrFail($jobId);

        return view('employer.jobs.applications', compact('job'));
    }

    public function updateStatus($applicationId, Request $request)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $application = Application::with('job')->findOrFail($applicationId);

        // Ensure the employer owns the job
        if ($application->job->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $application->status = $request->status;
        $application->save();

        return back()->with('success', 'Application status updated.');
    }

        public function bookmark($id)
    {
        $job = Job::findOrFail($id);

        // Avoid duplicate
        if (!Bookmark::where('user_id', auth()->id())->where('job_id', $id)->exists()) {
            Bookmark::create([
                'user_id' => auth()->id(),
                'job_id' => $id,
            ]);
        }

        return back()->with('success', 'Job saved.');
    }
    public function unbookmark($id)
    {
        Bookmark::where('user_id', auth()->id())
            ->where('job_id', $id)
            ->delete();

        return back()->with('success', 'Job removed from saved.');
    }

    public function saved()
    {
        $bookmarkedJobs = Bookmark::where('user_id', auth()->id())
            ->with('job')
            ->latest()
            ->paginate(10);

        return view('jobseeker.jobs.saved', ['bookmarks' => $bookmarkedJobs]);
    }

}
