<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrationCourse;
use App\Models\Feedback;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Hiển thị danh sách khóa học của học viên
     */
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            // Nếu chưa có hồ sơ học viên, trả về view rỗng hoặc báo lỗi
            return view('pages.student.course_history', ['registrations' => []]);
        }

        // Lấy tất cả các lớp học đã đăng ký và được duyệt
        $registrations = RegistrationCourse::with(['class.course'])
            ->where('studentid', $student->studentid)
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->get();

        // Lấy danh sách feedback của học viên này để kiểm tra lớp nào đã đánh giá
        $feedbackClassIds = Feedback::where('studentid', $student->studentid)
                                    ->pluck('classid')
                                    ->toArray();

        return view('pages.student.course_history', compact('registrations', 'feedbackClassIds'));
    }

    /**
     * Hiển thị form đánh giá
     */
    public function create($classid)
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            return redirect()->route('student.courses')->withErrors(['err' => 'Bạn không có quyền thực hiện hành động này.']);
        }

        // Kiểm tra xem học viên có đăng ký lớp này không
        $registration = RegistrationCourse::with(['class.course'])
            ->where('studentid', $student->studentid)
            ->where('classid', $classid)
            ->where('status', 'approved')
            ->first();

        if (!$registration) {
            return redirect()->route('student.courses')->withErrors(['err' => 'Không tìm thấy lớp học trong danh sách của bạn.']);
        }

        $class = $registration->class;

        // Kiểm tra xem lớp đã kết thúc chưa
        if (now()->startOfDay() <= \Carbon\Carbon::parse($class->end_date)->startOfDay()) {
            return redirect()->route('student.courses')->withErrors(['err' => 'Lớp học này chưa kết thúc, không thể đánh giá.']);
        }

        // Kiểm tra xem đã quá 30 ngày chưa
        if (now()->diffInDays(\Carbon\Carbon::parse($class->end_date)) > 30) {
            return redirect()->route('student.courses')->withErrors(['err' => 'Đã quá thời hạn 30 ngày để đánh giá lớp học này.']);
        }

        // Kiểm tra xem đã đánh giá chưa
        $existingFeedback = Feedback::where('studentid', $student->studentid)
                                    ->where('classid', $classid)
                                    ->first();

        if ($existingFeedback) {
            return redirect()->route('student.courses')->withErrors(['err' => 'Bạn đã gửi đánh giá cho lớp học này rồi.']);
        }

        return view('pages.student.feedback_form', compact('class'));
    }

    /**
     * Lưu đánh giá
     */
    public function store(Request $request, $classid)
    {
        $request->validate([
            'ratingscore' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            return redirect()->route('student.courses')->withErrors(['err' => 'Bạn không có quyền thực hiện hành động này.']);
        }

        // Các kiểm tra tương tự form create
        $registration = RegistrationCourse::where('studentid', $student->studentid)
            ->where('classid', $classid)
            ->where('status', 'approved')
            ->first();

        if (!$registration) {
            return redirect()->route('student.courses')->withErrors(['err' => 'Không hợp lệ.']);
        }

        $class = Classes::findOrFail($classid);

        if (now()->startOfDay() <= \Carbon\Carbon::parse($class->end_date)->startOfDay() || now()->diffInDays(\Carbon\Carbon::parse($class->end_date)) > 30) {
            return redirect()->route('student.courses')->withErrors(['err' => 'Lớp học không trong thời gian cho phép đánh giá.']);
        }

        $existingFeedback = Feedback::where('studentid', $student->studentid)
                                    ->where('classid', $classid)
                                    ->first();

        if ($existingFeedback) {
            return redirect()->route('student.courses')->withErrors(['err' => 'Bạn đã đánh giá lớp học này.']);
        }

        // Lưu feedback
        Feedback::create([
            'studentid' => $student->studentid,
            'courseid' => $class->courseid,
            'classid' => $classid,
            'ratingscore' => $request->ratingscore,
            'comment' => $request->comment ?? '',
        ]);

        return redirect()->route('student.courses')->with('success', 'Cảm ơn bạn đã gửi đánh giá! Phản hồi của bạn sẽ giúp trung tâm cải thiện chất lượng tốt hơn.');
    }
}
