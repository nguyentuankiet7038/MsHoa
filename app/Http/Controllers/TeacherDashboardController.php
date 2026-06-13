<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\LearningProgress;
use App\Models\RegistrationCourse;
use App\Models\Student;

class TeacherDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || auth()->user()->role !== 'teacher') {
                return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập trang này.');
            }
            return $next($request);
        });
    }

    private function getTeacher()
    {
        return auth()->user()->teacher;
    }

    public function schedule()
    {
        $teacher = $this->getTeacher();
        if (!$teacher) return redirect()->back()->with('error', 'Hồ sơ giáo viên không tồn tại.');

        $classes = Classes::with('course')
            ->where('teacherid', $teacher->teacherid)
            ->get();

        return view('pages.teacher.schedule', compact('classes'));
    }

    public function gradesAttendance(Request $request)
    {
        $teacher = $this->getTeacher();
        $classes = Classes::with('course')
            ->where('teacherid', $teacher->teacherid)
            ->get();

        $selectedClass = null;
        $students = collect();

        if ($request->has('classid')) {
            $selectedClass = Classes::with('course')->findOrFail($request->classid);
            
            // Verify ownership
            if ($selectedClass->teacherid !== $teacher->teacherid) {
                return redirect()->back()->with('error', 'Bạn không có quyền quản lý lớp này.');
            }

            // Get students in this class from RegistrationCourse
            $registrationStudents = RegistrationCourse::where('classid', $selectedClass->classid)
                ->where('status', 'approved')
                ->with('student.user')
                ->get();

            foreach ($registrationStudents as $reg) {
                // Ensure LearningProgress record exists
                $progress = LearningProgress::firstOrCreate(
                    [
                        'studentid' => $reg->studentid,
                        'classid' => $selectedClass->classid
                    ],
                    [
                        'midterm_score' => 0,
                        'final_score' => 0,
                        'attendance_rate' => 0,
                        'is_blocked' => true
                    ]
                );
                
                $students->push([
                    'id' => $reg->studentid,
                    'fullname' => $reg->student->user->fullname,
                    'progress' => $progress
                ]);
            }
        }

        return view('pages.teacher.grades-attendance', compact('classes', 'selectedClass', 'students'));
    }

    public function updateGradesAttendance(Request $request)
    {
        $request->validate([
            'classid' => 'required|exists:classes,classid',
            'data' => 'required|array'
        ]);

        $teacher = $this->getTeacher();
        $class = Classes::findOrFail($request->classid);

        if ($class->teacherid !== $teacher->teacherid) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        foreach ($request->data as $studentid => $values) {
            $progress = LearningProgress::where('classid', $class->classid)
                ->where('studentid', $studentid)
                ->first();

            if ($progress && !$progress->is_blocked) {
                $progress->update([
                    'midterm_score' => $values['midterm'] ?? $progress->midterm_score,
                    'final_score' => $values['final'] ?? $progress->final_score,
                    'attendance_rate' => $values['attendance'] ?? $progress->attendance_rate,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Cập nhật thành công. (Chỉ những bản ghi không bị khóa mới được cập nhật)');
    }
}
