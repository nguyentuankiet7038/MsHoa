@extends('layouts.dashboard')

@section('contentdashboard')
<main class="flex-1 lg:ml-64 p-6 bg-surface-bright">
    <div class="max-w-3xl mx-auto">
        <header class="mb-8">
            <h1 class="text-3xl font-headline font-extrabold text-on-surface">Thêm điểm sinh viên</h1>
            <p class="text-on-surface-variant">Nhập thông tin điểm và chuyên cần cho sinh viên.</p>
        </header>

        <div class="bg-white rounded-3xl border border-outline-variant shadow-sm p-8">
            <form action="{{ route('admin.learning-progress.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold mb-2">Sinh viên</label>
                        <select name="studentid" required class="w-full rounded-xl border-outline-variant focus:border-primary">
                            <option value="">Chọn sinh viên</option>
                            @foreach($students as $student)
                            <option value="{{ $student->studentid }}">{{ $student->user->fullname }} (#{{ $student->studentid }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Lớp học</label>
                        <select name="classid" required class="w-full rounded-xl border-outline-variant focus:border-primary">
                            <option value="">Chọn lớp học</option>
                            @foreach($classes as $class)
                            <option value="{{ $class->classid }}">{{ $class->classname }} ({{ $class->course->coursename }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Điểm giữa kì</label>
                        <input type="number" step="0.1" name="midterm_score" class="w-full rounded-xl border-outline-variant focus:border-primary" placeholder="0.0">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Điểm cuối kì</label>
                        <input type="number" step="0.1" name="final_score" class="w-full rounded-xl border-outline-variant focus:border-primary" placeholder="0.0">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2">Số tiết tham dự</label>
                        <input type="number" name="attendance_rate" class="w-full rounded-xl border-outline-variant focus:border-primary" placeholder="0">
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8">
                    <a href="{{ route('admin.learning-progress.index') }}" class="px-6 py-3 rounded-xl font-bold text-on-surface-variant hover:bg-surface-container transition-all">Hủy</a>
                    <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold shadow-lg hover:opacity-90 transition-all">Lưu điểm</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
