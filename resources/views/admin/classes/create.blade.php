@extends('layouts.dashboard')

@section('contentdashboard')
<main class="p-8">
    <div class="mb-10">
        <a href="{{ route('admin.classes.index') }}" class="text-on-surface-variant hover:text-primary flex items-center gap-1 mb-2">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Quay lại danh sách
        </a>
        <h1 class="text-3xl font-headline font-black text-on-surface">Tạo lớp học mới</h1>
        <p class="text-on-surface-variant mt-1">Thiết lập chi tiết lớp học và phân bổ học sinh/giáo viên.</p>
    </div>

    <form action="{{ route('admin.classes.store') }}" method="POST" id="createClassForm">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Side: Basic Info -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white p-6 rounded-3xl border border-outline-variant shadow-sm">
                    <h3 class="font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">info</span>
                        Thông tin lớp học
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Tên lớp học</label>
                            <input type="text" name="classname" required class="w-full rounded-xl border-outline-variant">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Chọn khóa học</label>
                            <select name="courseid" id="course_select" required class="w-full rounded-xl border-outline-variant">
                                <option value="">-- Chọn khóa học --</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->courseid }}">{{ $course->coursename }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Lịch học</label>
                            <input type="text" name="schedule" id="schedule_input" placeholder="vd: 2,4,6|18:00-20:00" required class="w-full rounded-xl border-outline-variant">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Ngày bắt đầu</label>
                                <input type="date" name="start_date" required class="w-full rounded-xl border-outline-variant">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Ngày kết thúc</label>
                                <input type="date" name="end_date" required class="w-full rounded-xl border-outline-variant">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-outline-variant shadow-sm">
                    <h3 class="font-bold mb-4 flex items-center gap-2 text-on-surface">
                        <span class="material-symbols-outlined text-primary">person</span>
                        Phân công giáo viên
                    </h3>
                    <div class="space-y-4">
                        <div class="flex gap-2">
                            <input type="text" id="qual_filter" placeholder="Bằng cấp" class="w-1/2 text-xs rounded-xl border-outline-variant focus:ring-primary focus:border-primary">
                            <input type="text" id="exp_filter" placeholder="Chuyên môn" class="w-1/2 text-xs rounded-xl border-outline-variant focus:ring-primary focus:border-primary">
                        </div>
                        <button type="button" onclick="filterTeachers()" class="w-full py-3 bg-primary-container/30 text-primary rounded-xl text-xs font-bold hover:bg-primary-container/50 transition-all">
                            Tìm giáo viên có sẵn
                        </button>
                        
                        <div id="teacher_list" class="space-y-2 max-h-[250px] overflow-y-auto p-1 custom-scrollbar" style="overscroll-behavior: contain;">
                            <p class="text-xs text-on-surface-variant italic py-4 text-center">Tìm kiếm để xem giáo viên có sẵn...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Student Selection -->
            <div class="lg:col-span-8">
                <div class="bg-white p-8 rounded-[2rem] border border-outline-variant shadow-sm flex flex-col">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="font-bold text-xl flex items-center gap-2 text-on-surface">
                            <span class="material-symbols-outlined text-primary">group</span>
                            Phân bổ học sinh đã duyệt
                        </h3>
                        <span id="student_count" class="text-sm bg-primary text-on-primary px-4 py-1 rounded-full font-bold">0 Đã chọn</span>
                    </div>

                    <div class="max-h-[600px] overflow-y-auto pr-2 custom-scrollbar" style="overscroll-behavior: contain;">
                        <div id="student_container" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="col-span-full py-32 text-center text-on-surface-variant">
                                <span class="material-symbols-outlined text-6xl opacity-20 mb-4">how_to_reg</span>
                                <p class="text-lg">Vui lòng chọn Khóa học và Lịch học để xem học sinh có sẵn.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-primary text-on-primary px-12 py-4 rounded-full font-bold shadow-xl hover:brightness-110 transition-all active:scale-95 flex items-center gap-3 text-lg">
                        <span class="material-symbols-outlined">verified_user</span>
                        Tạo lớp & Phân bổ
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

        fetch(`{{ route('admin.classes.getStudents') }}?course_id=${courseId}&schedule=${schedule}`)
            .then(res => res.json())
            .then(data => {
                studentContainer.innerHTML = '';
                if (data.length === 0) {
                    studentContainer.innerHTML = '<div class="col-span-full text-center py-10 opacity-50 italic">Không tìm thấy học sinh đã duyệt cho khóa học này.</div>';
                    return;
                }

                data.forEach(reg => {
                    const card = `
                        <label class="flex items-center gap-4 p-4 rounded-2xl border border-outline-variant hover:bg-surface-container transition-all cursor-pointer group">
                            <input type="checkbox" name="student_ids[]" value="${reg.studentid}" onchange="updateCount()" class="rounded-full text-primary focus:ring-primary">
                            <div class="flex-grow">
                                <p class="font-bold text-sm group-hover:text-primary transition-colors">${reg.student.user.fullname}</p>
                                <p class="text-xs text-on-surface-variant">${reg.student.user.email}</p>
                            </div>
                        </label>
                    `;
                    studentContainer.insertAdjacentHTML('beforeend', card);
                });
            });
    }

    function filterTeachers() {
        const qual = document.getElementById('qual_filter').value;
        const exp = document.getElementById('exp_filter').value;

        fetch(`{{ route('admin.classes.getTeachers') }}?qualification=${qual}&expertise=${exp}`)
            .then(res => res.json())
            .then(data => {
                teacherList.innerHTML = '';
                data.forEach(t => {
                    const item = `
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-outline-variant hover:border-primary transition-all cursor-pointer">
                            <input type="radio" name="teacherid" value="${t.teacherid}" required class="text-primary focus:ring-primary">
                            <div class="text-xs">
                                <p class="font-bold">${t.user.fullname}</p>
                                <p class="opacity-70">${t.qualification} - ${t.expertise}</p>
                            </div>
                        </label>
                    `;
                    teacherList.insertAdjacentHTML('beforeend', item);
                });
            });
    }

    function updateCount() {
        const checked = document.querySelectorAll('input[name="student_ids[]"]:checked').length;
        document.getElementById('student_count').textContent = `${checked} Đã chọn`;
    }

    courseSelect.addEventListener('change', updateStudentFilter);
    scheduleInput.addEventListener('blur', updateStudentFilter);
</script>
@endsection
