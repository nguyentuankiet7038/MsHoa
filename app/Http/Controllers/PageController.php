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

        // Hoạt động gần đây lấy từ bảng Notifications của người dùng hiện tại
        $activities = auth()->check() ? auth()->user()->notifications()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function($notif) {
                $type = $notif->data['type'] ?? 'info';
                
                // Ánh xạ màu sắc sang các class bento UI có sẵn (primary, secondary, tertiary, error)
                $colorMap = [
                    'success' => 'secondary',
                    'danger' => 'error',
                    'warning' => 'tertiary',
                    'info' => 'primary'
                ];
                
                // Ánh xạ icon
                $iconMap = [
                    'success' => 'check_circle',
                    'danger' => 'delete',
                    'warning' => 'edit',
                    'info' => 'notifications'
                ];

                return [
                    'type' => 'notification',
                    'title' => $notif->data['title'] ?? 'Thông báo',
                    'desc' => $notif->data['message'] ?? '',
                    'time' => $notif->created_at->diffForHumans(),
                    'icon' => $iconMap[$type] ?? 'notifications',
                    'color' => $colorMap[$type] ?? 'primary'
                ];
            }) : collect();

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

