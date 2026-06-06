<!DOCTYPE html>
<html class="light" lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Chi tiết hóa đơn #{{ $payment->paymentid }} | Ms. Hoa English</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Public Sans', sans-serif; }
        @media print {
            .no-print { display: none !important; }
            .print-area { border: none !important; box-shadow: none !important; padding: 0 !important; margin: 0 !important; width: 100% !important; max-width: none !important; }
            body { background: white !important; padding: 0 !important; }
        }
    </style>
</head>
<body class="bg-[#fdf7ff] text-[#1d1b20] min-h-screen p-6">
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex justify-between items-center no-print">
            <a href="{{ route('payment.admin') }}" class="flex items-center gap-2 text-[#4f378a] font-bold hover:underline">
                <span class="material-symbols-outlined">arrow_back</span> Quay lại danh sách
            </a>
            <div class="flex gap-3">
                <button onclick="window.print()" class="flex items-center gap-2 bg-[#4f378a] text-white px-6 py-2.5 rounded-xl font-bold hover:opacity-90 transition-all">
                    <span class="material-symbols-outlined">print</span> In hóa đơn
                </button>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-[#e6e0e9] overflow-hidden print-area">
            <!-- Invoice Header -->
            <div class="p-10 border-b border-[#e6e0e9] flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-black text-[#4f378a]">HÓA ĐƠN THANH TOÁN</h1>
                    <p class="text-[#494551] mt-1 italic">Mã số: INV-{{ str_pad($payment->paymentid, 5, '0', STR_PAD_LEFT) }}</p>
                    <div class="mt-6 space-y-1">
                        <p class="font-bold">Ms. Hoa English Center</p>
                        <p class="text-sm text-[#494551]">Địa chỉ: 123 Đường ABC, Quận XYZ, TP. HCM</p>
                        <p class="text-sm text-[#494551]">Hotline: 0123 456 789</p>
                        <p class="text-sm text-[#494551]">Email: support@mshoaenglish.edu.vn</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="bg-[#f2ecf4] p-4 rounded-2xl inline-block text-left border border-[#e6e0e9]">
                        <p class="text-xs font-bold text-[#494551] uppercase tracking-wider">Ngày thanh toán</p>
                        <p class="font-bold text-lg text-[#4f378a]">{{ $payment->paymentdate->format('d/m/Y H:i') }}</p>
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
            <div class="p-10 grid grid-cols-2 gap-10">
                <div>
                    <h3 class="text-[#4f378a] font-black uppercase text-xs tracking-widest mb-4">Thông tin khách hàng</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-[#494551] font-bold">Học viên:</p>
                            <p class="font-medium">{{ $payment->registration->student->studentname ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#494551] font-bold">Phụ huynh:</p>
                            <p class="font-medium">{{ $payment->registration->student->parentname ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#494551] font-bold">Số điện thoại:</p>
                            <p class="font-medium">{{ $payment->registration->student->parentphone ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-[#4f378a] font-black uppercase text-xs tracking-widest mb-4">Thông tin khóa học</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-[#494551] font-bold">Khóa học:</p>
                            <p class="font-medium text-[#4f378a]">{{ $payment->registration->class->course->coursename ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#494551] font-bold">Lớp học:</p>
                            <p class="font-medium">{{ $payment->registration->class->classname ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#494551] font-bold">Phương thức thanh toán:</p>
                            <p class="font-medium">{{ $payment->paymentmethod }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Price Table -->
            <div class="px-10 pb-10">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-[#4f378a]">
                            <th class="py-4 font-black uppercase text-xs tracking-widest">Mô tả dịch vụ</th>
                            <th class="py-4 font-black uppercase text-xs tracking-widest text-right">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-[#e6e0e9]">
                            <td class="py-6">
                                <p class="font-bold">Học phí khóa học {{ $payment->registration->class->course->coursename }}</p>
                                <p class="text-xs text-[#494551] mt-1">Lớp: {{ $payment->registration->class->classname }}</p>
                            </td>
                            <td class="py-6 font-bold text-right text-lg">
                                {{ number_format($payment->amount, 0, ',', '.') }}₫
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="py-6 text-right font-bold text-[#494551]">Tổng cộng (đã bao gồm VAT):</td>
                            <td class="py-6 font-black text-right text-3xl text-[#4f378a]">
                                {{ number_format($payment->amount, 0, ',', '.') }}₫
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!-- Notes & Signature -->
                <div class="mt-16 grid grid-cols-2 gap-10">
                    <div class="space-y-2">
                        <p class="text-xs font-black uppercase tracking-widest">Ghi chú</p>
                        <p class="text-sm text-[#494551] italic">
                            * Vui lòng giữ hóa đơn này để đối soát khi cần thiết.<br>
                            * Học phí đã đóng không được hoàn lại trừ trường hợp đặc biệt theo quy định của trung tâm.
                        </p>
                    </div>
                    <div class="text-center space-y-20">
                        <p class="text-xs font-black uppercase tracking-widest">Người lập hóa đơn</p>
                        <p class="font-bold">(Ký và ghi rõ họ tên)</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-[#f2ecf4] p-6 text-center text-xs text-[#494551] border-t border-[#e6e0e9]">
                Cảm ơn Quý phụ huynh và Học viên đã tin tưởng lựa chọn Ms. Hoa English!
            </div>
        </div>
    </div>
</body>
</html>