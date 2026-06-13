@extends('layouts.app')

@section('title', 'Quản lý điểm & Điểm danh')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-20">
    <div class="mb-12 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h1 class="text-4xl font-black mb-2">Nhập điểm & Điểm danh</h1>
            <p class="text-on-surface-variant italic">Chọn lớp học để bắt đầu cập nhật tiến độ của sinh viên.</p>
        </div>
        
        <!-- Filter Form -->
        <form action="{{ route('teacher.grades_attendance') }}" method="GET" class="flex items-center gap-2 bg-white p-2 rounded-2xl shadow-lg border border-outline-variant">
            <select name="classid" class="border-none focus:ring-0 text-sm font-bold bg-transparent">
                <option value="">Chọn lớp học</option>
                @foreach($classes as $class)
                    <option value="{{ $class->classid }}" {{ (isset($selectedClass) && $selectedClass->classid == $class->classid) ? 'selected' : '' }}>
                        {{ $class->classname }} ({{ $class->course->coursename }})
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-[#00C2CB] text-white px-6 py-2 rounded-xl font-bold hover:opacity-90 transition-all">OK</button>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-2xl border border-green-200 flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    @if(isset($selectedClass))
        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-outline-variant overflow-hidden">
            <!-- Tabs Header -->
            <div class="flex border-b border-outline-variant bg-surface-container-low">
                <button onclick="switchTab('attendance')" id="tab-btn-attendance" class="flex-1 py-6 font-black uppercase tracking-widest transition-all border-b-4 border-primary text-primary">
                    <span class="flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">how_to_reg</span>
                        Điểm danh
                    </span>
                </button>
                <button onclick="switchTab('grades')" id="tab-btn-grades" class="flex-1 py-6 font-black uppercase tracking-widest transition-all border-b-4 border-transparent text-on-surface-variant hover:text-primary">
                    <span class="flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">grade</span>
                        Nhập điểm
                    </span>
                </button>
            </div>

            <form action="{{ route('teacher.grades_attendance.update') }}" method="POST">
                @csrf
                <input type="hidden" name="classid" value="{{ $selectedClass->classid }}">

                <!-- Attendance Tab Content -->
                <div id="tab-content-attendance" class="p-8">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-outline uppercase text-[10px] font-black tracking-widest border-b border-outline-variant">
                                <th class="px-6 py-4">Sinh viên</th>
                                <th class="px-6 py-4">Số tiết đã tham dự</th>
                                <th class="px-6 py-4 text-right">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @foreach($students as $item)
                            <tr>
                                <td class="px-6 py-4 font-bold">{{ $item['fullname'] }}</td>
                                <td class="px-6 py-4">
                                    <input type="number" name="data[{{ $item['id'] }}][attendance]" value="{{ $item['progress']->attendance_rate }}" {{ $item['progress']->is_blocked ? 'disabled' : '' }} class="w-24 rounded-xl border-outline-variant focus:border-primary">
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $item['progress']->is_blocked ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                        {{ $item['progress']->is_blocked ? 'Đã khóa' : 'Đang mở' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Grades Tab Content -->
                <div id="tab-content-grades" class="hidden p-8">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-outline uppercase text-[10px] font-black tracking-widest border-b border-outline-variant">
                                <th class="px-6 py-4">Sinh viên</th>
                                <th class="px-6 py-4">Điểm giữa kì</th>
                                <th class="px-6 py-4">Điểm cuối kì</th>
                                <th class="px-6 py-4 text-right">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @foreach($students as $item)
                            <tr>
                                <td class="px-6 py-4 font-bold">{{ $item['fullname'] }}</td>
                                <td class="px-6 py-4">
                                    <input type="number" step="0.1" name="data[{{ $item['id'] }}][midterm]" value="{{ $item['progress']->midterm_score }}" {{ $item['progress']->is_blocked ? 'disabled' : '' }} class="w-24 rounded-xl border-outline-variant focus:border-primary">
                                </td>
                                <td class="px-6 py-4">
                                    <input type="number" step="0.1" name="data[{{ $item['id'] }}][final]" value="{{ $item['progress']->final_score }}" {{ $item['progress']->is_blocked ? 'disabled' : '' }} class="w-24 rounded-xl border-outline-variant focus:border-primary">
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $item['progress']->is_blocked ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                        {{ $item['progress']->is_blocked ? 'Đã khóa' : 'Đang mở' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-8 bg-surface-container-low border-t border-outline-variant flex justify-between items-center">
                    <p class="text-sm text-on-surface-variant italic max-w-md">
                        <span class="material-symbols-outlined text-sm align-middle">info</span>
                        Lưu ý: Chỉ những sinh viên có trạng thái "Đang mở" mới có thể lưu dữ liệu. Liên hệ Admin nếu bản ghi bị khóa.
                    </p>
                    <button type="submit" class="bg-[#dc2626] text-white px-12 py-4 rounded-2xl font-black shadow-xl hover:scale-105 transition-all">LƯU CẬP NHẬT</button>
                </div>
            </form>
        </div>
    @else
        <div class="bg-white rounded-[2rem] p-20 text-center shadow-lg border border-outline-variant">
            <span class="material-symbols-outlined text-8xl text-outline mb-6">filter_alt</span>
            <h2 class="text-3xl font-black text-on-surface">Vui lòng chọn lớp học</h2>
            <p class="text-on-surface-variant mt-4 text-lg">Chọn một lớp từ danh sách phía trên để bắt đầu quản lý sinh viên.</p>
        </div>
    @endif
</main>

<script>
    function switchTab(tab) {
        const attendanceBtn = document.getElementById('tab-btn-attendance');
        const gradesBtn = document.getElementById('tab-btn-grades');
        const attendanceContent = document.getElementById('tab-content-attendance');
        const gradesContent = document.getElementById('tab-content-grades');

        if (tab === 'attendance') {
            attendanceBtn.classList.add('border-primary', 'text-primary');
            attendanceBtn.classList.remove('border-transparent', 'text-on-surface-variant');
            gradesBtn.classList.add('border-transparent', 'text-on-surface-variant');
            gradesBtn.classList.remove('border-primary', 'text-primary');
            
            attendanceContent.classList.remove('hidden');
            gradesContent.classList.add('hidden');
        } else {
            gradesBtn.classList.add('border-primary', 'text-primary');
            gradesBtn.classList.remove('border-transparent', 'text-on-surface-variant');
            attendanceBtn.classList.add('border-transparent', 'text-on-surface-variant');
            attendanceBtn.classList.remove('border-primary', 'text-primary');
            
            gradesContent.classList.remove('hidden');
            attendanceContent.classList.add('hidden');
        }
    }
</script>
@endsection
