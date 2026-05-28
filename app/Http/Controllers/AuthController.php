<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
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
        ]
        );


        User::create([
            'fullName' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone
        ]);

        //Auth::login($user); tự động đăng nhập

        return redirect('/login');
    }
}
