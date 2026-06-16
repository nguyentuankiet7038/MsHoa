@extends('layouts.dashboard')

@section('contentdashboard')
<main class="p-8">
    <div class="mb-10">
        <a href="{{ route('admin.classes.index') }}" class="text-on-surface-variant hover:text-primary flex items-center gap-1 mb-2">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Quay lại danh sách
        </a>
        <h1 class="text-3xl font-headline font-black text-on-surface">Cập nhật lớp học: <span class="text-primary">{{ $class->classname }}</span></h1>
        <p class="text-on-surface-variant mt-1">Chỉnh sửa thông tin, phân công giáo viên và quản lý học sinh.</p>
    </div>

    <form action="{{ route('admin.classes.update', $class->classid) }}" method="POST" id="editClassForm">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Side: Basic Info -->
            <div class="lg:col-span-4 space-y-6">
                <!-- THÔNG TIN LỚP HỌC -->
                <div class="bg-white p-6 rounded-3xl border border-outline-variant shadow-sm">
                    <h3 class="font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">info</span>
                        Thông tin lớp học
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Tên lớp học</label>
                            <input type="text" name="classname" value="{{ $class->classname }}" required class="w-full rounded-xl border-outline-variant">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Khóa học</label>
                            <select name="courseid" id="course_select" required class="w-full rounded-xl border-outline-variant">
                                @foreach($courses as $course)
                                    <option value="{{ $course->courseid }}" {{ $class->courseid == $course->courseid ? 'selected' : '' }}>
                                        {{ $course->coursename }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Lịch học</label>
                            <input type="text" name="schedule" id="schedule_input" value="{{ $class->schedule }}" required class="w-full rounded-xl border-outline-variant">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Ngày bắt đầu</label>
                                <input type="date" name="start_date" value="{{ $class->start_date }}" required class="w-full rounded-xl border-outline-variant">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Ngày kết thúc</label>
                                <input type="date" name="end_date" value="{{ $class->end_date }}" required class="w-full rounded-xl border-outline-variant">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PHÂN CÔNG GIÁO VIÊN -->
                <div class="bg-white p-6 rounded-3xl border border-outline-variant shadow-sm">
                    <h3 class="font-bold mb-4 flex items-center gap-2 text-on-surface">
                        <span class="material-symbols-outlined text-primary">person</span>
                        Phân công giáo viên
                    </h3>
                    
                    <!-- Giáo viên hiện tại -->
                    <div class="mb-4 p-3 bg-primary-container/20 border border-primary/20 rounded-xl flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold">
                            {{ substr($class->teacher->user->fullname ?? 'G', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-xs text-outline font-bold uppercase tracking-wider">Giáo viên hiện tại</p>
                            <p class="font-bold text-sm">{{ $class->teacher->user->fullname ?? 'Chưa phân công' }}</p>
                        </div>
                    </div>

                    <!-- Tìm giáo viên mới để đổi -->
                    <div class="space-y-4">
                        <div class="flex gap-2">
                            <input type="text" id="qual_filter" placeholder="Bằng cấp" class="w-1/2 text-xs rounded-xl border-outline-variant focus:ring-primary focus:border-primary">
                            <input type="text" id="exp_filter" placeholder="Chuyên môn" class="w-1/2 text-xs rounded-xl border-outline-variant focus:ring-primary focus:border-primary">
                        </div>
                        <button type="button" onclick="filterTeachers()" class="w-full py-3 bg-surface-container-high text-on-surface-variant rounded-xl text-xs font-bold hover:bg-surface-container-highest transition-all flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">search</span> Tìm giáo viên thay thế
                        </button>
                        
                        <div id="teacher_list" class="space-y-2 max-h-[250px] overflow-y-auto p-1 custom-scrollbar" style="overscroll-behavior: contain;">
                            <!-- Mặc định chọn giáo viên cũ -->
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-primary bg-primary/5 cursor-pointer">
                                <input type="radio" name="teacherid" value="{{ $class->teacherid }}" checked required class="text-primary focus:ring-primary">
                                <div class="text-xs">
                                    <p class="font-bold">Giữ nguyên giáo viên hiện tại</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Students -->
            <div class="lg:col-span-8 space-y-6">
                
                <!-- HỌC SINH ĐANG TRONG LỚP -->
                <div class="bg-white p-6 rounded-3xl border border-outline-variant shadow-sm flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-lg flex items-center gap-2 text-on-surface">
                            <span class="material-symbols-outlined text-primary">groups</span>
                            Học sinh đang có trong lớp
                        </h3>
                        <span class="text-sm bg-primary/10 text-primary px-3 py-1 rounded-full font-bold">{{ $class->registrations->count() }} Học sinh</span>
                    </div>
                    
                    <p class="text-xs text-outline mb-4 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">info</span> Tích chọn học sinh để <strong>gỡ bỏ</strong> khỏi lớp học này.</p>

                    <div class="max-h-[300px] overflow-y-auto pr-2 custom-scrollbar border border-outline-variant rounded-xl p-2 bg-surface-container-lowest" style="overscroll-behavior: contain;">
                        @if($class->registrations->count() > 0)
                            <div class="grid grid-cols-1 gap-2">
                                @foreach($class->registrations as $reg)
                                    <label class="flex items-center justify-between p-3 rounded-xl border border-transparent hover:bg-error/5 hover:border-error/20 transition-all cursor-pointer group">
                                        <div class="flex items-center gap-3">
                                            <input type="checkbox" name="remove_student_ids[]" value="{{ $reg->studentid }}" class="rounded text-error focus:ring-error w-5 h-5">
                                            <div>
                                                <p class="font-bold text-sm text-on-surface">{{ $reg->student->user->fullname ?? 'N/A' }}</p>
                                                <p class="text-xs text-on-surface-variant">{{ $reg->student->user->email ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <span class="text-error text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity">Gỡ bỏ</span>
                                    </label>
                                @endforeach
                            </div>
                        @else
                            <div class="py-10 text-center text-on-surface-variant italic text-sm">
                                Lớp học này chưa có học sinh nào.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- THÊM HỌC SINH MỚI -->
                <div class="bg-white p-6 rounded-3xl border border-outline-variant shadow-sm flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-lg flex items-center gap-2 text-on-surface">
                            <span class="material-symbols-outlined text-success">person_add</span>
                            Thêm học sinh mới vào lớp
                        </h3>
                        <button type="button" onclick="updateStudentFilter()" class="bg-surface-container-high hover:bg-surface-container-highest px-3 py-1 rounded-lg text-xs font-bold flex items-center gap-1 transition-colors">
                            <span class="material-symbols-outlined text-[16px]">refresh</span> Làm mới
                        </button>
                    </div>

                    <p class="text-xs text-outline mb-4">Danh sách học sinh <strong>đã được duyệt</strong> của khóa học tương ứng nhưng <strong>chưa được phân lớp</strong>.</p>

                    <div class="max-h-[300px] overflow-y-auto pr-2 custom-scrollbar border border-outline-variant rounded-xl p-2 bg-surface-container-lowest" style="overscroll-behavior: contain;">
                        <div id="student_container" class="grid grid-cols-1 gap-2">
                            <div class="py-10 text-center text-on-surface-variant">
                                <span class="material-symbols-outlined text-4xl opacity-20 mb-2 block">hourglass_empty</span>
                                <p class="text-sm">Đang tải danh sách học sinh...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex justify-end">
                    <button type="submit" class="bg-primary text-on-primary px-10 py-4 rounded-full font-bold shadow-xl hover:brightness-110 transition-all active:scale-95 flex items-center gap-3 text-lg">
                        <span class="material-symbols-outlined">save</span>
                        Lưu Cập Nhật
                    </button>
                </div>
            </div>
        </div>
    </form>
</main>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e6e0e9;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #00C2CB;
    }
</style>

<script>
    const courseSelect = document.getElementById('course_select');
    const scheduleInput = document.getElementById('schedule_input');
    const studentContainer = document.getElementById('student_container');
    const teacherList = document.getElementById('teacher_list');

    function updateStudentFilter() {
        const courseId = courseSelect.value;
        const schedule = scheduleInput.value;

        if (!courseId) return;

        studentContainer.innerHTML = '<div class="py-10 text-center text-on-surface-variant"><span class="material-symbols-outlined animate-spin text-2xl block mb-2">autorenew</span><p class="text-sm">Đang tải...</p></div>';

        fetch(`{{ route('admin.classes.getStudents') }}?course_id=${courseId}&schedule=${schedule}`)
            .then(res => res.json())
            .then(data => {
                studentContainer.innerHTML = '';
                if (data.length === 0) {
                    studentContainer.innerHTML = '<div class="text-center py-10 opacity-50 italic text-sm">Không tìm thấy học sinh rảnh cho khóa học này.</div>';
                    return;
                }

                data.forEach(reg => {
                    const card = `
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-transparent hover:bg-success/5 hover:border-success/20 transition-all cursor-pointer group">
                            <input type="checkbox" name="add_student_ids[]" value="${reg.studentid}" class="rounded-full text-success focus:ring-success w-5 h-5">
                            <div class="flex-grow">
                                <p class="font-bold text-sm text-on-surface group-hover:text-success transition-colors">${reg.student.user.fullname}</p>
                                <p class="text-xs text-on-surface-variant">${reg.student.user.email}</p>
                            </div>
                            <span class="text-success text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">add</span>Thêm</span>
                        </label>
                    `;
                    studentContainer.insertAdjacentHTML('beforeend', card);
                });
            })
            .catch(err => {
                studentContainer.innerHTML = '<div class="text-center py-10 text-error text-sm">Lỗi tải dữ liệu.</div>';
            });
    }

    function filterTeachers() {
        const qual = document.getElementById('qual_filter').value;
        const exp = document.getElementById('exp_filter').value;

        teacherList.innerHTML += '<div class="text-center py-4"><span class="material-symbols-outlined animate-spin">autorenew</span></div>';

        fetch(`{{ route('admin.classes.getTeachers') }}?qualification=${qual}&expertise=${exp}`)
            .then(res => res.json())
            .then(data => {
                // Keep the "Giữ nguyên" option
                const currentTeacherRadio = `
                    <label class="flex items-center gap-3 p-3 rounded-xl border border-primary bg-primary/5 cursor-pointer mb-2">
                        <input type="radio" name="teacherid" value="{{ $class->teacherid }}" checked required class="text-primary focus:ring-primary">
                        <div class="text-xs">
                            <p class="font-bold text-primary">Giữ nguyên giáo viên hiện tại</p>
                        </div>
                    </label>
                `;
                
                teacherList.innerHTML = currentTeacherRadio;

                data.forEach(t => {
                    if(t.teacherid == "{{ $class->teacherid }}") return; // Skip current teacher to avoid duplicate
                    
                    const item = `
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-outline-variant hover:border-primary hover:bg-surface-container transition-all cursor-pointer">
                            <input type="radio" name="teacherid" value="${t.teacherid}" class="text-primary focus:ring-primary">
                            <div class="text-xs">
                                <p class="font-bold">${t.user.fullname}</p>
                                <p class="opacity-70">${t.qualification || 'N/A'} - ${t.expertise || 'N/A'}</p>
                            </div>
                        </label>
                    `;
                    teacherList.insertAdjacentHTML('beforeend', item);
                });
            });
    }

    // Load available students on page load
    document.addEventListener('DOMContentLoaded', () => {
        updateStudentFilter();
    });

    courseSelect.addEventListener('change', updateStudentFilter);
</script>
@endsection
