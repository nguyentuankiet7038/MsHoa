@extends('layouts.dashboard')

@section('contentdashboard')
<main class="flex-1 lg:ml-64 p-6 bg-surface-bright">
    <div class="max-w-3xl mx-auto">
        <header class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-headline font-extrabold text-on-surface">Chỉnh sửa điểm sinh viên</h1>
                <p class="text-on-surface-variant">Cập nhật thông tin điểm cho {{ $item->student->user->fullname }}.</p>
            </div>
            <form action="{{ route('admin.learning-progress.update', $item->progressid) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="toggle_block" value="1">
                <button type="submit" class="flex items-center gap-2 px-6 py-3 rounded-xl font-bold shadow-lg transition-all {{ $item->is_blocked ? 'bg-error-container text-on-error-container hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                    <span class="material-symbols-outlined">{{ $item->is_blocked ? 'lock' : 'lock_open' }}</span>
                    {{ $item->is_blocked ? 'Đang Khóa (Bấm để Mở)' : 'Đang Mở (Bấm để Khóa)' }}
                </button>
            </form>
        </header>

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl border border-red-200">
            {{ session('error') }}
        </div>
        @endif

        <div class="bg-white rounded-3xl border border-outline-variant shadow-sm p-8">
            <form action="{{ route('admin.learning-progress.update', $item->progressid) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                @if($item->is_blocked)
                <div class="p-4 bg-yellow-50 text-yellow-700 rounded-xl border border-yellow-200 mb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined">warning</span>
                    Bản ghi đang bị khóa. Bạn không thể chỉnh sửa điểm trừ khi mở khóa.
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold mb-2">Sinh viên</label>
                        <input type="text" disabled value="{{ $item->student->user->fullname }}" class="w-full rounded-xl border-outline-variant bg-surface-container-low">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Lớp học</label>
                        <input type="text" disabled value="{{ $item->class->classname }}" class="w-full rounded-xl border-outline-variant bg-surface-container-low">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Điểm giữa kì</label>
                        <input type="number" step="0.1" name="midterm_score" value="{{ $item->midterm_score }}" {{ $item->is_blocked ? 'disabled' : '' }} class="w-full rounded-xl border-outline-variant focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Điểm cuối kì</label>
                        <input type="number" step="0.1" name="final_score" value="{{ $item->final_score }}" {{ $item->is_blocked ? 'disabled' : '' }} class="w-full rounded-xl border-outline-variant focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Số tiết tham dự</label>
                        <input type="number" name="attendance_rate" value="{{ $item->attendance_rate }}" {{ $item->is_blocked ? 'disabled' : '' }} class="w-full rounded-xl border-outline-variant focus:border-primary">
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8">
                    <a href="{{ route('admin.learning-progress.index') }}" class="px-6 py-3 rounded-xl font-bold text-on-surface-variant hover:bg-surface-container transition-all">Hủy</a>
                    @if(!$item->is_blocked)
                    <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold shadow-lg hover:opacity-90 transition-all">Cập nhật điểm</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
