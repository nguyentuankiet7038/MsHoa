<!DOCTYPE html>

<html class="light" lang="vi"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Quản lý thanh toán | Ms. Hoa English</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        body { font-family: 'Public Sans', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(8px); }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbc4d2; border-radius: 10px; }
    </style>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                "surface-variant": "#e6e0e9",
                "surface-container-highest": "#e6e0e9",
                "on-error-container": "#93000a",
                "on-primary-fixed-variant": "#4f378a",
                "tertiary-fixed-dim": "#e7c365",
                "surface-tint": "#6750a4",
                "tertiary": "#765b00",
                "on-primary-fixed": "#22005d",
                "outline-variant": "#cbc4d2",
                "tertiary-fixed": "#ffdf93",
                "surface-bright": "#fdf7ff",
                "surface-container-high": "#ece6ee",
                "on-tertiary-fixed": "#241a00",
                "inverse-primary": "#cfbcff",
                "background": "#fdf7ff",
                "surface": "#fdf7ff",
                "inverse-on-surface": "#f5eff7",
                "surface-container": "#f2ecf4",
                "on-background": "#1d1b20",
                "surface-dim": "#ded8e0",
                "secondary-fixed": "#e9ddff",
                "primary-fixed": "#e9ddff",
                "outline": "#7a7582",
                "secondary-container": "#e1d4fd",
                "on-tertiary-fixed-variant": "#594400",
                "on-tertiary-container": "#503d00",
                "tertiary-container": "#c9a74d",
                "secondary": "#63597c",
                "on-surface": "#1d1b20",
                "error-container": "#ffdad6",
                "error": "#ba1a1a",
                "surface-container-lowest": "#ffffff",
                "on-secondary-fixed": "#1f1635",
                "surface-container-low": "#f8f2fa",
                "on-secondary-container": "#645a7d",
                "on-tertiary": "#ffffff",
                "on-surface-variant": "#494551",
                "on-secondary-fixed-variant": "#4b4263",
                "on-secondary": "#ffffff",
                "primary": "#4f378a",
                "on-primary": "#ffffff",
                "primary-container": "#6750a4",
                "on-primary-container": "#e0d2ff",
                "inverse-surface": "#322f35",
                "primary-fixed-dim": "#cfbcff",
                "on-error": "#ffffff",
                "secondary-fixed-dim": "#cdc0e9",
                "success": "#00897b", /* Teal accent */
                "on-success": "#ffffff"
              },
              "borderRadius": {
                "DEFAULT": "0.125rem",
                "lg": "0.25rem",
                "xl": "0.5rem",
                "full": "0.75rem"
              }
            }
          }
        }
    </script>
