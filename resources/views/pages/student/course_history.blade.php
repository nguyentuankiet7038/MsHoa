@extends('layouts.app')

@section('title', 'Lịch sử khóa học')

@section('content')
<div class="bg-surface py-12">
    <div class="container mx-auto px-4">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-black text-on-surface flex items-center gap-3">
                <span class="material-symbols-outlined text-primary text-4xl">history_edu</span>
                Lịch sử khóa học
            </h1>
            <p class="text-outline mt-2">Danh sách các khóa học bạn đã đăng ký và theo học tại trung tâm.</p>
        </div>

        @if(session('success'))
            <div class="bg-success/20 text-success border border-success/30 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-error/20 text-error border border-error/30 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <span class="material-symbols-outlined">error</span>
                <span class="font-bold">{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Course List -->
        @if(count($registrations) === 0)
            <div class="bg-white rounded-3xl shadow-md border border-outline-variant p-12 text-center">
                <div class="w-20 h-20 bg-surface-container rounded-full flex items-center justify-center mx-auto mb-4 text-outline">
                    <span class="material-symbols-outlined text-4xl">menu_book</span>
                </div>
                <h3 class="text-xl font-bold text-on-surface mb-2">Bạn chưa có khóa học nào</h3>
                <p class="text-outline mb-6">Hãy tham khảo các khóa học của trung tâm và đăng ký ngay để bắt đầu hành trình chinh phục tiếng Anh nhé.</p>
                <a href="{{ route('courses.index') }}" class="btn btn--primary px-6 py-2 rounded-xl">Xem danh sách khóa học</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($registrations as $reg)
                    @php
                        $class = $reg->class;
                        $course = $class->course;
                        $endDate = \Carbon\Carbon::parse($class->end_date)->startOfDay();
                        $isFinished = now()->startOfDay() > $endDate;
                        $daysSinceEnd = $endDate->diffInDays(now()->startOfDay(), false); // if positive, it's after end_date
                        
                        $canFeedback = false;
                        $feedbackStatus = '';

                        if (!$isFinished) {
                            $feedbackStatus = '<span class="text-primary font-bold text-sm bg-primary/10 px-3 py-1 rounded-full">Đang học</span>';
                        } else {
                            if (in_array($class->classid, $feedbackClassIds)) {
                                $feedbackStatus = '<span class="text-success font-bold text-sm bg-success/10 px-3 py-1 rounded-full flex items-center gap-1"><span class="material-symbols-outlined text-sm">done_all</span> Đã đánh giá</span>';
                            } elseif ($daysSinceEnd <= 30) {
                                $canFeedback = true;
                            } else {
                                $feedbackStatus = '<span class="text-outline font-bold text-sm bg-surface-container px-3 py-1 rounded-full">Hết hạn đánh giá</span>';
                            }
                        }
                    @endphp

                    <div class="bg-white rounded-3xl shadow-lg border border-outline-variant overflow-hidden hover:shadow-xl transition-shadow flex flex-col">
                        <!-- Course Image (optional fallback if image is missing) -->
                        <div class="h-40 bg-surface-container relative">
                            @if($course->image)
                                <img src="{{ asset($course->image) }}" alt="{{ $course->coursename }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary to-secondary opacity-80"></div>
                            @endif
                            <div class="absolute top-4 right-4">
                                <span class="bg-white/90 backdrop-blur text-primary font-black px-3 py-1 rounded-full text-xs shadow-sm uppercase tracking-widest">{{ $course->level }}</span>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-on-surface mb-1 line-clamp-2">{{ $course->coursename }}</h3>
                            <p class="text-sm text-outline font-bold mb-4">Mã lớp: <span class="text-primary">{{ $class->classname }}</span></p>

                            <div class="space-y-2 mb-6">
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="material-symbols-outlined text-outline text-[18px]">calendar_today</span>
                                    <span class="text-on-surface-variant">Bắt đầu: {{ \Carbon\Carbon::parse($class->start_date)->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="material-symbols-outlined text-outline text-[18px]">event_available</span>
                                    <span class="text-on-surface-variant">Kết thúc: {{ \Carbon\Carbon::parse($class->end_date)->format('d/m/Y') }}</span>
                                </div>
                            </div>

                            <div class="mt-auto pt-4 border-t border-outline-variant flex items-center justify-between">
                                <div>
                                    {!! $feedbackStatus !!}
                                </div>
                                @if($canFeedback)
                                    <a href="{{ route('feedback.create', $class->classid) }}" class="btn btn--secondary px-4 py-2 rounded-xl flex items-center gap-2 text-sm shadow hover:-translate-y-0.5 transition-transform">
                                        <span class="material-symbols-outlined text-[18px]">rate_review</span>
                                        Đánh giá
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
