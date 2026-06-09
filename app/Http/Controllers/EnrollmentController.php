<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegistrationCourse;
use App\Models\Student;
use App\Models\Classes;

class EnrollmentController extends Controller
{
    public function index()
    {
        $registrations = RegistrationCourse::with(['student.user', 'class.course'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.registrations.index', compact('registrations'));
    }

    public function enrollmentCourse(Request $request, $id)
    {
        // Keep existing method placeholder if needed, 
        // but the CRUD uses index, edit, update, destroy
    }

    public function edit($id)
    {
        $registration = RegistrationCourse::with(['student.user', 'class.course'])->findOrFail($id);
        return view('admin.registrations.edit', compact('registration'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,canceled'
        ]);

        $registration = RegistrationCourse::findOrFail($id);
        $registration->status = $request->status;
        $registration->save();

        return redirect()->route('admin.registrations.index')->with('success', 'Registration updated successfully.');
    }

    public function destroy($id)
    {
        $registration = RegistrationCourse::findOrFail($id);
        $registration->delete();

        return redirect()->route('admin.registrations.index')->with('success', 'Registration deleted successfully.');
    }
}
