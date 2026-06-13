@extends('layouts.dashboard')

@section('contentdashboard')
<main class="p-8">
    <!-- Header -->
    <div class="mb-10">
        <div class="flex items-center gap-2 text-on-surface-variant mb-2">
            <a href="{{ route('admin.registrations.index') }}" class="hover:text-primary flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Quay lại danh sách
            </a>
        </div>
        <h1 class="text-3xl font-headline font-black text-on-surface">Cập nhật đăng ký</h1>
        <p class="text-on-surface-variant mt-1">Thay đổi trạng thái cho đăng ký #{{ $registration->registrationid }}</p>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white rounded-[2rem] border border-outline-variant overflow-hidden shadow-sm">
            <div class="p-8 border-b border-outline-variant bg-surface-container-low">
                <h3 class="text-xl font-bold text-on-surface mb-6">Chi tiết đăng ký</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-on-surface-variant font-bold mb-1">Học sinh</p>
                        <p class="font-semibold text-on-surface">{{ $registration->student->user->fullname ?? 'Không xác định' }}</p>
                        <p class="text-sm text-on-surface-variant">{{ $registration->student->user->email ?? '' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-on-surface-variant font-bold mb-1">Khóa học & Lớp học</p>
                        <p class="font-semibold text-on-surface">{{ $registration->class->course->coursename ?? 'Không có khóa học' }}</p>
                        <p class="text-sm text-on-surface-variant">Lớp: {{ $registration->class->classname ?? 'Không có lớp học' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-on-surface-variant font-bold mb-1">Ngày đăng ký</p>
                        <p class="font-semibold text-on-surface">{{ \Carbon\Carbon::parse($registration->registration_date)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-on-surface-variant font-bold mb-1">Trạng thái hiện tại</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold capitalize bg-secondary-container text-on-secondary-container">
                            {{ $registration->status }}
                        </span>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.registrations.update', $registration->registrationid) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')
                
                <div class="mb-8">
                    <label for="status" class="block text-sm font-bold text-on-surface mb-4">Cập nhật trạng thái</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach(['pending', 'approved', 'rejected', 'canceled'] as $status)
                        <label class="relative flex flex-col items-center gap-2 p-4 rounded-2xl border-2 cursor-pointer transition-all {{ $registration->status == $status ? 'border-primary bg-primary-container/10' : 'border-outline-variant hover:border-outline' }}">
                            <input type="radio" name="status" value="{{ $status }}" class="absolute opacity-0" {{ $registration->status == $status ? 'checked' : '' }}>
                            <span class="material-symbols-outlined {{ $registration->status == $status ? 'text-primary' : 'text-on-surface-variant' }}">
                                @if($status == 'pending') timer @elseif($status == 'approved') check_circle @elseif($status == 'rejected') cancel @else block @endif
                            </span>
                            <span class="text-xs font-bold capitalize {{ $registration->status == $status ? 'text-primary' : 'text-on-surface-variant' }}">
                                @if($status == 'pending') đang chờ @elseif($status == 'approved') đã duyệt @elseif($status == 'rejected') từ chối @else đã hủy @endif
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.registrations.index') }}" class="px-8 py-3 rounded-full font-bold text-on-surface-variant hover:bg-surface-container-high transition-all">
                        Hủy
                    </a>
                    <button type="submit" class="bg-primary text-on-primary px-10 py-3 rounded-full font-bold shadow-lg hover:brightness-110 transition-all active:scale-95">
                        Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<style>
    input[type="radio"]:checked + span {
        color: var(--primary);
    }
</style>
@endsection
