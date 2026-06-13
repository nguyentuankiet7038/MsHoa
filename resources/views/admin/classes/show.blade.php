@extends('layouts.dashboard')

@section('contentdashboard')
<main class="p-8" id="print-area">
    <div class="mb-10 no-print">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('admin.classes.index') }}" class="text-on-surface-variant hover:text-primary flex items-center gap-1 mb-2">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Quay lại danh sách lớp
                </a>
                <h1 class="text-3xl font-headline font-black text-on-surface">{{ $class->classname }}</h1>
                <p class="text-on-surface-variant mt-1">Danh sách học sinh chi tiết và thông tin lớp học.</p>
            </div>
            <div class="flex gap-3">
                <button onclick="window.print()" class="flex items-center gap-2 px-6 py-3 bg-surface-container-high text-on-surface rounded-xl font-bold hover:bg-surface-container-highest transition-all">
                    <span class="material-symbols-outlined">print</span>
                    In danh sách
                </button>
                <a href="{{ route('admin.classes.export', $class->classid) }}" class="flex items-center gap-2 px-6 py-3 bg-[#1D6F42] text-white rounded-xl font-bold hover:brightness-110 transition-all">
                    <span class="material-symbols-outlined">download</span>
                    Xuất Excel (CSV)
                </a>
            </div>
        </div>
    </div>

    <!-- Print-only Header -->
    <div class="only-print mb-8 text-center">
        <h1 class="text-2xl font-bold uppercase">Danh sách lớp: {{ $class->classname }}</h1>
        <p class="text-lg">Khóa học: {{ $class->course->coursename }}</p>
        <p class="text-lg">Giáo viên: {{ $class->teacher->user->fullname ?? 'N/A' }}</p>
        <hr class="my-4 border-black">
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8 no-print">
        <div class="lg:col-span-12 bg-white p-8 rounded-[2.5rem] border border-outline-variant shadow-sm flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-6 w-full md:w-auto">
                <div class="w-16 h-16 rounded-2xl bg-primary-container flex items-center justify-center text-primary text-3xl">
                    <span class="material-symbols-outlined text-4xl">person</span>
                </div>
                <div>
                    <p class="text-sm uppercase tracking-widest text-on-surface-variant font-bold">Giáo viên phụ trách</p>
                    <p class="text-2xl font-black text-on-surface">{{ $class->teacher->user->fullname ?? 'Chưa phân công' }}</p>
                </div>
            </div>
            <div class="flex gap-8 w-full md:w-auto justify-around md:justify-end">
                <div class="text-center">
                    <p class="text-xs uppercase font-bold text-on-surface-variant">Sĩ số</p>
                    <p class="text-xl font-black text-primary">{{ $registrations->count() }}</p>
                </div>
                <div class="text-center">
                    <p class="text-xs uppercase font-bold text-on-surface-variant">Lịch học</p>
                    <p class="text-xl font-black text-primary">{{ $class->schedule }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Table -->
    <div class="bg-white border border-outline-variant rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-surface-container-high border-b border-outline-variant">
                    <tr>
                        <th class="px-4 py-4 text-label-large font-bold text-on-surface text-center">STT</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Họ và Tên</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Ngày sinh</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Phụ huynh (Ba/Mẹ)</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Điện thoại</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Ghi chú</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($registrations as $index => $reg)
                    <tr class="hover:bg-surface-container transition-colors">
                        <td class="px-4 py-4 text-center text-on-surface-variant">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-bold text-on-surface">{{ $reg->student->user->fullname ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $reg->student->dateofbirth ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $reg->student->parentname ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $reg->student->user->phone ?? ($reg->student->parentphone ?? 'N/A') }}</td>
                        <td class="px-6 py-4 text-sm text-on-surface-variant italic">{{ $reg->student->user->notes ?? '' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant">Chưa có học sinh nào trong lớp này.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    @media print {
        .no-print {
            display: none !important;
        }
        .lg\:ml-64 {
            margin-left: 0 !important;
        }
        aside, header, footer {
            display: none !important;
        }
        main {
            padding: 0 !important;
        }
        .only-print {
            display: block !important;
        }
        table {
            border: 1px solid black !important;
        }
        th, td {
            border: 1px solid black !important;
            padding: 8px !important;
        }
    }
    .only-print {
        display: none;
    }
</style>
@endsection
