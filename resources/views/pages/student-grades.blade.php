@extends('layouts.app')

@section('title', 'Phiếu điểm học tập')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-20">
    <div class="mb-12">
        <h1 class="text-4xl font-black mb-2">Phiếu xem điểm học tập</h1>
        <p class="text-on-surface-variant italic">Theo dõi kết quả học tập và rèn luyện của bạn tại Ms. Hoa English.</p>
    </div>

    @if($grades->isEmpty())
        <div class="bg-white rounded-[2rem] p-12 text-center shadow-lg border border-outline-variant">
            <span class="material-symbols-outlined text-6xl text-outline mb-4">school</span>
            <h2 class="text-2xl font-bold text-on-surface">Chưa có dữ liệu điểm</h2>
            <p class="text-on-surface-variant mt-2">Dữ liệu điểm của bạn sẽ xuất hiện sau khi giáo viên cập nhật lên hệ thống.</p>
        </div>
    @else
        <div class="grid grid-cols-1 gap-8">
            @foreach($grades as $grade)
            <div class="bg-white rounded-[2rem] overflow-hidden shadow-xl border border-outline-variant transition-transform hover:scale-[1.01]">
                <!-- Header: Tên khóa học & Lớp -->
                <div class="bg-[#00C2CB] p-8 text-white">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest bg-white/20 px-3 py-1 rounded-full mb-2 inline-block">Khóa học</span>
                            <h2 class="text-3xl font-black">{{ $grade->class->course->coursename }}</h2>
                        </div>
                        <div class="text-right">
                            <p class="text-sm opacity-80 font-bold uppercase">Mã lớp</p>
                            <p class="text-2xl font-black">{{ $grade->class->classname }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Cột 1: Thông tin lớp học -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold border-b border-outline-variant pb-2">Thông tin lớp học</h3>
                            
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-surface-container flex items-center justify-center text-[#00C2CB]">
                                    <span class="material-symbols-outlined">person</span>
                                </div>
                                <div>
                                    <p class="text-xs text-outline font-bold uppercase">Giáo viên phụ trách</p>
                                    <p class="font-bold">{{ $grade->class->teacher->user->fullname ?? 'Chưa cập nhật' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-surface-container flex items-center justify-center text-[#00C2CB]">
                                    <span class="material-symbols-outlined">calendar_today</span>
                                </div>
                                <div>
                                    <p class="text-xs text-outline font-bold uppercase">Thời gian học trong tuần</p>
                                    <p class="font-bold">{{ $grade->class->schedule }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-surface-container flex items-center justify-center text-[#00C2CB]">
                                    <span class="material-symbols-outlined">event</span>
                                </div>
                                <div>
                                    <p class="text-xs text-outline font-bold uppercase">Ngày cập nhật</p>
                                    <p class="font-bold">{{ $grade->updated_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Cột 2 & 3: Bảng điểm -->
                        <div class="lg:col-span-2 bg-surface-container-lowest rounded-3xl p-8 border border-outline-variant">
                            <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[#00C2CB]">leaderboard</span>
                                Kết quả học tập
                            </h3>

                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div class="p-6 bg-white rounded-2xl shadow-sm border border-outline-variant">
                                    <p class="text-xs text-outline font-bold uppercase mb-2">Giữa kì</p>
                                    <p class="text-4xl font-black text-[#dc2626]">{{ $grade->midterm_score }}</p>
                                    <p class="text-[10px] text-outline mt-2 font-bold uppercase">Thang điểm 10</p>
                                </div>
                                <div class="p-6 bg-white rounded-2xl shadow-sm border border-outline-variant">
                                    <p class="text-xs text-outline font-bold uppercase mb-2">Cuối kì</p>
                                    <p class="text-4xl font-black text-[#dc2626]">{{ $grade->final_score }}</p>
                                    <p class="text-[10px] text-outline mt-2 font-bold uppercase">Thang điểm 10</p>
                                </div>
                                <div class="p-6 bg-white rounded-2xl shadow-sm border border-outline-variant">
                                    <p class="text-xs text-outline font-bold uppercase mb-2">Đi học</p>
                                    <p class="text-4xl font-black text-[#00C2CB]">{{ $grade->attendance_rate }}</p>
                                    <p class="text-[10px] text-outline mt-2 font-bold uppercase">Số tiết tham dự</p>
                                </div>
                            </div>

                            <div class="mt-8 p-4 bg-[#FFF5F2] rounded-xl border border-primary/20 flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary">info</span>
                                <p class="text-sm text-on-surface-variant">
                                    <strong>Nhận xét:</strong> 
                                    @if($grade->final_score >= 8)
                                        Kết quả học tập xuất sắc! Hãy tiếp tục duy trì phong độ này.
                                    @elseif($grade->final_score >= 5)
                                        Kết quả học tập ổn định. Cần tập trung hơn vào các kỹ năng yếu.
                                    @else
                                        Cần nỗ lực nhiều hơn trong giai đoạn tiếp theo. Liên hệ giáo viên để được hỗ trợ.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    <div class="mt-12 text-center">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
            <span class="material-symbols-outlined">arrow_back</span>
            Quay lại trang chủ
        </a>
    </div>
</main>
@endsection
