@extends('layouts.dashboard')

@section('title', 'Quản lý giáo viên')

@section('contentdashboard')
<div class="p-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-3xl font-black text-on-surface">Quản lý giáo viên</h1>
            <p class="text-on-surface/70 mt-1">Quản lý đội ngũ giảng dạy và chuyên môn của họ.</p>
        </div>
        <a href="{{ route('admin.teachers.create') }}" class="flex items-center justify-center gap-2 px-6 py-4 bg-primary text-on-primary rounded-xl font-bold shadow-lg hover:brightness-110 transition-all active:scale-[0.98]">
            <span class="material-symbols-outlined">person_add</span>
            Thêm giáo viên mới
        </a>
    </div>

    <div class="bg-white border border-outline/10 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-surface-container-high border-b border-outline/10">
                    <tr>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Tên giáo viên</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Chuyên môn</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Bằng cấp</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Email</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface text-right">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline/10">
                    @forelse($teachers as $teacher)
                    <tr class="hover:bg-surface-container-low transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                    {{ substr($teacher->user->fullname, 0, 1) }}
                                </div>
                                <span class="font-bold text-on-surface">{{ $teacher->user->fullname }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-on-surface/70">{{ $teacher->specialy }}</td>
                        <td class="px-6 py-4 text-on-surface/70">{{ $teacher->qualification }}</td>
                        <td class="px-6 py-4 text-on-surface/70">{{ $teacher->user->email }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.teachers.edit', $teacher->teacherid) }}" class="p-2 text-on-surface/70 hover:text-primary hover:bg-primary/10 rounded-lg transition-all">
                                    <span class="material-symbols-outlined text-xl">edit</span>
                                </a>
                                <form action="{{ route('admin.teachers.destroy', $teacher->teacherid) }}" method="POST" onsubmit="return confirm('Xóa giáo viên này?')">
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
                        <td colspan="5" class="px-6 py-8 text-center text-on-surface/50">Không tìm thấy giáo viên nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-outline/10">
            {{ $teachers->links() }}
        </div>
    </div>
</div>
@endsection
