@extends('layouts.dashboard')

@section('title', 'Quản lý khóa học')

@section('contentdashboard')
<div class="p-8">
    <!-- Header & Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-3xl font-headline font-black text-on-surface">Quản lý khóa học</h1>
            <p class="text-on-surface-variant mt-1">Quản lý và tổ chức các chương trình học tiếng Anh cho học sinh của bạn.</p>
        </div>
        <a href="{{ route('admin.courses.create') }}" class="flex items-center justify-center gap-2 px-6 py-4 bg-[#00C2CB] text-white rounded-xl font-bold shadow-lg hover:brightness-105 transition-all active:scale-95">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add_circle</span>
            Thêm khóa học mới
        </a>
    </div>

    <!-- Bento Filter & Grid -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-8">
        <!-- Filter Section -->
        <form action="{{ route('admin.courses') }}" method="GET" class="md:col-span-12 lg:col-span-4 bg-surface-container p-6 rounded-3xl flex flex-col justify-center border border-outline-variant">
            <div class="flex items-center justify-between mb-4">
                <span class="font-bold text-on-surface">Bộ lọc</span>
                <button type="submit" class="material-symbols-outlined text-primary">search</button>
            </div>
            <div class="space-y-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm khóa học..." class="w-full rounded-full border-outline-variant bg-surface text-sm focus:ring-primary focus:border-primary">
                <div class="flex flex-wrap gap-2">
                    <select name="level" class="text-xs rounded-full border-outline-variant bg-surface py-1">
                        <option value="All">Tất cả cấp độ</option>
                        <option value="Beginner" {{ request('level') == 'Beginner' ? 'selected' : '' }}>Sơ cấp</option>
                        <option value="Intermediate" {{ request('level') == 'Intermediate' ? 'selected' : '' }}>Trung cấp</option>
                        <option value="Advanced" {{ request('level') == 'Advanced' ? 'selected' : '' }}>Nâng cao</option>
                    </select>
                    <select name="status" class="text-xs rounded-full border-outline-variant bg-surface py-1">
                        <option value="All">Tất cả trạng thái</option>
                        <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Đang hoạt động</option>
                        <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Ngừng hoạt động</option>
                    </select>
                    <a href="{{ route('admin.courses') }}" class="text-xs text-on-surface-variant hover:text-primary underline flex items-center">Thiết lập lại</a>
                </div>
            </div>
        </form>

        <!-- Stats/Briefing -->
        <div class="md:col-span-6 lg:col-span-4 bg-primary-container text-on-primary-container p-6 rounded-3xl flex items-center justify-between border border-primary">
            <div>
                <p class="text-sm font-medium opacity-80 uppercase tracking-widest">Khóa học đang hoạt động</p>
                <p class="text-4xl font-black">{{ $stats['active'] }}</p>
                <p class="text-xs opacity-70">Tổng cộng: {{ $stats['total'] }}</p>
            </div>
            <span class="material-symbols-outlined text-5xl opacity-40">school</span>
        </div>
        <div class="md:col-span-6 lg:col-span-4 bg-tertiary-container text-on-tertiary-container p-6 rounded-3xl flex items-center justify-between border border-tertiary">
            <div>
                <p class="text-sm font-medium opacity-80 uppercase tracking-widest">TOEIC & IELTS</p>
                <p class="text-4xl font-black">{{ $stats['toeic'] + $stats['ielts'] }}</p>
                <p class="text-xs opacity-70">T: {{ $stats['toeic'] }} | I: {{ $stats['ielts'] }}</p>
            </div>
            <span class="material-symbols-outlined text-5xl opacity-40">trending_up</span>
        </div>
    </div>

    <!-- Courses Table Container -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-surface-container-high border-b border-outline-variant">
                    <tr>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Tên khóa học</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Thời gian</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Học phí</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Trạng thái</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface text-right">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($courses as $course)
                    <tr class="hover:bg-surface-container transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-surface-variant overflow-hidden flex-shrink-0">
                                    @if($course->image)
                                        <img class="w-full h-full object-cover" src="{{ asset($course->image) }}" alt="{{ $course->coursename }}" />
                                    @else
                                        <div class="w-full h-full bg-primary-container flex items-center justify-center text-on-primary-container">
                                            <span class="material-symbols-outlined">book</span>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-bold text-on-surface">{{$course->coursename}}</p>
                                    <p class="text-xs text-on-surface-variant">Cấp độ: {{$course->level}}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-on-surface-variant">12 Tuần</td>
                        <td class="px-6 py-4 font-semibold text-primary">{{ number_format($course->price, 0, ',', '.') }} VNĐ</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $course->status == 'Active' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{$course->status}}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.courses.edit', $course->courseid) }}" class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                                <form action="{{ route('admin.courses.destroy', $course->courseid) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa khóa học này không?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-on-surface-variant">Không tìm thấy khóa học nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="px-6 py-4 bg-surface-container-low border-t border-outline-variant flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm text-on-surface-variant">
                Đang hiển thị {{ $courses->firstItem() ?? 0 }} đến {{ $courses->lastItem() ?? 0 }} trong số {{ $courses->total() }} khóa học
            </p>
            <div class="pagination-links">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
