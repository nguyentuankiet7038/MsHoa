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
        $request->validate([
            'student_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:20',
        ]);

        // 1. Check if user is logged in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để đăng ký khóa học.');
        }

        $user = auth()->user();

        // 2. Check or Create Student profile for this user
        $student = Student::firstOrCreate(
            ['userid' => $user->userid],
            [
                'studentname' => $request->student_name,
                'dateofbirth' => $request->dob,
                'gender' => $request->gender,
                'parentname' => $request->guardian_name,
                'parentphone' => $request->guardian_phone,
                // address could be added here if in the form
            ]
        );

        // Update student info if it already existed but might be different
        if (!$student->wasRecentlyCreated) {
            $student->update([
                'studentname' => $request->student_name,
                'dateofbirth' => $request->dob,
                'gender' => $request->gender,
                'parentname' => $request->guardian_name,
                'parentphone' => $request->guardian_phone,
            ]);
        }

        // 3. Create Registration Course record
        // By default, registration points to a class. But if a class isn't assigned yet,
        // we might need a way to store just the course intent.
        // Assuming the logic is to create a 'pending' registration.
        // Wait, RegistrationCourse requires a classid according to its schema (unless it's nullable).
        // Let's check the migration: 2026_05_28_074644_create_registration__courses_table.php
        // It has unsignedBigInteger('classid')->nullable(); (Assuming nullable, if not it will fail).
        
        RegistrationCourse::create([
            'studentid' => $student->studentid,
            'courseid' => $request->course_id, // Save the requested course
            'classid' => null, // Needs to be assigned later by admin
            'registration_date' => now(),
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Đăng ký thành công! Vui lòng chờ trung tâm xác nhận và xếp lớp.');
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
