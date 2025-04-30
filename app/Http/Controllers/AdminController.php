<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $users = User::where('role', '!=', 'admin')->get();
        $jobs = Job::latest()->get();
        return view('admin.dashboard', compact('users', 'jobs'));
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
