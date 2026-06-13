@extends('layouts.dashboard')

@section('title', 'Tạo hóa đơn mới')

@section('contentdashboard')
<div class="p-8 flex justify-center">
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-xl border border-outline-variant overflow-hidden">
        <div class="bg-primary p-6 text-white flex justify-between items-center">
            <h1 class="text-2xl font-bold">Tạo hóa đơn mới</h1>
            <a href="{{ route('payment.admin') }}" class="material-symbols-outlined hover:bg-white/10 p-2 rounded-full transition-all">close</a>
        </div>
        
        <form action="{{ route('payment.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label class="block text-sm font-bold text-on-surface-variant">Chọn đăng ký khóa học</label>
                <select name="registrationid" class="w-full rounded-xl border-outline-variant focus:ring-primary focus:border-primary" required>
                    <option value="">-- Chọn đăng ký --</option>
                    @foreach($registrations as $reg)
                        <option value="{{ $reg->registrationid }}">
                            {{ $reg->student->user->fullname ?? 'N/A' }} - {{ $reg->class->course->coursename }} ({{ $reg->class->classname }})
                        </option>
                    @endforeach
                </select>
                @error('registrationid') <p class="text-error text-xs">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-on-surface-variant">Số tiền (VNĐ)</label>
                    <input type="number" name="amount" class="w-full rounded-xl border-outline-variant focus:ring-primary focus:border-primary" placeholder="VD: 5000000" required>
                    @error('amount') <p class="text-error text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-on-surface-variant">Phương thức thanh toán</label>
                    <select name="paymentmethod" class="w-full rounded-xl border-outline-variant focus:ring-primary focus:border-primary" required>
                        <option value="Chuyển khoản">Chuyển khoản</option>
                        <option value="Tiền mặt">Tiền mặt</option>
                        <option value="Thẻ tín dụng">Thẻ tín dụng</option>
                        <option value="Ví điện tử">Ví điện tử</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-on-surface-variant">Ngày thanh toán</label>
                    <input type="datetime-local" name="paymentdate" value="{{ date('Y-m-d\TH:i') }}" class="w-full rounded-xl border-outline-variant focus:ring-primary focus:border-primary" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-on-surface-variant">Trạng thái</label>
                    <select name="status" class="w-full rounded-xl border-outline-variant focus:ring-primary focus:border-primary" required>
                        <option value="pending">Đang xử lý</option>
                        <option value="Success">Thành công</option>
                        <option value="failed">Thất bại</option>
                    </select>
                </div>
            </div>

            <div class="pt-6 flex gap-4">
                <button type="submit" class="flex-1 bg-primary text-white py-3 rounded-xl font-bold hover:opacity-90 active:scale-[0.98] transition-all">
                    Tạo hóa đơn
                </button>
                <a href="{{ route('payment.admin') }}" class="flex-1 text-center bg-surface-variant text-on-surface-variant py-3 rounded-xl font-bold hover:bg-outline-variant transition-all">
                    Hủy bỏ
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
