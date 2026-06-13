@extends('layouts.dashboard')

@section('contentdashboard')
<div class="p-8 bg-surface-bright">
    
        <div class="max-w-7xl mx-auto">
            <header class="mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-headline font-extrabold text-on-surface">Quản lý điểm sinh viên</h1>
                    <p class="text-on-surface-variant">Theo dõi và cập nhật tiến độ học tập của sinh viên.</p>
                </div>
                <a href="{{ route('admin.learning-progress.create') }}" class="bg-primary text-on-primary px-6 py-3 rounded-xl font-bold flex items-center gap-2 shadow-lg hover:opacity-90 transition-all">
                    <span class="material-symbols-outlined">add</span>
                    Thêm điểm mới
                </a>
            </header>

            @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl border border-green-200">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl border border-red-200">
                {{ session('error') }}
            </div>
            @endif

            <div class="bg-white rounded-3xl border border-outline-variant shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-surface-container-low text-on-surface-variant">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Mã SV</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Tên sinh viên</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Lớp / Khóa học</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Giữa kì</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Cuối kì</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Đi học (tiết)</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Trạng thái</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @forelse($progress as $item)
                            <tr class="hover:bg-surface-container-lowest transition-colors">
                                <td class="px-6 py-4 font-bold text-primary">#{{ $item->studentid }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-on-surface">{{ $item->student->user->fullname ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-on-surface">{{ $item->class->classname ?? 'N/A' }}</div>
                                    <div class="text-xs text-on-surface-variant">{{ $item->class->course->coursename ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 font-bold">{{ $item->midterm_score }}</td>
                                <td class="px-6 py-4 font-bold">{{ $item->final_score }}</td>
                                <td class="px-6 py-4">{{ $item->attendance_rate }} tiết</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $item->is_blocked ? 'bg-error-container text-on-error-container' : 'bg-green-100 text-green-700' }}">
                                        {{ $item->is_blocked ? 'Đã khóa' : 'Đang hoạt động' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        <form action="{{ route('admin.learning-progress.update', $item->progressid) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="toggle_block" value="1">
                                            <button type="submit" class="p-2 {{ $item->is_blocked ? 'text-error' : 'text-green-600' }} hover:bg-surface-container rounded-lg transition-all" title="{{ $item->is_blocked ? 'Mở khóa' : 'Khóa' }}">
                                                <span class="material-symbols-outlined">{{ $item->is_blocked ? 'lock' : 'lock_open' }}</span>
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.learning-progress.edit', $item->progressid) }}" class="p-2 text-on-surface-variant hover:text-primary rounded-lg transition-all" title="Chỉnh sửa">
                                            <span class="material-symbols-outlined">edit</span>
                                        </a>
                                        <form action="{{ route('admin.learning-progress.destroy', $item->progressid) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-on-surface-variant hover:text-error rounded-lg transition-all" title="Xóa">
                                                <span class="material-symbols-outlined">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-on-surface-variant italic">Chưa có dữ liệu điểm sinh viên.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-outline-variant bg-surface-container-lowest">
                    {{ $progress->links() }}
                </div>
            </div>
        </div>
</div>


@endsection