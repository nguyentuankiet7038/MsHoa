<!DOCTYPE html>
<html class="light" lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tạo hóa đơn mới | Ms. Hoa English</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Public Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#fdf7ff] text-[#1d1b20] min-h-screen p-6">
    <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-xl border border-[#e6e0e9] overflow-hidden">
        <div class="bg-[#4f378a] p-6 text-white flex justify-between items-center">
            <h1 class="text-2xl font-bold">Tạo hóa đơn mới</h1>
            <a href="{{ route('payment.admin') }}" class="material-symbols-outlined hover:bg-white/10 p-2 rounded-full transition-all">close</a>
        </div>
        
        <form action="{{ route('payment.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label class="block text-sm font-bold text-[#494551]">Chọn đăng ký khóa học</label>
                <select name="registrationid" class="w-full rounded-xl border-[#cbc4d2] focus:ring-[#4f378a] focus:border-[#4f378a]" required>
                    <option value="">-- Chọn đăng ký --</option>
                    @foreach($registrations as $reg)
                        <option value="{{ $reg->registrationid }}">
                            {{ $reg->student->studentname }} - {{ $reg->class->course->coursename }} ({{ $reg->class->classname }})
                        </option>
                    @endforeach
                </select>
                @error('registrationid') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-[#494551]">Số tiền (VNĐ)</label>
                    <input type="number" name="amount" class="w-full rounded-xl border-[#cbc4d2] focus:ring-[#4f378a] focus:border-[#4f378a]" placeholder="VD: 5000000" required>
                    @error('amount') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-[#494551]">Phương thức thanh toán</label>
                    <select name="paymentmethod" class="w-full rounded-xl border-[#cbc4d2] focus:ring-[#4f378a] focus:border-[#4f378a]" required>
                        <option value="Chuyển khoản">Chuyển khoản</option>
                        <option value="Tiền mặt">Tiền mặt</option>
                        <option value="Thẻ tín dụng">Thẻ tín dụng</option>
                        <option value="Ví điện tử">Ví điện tử</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-[#494551]">Ngày thanh toán</label>
                    <input type="datetime-local" name="paymentdate" value="{{ date('Y-m-d\TH:i') }}" class="w-full rounded-xl border-[#cbc4d2] focus:ring-[#4f378a] focus:border-[#4f378a]" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-[#494551]">Trạng thái</label>
                    <select name="status" class="w-full rounded-xl border-[#cbc4d2] focus:ring-[#4f378a] focus:border-[#4f378a]" required>
                        <option value="pending">Đang xử lý</option>
                        <option value="Success">Thành công</option>
                        <option value="failed">Thất bại</option>
                    </select>
                </div>
            </div>

            <div class="pt-6 flex gap-4">
                <button type="submit" class="flex-1 bg-[#4f378a] text-white py-3 rounded-xl font-bold hover:opacity-90 active:scale-[0.98] transition-all">
                    Tạo hóa đơn
                </button>
                <a href="{{ route('payment.admin') }}" class="flex-1 text-center bg-[#e6e0e9] text-[#4f378a] py-3 rounded-xl font-bold hover:bg-[#ded8e0] transition-all">
                    Hủy bỏ
                </a>
            </div>
        </form>
    </div>
</body>
</html>