</head>
<body class="bg-surface text-on-surface min-h-screen">
<!-- TopNavBar -->
<header class="sticky top-0 z-50 flex justify-between items-center w-full px-6 py-3 bg-surface dark:bg-surface-container border-b border-outline-variant dark:border-outline shadow-sm">
<div class="flex items-center gap-4">
<span class="text-xl font-headline font-black text-primary dark:text-inverse-primary">Ms. Hoa English</span>
</div>
<nav class="hidden md:flex items-center gap-8">
<a class="text-on-surface-variant dark:text-outline-variant font-body text-label-large hover:text-primary transition-colors" href="#">Courses</a>
<a class="text-on-surface-variant dark:text-outline-variant font-body text-label-large hover:text-primary transition-colors" href="#">Registration</a>
<a class="text-on-surface-variant dark:text-outline-variant font-body text-label-large hover:text-primary transition-colors" href="#">Support</a>
<a class="text-on-surface-variant dark:text-outline-variant font-body text-label-large hover:text-primary transition-colors" href="#">Dashboard</a>
</nav>
<div class="flex items-center gap-4">
<div class="relative hidden sm:block">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
<input class="pl-10 pr-4 py-2 bg-surface-container-low border-none rounded-full text-sm focus:ring-2 focus:ring-primary w-64" placeholder="Search invoices..." type="text"/>
</div>
<button class="material-symbols-outlined text-on-surface-variant hover:text-primary">notifications</button>
<button class="material-symbols-outlined text-on-surface-variant hover:text-primary">account_circle</button>
</div>
</header>
<div class="flex">
<!-- SideNavBar -->
<aside class="hidden lg:flex flex-col w-64 h-[calc(100vh-64px)] fixed left-0 top-16 pt-8 pb-4 bg-surface-container-low border-r border-outline-variant dark:border-outline overflow-y-auto">
<div class="px-6 mb-8">
<h2 class="text-lg font-headline font-bold text-on-surface">Admin Panel</h2>
<p class="text-xs text-on-surface-variant">Management Suite</p>
</div>
<nav class="flex-1 space-y-1">
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-body text-label-medium">Overview</span>
</a>
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">menu_book</span>
<span class="font-body text-label-medium">Course Catalog</span>
</a>
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">group</span>
<span class="font-body text-label-medium">Student List</span>
</a>
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">mail</span>
<span class="font-body text-label-medium">Marketing</span>
</a>
<a class="flex items-center gap-3 bg-secondary-container text-on-secondary-container rounded-xl font-bold px-4 py-3 mx-2 scale-95 transition-transform" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">payments</span>
<span class="font-body text-label-medium">Payments</span>
</a>
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">support_agent</span>
<span class="font-body text-label-medium">Help Center</span>
</a>
</nav>
<div class="px-4 mb-4">
<button class="w-full bg-primary text-on-primary py-3 rounded-xl font-bold flex items-center justify-center gap-2 shadow-lg shadow-primary/20 hover:opacity-90 active:scale-95 transition-all">
<span class="material-symbols-outlined">add</span>
                    New Campaign
                </button>
</div>
<div class="border-t border-outline-variant pt-4 mt-auto">
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">settings</span>
<span class="font-body text-label-medium">Settings</span>
</a>
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">logout</span>
<span class="font-body text-label-medium">Sign Out</span>
</a>
</div>
</aside>
<!-- Main Content -->
<main class="flex-1 ml-0 lg:ml-64 p-6 bg-surface-container-low min-h-screen">
<!-- Header Section -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
<div>
<h1 class="text-3xl font-headline font-black text-on-surface tracking-tight">Payment Management</h1>
<p class="text-on-surface-variant">Review and manage student tuition invoices</p>
</div>
<div class="flex items-center gap-3">
<a href="{{ route('payment.export') }}" class="flex items-center gap-2 bg-surface text-primary border border-primary/20 px-4 py-2.5 rounded-xl font-bold hover:bg-primary/5 transition-all">
<span class="material-symbols-outlined">description</span>
                        Xuất báo cáo
                    </a>
<a href="{{ route('payment.create') }}" class="flex items-center gap-2 bg-success text-on-success px-4 py-2.5 rounded-xl font-bold shadow-lg shadow-success/20 hover:opacity-90 transition-all">
<span class="material-symbols-outlined">add_card</span>
                        Tạo hóa đơn
                    </a>
