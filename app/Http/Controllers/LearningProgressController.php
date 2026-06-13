<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LearningProgress;
use App\Models\Student;
use App\Models\Classes;

class LearningProgressController extends Controller
{
    public function index()
    {
        $progress = LearningProgress::with(['student.user', 'class.course'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.learning-progress.index', compact('progress'));
    }

    public function create()
    {
        $students = Student::with('user')->get();
        $classes = Classes::with('course')->get();
        return view('admin.learning-progress.create', compact('students', 'classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'studentid' => 'required|exists:students,studentid',
            'classid' => 'required|exists:classes,classid',
            'midterm_score' => 'nullable|numeric|min:0|max:10',
            'final_score' => 'nullable|numeric|min:0|max:10',
            'attendance_rate' => 'nullable|integer|min:0',
        ]);

        LearningProgress::create([
            'studentid' => $request->studentid,
            'classid' => $request->classid,
            'midterm_score' => $request->midterm_score ?? 0,
            'final_score' => $request->final_score ?? 0,
            'attendance_rate' => $request->attendance_rate ?? 0,
            'is_blocked' => true, // Default as requested
        ]);

        return redirect()->route('admin.learning-progress.index')->with('success', 'Điểm sinh viên đã được tạo.');
    }

    public function edit($id)
    {
        $item = LearningProgress::findOrFail($id);
        $students = Student::with('user')->get();
        $classes = Classes::with('course')->get();
        return view('admin.learning-progress.edit', compact('item', 'students', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $item = LearningProgress::findOrFail($id);

        if ($item->is_blocked && !$request->has('toggle_block')) {
            return redirect()->back()->with('error', 'Bản ghi này đang bị khóa. Vui lòng mở khóa trước khi sửa.');
        }

        if ($request->has('toggle_block')) {
            $item->is_blocked = !$item->is_blocked;
            $item->save();
            return redirect()->back()->with('success', $item->is_blocked ? 'Đã khóa bản ghi.' : 'Đã mở khóa bản ghi.');
        }

        $request->validate([
            'midterm_score' => 'required|numeric|min:0|max:10',
            'final_score' => 'required|numeric|min:0|max:10',
            'attendance_rate' => 'required|integer|min:0',
        ]);

        $item->update($request->only(['midterm_score', 'final_score', 'attendance_rate']));

        return redirect()->route('admin.learning-progress.index')->with('success', 'Cập nhật điểm thành công.');
    }

    public function destroy($id)
    {
        $item = LearningProgress::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.learning-progress.index')->with('success', 'Đã xóa bản ghi.');
    }

    /**
     * View grades for the logged-in student
     */
    public function studentIndex()
    {
        if (!auth()->check() || auth()->user()->role !== 'student') {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập với tài khoản sinh viên.');
        }

        $student = auth()->user()->student;
        
        if (!$student) {
            return redirect()->back()->with('error', 'Không tìm thấy hồ sơ sinh viên.');
        }

        $grades = LearningProgress::with(['class.course', 'class.teacher.user'])
            ->where('studentid', $student->studentid)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.student-grades', compact('grades'));
    }
}
