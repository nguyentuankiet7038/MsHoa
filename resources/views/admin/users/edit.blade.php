@extends('layouts.dashboard')

@section('title', 'Chỉnh sửa người dùng')

@section('contentdashboard')
<div class="p-8">
    <div class="mb-8">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-primary hover:underline font-medium mb-4">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Quay lại danh sách
        </a>
        <h1 class="text-3xl font-headline font-black text-on-surface">Chỉnh sửa người dùng</h1>
        <p class="text-on-surface-variant mt-1">Cập nhật thông tin, thay đổi quyền hoặc mật khẩu của <b>{{ $user->fullname }}</b>.</p>
    </div>

    @if($errors->any())
        <div class="mb-6 bg-red-100 text-red-700 p-4 rounded-xl font-bold">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-surface-container-lowest border border-outline-variant rounded-3xl p-6 shadow-sm max-w-3xl">
        <form action="{{ route('admin.users.update', $user->userid) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Họ tên -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Họ và tên <span class="text-error">*</span></label>
                    <input type="text" name="fullname" value="{{ old('fullname', $user->fullname) }}" required class="w-full rounded-xl border-outline-variant bg-surface px-4 py-3 focus:ring-primary focus:border-primary">
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Email <span class="text-error">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-xl border-outline-variant bg-surface px-4 py-3 focus:ring-primary focus:border-primary">
                </div>

                <!-- Mật khẩu -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Mật khẩu mới (Nếu có)</label>
                    <input type="password" name="password" minlength="6" placeholder="Để trống nếu không muốn đổi" class="w-full rounded-xl border-outline-variant bg-surface px-4 py-3 focus:ring-primary focus:border-primary">
                    <p class="text-xs text-on-surface-variant">Để trống nếu muốn giữ nguyên mật khẩu cũ</p>
                </div>

                <!-- Số điện thoại -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Số điện thoại</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full rounded-xl border-outline-variant bg-surface px-4 py-3 focus:ring-primary focus:border-primary">
                </div>

                <!-- Phân quyền -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Quyền hạn (Role) <span class="text-error">*</span></label>
                    <select name="role" required class="w-full rounded-xl border-outline-variant bg-surface px-4 py-3 focus:ring-primary focus:border-primary" {{ auth()->id() == $user->userid ? 'disabled' : '' }}>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User (Mặc định)</option>
                        <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Học viên</option>
                        <option value="teacher" {{ old('role', $user->role) == 'teacher' ? 'selected' : '' }}>Giáo viên</option>
                        <option value="consultant" {{ old('role', $user->role) == 'consultant' ? 'selected' : '' }}>Tư vấn viên</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @if(auth()->id() == $user->userid)
                        <input type="hidden" name="role" value="{{ $user->role }}">
                        <p class="text-xs text-on-surface-variant mt-1">Bạn không thể tự đổi quyền của chính mình.</p>
                    @endif
                </div>

                <!-- Khóa tài khoản -->
                <div class="space-y-2 flex flex-col justify-center">
                    <label class="flex items-center gap-3 cursor-pointer {{ auth()->id() == $user->userid ? 'opacity-50 pointer-events-none' : '' }}">
                        <input type="checkbox" name="is_locked" value="1" {{ old('is_locked', $user->is_locked) ? 'checked' : '' }} class="w-5 h-5 rounded text-error focus:ring-error border-outline-variant">
                        <span class="font-bold text-on-surface">Khóa tài khoản (Cấm đăng nhập)</span>
                    </label>
                    @if(auth()->id() == $user->userid)
                        <input type="hidden" name="is_locked" value="0">
                        <p class="text-xs text-on-surface-variant mt-1">Bạn không thể tự khóa chính mình.</p>
                    @endif
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-outline-variant gap-4">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 rounded-xl border border-outline-variant text-on-surface-variant font-bold hover:bg-surface-container transition-colors">Hủy bỏ</a>
                <button type="submit" class="px-6 py-3 bg-[#00C2CB] text-white rounded-xl font-bold shadow-lg hover:brightness-105 transition-all">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>
@endsection
