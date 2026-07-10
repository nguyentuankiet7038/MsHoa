<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;

        return view('pages.profile', compact('user', 'student'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation rules
        $rules = [
            'fullname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ];

        // If user is a student or is submitting student info
        if ($user->role === 'student' || $request->has('dateofbirth')) {
            $rules = array_merge($rules, [
                'dateofbirth' => 'nullable|date',
                'gender' => 'nullable|in:nam,nữ,khác',
                'address' => 'nullable|string|max:255',
                'parentname' => 'nullable|string|max:255',
                'parentphone' => 'nullable|string|max:20',
            ]);
        }

        $validated = $request->validate($rules);

        // Update User info
        $user->email = $validated['fullname'];
        $user->phone = $validated['phone'] ?? $user->phone;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Update Student info if applicable
        if ($user->role === 'student' || $user->student) {
            $studentData = [
                'dateofbirth' => $validated['dateofbirth'] ?? null,
                'gender' => $validated['gender'] ?? 'khác',
                'address' => $validated['address'] ?? null,
                'parentname' => $validated['parentname'] ?? null,
                'parentphone' => $validated['parentphone'] ?? null,
            ];

            if ($user->student) {
                // Update existing
                $user->student->update($studentData);
            } else {
                // Create new
                // Default student name is the same as fullname initially if not provided
                $studentData['userid'] = $user->userid;
                $studentData['studentname'] = $user->email;
                Student::create($studentData);
            }
        }

        // --- Gửi thông báo ---
        \Illuminate\Support\Facades\Notification::send($user, new \App\Notifications\SystemNotification([
            'title' => 'Cập nhật thành công',
            'message' => 'Hồ sơ cá nhân của bạn đã được cập nhật.',
            'type' => 'success',
            'action_by' => 'Hệ thống',
            'link' => route('profile.index')
        ]));

        return redirect()->route('profile.index')->with('success', 'Hồ sơ cá nhân đã được cập nhật thành công!');
    }
}
