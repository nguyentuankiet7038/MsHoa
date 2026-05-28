<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{   
    public function index() {
        $courses = Course::paginate(10);
        return view('pages.courses', compact('courses'));
    }
    //
    public function show($id) {
        $course= Course::findOrFail($id);
        return view('pages.course-detail', compact('course'));
    }
}
