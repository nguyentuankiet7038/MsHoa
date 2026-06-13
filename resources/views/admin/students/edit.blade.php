@extends('layouts.dashboard')

@section('title', 'Chỉnh sửa học sinh')

@section('contentdashboard')
<div class="p-8">
    <div class="mb-10">
        <a href="{{ route('admin.students.index') }}" class="flex items-center gap-2 text-primary font-bold mb-4 hover:underline">
            <span class="material-symbols-outlined">arrow_back</span>
            Quay lại danh sách học sinh
        </a>
        <h1 class="text-3xl font-black text-on-surface">Chỉnh sửa học sinh</h1>
        <p class="text-on-surface/70 mt-1">Cập nhật hồ sơ học sinh và chi tiết tài khoản.</p>
    </div>

    <div class="max-w-4xl bg-white border border-outline-variant rounded-3xl p-8 shadow-sm">
        <form action="{{ route('admin.students.update', $student->studentid) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Họ và tên</label>
                    <input type="text" name="fullname" required value="{{ old('fullname', $student->user->fullname) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Nhập họ tên học sinh">
                    @error('fullname') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Địa chỉ Email</label>
                    <input type="email" name="email" required value="{{ old('email', $student->user->email) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="email@example.com">
                    @error('email') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Mật khẩu (để trống nếu giữ nguyên)</label>
                    <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Tối thiểu 6 ký tự">
                    @error('password') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Số điện thoại</label>
                    <input type="text" name="phone" value="{{ old('phone', $student->user->phone) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Nhập số điện thoại">
                    @error('phone') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Ngày sinh</label>
                    <input type="date" name="dateofbirth" required value="{{ old('dateofbirth', $student->dateofbirth) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                    @error('dateofbirth') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Giới tính</label>
                    <select name="gender" required class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <option value="">Chọn giới tính</option>
                        <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Nam</option>
                        <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Nữ</option>
                        <option value="Other" {{ old('gender', $student->gender) == 'Other' ? 'selected' : '' }}>Khác</option>
                    </select>
                    @error('gender') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2 space-y-2">
                    <label class="text-sm font-bold text-on-surface">Địa chỉ</label>
                    <textarea name="address" required rows="2" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Nhập địa chỉ đầy đủ">{{ old('address', $student->address) }}</textarea>
                    @error('address') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Tên phụ huynh/Người giám hộ</label>
                    <input type="text" name="parentname" required value="{{ old('parentname', $student->parentname) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Nhập tên phụ huynh">
                    @error('parentname') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Số điện thoại phụ huynh</label>
                    <input type="text" name="parentphone" required value="{{ old('parentphone', $student->parentphone) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Nhập số điện thoại phụ huynh">
                    @error('parentphone') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-4 flex justify-end gap-4">
                <a href="{{ route('admin.students.index') }}" class="px-8 py-4 border border-outline-variant text-on-surface/70 rounded-xl font-bold hover:bg-surface transition-all">Hủy</a>
                <button type="submit" class="px-8 py-4 bg-primary text-on-primary rounded-xl font-bold shadow-lg hover:brightness-110 transition-all active:scale-[0.98]">Cập nhật học sinh</button>
            </div>
        </form>
    </div>
</div>
@endsection
