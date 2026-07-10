@extends('layouts.dashboard')

@section('title', 'Quản lý người dùng')

@section('contentdashboard')
<div class="p-8">
    <!-- Header & Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-3xl font-headline font-black text-on-surface">Quản lý người dùng</h1>
            <p class="text-on-surface-variant mt-1">Quản lý tài khoản, phân quyền và trạng thái hoạt động của người dùng.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="flex items-center justify-center gap-2 px-6 py-4 bg-[#00C2CB] text-white rounded-xl font-bold shadow-lg hover:brightness-105 transition-all active:scale-95">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">person_add</span>
            Thêm người dùng mới
        </a>
    </div>

    <!-- Màn hình lỗi / thành công -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 p-4 rounded-xl font-bold">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-4 rounded-xl font-bold">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- Bento Filter & Grid -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-8">
        <!-- Filter Section -->
        <form action="{{ route('admin.users.index') }}" method="GET" class="md:col-span-12 lg:col-span-4 bg-surface-container p-6 rounded-3xl flex flex-col justify-center border border-outline-variant">
            <div class="flex items-center justify-between mb-4">
                <span class="font-bold text-on-surface">Bộ lọc</span>
                <button type="submit" class="material-symbols-outlined text-primary">search</button>
            </div>
            <div class="space-y-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm tên, email, sđt..." class="w-full rounded-full border-outline-variant bg-surface text-sm focus:ring-primary focus:border-primary">
                <div class="flex flex-wrap gap-2">
                    <select name="role" class="text-xs rounded-full border-outline-variant bg-surface py-1">
                        <option value="All">Tất cả Quyền</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="consultant" {{ request('role') == 'consultant' ? 'selected' : '' }}>Tư vấn viên</option>
                        <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Giáo viên</option>
                        <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Học viên</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User (chưa đăng ký)</option>
                    </select>
                    <select name="status" class="text-xs rounded-full border-outline-variant bg-surface py-1">
                        <option value="All">Tất cả trạng thái</option>
                        <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Đang hoạt động</option>
                        <option value="Locked" {{ request('status') == 'Locked' ? 'selected' : '' }}>Bị khóa</option>
                    </select>
                    <a href="{{ route('admin.users.index') }}" class="text-xs text-on-surface-variant hover:text-primary underline flex items-center">Thiết lập lại</a>
                </div>
            </div>
        </form>

        <!-- Stats/Briefing -->
        <div class="md:col-span-6 lg:col-span-4 bg-primary-container text-on-primary-container p-6 rounded-3xl flex items-center justify-between border border-primary">
            <div>
                <p class="text-sm font-medium opacity-80 uppercase tracking-widest">Tổng số người dùng</p>
                <p class="text-4xl font-black">{{ $stats['total'] }}</p>
                <p class="text-xs opacity-70">Admin: {{ $stats['admins'] }} | GV: {{ $stats['teachers'] }} | HV: {{ $stats['students'] }}</p>
            </div>
            <span class="material-symbols-outlined text-5xl opacity-40">group</span>
        </div>
        <div class="md:col-span-6 lg:col-span-4 bg-error-container text-on-error-container p-6 rounded-3xl flex items-center justify-between border border-error">
            <div>
                <p class="text-sm font-medium opacity-80 uppercase tracking-widest">Tài khoản bị khóa</p>
                <p class="text-4xl font-black">{{ $stats['locked'] }}</p>
                <p class="text-xs opacity-70">Cần kiểm tra trạng thái</p>
            </div>
            <span class="material-symbols-outlined text-5xl opacity-40">lock</span>
        </div>
    </div>

    <!-- Users Table Container -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-surface-container-high border-b border-outline-variant">
                    <tr>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Người dùng</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Vai trò (Role)</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Số điện thoại</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Trạng thái</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface text-right">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($users as $user)
                    <tr class="hover:bg-surface-container transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold flex-shrink-0">
                                    {{ substr($user->fullname, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-on-surface">{{$user->fullname}}</p>
                                    <p class="text-xs text-on-surface-variant">{{$user->email}}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-surface-variant text-on-surface-variant uppercase tracking-wider">
                                {{$user->role}}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $user->phone ?? 'Chưa cập nhật' }}</td>
                        <td class="px-6 py-4">
                            @if($user->is_locked)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-error-container text-on-error-container">Bị khóa</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">Hoạt động</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $user->userid) }}" class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                                @if(auth()->id() != $user->userid)
                                <form action="{{ route('admin.users.destroy', $user->userid) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-on-surface-variant">Không tìm thấy người dùng nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="px-6 py-4 bg-surface-container-low border-t border-outline-variant flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm text-on-surface-variant">
                Đang hiển thị {{ $users->firstItem() ?? 0 }} đến {{ $users->lastItem() ?? 0 }} trong số {{ $users->total() }} người dùng
            </p>
            <div class="pagination-links">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
