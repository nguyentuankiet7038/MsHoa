@extends('layouts.dashboard')

@section('title', 'Quản lý học sinh')

@section('contentdashboard')
<div class="p-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-3xl font-black text-on-surface">Quản lý học sinh</h1>
            <p class="text-on-surface/70 mt-1">Quản lý học sinh và chi tiết đăng ký của họ.</p>
        </div>
        <a href="{{ route('admin.students.create') }}" class="flex items-center justify-center gap-2 px-6 py-4 bg-primary text-on-primary rounded-xl font-bold shadow-lg hover:brightness-110 transition-all active:scale-[0.98]">
            <span class="material-symbols-outlined">person_add</span>
            Thêm học sinh mới
        </a>
    </div>

    <div class="bg-white border border-outline/10 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-surface-container-high border-b border-outline/10">
                    <tr>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Tên học sinh</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Ngày sinh</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Liên hệ phụ huynh</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Email</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface text-right">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline/10">
                    @forelse($students as $student)
                    <tr class="hover:bg-surface-container-low transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                    {{ substr($student->user->fullname, 0, 1) }}
                                </div>
                                <span class="font-bold text-on-surface">{{ $student->user->fullname }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-on-surface/70">{{ $student->dateofbirth }}</td>
                        <td class="px-6 py-4 text-on-surface/70">
                            <p class="font-medium text-on-surface">{{ $student->parentname }}</p>
                            <p class="text-xs">{{ $student->parentphone }}</p>
                        </td>
                        <td class="px-6 py-4 text-on-surface/70">{{ $student->user->email }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.students.edit', $student->studentid) }}" class="p-2 text-on-surface/70 hover:text-primary hover:bg-primary/10 rounded-lg transition-all">
                                    <span class="material-symbols-outlined text-xl">edit</span>
                                </a>
                                <form action="{{ route('admin.students.destroy', $student->studentid) }}" method="POST" onsubmit="return confirm('Xóa học sinh này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-on-surface/70 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                        <span class="material-symbols-outlined text-xl">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-on-surface/50">Không tìm thấy học sinh nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-outline/10">
            {{ $students->links() }}
        </div>
    </div>
</div>
@endsection
