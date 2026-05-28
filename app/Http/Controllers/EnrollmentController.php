<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    //
    public function enrollmentCourse(Request $request, $id){
        $user = Auth::user();
        $user->courses()->attach($id);
        return redirect()->route('courses.show', $id);
    }
}
