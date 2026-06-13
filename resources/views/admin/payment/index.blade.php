@extends('layouts.dashboard')

@section('title', 'Quản lý thanh toán')

@section('contentdashboard')
<div class="p-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-headline font-black text-on-surface tracking-tight">Quản lý thanh toán</h1>
            <p class="text-on-surface-variant">Xem lại và quản lý hóa đơn học phí của học sinh</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('payment.export') }}" class="flex items-center gap-2 bg-white text-primary border border-primary/20 px-4 py-2.5 rounded-xl font-bold hover:bg-primary/5 transition-all">
                <span class="material-symbols-outlined">description</span>
                Xuất báo cáo
            </a>
            <a href="{{ route('payment.create') }}" class="flex items-center gap-2 bg-[#00897b] text-white px-4 py-2.5 rounded-xl font-bold shadow-lg hover:opacity-90 transition-all">
                <span class="material-symbols-outlined">add_card</span>
                Tạo hóa đơn
            </a>
        </div>
    </div>

    <!-- Bento Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-outline-variant shadow-sm">
            <span class="text-on-surface-variant text-sm font-medium">Tổng doanh thu</span>
            <div class="flex items-end justify-between mt-2">
                <span class="text-2xl font-bold">{{ number_format($payments->where('status', 'Success')->sum('amount'), 0, ',', '.') }}₫</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-outline-variant shadow-sm">
            <span class="text-on-surface-variant text-sm font-medium">Đang xử lý</span>
            <div class="flex items-end justify-between mt-2">
                <span class="text-2xl font-bold">{{ $payments->where('status', 'pending')->count() }}</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-outline-variant shadow-sm">
            <span class="text-on-surface-variant text-sm font-medium">Thất bại</span>
            <div class="flex items-end justify-between mt-2">
                <span class="text-2xl font-bold">{{ $payments->where('status', 'failed')->count() }}</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-outline-variant shadow-sm">
            <span class="text-on-surface-variant text-sm font-medium">Thành công</span>
            <div class="flex items-end justify-between mt-2">
                <span class="text-2xl font-bold">{{ $payments->where('status', 'Success')->count() }}</span>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <form action="{{ route('payment.admin') }}" method="GET" class="bg-white p-4 rounded-3xl border border-outline-variant mb-6 shadow-sm flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase tracking-wider">Tìm kiếm</label>
            <input name="search" value="{{ request('search') }}" class="w-full px-4 py-2 bg-surface rounded-xl border-outline-variant focus:ring-primary focus:border-primary text-sm" placeholder="Mã hóa đơn..." type="text"/>
        </div>
        <div class="min-w-[150px]">
            <label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase tracking-wider">Trạng thái</label>
            <select name="status" class="w-full py-2 bg-surface border-outline-variant rounded-xl focus:ring-primary focus:border-primary text-sm">
                <option value="Tất cả" {{ request('status') == 'Tất cả' ? 'selected' : '' }}>Tất cả</option>
                <option value="Success" {{ request('status') == 'Success' ? 'selected' : '' }}>Đã thanh toán</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Thất bại</option>
            </select>
        </div>
        <button type="submit" class="bg-primary text-white px-6 py-2 rounded-xl font-bold text-sm hover:opacity-90 transition-all">Lọc</button>
    </form>

    <!-- Table Section -->
    <div class="bg-white rounded-3xl border border-outline-variant shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-high border-b border-outline-variant">
                        <th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest">Mã hóa đơn</th>
                        <th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest">Học viên</th>
                        <th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest text-right">Tổng tiền</th>
                        <th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest">Hình thức</th>
                        <th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest">Trạng thái</th>
                        <th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @foreach($payments as $payment)
                    <tr class="hover:bg-surface transition-colors">
                        <td class="px-6 py-4 font-bold text-primary">INV-{{ $payment->paymentid }}</td>
                        <td class="px-6 py-4">
                            <p class="font-medium">{{ $payment->registration->student->user->fullname ?? 'N/A' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-right">{{ number_format($payment->amount, 0, ',', '.') }}₫</td>
                        <td class="px-6 py-4 text-sm">{{ $payment->paymentmethod }}</td>
                        <td class="px-6 py-4">
                            @if($payment->status == 'Success')
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">Đã thanh toán</span>
                            @elseif($payment->status == 'failed')
                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">Thất bại</span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">Đang xử lý</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('payment.show', $payment->paymentid) }}" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-all">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-outline-variant">
            {{ $payments->links() }}
        </div>
    </div>
</div>
@endsection
