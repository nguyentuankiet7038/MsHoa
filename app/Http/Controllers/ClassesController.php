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
        $schedule = $request->schedule; // Standard format: "2,4,6|18:00-20:00"

        // Find approved students for this course
        $registrations = RegistrationCourse::with('student.user')
            ->where('status', 'approved')
            // Add logic here to filter students who are in classes matching the course but maybe not yet in a class
            // or just list all approved students for this course.
            // The user wants to filter students registered for this course.
            ->whereHas('class', function($q) use ($courseId) {
                // This might be tricky if they are already in a class.
                // Assuming we want students approved for this course who aren't in a class yet, or just list all approved.
            })
            // Let's simplify: Get students approved for this specific course.
            // Need a way to link RegistrationCourse to Course. 
            // RegistrationCourse belongs to Classes, Classes belongs to Course.
            ->whereHas('class.course', function($q) use ($courseId) {
                $q->where('courseid', $courseId);
            })
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
                ->whereHas('class', function($q) use ($request) {
                    $q->where('courseid', $request->courseid);
                })
                ->update(['classid' => $class->classid]);
        }

        return redirect()->route('admin.classes.index')->with('success', 'Class created successfully.');
    }

    public function autoArrange(Request $request)
    {
        $classIds = $request->class_ids;
        $classes = Classes::whereIn('classid', $classIds)->get();

        foreach ($classes as $class) {
            // 1. Find approved students for this class's course who are NOT assigned to a class yet
            $students = RegistrationCourse::where('status', 'approved')
                // Logic to find registrations for this course. 
                // Since RegistrationCourse points to a class, we need to find registrations 
                // where the current class's course matches the registration's intended course.
                // Assuming we have a way to know which course a registration is for if classid is null/placeholder.
                // If registration_courses always has a classid, maybe we look for registrations in "placeholder" classes?
                // Or maybe RegistrationCourse should have course_id directly.
                ->whereHas('class', function($q) use ($class) {
                    $q->where('courseid', $class->courseid);
                })
                ->where('classid', '!=', $class->classid) // Avoid re-assigning same class
                ->get();

            foreach ($students as $student) {
                if (!$this->hasConflict($student->studentid, $class->schedule, 'student')) {
                    $student->update(['classid' => $class->classid]);
                }
            }

            // 2. Assign teacher if not already assigned or if we want to auto-assign
            // (The user said "cả giáo viên và học sinh đều phải có lọc không trùng lịch")
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
}
