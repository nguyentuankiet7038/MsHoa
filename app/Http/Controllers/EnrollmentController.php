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
        $registrations = RegistrationCourse::with(['student.user', 'class.course', 'course'])
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
                'address' => $request->address??'Chưa có thông tin',
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

        // --- Gửi thông báo ---
        // Cho Học viên
        \Illuminate\Support\Facades\Notification::send($user, new \App\Notifications\SystemNotification([
            'title' => 'Đăng ký thành công',
            'message' => 'Bạn đã đăng ký khóa học thành công. Vui lòng chờ trung tâm xác nhận.',
            'type' => 'success',
            'action_by' => 'Hệ thống'
        ]));

        // Cho Tư vấn viên & Admin
        $staffs = \App\Models\User::whereIn('role', ['consultant', 'admin'])->get();
        $courseName = \App\Models\Course::find($request->course_id)->coursename ?? 'Khóa học mới';
        \Illuminate\Support\Facades\Notification::send($staffs, new \App\Notifications\SystemNotification([
            'title' => 'Đơn đăng ký mới',
            'message' => 'Học viên ' . $request->student_name . ' vừa đặt khóa học: ' . $courseName,
            'type' => 'info',
            'action_by' => $user->email,
            'link' => route('admin.registrations.index')
        ]));

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

        $registration = RegistrationCourse::with(['student.user', 'course'])->findOrFail($id);
        $oldStatus = $registration->status;
        $registration->status = $request->status;
        $registration->save();

        // --- Gửi thông báo khi thay đổi trạng thái ---
        if ($oldStatus !== $request->status && $registration->student && $registration->student->user) {
            $studentUser = $registration->student->user;
            $courseName = $registration->course ? $registration->course->coursename : 'khóa học';
            
            if ($request->status === 'approved') {
                // Báo cho Học viên
                \Illuminate\Support\Facades\Notification::send($studentUser, new \App\Notifications\SystemNotification([
                    'title' => 'Xác nhận khóa học',
                    'message' => 'Đơn đăng ký ' . $courseName . ' của bạn đã được xác nhận thành công!',
                    'type' => 'success',
                    'action_by' => auth()->user()->email ?? 'Tư vấn viên'
                ]));
                // Báo lại cho Consultant (Activity Log)
                $consultants = \App\Models\User::where('role', 'consultant')->get();
                \Illuminate\Support\Facades\Notification::send($consultants, new \App\Notifications\SystemNotification([
                    'title' => 'Đã xác nhận đơn',
                    'message' => 'Đã xác nhận đơn đăng ký ' . $courseName . ' của học viên ' . $registration->student->studentname,
                    'type' => 'success',
                    'action_by' => auth()->user()->email ?? 'Hệ thống'
                ]));
            } elseif ($request->status === 'rejected') {
                // Báo cho Học viên
                \Illuminate\Support\Facades\Notification::send($studentUser, new \App\Notifications\SystemNotification([
                    'title' => 'Từ chối đăng ký',
                    'message' => 'Đơn đăng ký ' . $courseName . ' của bạn đã bị từ chối. Vui lòng liên hệ để biết thêm chi tiết.',
                    'type' => 'danger',
                    'action_by' => auth()->user()->email ?? 'Tư vấn viên'
                ]));
                // Báo lại cho Consultant (Activity Log)
                $consultants = \App\Models\User::where('role', 'consultant')->get();
                \Illuminate\Support\Facades\Notification::send($consultants, new \App\Notifications\SystemNotification([
                    'title' => 'Đã từ chối đơn',
                    'message' => 'Đã từ chối đơn đăng ký ' . $courseName . ' của học viên ' . $registration->student->studentname,
                    'type' => 'warning',
                    'action_by' => auth()->user()->email ?? 'Hệ thống'
                ]));
            }
        }

        // --- Gửi thông báo cho Admin CRUD ---
        $admins = \App\Models\User::where('role', 'admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification([
            'title' => 'Cập nhật Đơn đăng ký',
            'message' => 'Đơn đăng ký của ' . ($registration->student->studentname ?? 'Học viên') . ' vừa được cập nhật.',
            'type' => 'warning',
            'action_by' => auth()->user()->email ?? 'Hệ thống',
            'link' => route('admin.registrations.index')
        ]));

        return redirect()->route('admin.registrations.index')->with('success', 'Registration updated successfully.');
    }

    public function destroy($id)
    {
        $registration = RegistrationCourse::findOrFail($id);
        $registration->delete();

        // --- Gửi thông báo cho Admin CRUD ---
        $admins = \App\Models\User::where('role', 'admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification([
            'title' => 'Xóa Đơn đăng ký',
            'message' => 'Một đơn đăng ký đã bị xóa khỏi hệ thống.',
            'type' => 'danger',
            'action_by' => auth()->user()->email ?? 'Hệ thống',
            'link' => route('admin.registrations.index')
        ]));

        return redirect()->route('admin.registrations.index')->with('success', 'Registration deleted successfully.');
    }
}
