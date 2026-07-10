@extends('layouts.app')

@section('title', 'Lịch dạy giáo viên')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-20">
    <div class="mb-12">
        <h1 class="text-4xl font-black mb-2">Lịch dạy của bạn</h1>
        <p class="text-on-surface-variant italic">Danh sách các lớp học bạn đang phụ trách giảng dạy.</p>
    </div>

    @if($classes->isEmpty())
        <div class="bg-white rounded-[2rem] p-12 text-center shadow-lg border border-outline-variant">
            <span class="material-symbols-outlined text-6xl text-outline mb-4">event_busy</span>
            <h2 class="text-2xl font-bold text-on-surface">Chưa có lịch dạy</h2>
            <p class="text-on-surface-variant mt-2">Bạn hiện chưa được phân công giảng dạy lớp học nào.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($classes as $class)
            <div class="bg-white rounded-[2rem] overflow-hidden shadow-xl border border-outline-variant transition-transform hover:scale-[1.02]">
                <div class="bg-[#dc2626] p-6 text-white">
                    <h3 class="text-xl font-black">{{ $class->classname }}</h3>
<p class="text-sm opacity-80">
    {{ $class->course->coursename ?? 'Chưa có khóa học' }}
</p>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">calendar_month</span>
                        <div>
                            <p class="text-[10px] text-outline font-bold uppercase">Thời gian</p>
                            <p class="text-sm font-bold text-on-surface">{{ \Carbon\Carbon::parse($class->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($class->end_date)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">schedule</span>
                        <div>
                            <p class="text-[10px] text-outline font-bold uppercase">Lịch học</p>
                            <p class="text-sm font-bold text-on-surface">{{ $class->schedule }}</p>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-outline-variant">
                        <a href="{{ route('teacher.grades_attendance', ['classid' => $class->classid]) }}" class="w-full flex items-center justify-center gap-2 bg-[#00C2CB] text-white py-3 rounded-xl font-bold hover:opacity-90 transition-all">
                            <span class="material-symbols-outlined">edit_note</span>
                            Nhập điểm & Điểm danh
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</main>
@endsection
