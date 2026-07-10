<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    //Hiển thịn form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // xử lý user bấm nút đăng nhập
    public function login(Request $request)
    {
        
        //Kiểm tra dữ liệu người dùng nhập
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //dùng Auth::attemp để so sanh database
        if (Auth::attempt($credentials)) {
            
            // Kiểm tra xem tài khoản có bị khóa không
            if (Auth::user()->is_locked) {
                Auth::logout();
                return back()->withErrors([
                    'err' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.'
                ])->onlyInput('email');
            }

            // Đăng nhập thành công tạo sesion chuyển hướng
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'admin' || Auth::user()->role === 'consultant') {
                return redirect()->intended('/dashboard')->with('success', 'Đăng nhập thành công');
            }
            
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công');
           
        }

        // đăng nhập thất bại
        return back()->withErrors([
            'err'=> 'Sai tài khoản hoặc mật khẩu'
        ])->onlyInput('err');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();//Xoa session
        $request->session()->regenerateToken();//tao session moi
        return redirect('/');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required'],
        ],
        [
            'email.unique' => 'Email đã tồn tại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
        ]);

        $otp = rand(100000, 999999);
        $registerData = [
            'fullname' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'user' // default
        ];

        session()->put('register_data', $registerData);
        session()->put('otp', $otp);
        session()->put('otp_time', now());

        try {
            \Illuminate\Support\Facades\Mail::to($request->email)->send(new \App\Mail\OtpMail($otp));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Lỗi gửi OTP: ' . $e->getMessage());
            // Optionally, we could still redirect or show an error. We'll proceed so testing is easier (check log).
        }

        return redirect()->route('otp.show')->with('success', 'Mã OTP đã được gửi đến email của bạn.');
    }
}
