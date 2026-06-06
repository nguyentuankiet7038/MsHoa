<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'nullable|string',
            'dateofbirth' => 'required|date',
            'gender' => 'required',
            'address' => 'required',
            'parentname' => 'required',
            'parentphone' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'phone' => $request->phone,
            ]);

            Student::create([
                'studentname' => $request->fullname,
                'userid' => $user->userid,
                'dateofbirth' => $request->dateofbirth,
                'gender' => $request->gender,
                'address' => $request->address,
                'parentname' => $request->parentname,
                'parentphone' => $request->parentphone,
            ]);

            DB::commit();
            return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error creating student: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $user = $student->user;

        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->userid . ',userid',
            'phone' => 'nullable|string',
            'dateofbirth' => 'required|date',
            'gender' => 'required',
            'address' => 'required',
            'parentname' => 'required',
            'parentphone' => 'required',
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

            $student->update([
                'studentname' => $request->fullname,
                'dateofbirth' => $request->dateofbirth,
                'gender' => $request->gender,
                'address' => $request->address,
                'parentname' => $request->parentname,
                'parentphone' => $request->parentphone,
            ]);

            DB::commit();
            return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error updating student: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $user = $student->user;

        DB::beginTransaction();
        try {
            $student->delete();
            $user->delete();
            DB::commit();
            return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error deleting student: ' . $e->getMessage());
        }
    }
}