</div>
</div>
<!-- Bento Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
<div class="bg-surface-container-lowest p-6 rounded-full border border-outline-variant flex flex-col justify-between">
<span class="text-on-surface-variant text-sm font-medium">Tổng doanh thu</span>
<div class="flex items-end justify-between mt-2">
<span class="text-2xl font-bold">{{ number_format($payments->where('status', 'Success')->sum('amount'), 0, ',', '.') }} VNĐ</span>
<span class="text-success text-xs font-bold flex items-center bg-success/10 px-2 py-1 rounded-full">+12%</span>
</div>
</div>
<div class="bg-surface-container-lowest p-6 rounded-full border border-outline-variant flex flex-col justify-between">
<span class="text-on-surface-variant text-sm font-medium">Đang xử lý</span>
<div class="flex items-end justify-between mt-2">
<span class="text-2xl font-bold">{{ $payments->where('status', 'pending')->count() }}</span>
<span class="text-tertiary text-xs font-bold flex items-center bg-tertiary/10 px-2 py-1 rounded-full">Pending</span>
</div>
</div>
<div class="bg-surface-container-lowest p-6 rounded-full border border-outline-variant flex flex-col justify-between">
<span class="text-on-surface-variant text-sm font-medium">Thất bại</span>
<div class="flex items-end justify-between mt-2">
<span class="text-2xl font-bold">{{ $payments->where('status', 'failed')->count() }}</span>
<span class="text-error text-xs font-bold flex items-center bg-error/10 px-2 py-1 rounded-full">Failed</span>
</div>
</div>
<div class="bg-surface-container-lowest p-6 rounded-full border border-outline-variant flex flex-col justify-between">
<span class="text-on-surface-variant text-sm font-medium">Thành công</span>
<div class="flex items-end justify-between mt-2">
<span class="text-2xl font-bold">{{ $payments->where('status', 'Success')->count() }}</span>
<span class="text-success text-xs font-bold flex items-center bg-success/10 px-2 py-1 rounded-full">Success</span>
</div>
</div>
</div>
<!-- Filter Bar -->
<form action="{{ route('payment.admin') }}" method="GET" class="bg-surface-container-lowest p-4 rounded-xl border border-outline-variant mb-6 shadow-sm flex flex-wrap gap-4 items-end">
<div class="flex-1 min-w-[200px]">
<label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase tracking-wider">Mã hóa đơn</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">search</span>
<input name="search" value="{{ request('search') }}" class="w-full pl-9 pr-4 py-2 bg-surface-container-low border-outline-variant rounded-lg focus:ring-success focus:border-success text-sm" placeholder="VD: 1, 2, 3..." type="text"/>
</div>
</div>
<div class="min-w-[150px]">
<label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase tracking-wider">Trạng thái</label>
<select name="status" class="w-full py-2 bg-surface-container-low border-outline-variant rounded-lg focus:ring-success focus:border-success text-sm">
<option {{ request('status') == 'Tất cả' ? 'selected' : '' }}>Tất cả</option>
<option {{ request('status') == 'Đã thanh toán' ? 'selected' : '' }}>Đã thanh toán</option>
<option {{ request('status') == 'Chưa thanh toán' ? 'selected' : '' }}>Chưa thanh toán</option>
<option {{ request('status') == 'Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
</select>
</div>
<div class="min-w-[200px]">
<label class="block text-xs font-bold text-on-surface-variant mb-1 uppercase tracking-wider">Ngày thanh toán</label>
<input name="date" value="{{ request('date') }}" class="w-full py-2 bg-surface-container-low border-outline-variant rounded-lg focus:ring-success focus:border-success text-sm" type="date"/>
</div>
<button type="submit" class="bg-surface-variant text-on-surface px-6 py-2 rounded-lg font-bold text-sm hover:bg-outline-variant transition-all">Lọc kết quả</button>
<a href="{{ route('payment.admin') }}" class="text-sm text-on-surface-variant hover:text-primary transition-all underline">Reset</a>
</form>
<!-- Table Section -->
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden">
<div class="overflow-x-auto custom-scrollbar">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low border-b border-outline-variant">
<th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest">Mã hóa đơn</th>
<th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest">Phụ huynh</th>
<th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest">Học viên</th>
<th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest">Dịch vụ</th>
<th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest text-right">Tổng tiền</th>
<th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest">Hình thức</th>
<th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest">Trạng thái</th>
<th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest">Ngày tạo</th>
<th class="px-6 py-4 text-xs font-black text-on-surface-variant uppercase tracking-widest">Hành động</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
@foreach($payments as $payment)
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="px-6 py-4 font-bold text-primary">INV-{{ $payment->paymentid }}</td>
<td class="px-6 py-4 text-sm">{{ $payment->registration->student->parentname ?? 'N/A' }}</td>
<td class="px-6 py-4 text-sm font-medium">{{ $payment->registration->student->studentname ?? 'N/A' }}</td>
<td class="px-6 py-4">
<span class="inline-flex bg-primary-container text-on-primary-container text-[10px] px-2 py-0.5 rounded font-bold uppercase">
    {{ $payment->registration->class->course->coursename ?? 'N/A' }}
</span>
</td>
<td class="px-6 py-4 text-sm font-bold text-right">{{ number_format($payment->amount, 0, ',', '.') }}₫</td>
<td class="px-6 py-4 text-sm">{{ $payment->paymentmethod }}</td>
<td class="px-6 py-4">
    @if($payment->status == 'Success')
    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-success/10 text-success text-xs font-bold">
        <span class="w-1.5 h-1.5 rounded-full bg-success"></span>
        Đã thanh toán
    </span>
    @elseif($payment->status == 'failed')
    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-error/10 text-error text-xs font-bold">
        <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
        Thất bại
    </span>
    @else
    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary/10 text-tertiary text-xs font-bold">
        <span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span>
        Đang xử lý
    </span>
    @endif
</td>
<td class="px-6 py-4 text-xs text-on-surface-variant">{{ $payment->paymentdate ? $payment->paymentdate->format('d/m/Y') : 'N/A' }}</td>
<td class="px-6 py-4">
<div class="flex items-center gap-2">
<a href="{{ route('payment.show', $payment->paymentid) }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-primary hover:bg-primary/10 transition-all" title="Xem chi tiết & In">
<span class="material-symbols-outlined text-xl">visibility</span>
</a>
<button class="w-8 h-8 flex items-center justify-center rounded-lg text-success hover:bg-success/10 transition-all" title="Cập nhật">
<span class="material-symbols-outlined text-xl">edit</span>
</button>
</div>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="px-6 py-4 bg-surface-container-low flex justify-between items-center border-t border-outline-variant">
<span class="text-xs text-on-surface-variant font-medium">Hiển thị {{ $payments->count() }} hóa đơn</span>
<div class="flex items-center gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-lg border border-outline-variant hover:bg-surface transition-all text-on-surface-variant">
<span class="material-symbols-outlined text-sm">chevron_left</span>
</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-on-primary font-bold text-xs">1</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg border border-outline-variant hover:bg-surface transition-all text-xs">2</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg border border-outline-variant hover:bg-surface transition-all text-xs">3</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg border border-outline-variant hover:bg-surface transition-all text-on-surface-variant">
<span class="material-symbols-outlined text-sm">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Footer Section -->
<footer class="mt-12 w-full py-8 px-6 flex flex-col md:flex-row justify-between items-center gap-4 bg-surface-container-highest dark:bg-inverse-surface rounded-t-3xl border-t border-outline-variant">
<span class="text-md font-headline font-bold text-on-surface dark:text-inverse-on-surface">Ms. Hoa English</span>
<p class="text-on-surface-variant dark:text-outline-variant font-body text-label-small">© 2024 Ms. Hoa English Center. All rights reserved.</p>
<div class="flex gap-4">
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary transition-colors text-label-small" href="#">Privacy Policy</a>
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary transition-colors text-label-small" href="#">Terms of Service</a>
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary transition-colors text-label-small" href="#">Cookie Policy</a>
</div>
</footer>
</main>
</div>
<script>
        // Micro-interaction for table rows
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('click', () => {
                // Potential logic to select row or show quick view
            });
        });

        // Search highlight effect
        const searchInput = document.querySelector('input[type="text"]');
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.classList.add('ring-2', 'ring-primary/20');
        });
        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.classList.remove('ring-2', 'ring-primary/20');
        });
    </script>
</body></html>