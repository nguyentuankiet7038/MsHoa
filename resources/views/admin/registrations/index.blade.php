@extends('layouts.dashboard')

@section('contentdashboard')
<main class="p-8">
    <!-- Header & Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-3xl font-headline font-black text-on-surface">Quản lý đăng ký</h1>
            <p class="text-on-surface-variant mt-1">Quản lý và theo dõi các đăng ký khóa học của học sinh.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    <!-- Registrations Table Container -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-surface-container-high border-b border-outline-variant">
                    <tr>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Mã đăng ký</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Học sinh</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Khóa học/Lớp học</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Ngày đăng ký</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Trạng thái</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface text-right">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($registrations as $reg)
                    <tr class="hover:bg-surface-container transition-colors group">
                        <td class="px-6 py-4 font-mono text-sm text-on-surface-variant">#{{ $reg->registrationid }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-on-primary-fixed font-bold">
                                    {{ substr($reg->student->user->fullname ?? 'S', 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-on-surface">{{ $reg->student->user->fullname ?? 'Không xác định' }}</p>
                                    <p class="text-xs text-on-surface-variant">{{ $reg->student->user->email ?? '' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-on-surface">{{ $reg->class->course->coursename ?? 'Không có khóa học' }}</p>
                            <p class="text-xs text-on-surface-variant">Lớp: {{ $reg->class->classname ?? 'Không có lớp học' }}</p>
                        </td>
                        <td class="px-6 py-4 text-on-surface-variant text-sm">
                            {{ \Carbon\Carbon::parse($reg->registration_date)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'approved' => 'bg-green-100 text-green-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                    'canceled' => 'bg-gray-100 text-gray-700'
                                ];
                                $statusTexts = [
                                    'pending' => 'đang chờ',
                                    'approved' => 'đã duyệt',
                                    'rejected' => 'từ chối',
                                    'canceled' => 'đã hủy'
                                ];
                                $statusClass = $statusClasses[$reg->status] ?? 'bg-surface-variant text-on-surface-variant';
                                $statusText = $statusTexts[$reg->status] ?? $reg->status;
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold capitalize {{ $statusClass }}">
                                {{ $statusText }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.registrations.edit', $reg->registrationid) }}" class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary-fixed rounded-lg">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                                <form action="{{ route('admin.registrations.destroy', $reg->registrationid) }}" method="POST" onsubmit="return confirm('Xóa bản ghi đăng ký này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error-container rounded-lg">
                                        <span class="material-symbols-outlined text-[red]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-on-surface-variant">Không tìm thấy bản ghi đăng ký nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="px-6 py-4 bg-surface-container-low border-t border-outline-variant">
            {{ $registrations->links() }}
        </div>
    </div>
</div>
@endsection
