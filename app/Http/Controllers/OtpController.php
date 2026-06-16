<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Log;

class OtpController extends Controller
{
    public function show()
    {
        if (!session()->has('register_data')) {
            return redirect()->route('form.login')->withErrors(['err' => 'Phiên đăng ký đã hết hạn hoặc không tồn tại.']);
        }
        return view('auth.otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        if (!session()->has('register_data') || !session()->has('otp')) {
            return redirect()->route('form.login')->withErrors(['err' => 'Phiên đăng ký đã hết hạn.']);
        }

        $sessionOtp = session('otp');
        $otpTime = session('otp_time');

        // Check if expired (5 minutes = 300 seconds)
        if (now()->diffInSeconds($otpTime) > 300) {
            return back()->withErrors(['otp' => 'Mã OTP đã hết hạn. Vui lòng yêu cầu gửi lại mã mới.']);
        }

        // Check if matches
        if ($request->otp != $sessionOtp) {
            return back()->withErrors(['otp' => 'Mã OTP không chính xác.']);
        }

        // OTP is valid. Create User
        $registerData = session('register_data');
        User::create($registerData);

        // Clear session
        session()->forget(['register_data', 'otp', 'otp_time']);

        return redirect()->route('form.login')->with('success', 'Đăng ký thành công! Bạn có thể đăng nhập ngay.');
    }

    public function resend(Request $request)
    {
        if (!session()->has('register_data')) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy phiên đăng ký.'], 400);
        }

        $otpTime = session('otp_time');

        // Backend Anti-Spam: 20s
        if ($otpTime && now()->diffInSeconds($otpTime) < 20) {
            return response()->json(['success' => false, 'message' => 'Bạn thao tác quá nhanh. Vui lòng chờ vài giây trước khi yêu cầu lại.'], 429);
        }

        // Generate new OTP
        $otp = rand(100000, 999999);
        session()->put('otp', $otp);
        session()->put('otp_time', now());

        $registerData = session('register_data');
        
        try {
            Mail::to($registerData['email'])->send(new OtpMail($otp));
            return response()->json(['success' => true, 'message' => 'Mã OTP mới đã được gửi.']);
        } catch (\Exception $e) {
            Log::error('Lỗi gửi OTP Resend: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Đã có lỗi xảy ra khi gửi email. Vui lòng thử lại sau.'], 500);
        }
    }
}
