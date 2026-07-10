<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('fullname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role') && $request->input('role') !== 'All') {
            $query->where('role', $request->input('role'));
        }

        // Filter by status (locked/unlocked)
        if ($request->filled('status') && $request->input('status') !== 'All') {
            $is_locked = $request->input('status') === 'Locked' ? 1 : 0;
            $query->where('is_locked', $is_locked);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        // Stats
        $stats = [
            'total' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'teachers' => User::where('role', 'teacher')->count(),
            'students' => User::where('role', 'student')->count(),
            'locked' => User::where('is_locked', 1)->count(),
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,consultant,teacher,student,user',
            'phone' => 'nullable|string|max:20',
            'is_locked' => 'boolean'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['is_locked'] = $request->has('is_locked') ? 1 : 0;

        User::create($data);

        // --- Gửi thông báo cho Admin ---
        $admins = User::where('role', 'admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification([
            'title' => 'Người dùng mới',
            'message' => 'Tài khoản ' . $data['email'] . ' vừa được thêm vào hệ thống.',
            'type' => 'success',
            'action_by' => auth()->user()->email ?? 'Hệ thống',
            'link' => route('admin.users.index')
        ]));

        return redirect()->route('admin.users.index')->with('success', 'Đã thêm người dùng mới thành công.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id.',userid',
            'role' => 'required|in:admin,consultant,teacher,student,user',
            'phone' => 'nullable|string|max:20',
            'is_locked' => 'boolean'
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $request->validate($rules);

        $user->email = $request->fullname;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->phone = $request->phone;
        $user->is_locked = $request->has('is_locked') ? 1 : 0;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // --- Gửi thông báo cho Admin ---
        $admins = User::where('role', 'admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification([
            'title' => 'Cập nhật người dùng',
            'message' => 'Tài khoản ' . $user->email . ' vừa được cập nhật.',
            'type' => 'warning',
            'action_by' => auth()->user()->email ?? 'Hệ thống',
            'link' => route('admin.users.index')
        ]));

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật thông tin người dùng thành công.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting yourself
        if (auth()->id() == $user->userid) {
            return redirect()->route('admin.users.index')->withErrors(['err' => 'Bạn không thể xóa chính mình.']);
        }

        $emailDeleted = $user->email;
        $user->delete();

        // --- Gửi thông báo cho Admin ---
        $admins = User::where('role', 'admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification([
            'title' => 'Xóa người dùng',
            'message' => 'Tài khoản ' . $emailDeleted . ' đã bị xóa khỏi hệ thống.',
            'type' => 'danger',
            'action_by' => auth()->user()->email ?? 'Hệ thống',
            'link' => route('admin.users.index')
        ]));

        return redirect()->route('admin.users.index')->with('success', 'Đã xóa người dùng thành công.');
    }
}
