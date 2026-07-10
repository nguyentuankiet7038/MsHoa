<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\RegistrationCourse;

class PaymentController extends Controller
{
    public function index(Request $request) {
        $query = Payment::with(['registration.student', 'registration.class.course']);

        // Filtering
        if ($request->has('search') && $request->search != '') {
            $query->where('paymentid', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != 'Tất cả') {
            $statusMap = [
                'Đã thanh toán' => 'Success',
                'Chưa thanh toán' => 'failed',
                'Đang xử lý' => 'pending'
            ];
            if (isset($statusMap[$request->status])) {
                $query->where('status', $statusMap[$request->status]);
            }
        }

        if ($request->has('date') && $request->date != '') {
            $query->whereDate('paymentdate', $request->date);
        }

        $payments = $query->latest()->paginate(10)->withQueryString();
        return view('admin.payment.index', compact('payments'));
    }

    public function create() {
        $registrations = RegistrationCourse::with(['student', 'class.course'])->get();
        return view('admin.payment.create', compact('registrations'));
    }

    public function store(Request $request) {
        $request->validate([
            'registrationid' => 'required|exists:registration_courses,registrationid',
            'amount' => 'required|numeric',
            'paymentmethod' => 'required|string',
            'paymentdate' => 'required|date',
            'status' => 'required|in:Success,failed,pending',
        ]);

        $payment = Payment::create($request->all());

        // --- Gửi thông báo ---
        $registration = RegistrationCourse::with('student.user')->find($request->registrationid);
        if ($registration && $registration->student && $registration->student->user) {
            // Cho học viên
            \Illuminate\Support\Facades\Notification::send($registration->student->user, new \App\Notifications\SystemNotification([
                'title' => 'Thông tin thanh toán',
                'message' => 'Bạn có một hóa đơn mới với số tiền ' . number_format($request->amount) . ' VNĐ. Trạng thái: ' . $request->status,
                'type' => 'info',
                'action_by' => auth()->user()->email ?? 'Hệ thống'
            ]));
        }

        // Cho Admin CRUD
        $admins = \App\Models\User::where('role', 'admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification([
            'title' => 'Thêm Hóa đơn',
            'message' => 'Hóa đơn thanh toán mới đã được tạo.',
            'type' => 'success',
            'action_by' => auth()->user()->email ?? 'Hệ thống',
            'link' => route('payment.admin')
        ]));

        return redirect()->route('payment.admin')->with('success', 'Hóa đơn đã được tạo thành công.');
    }

    public function show($id) {
        $payment = Payment::with(['registration.student', 'registration.class.course'])->findOrFail($id);
        return view('admin.payment.show', compact('payment'));
    }

    public function exportCSV() {
        $payments = Payment::with(['registration.student', 'registration.class.course'])->get();
        $filename = "payments_" . date('Y-m-d') . ".csv";
        $handle = fopen('php://output', 'w');
        
        // Add UTF-8 BOM for Excel to recognize Vietnamese characters
        fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        fputcsv($handle, ['ID', 'Registration ID', 'Học viên', 'Phụ huynh', 'Dịch vụ', 'Số tiền', 'Phương thức', 'Ngày thanh toán', 'Trạng thái']);

        foreach ($payments as $p) {
            fputcsv($handle, [
                $p->paymentid,
                $p->registrationid,
                $p->registration->student->studentname ?? 'N/A',
                $p->registration->student->parentname ?? 'N/A',
                $p->registration->class->course->coursename ?? 'N/A',
                $p->amount,
                $p->paymentmethod,
                $p->paymentdate->format('Y-m-d H:i:s'),
                $p->status
            ]);
        }

        fclose($handle);
        exit;
    }
}
