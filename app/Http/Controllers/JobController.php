<?php

namespace App\Http\Controllers;

use DB;

use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Application;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ApplicationStatusNotification;

class JobController extends Controller
{
    public function create()
    {
        $tags = Tag::all(); // Fetch all available tags from the database
        return view('employer.jobs.create', compact('tags'));
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
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $job = new Job();
        $job->user_id = Auth::id();
        $job->title = $request->title;
        $job->description = $request->description;
        $job->location = $request->location;
        $job->type = $request->type;
        $job->salary = $request->salary;
        $job->deadline = $request->deadline;
        $job->status = 'pending';
        $job->save();

        // Sync tags if selected
        if ($request->filled('tags')) {
            $job->tags()->sync($request->tags);
        }

        return redirect('/employer/dashboard')->with('success', 'Job posted successfully!');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $showAll = $request->has('all'); // Toggle for all jobs or matched tags only
        $today = now()->toDateString();
    
        // Base query: only approved and not expired jobs
        $query = Job::where('status', 'approved')
            ->where(function ($q) use ($today) {
                $q->whereNull('deadline')
                  ->orWhere('deadline', '>=', $today);
            });
    
        // Apply filters
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
    
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
    
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
    
        // Tag-based filtering (only if 'all' not present)
        if (!$showAll) {
            $userTagIds = $user->tags->pluck('id');
            $query->whereHas('tags', function ($q) use ($userTagIds) {
                $q->whereIn('tags.id', $userTagIds);
            });
        }
    
        // Final job list
        $jobs = $query->latest()->paginate(10);
    
        // Bookmarked jobs for the logged-in user
        $savedJobIds = \App\Models\Bookmark::where('user_id', $user->id)
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

    public function updateStatus(Request $request, $applicationId)
    {
        // Validate input
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);
    
        // Load application with related job
        $application = Application::with('job')->findOrFail($applicationId);
    
        // ✅ Ensure the employer owns the job
        if ($application->job->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
    
        // Update status
        $application->status = $request->status;
        $application->save();
    
        // ✅ Notify the jobseeker
        $application->user->notify(
            new ApplicationStatusNotification($application->job->title, $application->status)
        );
    
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

    public function jobseekerDashboard()
    {
        // Fetch latest 5 announcements
        $announcements = Announcement::latest()->take(5)->get();

        // Pass them to the dashboard view
        return view('jobseeker.dashboard', compact('announcements'));
    }

}
