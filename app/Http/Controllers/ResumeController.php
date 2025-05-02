<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use Barryvdh\DomPDF\Facade\Pdf;
class ResumeController extends Controller
{
    //
    public function create()
    {
        $resume = Resume::firstOrNew(['user_id' => auth()->id()]);
        return view('jobseeker.resume.form', compact('resume'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'education' => 'nullable|string',
            'experience' => 'nullable|string',
            'skills' => 'nullable|string',
        ]);

        $resume = Resume::updateOrCreate(
            ['user_id' => auth()->id()],
            $data + ['user_id' => auth()->id()]
        );

        return redirect('/resume/create')->with('success', 'Resume saved!');
    }
    public function preview()
    {
        $resume = Resume::where('user_id', auth()->id())->first();

        if (!$resume) {
            return redirect('/resume/create')->with('error', 'No resume found. Please build your resume first.');
        }

        $pdf = Pdf::loadView('jobseeker.resume.pdf', compact('resume'));

        return $pdf->stream('resume-preview.pdf'); // Preview in browser
    }
}
