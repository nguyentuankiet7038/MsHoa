@extends('layouts.app')

@section('title', 'Chi tiết khóa học')

@section('content')
<main>
    <!-- Hero Section -->
    <!-- Course Highlights Bento Grid -->
    <section class="py-20 bg-surface-container-lowest">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="p-8 bg-surface-container rounded-3xl border border-outline-variant flex flex-col items-center text-center">
                    <span class="material-symbols-outlined text-4xl turquoise-text mb-4">calendar_today</span>
                    <h3 class="font-bold text-on-surface mb-1">Thời gian</h3>
                    <p class="text-on-surface-variant">{{ $duration }}</p>
                </div>
                <div class="p-8 bg-surface-container rounded-3xl border border-outline-variant flex flex-col items-center text-center">
                    <span class="material-symbols-outlined text-4xl turquoise-text mb-4">trending_up</span>
                    <h3 class="font-bold text-on-surface mb-1">Cấp độ</h3>
                    <p class="text-on-surface-variant">{{ $course->level ?: 'Chưa sắp lớp' }}</p>
                </div>
                <div class="p-8 bg-surface-container rounded-3xl border border-outline-variant flex flex-col items-center text-center">
                    <span class="material-symbols-outlined text-4xl turquoise-text mb-4">schedule</span>
                    <h3 class="font-bold text-on-surface mb-1">Lịch học</h3>
                    <p class="text-on-surface-variant">{{ $schedule }}</p>
                </div>
                <div class="p-8 bg-surface-container rounded-3xl border border-outline-variant flex flex-col items-center text-center">
                    <span class="material-symbols-outlined text-4xl turquoise-text mb-4">laptop_mac</span>
                    <h3 class="font-bold text-on-surface mb-1">Hình thức</h3>
                    <p class="text-on-surface-variant">Trực tiếp</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content Layout -->
    <section class="py-20">
        <div class="container mx-auto px-6 flex flex-col lg:flex-row gap-12">
            <!-- Content Left -->
            <div class="lg:w-2/3 space-y-20">
                <!-- Curriculum -->
                <div>
                    <h2 class="text-3xl font-display font-black text-on-surface mb-8">{{$course->coursename}}</h2>
                    <div class="space-y-4">
                        <div class="group bg-surface border border-outline-variant rounded-2xl overflow-hidden">
                         
                            <div class="p-6  text-on-surface-variant">
                                <p>{{$course->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Benefits -->
                <div>
                    <h2 class="text-3xl font-display font-black text-on-surface mb-8">Tại sao nên chọn khóa học này?</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="space-y-3">
                            <div class="w-12 h-12 bg-custom-turquoise/10 flex items-center justify-center rounded-xl">
                                <span class="material-symbols-outlined turquoise-text">verified_user</span>
                            </div>
                            <h4 class="font-bold">Phản hồi từ chuyên gia</h4>
                            <p class="text-sm text-on-surface-variant">Sửa bài chi tiết 1 kèm 1 cho mọi bài tập Viết và Nói bởi các cố vấn IELTS 8.5+.</p>
                        </div>
                        <div class="space-y-3">
                            <div class="w-12 h-12 bg-custom-turquoise/10 flex items-center justify-center rounded-xl">
                                <span class="material-symbols-outlined turquoise-text">analytics</span>
                            </div>
                            <h4 class="font-bold">Thi thử</h4>
                            <p class="text-sm text-on-surface-variant">Thi thử định kỳ hàng tuần với điều kiện phòng thi thật và báo cáo điểm số chi tiết.</p>
                        </div>
                        <div class="space-y-3">
                            <div class="w-12 h-12 bg-custom-turquoise/10 flex items-center justify-center rounded-xl">
                                <span class="material-symbols-outlined turquoise-text">groups</span>
                            </div>
                            <h4 class="font-bold">Hỗ trợ cộng đồng</h4>
                            <p class="text-sm text-on-surface-variant">Truy cập nhóm Discord riêng tư để cùng học tập và thực hiện các thử thách luyện nói hàng ngày.</p>
                        </div>
                    </div>
                </div>
      
                <!-- Reviews -->
                <div>
                    <h2 class="text-3xl font-display font-black text-on-surface mb-8">Cảm nhận học viên</h2>
                    @if($feedbacks->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($feedbacks as $feedback)
                        <div class="p-6 bg-white rounded-2xl border border-outline-variant shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex gap-1 mb-4 text-tertiary">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $feedback->ratingscore)
                                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                                        @else
                                        <span class="material-symbols-outlined">star</span>
                                        @endif
                                    @endfor
                                </div>
                                <p class="text-on-surface-variant italic mb-4">"{{ $feedback->comment }}"</p>
                            </div>
                            <p class="font-bold text-on-surface">— {{ $feedback->student->studentname ?? 'Học viên' }}</p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-on-surface-variant italic">Chưa có đánh giá nào cho khóa học này.</p>
                    @endif
                </div>
            </div>
<!-- Sticky Sidebar - Registration Form -->
<aside class="lg:w-1/3">
    <form action="{{route('enrollments.registration', $course->courseid)}}" method="POST">
        @csrf
        <div class="sticky top-24 p-8 bg-white rounded-3xl border-2 border-outline-variant shadow-2xl space-y-6">
            
            {{-- Header --}}
            <div class="flex justify-between items-start">
                <div>
                    <span class="px-3 py-1 bg-error/10 text-error text-xs font-bold rounded-full">-20% Thời gian có hạn</span>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="text-4xl font-display font-black text-on-surface">{{$course->price}}</span>
                        <span class="text-on-surface-variant line-through text-sm">{{$course->price*1.2}}</span>
                    </div>
                </div>
            </div>

            {{-- Hidden: Course ID --}}
            <input type="hidden" name="course_id" value="{{ $course->courseid }}">

            {{-- Form Fields --}}
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-on-surface tracking-wide uppercase">Phiếu Đăng Ký</h3>

                {{-- Tên học viên --}}
                <div class="space-y-1">
                    <label for="student_name" class="text-xs font-semibold text-on-surface-variant">
                        Tên học viên <span class="text-error">*</span>
                    </label>
                    <input type="text" id="student_name" name="student_name"
                        value="{{ old('student_name') }}"
                        placeholder="Nguyễn Văn A"
                        class="w-full px-4 py-2.5 rounded-xl border @error('student_name') border-error @else border-outline-variant @enderror bg-surface-container text-sm text-on-surface placeholder:text-on-surface-variant/50 focus:outline-none focus:border-custom-turquoise focus:ring-2 focus:ring-custom-turquoise/20 transition-all">
                    @error('student_name')
                        <p class="text-xs text-error mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ngày sinh & Giới tính --}}
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label for="dob" class="text-xs font-semibold text-on-surface-variant">
                            Ngày sinh <span class="text-error">*</span>
                        </label>
                        <input type="date" id="dob" name="dob"
                            value="{{ old('dob') }}"
                            class="w-full px-3 py-2.5 rounded-xl border @error('dob') border-error @else border-outline-variant @enderror bg-surface-container text-sm text-on-surface focus:outline-none focus:border-custom-turquoise focus:ring-2 focus:ring-custom-turquoise/20 transition-all">
                        @error('dob')
                            <p class="text-xs text-error mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-1">
                        <label for="gender" class="text-xs font-semibold text-on-surface-variant">
                            Giới tính <span class="text-error">*</span>
                        </label>
                        <select id="gender" name="gender"
                            class="w-full px-3 py-2.5 rounded-xl border @error('gender') border-error @else border-outline-variant @enderror bg-surface-container text-sm text-on-surface focus:outline-none focus:border-custom-turquoise focus:ring-2 focus:ring-custom-turquoise/20 transition-all">
                            <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Chọn...</option>
                            <option value="male"   {{ old('gender') == 'male'   ? 'selected' : '' }}>Nam</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                            <option value="other"  {{ old('gender') == 'other'  ? 'selected' : '' }}>Khác</option>
                        </select>
                        @error('gender')
                            <p class="text-xs text-error mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Tên người giám hộ --}}
                <div class="space-y-1">
                    <label for="guardian_name" class="text-xs font-semibold text-on-surface-variant">
                        Tên người giám hộ <span class="text-error">*</span>
                    </label>
                    <input type="text" id="guardian_name" name="guardian_name"
                        value="{{ old('guardian_name') }}"
                        placeholder="Nguyễn Thị B"
                        class="w-full px-4 py-2.5 rounded-xl border @error('guardian_name') border-error @else border-outline-variant @enderror bg-surface-container text-sm text-on-surface placeholder:text-on-surface-variant/50 focus:outline-none focus:border-custom-turquoise focus:ring-2 focus:ring-custom-turquoise/20 transition-all">
                    @error('guardian_name')
                        <p class="text-xs text-error mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- SĐT người giám hộ --}}
                <div class="space-y-1">
                    <label for="guardian_phone" class="text-xs font-semibold text-on-surface-variant">
                        SĐT người giám hộ <span class="text-error">*</span>
                    </label>
                    <input type="number" maxlength="10" id="guardian_phone" name="guardian_phone"
                        value="{{ old('guardian_phone') }}"
                        placeholder="0909 123 456"
                        class="w-full px-4 py-2.5 rounded-xl border @error('guardian_phone') border-error @else border-outline-variant @enderror bg-surface-container text-sm text-on-surface placeholder:text-on-surface-variant/50 focus:outline-none focus:border-custom-turquoise focus:ring-2 focus:ring-custom-turquoise/20 transition-all">
                    @error('guardian_phone')
                        <p class="text-xs text-error mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tên khóa học (readonly) --}}
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-on-surface-variant">Khóa học đăng ký</label>
                    <div class="w-full px-4 py-2.5 rounded-xl border border-outline-variant bg-surface-container/60 text-sm text-on-surface font-medium flex items-center gap-2">
                        <span class="material-symbols-outlined text-custom-turquoise text-base">school</span>
                        {{ $course->coursename }}
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full py-4 turquoise-primary text-black font-bold rounded-xl text-lg hover:brightness-110 active:scale-95 transition-all shadow-lg shadow-custom-turquoise/30">
                Đăng Ký Ngay
            </button>

            {{-- Payment Methods --}}
            <div class="p-4 bg-surface-container rounded-xl text-center">
                <p class="text-xs text-on-surface-variant">Thanh toán an toàn qua:</p>
                <div class="flex justify-center gap-4 mt-2 opacity-50">
                    <span class="material-symbols-outlined">credit_card</span>
                    <span class="material-symbols-outlined">account_balance</span>
                    <span class="material-symbols-outlined">qr_code_2</span>
                </div>
            </div>

        </div>
    </form>
</aside>
        </div>
    </section>
</main>
@endsection
