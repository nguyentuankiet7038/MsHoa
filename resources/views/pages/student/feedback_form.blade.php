@extends('layouts.app')

@section('title', 'Đánh giá Khóa học')

@section('content')
<div class="bg-surface py-12">
    <div class="container max-w-2xl mx-auto px-4">
        
        <div class="mb-6">
            <a href="{{ route('student.courses') }}" class="text-primary font-bold flex items-center gap-1 hover:underline w-fit">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span> Quay lại Lịch sử khóa học
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-outline-variant overflow-hidden">
            <div class="bg-primary p-8 text-center text-white">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur">
                    <span class="material-symbols-outlined text-3xl">star</span>
                </div>
                <h1 class="text-2xl font-black mb-2">Đánh giá Lớp học</h1>
                <p class="text-white/80">{{ $class->course->coursename }} - Lớp {{ $class->classname }}</p>
            </div>

            <form action="{{ route('feedback.store', $class->classid) }}" method="POST" class="p-8 space-y-8">
                @csrf

                <!-- Star Rating -->
                <div>
                    <label class="block text-center text-on-surface font-bold mb-4">Bạn cảm thấy chất lượng khóa học như thế nào?</label>
                    <div class="flex justify-center items-center gap-2 flex-row-reverse star-rating-group">
                        <input type="radio" name="ratingscore" id="star5" value="5" class="peer hidden" required {{ old('ratingscore') == '5' ? 'checked' : '' }}>
                        <label for="star5" class="material-symbols-outlined text-4xl cursor-pointer text-outline peer-checked:text-warning hover:text-warning peer-hover:text-warning transition-colors" style="font-variation-settings: 'FILL' 1;">star</label>
                        
                        <input type="radio" name="ratingscore" id="star4" value="4" class="peer hidden" {{ old('ratingscore') == '4' ? 'checked' : '' }}>
                        <label for="star4" class="material-symbols-outlined text-4xl cursor-pointer text-outline peer-checked:text-warning hover:text-warning peer-hover:text-warning transition-colors" style="font-variation-settings: 'FILL' 1;">star</label>
                        
                        <input type="radio" name="ratingscore" id="star3" value="3" class="peer hidden" {{ old('ratingscore') == '3' ? 'checked' : '' }}>
                        <label for="star3" class="material-symbols-outlined text-4xl cursor-pointer text-outline peer-checked:text-warning hover:text-warning peer-hover:text-warning transition-colors" style="font-variation-settings: 'FILL' 1;">star</label>
                        
                        <input type="radio" name="ratingscore" id="star2" value="2" class="peer hidden" {{ old('ratingscore') == '2' ? 'checked' : '' }}>
                        <label for="star2" class="material-symbols-outlined text-4xl cursor-pointer text-outline peer-checked:text-warning hover:text-warning peer-hover:text-warning transition-colors" style="font-variation-settings: 'FILL' 1;">star</label>
                        
                        <input type="radio" name="ratingscore" id="star1" value="1" class="peer hidden" {{ old('ratingscore') == '1' ? 'checked' : '' }}>
                        <label for="star1" class="material-symbols-outlined text-4xl cursor-pointer text-outline peer-checked:text-warning hover:text-warning peer-hover:text-warning transition-colors" style="font-variation-settings: 'FILL' 1;">star</label>
                    </div>
                    @error('ratingscore')
                        <p class="text-error text-center mt-2 text-sm font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Comment -->
                <div>
                    <label for="comment" class="block text-on-surface font-bold mb-2">Lời góp ý / Cảm nhận của bạn (Tuỳ chọn)</label>
                    <textarea name="comment" id="comment" rows="5" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-on-surface resize-none placeholder:text-outline" placeholder="Hãy chia sẻ cảm nhận của bạn về giảng viên, tài liệu học tập, môi trường..."></textarea>
                    @error('comment')
                        <p class="text-error mt-1 text-sm font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full btn btn--primary py-4 rounded-xl shadow-lg hover:-translate-y-1 transition-all font-bold text-lg flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">send</span> Gửi đánh giá
                </button>
            </form>
        </div>
    </div>
</div>

<style>
/* Logic để highlight sao dựa theo hover và checked từ phải sang trái (do dùng flex-row-reverse) */
.star-rating-group label:hover,
.star-rating-group label:hover ~ label,
.star-rating-group input:checked ~ label {
    color: #ffb400; /* Màu warning (vàng/cam) */
}
</style>
@endsection
