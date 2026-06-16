@extends('layouts.app')

@section('title', 'Hồ sơ cá nhân')

@section('content')
<div class="bg-surface py-12">
    <div class="container max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-black text-on-surface mb-2">Hồ sơ cá nhân</h1>
            <p class="text-outline">Quản lý và cập nhật thông tin tài khoản của bạn</p>
        </div>

        @if(session('success'))
            <div class="bg-success/20 text-success border border-success/30 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-error/20 text-error border border-error/30 px-4 py-3 rounded-xl mb-6">
                <div class="flex items-center gap-3 mb-2">
                    <span class="material-symbols-outlined">error</span>
                    <span class="font-bold">Đã có lỗi xảy ra!</span>
                </div>
                <ul class="list-disc list-inside text-sm pl-8">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Profile Form -->
        <div class="bg-white rounded-3xl shadow-xl border border-outline-variant overflow-hidden">
            <form action="{{ route('profile.update') }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')

                <!-- Section: User Info -->
                <div>
                    <h2 class="text-xl font-bold text-primary border-b border-outline-variant pb-2 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined">person</span> Thông tin tài khoản
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Họ tên -->
                        <div class="space-y-2">
                            <label for="fullname" class="text-sm font-bold text-on-surface">Họ và tên <span class="text-error">*</span></label>
                            <input type="text" name="fullname" id="fullname" value="{{ old('fullname', $user->fullname) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-on-surface" required>
                        </div>
                        
                        <!-- Email (Read Only) -->
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-bold text-on-surface">Email</label>
                            <input type="email" value="{{ $user->email }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container/50 text-outline cursor-not-allowed font-semibold" readonly disabled title="Email không thể thay đổi">
                        </div>

                        <!-- Số điện thoại -->
                        <div class="space-y-2">
                            <label for="phone" class="text-sm font-bold text-on-surface">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-on-surface">
                        </div>

                        <!-- Vai trò (Read Only) -->
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface">Vai trò</label>
                            <input type="text" value="{{ strtoupper($user->role) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container/50 text-outline cursor-not-allowed font-semibold uppercase" readonly disabled>
                        </div>
                    </div>
                </div>

                <!-- Section: Student Info (Chỉ hiển thị cho Student) -->
                @if($user->role === 'student' || $student)
                <div>
                    <h2 class="text-xl font-bold text-primary border-b border-outline-variant pb-2 mb-6 flex items-center gap-2 mt-8">
                        <span class="material-symbols-outlined">school</span> Thông tin học viên
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Ngày sinh -->
                        <div class="space-y-2">
                            <label for="dateofbirth" class="text-sm font-bold text-on-surface">Ngày sinh</label>
                            <input type="date" name="dateofbirth" id="dateofbirth" value="{{ old('dateofbirth', $student ? $student->dateofbirth : '') }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-on-surface">
                        </div>

                        <!-- Giới tính -->
                        <div class="space-y-2">
                            <label for="gender" class="text-sm font-bold text-on-surface">Giới tính</label>
                            <select name="gender" id="gender" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-on-surface appearance-none">
                                <option value="nam" {{ old('gender', $student ? $student->gender : '') === 'nam' ? 'selected' : '' }}>Nam</option>
                                <option value="nữ" {{ old('gender', $student ? $student->gender : '') === 'nữ' ? 'selected' : '' }}>Nữ</option>
                                <option value="khác" {{ old('gender', $student ? $student->gender : '') === 'khác' ? 'selected' : '' }}>Khác</option>
                            </select>
                        </div>

                        <!-- Địa chỉ -->
                        <div class="space-y-2 md:col-span-2">
                            <label for="address" class="text-sm font-bold text-on-surface">Địa chỉ</label>
                            <input type="text" name="address" id="address" value="{{ old('address', $student ? $student->address : '') }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-on-surface">
                        </div>

                        <!-- Tên phụ huynh -->
                        <div class="space-y-2">
                            <label for="parentname" class="text-sm font-bold text-on-surface">Tên phụ huynh</label>
                            <input type="text" name="parentname" id="parentname" value="{{ old('parentname', $student ? $student->parentname : '') }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-on-surface">
                        </div>

                        <!-- SĐT phụ huynh -->
                        <div class="space-y-2">
                            <label for="parentphone" class="text-sm font-bold text-on-surface">Số điện thoại phụ huynh</label>
                            <input type="text" name="parentphone" id="parentphone" value="{{ old('parentphone', $student ? $student->parentphone : '') }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-on-surface">
                        </div>
                    </div>
                </div>
                @endif

                <!-- Section: Change Password -->
                <div>
                    <h2 class="text-xl font-bold text-primary border-b border-outline-variant pb-2 mb-6 flex items-center gap-2 mt-8">
                        <span class="material-symbols-outlined">lock_reset</span> Đổi mật khẩu
                    </h2>
                    <p class="text-sm text-outline mb-4">Bỏ trống nếu không muốn thay đổi mật khẩu hiện tại.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Mật khẩu mới -->
                        <div class="space-y-2">
                            <label for="password" class="text-sm font-bold text-on-surface">Mật khẩu mới</label>
                            <input type="password" name="password" id="password" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-on-surface" placeholder="Ít nhất 8 ký tự">
                        </div>

                        <!-- Xác nhận mật khẩu mới -->
                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-sm font-bold text-on-surface">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-on-surface" placeholder="Nhập lại mật khẩu mới">
                        </div>
                    </div>
                </div>

                <!-- Submit Action -->
                <div class="pt-6 border-t border-outline-variant text-right">
                    <button type="submit" class="btn btn--primary flex items-center gap-2 px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 ml-auto">
                        <span class="material-symbols-outlined">save</span>
                        <span>Cập nhật thông tin</span>
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>
@endsection
