<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Course;
use App\Models\Payment;
use App\Models\RegistrationCourse;
use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class PageController
 * Xử lý trang hiển thị trên website
 */
class PageController extends Controller
{
    // ... rest of the methods
    public function home() {
        $courses = Course::whereIn('status', ['active', 'Active'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $feedbacks = Feedback::with(['student.user', 'course'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('pages.home', compact('courses', 'feedbacks'));
    }

    public function dashboard() {
        $totalStudents = Student::count();
        $activeCourses = Course::where('status', 'Active')->count();
        $monthlyRevenue = Payment::where('status', 'Success')
            ->whereMonth('paymentdate', Carbon::now()->month)
            ->whereYear('paymentdate', Carbon::now()->year)
            ->sum('amount');
        $pendingRegistrations = RegistrationCourse::where('status', 'pending')->count();

        // Thống kê đăng ký trong 6 tháng gần nhất
        $trends = RegistrationCourse::select(
            DB::raw('MONTH(registration_date) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->where('registration_date', '>=', Carbon::now()->subMonths(6))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $labels = [];
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M');
            $found = $trends->firstWhere('month', $month->month);
            $data[] = $found ? $found->count : 0;
        }

        // Hoạt động gần đây
        $recentRegistrations = RegistrationCourse::with('student')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function($reg) {
                return [
                    'type' => 'registration',
                    'title' => 'New student registration',
                    'desc' => ($reg->student->fullname ?? 'Unknown') . ' registered for a course',
                    'time' => $reg->created_at->diffForHumans(),
                    'icon' => 'person_add',
                    'color' => 'secondary'
                ];
            });

        $recentPayments = Payment::orderBy('created_at', 'desc')
            ->take(2)
            ->get()
            ->map(function($pay) {
                return [
                    'type' => 'payment',
                    'title' => 'Payment received',
                    'desc' => 'Invoice #' . $pay->paymentid . ' confirmed',
                    'time' => $pay->created_at->diffForHumans(),
                    'icon' => 'payments',
                    'color' => 'tertiary'
                ];
            });

        $activities = $recentRegistrations->concat($recentPayments)->sortByDesc('time')->values();

        return view('admin.index', compact(
            'totalStudents', 
            'activeCourses', 
            'monthlyRevenue', 
            'pendingRegistrations',
            'labels',
            'data',
            'activities'
        ));
    }

    public function login() {
        return view('auth.login');
    }
}

