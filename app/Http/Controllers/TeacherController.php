<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'nullable|string',
            'specialy' => 'required',
            'qualification' => 'required',
            'expertise' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'teacher',
                'phone' => $request->phone,
            ]);

            Teacher::create([
                'userid' => $user->userid,
                'specialy' => $request->specialy,
                'qualification' => $request->qualification,
                'expertise' => $request->expertise,
            ]);

            DB::commit();
            return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error creating teacher: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $user = $teacher->user;

        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->userid . ',userid',
            'phone' => 'nullable|string',
            'specialy' => 'required',
            'qualification' => 'required',
            'expertise' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user->update([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if ($request->password) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            $teacher->update([
                'specialy' => $request->specialy,
                'qualification' => $request->qualification,
                'expertise' => $request->expertise,
            ]);

            DB::commit();
            return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error updating teacher: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $user = $teacher->user;

        DB::beginTransaction();
        try {
            $teacher->delete();
            $user->delete();
            DB::commit();
            return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error deleting teacher: ' . $e->getMessage());
        }
    }
}
