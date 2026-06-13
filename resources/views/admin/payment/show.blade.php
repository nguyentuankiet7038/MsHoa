@extends('layouts.dashboard')

@section('title', 'Chi tiết hóa đơn #' . $payment->paymentid)

@section('contentdashboard')
<style>
    @media print {
        .no-print { display: none !important; }
        .print-area { border: none !important; box-shadow: none !important; padding: 0 !important; margin: 0 !important; width: 100% !important; max-width: none !important; }
        aside { display: none !important; }
        main { margin-left: 0 !important; }
    }
</style>

<div class="p-8">
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex justify-between items-center no-print">
            <a href="{{ route('payment.admin') }}" class="flex items-center gap-2 text-primary font-bold hover:underline">
                <span class="material-symbols-outlined">arrow_back</span> Quay lại danh sách
            </a>
            <div class="flex gap-3">
                <button onclick="window.print()" class="flex items-center gap-2 bg-primary text-white px-6 py-2.5 rounded-xl font-bold hover:opacity-90 transition-all">
                    <span class="material-symbols-outlined">print</span> In hóa đơn
                </button>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-outline-variant overflow-hidden print-area">
            <!-- Invoice Header -->
            <div class="p-10 border-b border-outline-variant flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-black text-primary">HÓA ĐƠN THANH TOÁN</h1>
                    <p class="text-on-surface-variant mt-1 italic">Mã số: INV-{{ str_pad($payment->paymentid, 5, '0', STR_PAD_LEFT) }}</p>
                    <div class="mt-6 space-y-1">
                        <p class="font-bold text-on-surface">Ms. Hoa English Center</p>
                        <p class="text-sm text-on-surface-variant">Địa chỉ: 123 Đường ABC, Quận XYZ, TP. HCM</p>
                        <p class="text-sm text-on-surface-variant">Hotline: 0123 456 789</p>
                        <p class="text-sm text-on-surface-variant">Email: support@mshoaenglish.edu.vn</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="bg-surface-container-low p-4 rounded-2xl inline-block text-left border border-outline-variant">
                        <p class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Ngày thanh toán</p>
                        <p class="font-bold text-lg text-primary">{{ $payment->paymentdate->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="mt-4">
                        @if($payment->status == 'Success')
                            <span class="inline-flex px-4 py-1.5 rounded-full bg-green-100 text-green-700 font-bold uppercase text-xs border border-green-200">Đã thanh toán</span>
                        @elseif($payment->status == 'failed')
                            <span class="inline-flex px-4 py-1.5 rounded-full bg-red-100 text-red-700 font-bold uppercase text-xs border border-red-200">Thất bại</span>
                        @else
                            <span class="inline-flex px-4 py-1.5 rounded-full bg-yellow-100 text-yellow-700 font-bold uppercase text-xs border border-yellow-200">Đang xử lý</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Customer & Service Info -->
            <div class="p-10 grid grid-cols-1 md:grid-cols-2 gap-10">
                <div>
                    <h3 class="text-primary font-black uppercase text-xs tracking-widest mb-4">Thông tin khách hàng</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-on-surface-variant font-bold">Học viên:</p>
                            <p class="font-medium text-on-surface">{{ $payment->registration->student->user->fullname ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-on-surface-variant font-bold">Phụ huynh:</p>
                            <p class="font-medium text-on-surface">{{ $payment->registration->student->parentname ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-primary font-black uppercase text-xs tracking-widest mb-4">Thông tin khóa học</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-on-surface-variant font-bold">Khóa học:</p>
                            <p class="font-medium text-primary">{{ $payment->registration->class->course->coursename ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-on-surface-variant font-bold">Phương thức:</p>
                            <p class="font-medium text-on-surface">{{ $payment->paymentmethod }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Price Table -->
            <div class="px-10 pb-10">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-primary">
                            <th class="py-4 font-black uppercase text-xs tracking-widest">Mô tả dịch vụ</th>
                            <th class="py-4 font-black uppercase text-xs tracking-widest text-right">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-outline-variant">
                            <td class="py-6">
                                <p class="font-bold text-on-surface">Học phí khóa học {{ $payment->registration->class->course->coursename }}</p>
                                <p class="text-xs text-on-surface-variant mt-1">Lớp: {{ $payment->registration->class->classname }}</p>
                            </td>
                            <td class="py-6 font-bold text-right text-lg text-on-surface">
                                {{ number_format($payment->amount, 0, ',', '.') }}₫
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="py-6 text-right font-bold text-on-surface-variant">Tổng cộng (đã bao gồm VAT):</td>
                            <td class="py-6 font-black text-right text-3xl text-primary">
                                {{ number_format($payment->amount, 0, ',', '.') }}₫
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="bg-surface-container-low p-6 text-center text-xs text-on-surface-variant border-t border-outline-variant">
                Cảm ơn Quý phụ huynh và Học viên đã tin tưởng lựa chọn Ms. Hoa English!
            </div>
        </div>
    </div>
</div>
@endsection
