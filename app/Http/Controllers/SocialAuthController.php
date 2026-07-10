<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Chuyển hướng người dùng sang trang đăng nhập của Google
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Xử lý phản hồi từ Google sau khi đăng nhập
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Tìm user theo google_id hoặc email
            $user = User::where('google_id', $googleUser->id)->orWhere('email', $googleUser->email)->first();

            if ($user) {
                // Nếu user đã tồn tại bằng email nhưng chưa có google_id thì cập nhật
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->id]);
                }
                
                // Kiểm tra khóa tài khoản
                if ($user->is_locked) {
                    return redirect('/login')->withErrors(['err' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.']);
                }

                Auth::login($user);
            } else {
                // Nếu user chưa tồn tại, tạo mới
                $user = User::create([
                    'fullname' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Str::random(24)), // Tạo mật khẩu ngẫu nhiên
                    'role' => 'user',
                ]);
                
                Auth::login($user);
            }

            // Kiểm tra role để chuyển hướng cho phù hợp
            if ($user->role === 'admin' || $user->role === 'consultant') {
                return redirect()->intended('/dashboard')->with('success', 'Đăng nhập thành công');
            }

            return redirect()->intended('/')->with('success', 'Đăng nhập thành công');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['err' => 'Đăng nhập bằng Google thất bại: ' . $e->getMessage()]);
        }
    }
}
