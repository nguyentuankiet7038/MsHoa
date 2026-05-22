<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //

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
            // Đăng nhập thành công tạo sesion chuyển hướng
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công');
        }

        // đăng nhập thất bại
        return back()->with([
            'email', 'Sai tài khoản hoặc mật khẩu'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();//Xoa session
        $request->session()->regenerateToken();//tao session moi
        return redirect('/');
    }
}
