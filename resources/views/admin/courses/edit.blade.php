@extends('layouts.dashboard')

@section('title', 'Chỉnh sửa khóa học')

@section('contentdashboard')
<div class="min-h-[calc(100vh-2rem)] flex items-center justify-center p-6">
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-xl overflow-hidden border border-outline-variant">
        <div class="bg-primary p-8 text-on-primary">
            <div class="flex items-center gap-4 mb-2">
                <a href="{{ route('admin.courses') }}" class="p-2 hover:bg-white/10 rounded-full transition-colors">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <h1 class="text-3xl font-black">Chỉnh sửa khóa học</h1>
            </div>
            <p class="text-white/80">Cập nhật chi tiết của "{{ $course->coursename }}".</p>
        </div>

        <form action="{{ route('admin.courses.update', $course->courseid) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface/70" for="coursename">Tên khóa học</label>
                    <input type="text" name="coursename" id="coursename" value="{{ $course->coursename }}" required class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface/70" for="level">Cấp độ</label>
                    <select name="level" id="level" required class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <option value="Beginner" {{ $course->level == 'Beginner' ? 'selected' : '' }}>Sơ cấp</option>
                        <option value="Intermediate" {{ $course->level == 'Intermediate' ? 'selected' : '' }}>Trung cấp</option>
                        <option value="Advanced" {{ $course->level == 'Advanced' ? 'selected' : '' }}>Nâng cao</option>
                        <option value="TOEIC" {{ $course->level == 'TOEIC' ? 'selected' : '' }}>TOEIC</option>
                        <option value="IELTS" {{ $course->level == 'IELTS' ? 'selected' : '' }}>IELTS</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-on-surface/70" for="description">Mô tả</label>
                <textarea name="description" id="description" rows="4" required class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ $course->description }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface/70" for="price">Học phí (VNĐ)</label>
                    <input type="number" name="price" id="price" value="{{ $course->price }}" required class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface/70" for="status">Trạng thái</label>
                    <select name="status" id="status" required class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <option value="Active" {{ $course->status == 'Active' ? 'selected' : '' }}>Đang hoạt động</option>
                        <option value="Inactive" {{ $course->status == 'Inactive' ? 'selected' : '' }}>Ngừng hoạt động</option>
                        <option value="Upcoming" {{ $course->status == 'Upcoming' ? 'selected' : '' }}>Sắp tới</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-on-surface/70" for="image">Hình ảnh khóa học</label>
                <div class="flex items-center gap-4">
                    @if($course->image)
                        <div class="w-20 h-20 rounded-xl overflow-hidden border border-outline-variant">
                            <img src="{{ asset($course->image) }}" class="w-full h-full object-cover" alt="Hình hiện tại">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="flex-1 px-4 py-3 rounded-xl border border-outline-variant focus:border-primary outline-none" />
                </div>
            </div>

            <div class="pt-4 flex gap-4">
                <button type="submit" class="flex-1 bg-primary text-on-primary py-4 rounded-xl font-bold shadow-lg hover:brightness-110 transition-all active:scale-[0.98]">
                    Cập nhật khóa học
                </button>
                <a href="{{ route('admin.courses') }}" class="px-8 py-4 rounded-xl font-bold border border-outline-variant hover:bg-surface transition-all">
                    Hủy
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
