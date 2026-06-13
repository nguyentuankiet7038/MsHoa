@if(Auth::check())
@php
    $user = Auth::user();
    $student = $user->student;
@endphp
<div id="account-dropdown" class="hidden absolute right-0 mt-12 w-80 bg-white rounded-3xl shadow-2xl border border-outline-variant overflow-hidden z-[60]">
    <!-- Header/Avatar Section -->
    <div class="bg-primary p-6 text-center relative">
        <div class="w-20 h-20 bg-white rounded-full mx-auto mb-3 flex items-center justify-center shadow-md overflow-hidden border-4 border-white">
            @if($user->avatar)
                <img src="{{ asset($user->avatar) }}" class="w-full h-full object-cover">
            @else
                <span class="text-3xl font-black text-primary">{{ substr($user->fullname, 0, 1) }}</span>
            @endif
        </div>
        <h3 class="text-white font-black text-lg">{{ $user->fullname }}</h3>
        <p class="text-white/80 text-xs uppercase tracking-widest font-bold">{{ $user->role }}</p>
    </div>

    <!-- Info Section -->
    <div class="p-6 space-y-4">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary text-sm">mail</span>
            <div>
                <p class="text-[10px] text-outline uppercase font-bold tracking-tighter">Địa chỉ Email</p>
                <p class="text-sm font-bold text-on-surface">{{ $user->email }}</p>
            </div>
        </div>

        @if($student)
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary text-sm">cake</span>
                <div>
                    <p class="text-[10px] text-outline uppercase font-bold tracking-tighter">Ngày sinh</p>
                    <p class="text-sm font-bold text-on-surface">{{ \Carbon\Carbon::parse($student->dateofbirth)->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary text-sm">person_pin</span>
                <div>
                    <p class="text-[10px] text-outline uppercase font-bold tracking-tighter">Giới tính</p>
                    <p class="text-sm font-bold text-on-surface capitalize">{{ $student->gender }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary text-sm">family_restroom</span>
                <div>
                    <p class="text-[10px] text-outline uppercase font-bold tracking-tighter">Tên phụ huynh</p>
                    <p class="text-sm font-bold text-on-surface">{{ $student->parentname }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary text-sm">call</span>
                <div>
                    <p class="text-[10px] text-outline uppercase font-bold tracking-tighter">Số điện thoại</p>
                    <p class="text-sm font-bold text-on-surface">{{ $student->parentphone }}</p>
                </div>
            </div>
        @else
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary text-sm">call</span>
                <div>
                    <p class="text-[10px] text-outline uppercase font-bold tracking-tighter">Điện thoại</p>
                    <p class="text-sm font-bold text-on-surface">{{ $user->phone ?? 'N/A' }}</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Actions Section -->
    <div class="bg-surface-container-low p-4 space-y-2 border-t border-outline-variant">
        @if($user->role === 'student')
            <a href="{{ route('student.grades') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white transition-all group">
                <span class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">grade</span>
                <span class="font-bold text-on-surface">Xem điểm học tập</span>
            </a>
        @endif

        @if($user->role === 'teacher')
            <a href="{{ route('teacher.schedule') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white transition-all group">
                <span class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">calendar_month</span>
                <span class="font-bold text-on-surface">Lịch dạy của tôi</span>
            </a>
            <a href="{{ route('teacher.grades_attendance') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white transition-all group">
                <span class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">edit_note</span>
                <span class="font-bold text-on-surface">Nhập điểm & Điểm danh</span>
            </a>
        @endif

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-error-container hover:text-on-error-container transition-all group">
                <span class="material-symbols-outlined text-error group-hover:rotate-12 transition-transform">logout</span>
                <span class="font-bold">Đăng xuất</span>
            </button>
        </form>
    </div>
</div>
@endif
