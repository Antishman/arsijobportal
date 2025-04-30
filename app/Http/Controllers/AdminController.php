<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        // Existing data
        $users = User::where('role', '!=', 'admin')->get();
        $jobs = Job::latest()->get();

        // New analytics
        $jobseekerCount = User::where('role', 'jobseeker')->count();
        $employerCount = User::where('role', 'employer')->count();
        $jobCount = Job::count();
        $applicationCount = Application::count();

        return view('admin.dashboard', compact(
            'users', 'jobs',
            'jobseekerCount', 'employerCount', 'jobCount', 'applicationCount'
        ));
    }

    public function updateJobStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $job = Job::findOrFail($id);
        $job->status = $request->status;
        $job->save();

        return back()->with('success', 'Job status updated.');
    }

    public function deleteUser($id)
    {
        User::where('id', $id)->where('role', '!=', 'admin')->delete();
        return back()->with('success', 'User deleted.');
    }

    public function deleteJob($id)
    {
        Job::findOrFail($id)->delete();
        return back()->with('success', 'Job deleted.');
    }
}
