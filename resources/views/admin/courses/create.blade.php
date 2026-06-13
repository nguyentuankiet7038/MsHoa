@extends('layouts.dashboard')

@section('title', 'Thêm khóa học mới')

@section('contentdashboard')
<div class="min-h-[calc(100vh-2rem)] flex items-center justify-center p-6">
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-xl overflow-hidden border border-outline-variant">
        <div class="bg-primary p-8 text-on-primary">
            <div class="flex items-center gap-4 mb-2">
                <a href="{{ route('admin.courses') }}" class="p-2 hover:bg-white/10 rounded-full transition-colors">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <h1 class="text-3xl font-black">Thêm khóa học mới</h1>
            </div>
            <p class="text-white/80">Tạo một chương trình học tiếng Anh mới cho học sinh của bạn.</p>
        </div>

        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface/70" for="coursename">Tên khóa học</label>
                    <input type="text" name="coursename" id="coursename" required class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="vd: Khóa học IELTS cấp tốc">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface/70" for="level">Cấp độ</label>
                    <select name="level" id="level" required class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <option value="Beginner">Sơ cấp</option>
                        <option value="Intermediate">Trung cấp</option>
                        <option value="Advanced">Nâng cao</option>
                        <option value="TOEIC">TOEIC</option>
                        <option value="IELTS">IELTS</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-on-surface/70" for="description">Mô tả</label>
                <textarea name="description" id="description" rows="4" required class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Mô tả nội dung và mục tiêu khóa học..."></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface/70" for="price">Học phí (VNĐ)</label>
                    <input type="number" name="price" id="price" required class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="500000">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface/70" for="status">Trạng thái</label>
                    <select name="status" id="status" required class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <option value="Active">Đang hoạt động</option>
                        <option value="Inactive">Ngừng hoạt động</option>
                        <option value="Upcoming">Sắp tới</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-on-surface/70" for="image">Hình ảnh khóa học</label>
                <input type="file" name="image" id="image" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary outline-none" />
            </div>

            <div class="pt-4 flex gap-4">
                <button type="submit" class="flex-1 bg-primary text-on-primary py-4 rounded-xl font-bold shadow-lg hover:brightness-110 transition-all active:scale-[0.98]">
                    Tạo khóa học
                </button>
                <a href="{{ route('admin.courses') }}" class="px-8 py-4 rounded-xl font-bold border border-outline-variant hover:bg-surface transition-all">
                    Hủy
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
