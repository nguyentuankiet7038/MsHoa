<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class PageController
 * Xử lý trang hiển thị trên website
 */
class PageController extends Controller
{
    //
    public function home() {
        return view('pages.home');
    }

    public function courses() {
        return view('pages.courses');
    }

    public function courseDetail($id) {
        // Tạm thời truyền $id ra view để test, sau này sẽ dùng để query database
        return view('pages.course-detail', compact('id'));
    }

    public function registration($id) {
        return view('pages.registration', compact('id'));
    }

    public function support() {
        return view('pages.support');
    }

    public function dashboard() {
        return view('admin.index');
    }

    public function login() {
        return view('auth.login');
    }
}

