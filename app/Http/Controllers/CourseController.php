<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{   
    public function index(Request $request) {
        $query = Course::query(); // Show all courses to see 11 records

        // Filter by category (search in name for simplicity)
        if ($request->has('category') && $request->category != 'Tất cả') {
            $query->where('level', 'like', '%' . $request->category . '%');
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $courses = $query->paginate(12)->withQueryString();
        return view('pages.courses', compact('courses'));
    }

    public function show($id) {
        $course = Course::findOrFail($id);
        return view('pages.course-detail', compact('course'));
    }

    public function admincourses(Request $request) {
        $query = Course::query();

        // Filtering
        if ($request->has('search') && $request->search != '') {
            $query->where('coursename', 'like', '%' . $request->search . '%');
        }

        if ($request->has('level') && $request->level != 'All') {
            $query->where('level', $request->level);
        }

        if ($request->has('status') && $request->status != 'All') {
            $query->where('status', $request->status);
        }

        $courses = $query->paginate(10)->withQueryString();

        // Statistics
        $stats = [
            'total' => Course::count(),
            'active' => Course::where('status', 'Active')->count(),
            'toeic' => Course::where('coursename', 'like', '%TOEIC%')->count(),
            'ielts' => Course::where('coursename', 'like', '%IELTS%')->count(),
        ];

        return view('admin.courses.courses', compact('courses', 'stats'));
    }

    public function create() {
        return view('admin.courses.create');
    }

    public function store(Request $request) {
        $request->validate([
            'coursename' => 'required',
            'description' => 'required',
            'level' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = 'images/'.$imageName;
        } else {
            $data['image'] = 'images/cousedefault.png';
        }

        Course::create($data);

        return redirect()->route('admin.courses')->with('success', 'Course created successfully.');
    }

    public function edit($id) {
        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, $id) {
        $course = Course::findOrFail($id);

        $request->validate([
            'coursename' => 'required',
            'description' => 'required',
            'level' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = 'images/'.$imageName;
        }

        $course->update($data);

        return redirect()->route('admin.courses')->with('success', 'Course updated successfully.');
    }

    public function destroy($id) {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.courses')->with('success', 'Course deleted successfully.');
    }
}
