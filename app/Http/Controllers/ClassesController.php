<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\RegistrationCourse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = Classes::with(['course', 'teacher.user'])->paginate(10);
        return view('admin.classes.index', compact('classes'));
    }

    public function show($id)
    {
        $class = Classes::with(['teacher.user', 'course', 'registrations.student.user'])->findOrFail($id);
        
        // Sort students alphabetically by user fullname
        $registrations = $class->registrations->sortBy(function($reg) {
            return $reg->student->user->fullname ?? '';
        });

        return view('admin.classes.show', compact('class', 'registrations'));
    }

    public function exportExcel($id)
    {
        $class = Classes::with(['teacher.user', 'registrations.student.user'])->findOrFail($id);
        $registrations = $class->registrations->sortBy(function($reg) {
            return $reg->student->user->fullname ?? '';
        });

        $fileName = 'danh-sach-lop-' . \Str::slug($class->classname) . '.csv';
        
        $headers = array(
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('STT', 'Ho va Ten', 'Ngay sinh', 'Phu huynh', 'Dien thoai', 'Ghi chu');

        $callback = function() use($registrations, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // BOM for UTF-8 Excel
            fputcsv($file, $columns);

            $i = 1;
            foreach ($registrations as $reg) {
                $row['STT'] = $i++;
                $row['Ho va Ten'] = $reg->student->user->fullname ?? 'N/A';
                $row['Ngay sinh'] = $reg->student->dateofbirth ?? 'N/A';
                $row['Phu huynh'] = $reg->student->parentname ?? 'N/A';
                $row['Dien thoai'] = $reg->student->user->phone ?? ($reg->student->parentphone ?? 'N/A');
                $row['Ghi chu'] = $reg->student->user->notes ?? '';

                fputcsv($file, array($row['STT'], $row['Ho va Ten'], $row['Ngay sinh'], $row['Phu huynh'], $row['Dien thoai'], $row['Ghi chu']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.classes.create', compact('courses'));
    }

    public function getAvailableStudents(Request $request)
    {
        $courseId = $request->course_id;

        // Find approved students for this course who are not yet in a class
        $registrations = RegistrationCourse::with('student.user')
            ->where('status', 'approved')
            ->where('courseid', $courseId)
            ->whereNull('classid')
            ->get();

        return response()->json($registrations);
    }

    public function getAvailableTeachers(Request $request)
    {
        $qualification = $request->qualification;
        $expertise = $request->expertise;

        $query = Teacher::with('user');

        if ($qualification) {
            $query->where('qualification', 'like', '%' . $qualification . '%');
        }
        if ($expertise) {
            $query->where('expertise', 'like', '%' . $expertise . '%');
        }

        $teachers = $query->get();
        return response()->json($teachers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'classname' => 'required',
            'courseid' => 'required',
            'teacherid' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'schedule' => 'required',
        ]);

        $class = Classes::create($request->only([
            'classname', 'courseid', 'teacherid', 'start_date', 'end_date', 'schedule'
        ]));

        if ($request->has('student_ids')) {
            RegistrationCourse::whereIn('studentid', $request->student_ids)
                ->where('courseid', $request->courseid)
                ->update(['classid' => $class->classid]);
        }

        // --- Gửi thông báo ---
        // Cho Giáo viên
        $teacher = Teacher::with('user')->find($request->teacherid);
        if ($teacher && $teacher->user) {
            \Illuminate\Support\Facades\Notification::send($teacher->user, new \App\Notifications\SystemNotification([
                'title' => 'Lịch dạy mới',
                'message' => 'Bạn vừa được phân công dạy lớp: ' . $request->classname,
                'type' => 'info',
                'action_by' => auth()->user()->email ?? 'Hệ thống'
            ]));
        }

        // Cho Admin CRUD
        $admins = \App\Models\User::where('role', 'admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification([
            'title' => 'Thêm Lớp học',
            'message' => 'Lớp học "' . $request->classname . '" vừa được thêm.',
            'type' => 'success',
            'action_by' => auth()->user()->email ?? 'Hệ thống',
            'link' => route('admin.classes.index')
        ]));

        return redirect()->route('admin.classes.index')->with('success', 'Class created successfully.');
    }

    public function autoArrange(Request $request)
    {
        $classIds = $request->class_ids;
        $classes = Classes::whereIn('classid', $classIds)->get();

        foreach ($classes as $class) {
            // 1. Find approved students for this class's course who are NOT assigned to a class yet
            $students = RegistrationCourse::where('status', 'approved')
                ->where('courseid', $class->courseid)
                ->whereNull('classid')
                ->get();

            foreach ($students as $student) {
                if (!$this->hasConflict($student->studentid, $class->schedule, 'student')) {
                    $student->update(['classid' => $class->classid]);
                }
            }
        }

        return response()->json(['success' => true]);
    }

    private function hasConflict($id, $newSchedule, $type)
    {
        // $newSchedule format: "2,4,6|18:00-20:00"
        // This is a placeholder for the actual conflict checking logic.
        // It would involve checking all classes the student/teacher is already in.
        return false; 
    }

    public function edit($id)
    {
        $class = Classes::with(['course', 'teacher.user', 'registrations.student.user'])->findOrFail($id);
        $courses = Course::all();
        return view('admin.classes.edit', compact('class', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'classname' => 'required',
            'courseid' => 'required',
            'teacherid' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'schedule' => 'required',
        ]);

        $class = Classes::findOrFail($id);
        $class->update($request->only([
            'classname', 'courseid', 'teacherid', 'start_date', 'end_date', 'schedule'
        ]));

        // Gỡ học sinh khỏi lớp
        if ($request->has('remove_student_ids')) {
            RegistrationCourse::whereIn('studentid', $request->remove_student_ids)
                ->where('classid', $id)
                ->update(['classid' => null]);
        }

        // Thêm học sinh mới vào lớp
        if ($request->has('add_student_ids')) {
            RegistrationCourse::whereIn('studentid', $request->add_student_ids)
                ->where('courseid', $request->courseid)
                ->update(['classid' => $id]);
        }

        // --- Gửi thông báo cho Admin CRUD ---
        $admins = \App\Models\User::where('role', 'admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification([
            'title' => 'Cập nhật Lớp học',
            'message' => 'Lớp học "' . $request->classname . '" vừa được cập nhật.',
            'type' => 'warning',
            'action_by' => auth()->user()->email ?? 'Hệ thống',
            'link' => route('admin.classes.index')
        ]));

        return redirect()->route('admin.classes.index')->with('success', 'Cập nhật thông tin lớp học thành công.');
    }

    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        
        // Trả học sinh về trạng thái chưa xếp lớp
        RegistrationCourse::where('classid', $id)->update(['classid' => null]);
        
        $className = $class->classname;
        // Xóa lớp
        $class->delete();

        // --- Gửi thông báo cho Admin CRUD ---
        $admins = \App\Models\User::where('role', 'admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification([
            'title' => 'Xóa Lớp học',
            'message' => 'Lớp học "' . $className . '" đã bị xóa.',
            'type' => 'danger',
            'action_by' => auth()->user()->email ?? 'Hệ thống',
            'link' => route('admin.classes.index')
        ]));

        return redirect()->route('admin.classes.index')->with('success', 'Xóa lớp học thành công.');
    }
}
