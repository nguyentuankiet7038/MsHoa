@extends('layouts.dashboard')

@section('title', 'Chỉnh sửa giáo viên')

@section('contentdashboard')
<div class="p-8">
    <div class="mb-10">
        <a href="{{ route('admin.teachers.index') }}" class="flex items-center gap-2 text-primary font-bold mb-4 hover:underline">
            <span class="material-symbols-outlined">arrow_back</span>
            Quay lại danh sách giáo viên
        </a>
        <h1 class="text-3xl font-black text-on-surface">Chỉnh sửa giáo viên</h1>
        <p class="text-on-surface/70 mt-1">Cập nhật hồ sơ giáo viên và chi tiết tài khoản.</p>
    </div>

    <div class="max-w-4xl bg-white border border-outline-variant rounded-3xl p-8 shadow-sm">
        <form action="{{ route('admin.teachers.update', $teacher->teacherid) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Họ và tên</label>
                    <input type="text" name="fullname" required value="{{ old('fullname', $teacher->user->fullname) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Nhập họ tên giáo viên">
                    @error('fullname') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Địa chỉ Email</label>
                    <input type="email" name="email" required value="{{ old('email', $teacher->user->email) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="email@example.com">
                    @error('email') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Mật khẩu (để trống nếu giữ nguyên)</label>
                    <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Tối thiểu 6 ký tự">
                    @error('password') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Số điện thoại</label>
                    <input type="text" name="phone" value="{{ old('phone', $teacher->user->phone) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Nhập số điện thoại">
                    @error('phone') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Chuyên môn</label>
                    <input type="text" name="specialy" required value="{{ old('specialy', $teacher->specialy) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="vd: IELTS, TOEIC">
                    @error('specialy') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface">Bằng cấp</label>
                    <input type="text" name="qualification" required value="{{ old('qualification', $teacher->qualification) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="vd: Thạc sĩ tiếng Anh">
                    @error('qualification') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2 space-y-2">
                    <label class="text-sm font-bold text-on-surface">Kinh nghiệm / Tiểu sử</label>
                    <textarea name="expertise" required rows="4" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Nhập chi tiết kinh nghiệm và tiểu sử ngắn">{{ old('expertise', $teacher->expertise) }}</textarea>
                    @error('expertise') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-4 flex justify-end gap-4">
                <a href="{{ route('admin.teachers.index') }}" class="px-8 py-4 border border-outline-variant text-on-surface/70 rounded-xl font-bold hover:bg-surface transition-all">Hủy</a>
                <button type="submit" class="px-8 py-4 bg-primary text-on-primary rounded-xl font-bold shadow-lg hover:brightness-110 transition-all active:scale-[0.98]">Cập nhật giáo viên</button>
            </div>
        </form>
    </div>
</div>
@endsection
