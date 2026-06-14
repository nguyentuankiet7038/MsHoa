<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điều khiển - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Public Sans', sans-serif;
            background-color: #fdf7ff;
        }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e6e0e9; border-radius: 10px; }

        :root {
            --primary: #00C2CB;
            --on-primary: #ffffff;
            --surface: #fdf7ff;
            --on-surface: #1d1b20;
            --outline-variant: #ece6ee;
        }
    </style>
</head>

<body class="bg-surface text-on-surface">
    <div class="flex min-h-screen">
        <!-- SideNavBar -->
        <aside class="hidden lg:flex flex-col w-64 h-screen fixed left-0 top-0 pt-6 pb-4 bg-surface-container-low border-r border-outline-variant z-40 shadow-sm">
            <div class="px-6 mb-8">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-bold">MH</div>
                    <div>
                        <p class="text-sm font-headline font-bold text-on-surface">Ms. Hoa English</p>
                        <p class="text-xs text-on-surface-variant italic capitalize">{{ auth()->user()->role }} Panel</p>
                    </div>
                </div>
            </div>
            
            <nav class="flex-1 space-y-1 overflow-y-auto custom-scrollbar">
                <!-- Shared -->
                <a class="flex items-center {{ request()->routeIs('dashboard') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant' }} rounded-xl font-bold px-4 py-3 mx-2 transition-all hover:bg-primary/5 active:scale-95" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined mr-3">dashboard</span>
                    <span class="font-body text-label-medium">Tổng quan</span>
                </a>

                @if(auth()->user()->role == 'admin')
                <a class="flex items-center {{ request()->routeIs('admin.courses*') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant' }} px-4 py-3 mx-2 hover:bg-primary/5 rounded-xl transition-all active:scale-95" href="{{ route('admin.courses') }}">
                    <span class="material-symbols-outlined mr-3">menu_book</span>
                    <span class="font-body text-label-medium">Khóa học</span>
                </a>
                <a class="flex items-center {{ request()->routeIs('admin.students.*') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant' }} px-4 py-3 mx-2 hover:bg-primary/5 rounded-xl transition-all active:scale-95" href="{{ route('admin.students.index') }}">
                    <span class="material-symbols-outlined mr-3">group</span>
                    <span class="font-body text-label-medium">Học sinh</span>
                </a>
                <a class="flex items-center {{ request()->routeIs('admin.teachers.*') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant' }} px-4 py-3 mx-2 hover:bg-primary/5 rounded-xl transition-all active:scale-95" href="{{ route('admin.teachers.index') }}">
                    <span class="material-symbols-outlined mr-3">person</span>
                    <span class="font-body text-label-medium">Giáo viên</span>
                </a>
                @endif

                <!-- Consultant & Admin -->
                <a class="flex items-center {{ request()->routeIs('admin.registrations.*') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant' }} px-4 py-3 mx-2 hover:bg-primary/5 rounded-xl transition-all active:scale-95" href="{{ route('admin.registrations.index') }}">
                    <span class="material-symbols-outlined mr-3">how_to_reg</span>
                    <span class="font-body text-label-medium">Đăng ký</span>
                </a>

                @if(auth()->user()->role == 'admin')
                <a class="flex items-center {{ request()->routeIs('admin.classes.*') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant' }} px-4 py-3 mx-2 hover:bg-primary/5 rounded-xl transition-all active:scale-95" href="{{ route('admin.classes.index') }}">
                    <span class="material-symbols-outlined mr-3">class</span>
                    <span class="font-body text-label-medium">Lớp học</span>
                </a>
                <a class="flex items-center {{ request()->routeIs('admin.learning-progress.*') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant' }} px-4 py-3 mx-2 hover:bg-primary/5 rounded-xl transition-all active:scale-95" href="{{ route('admin.learning-progress.index') }}">
                    <span class="material-symbols-outlined mr-3">grade</span>
                    <span class="font-body text-label-medium">Điểm số</span>
                </a>
                <a class="flex items-center {{ request()->routeIs('marketing.admin') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant' }} px-4 py-3 mx-2 hover:bg-primary/5 rounded-xl transition-all active:scale-95" href="{{route('marketing.admin')}}">
                    <span class="material-symbols-outlined mr-3">mail</span>
                    <span class="font-body text-label-medium">Tiếp thị</span>
                </a>
                @endif

                <!-- Consultant & Admin -->
                <a class="flex items-center {{ request()->routeIs('payment.admin') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant' }} px-4 py-3 mx-2 hover:bg-primary/5 rounded-xl transition-all active:scale-95" href="{{route('payment.admin')}}">
                    <span class="material-symbols-outlined mr-3">payments</span>
                    <span class="font-body text-label-medium">Thanh toán</span>
                </a>
                <a class="flex items-center {{ request()->routeIs('admin.help-center.*') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant' }} px-4 py-3 mx-2 hover:bg-primary/5 rounded-xl transition-all active:scale-95" href="{{ route('admin.help-center.index') }}">
                    <span class="material-symbols-outlined mr-3">support_agent</span>
                    <span class="font-body text-label-medium">Hỗ trợ AI</span>
                </a>
            </nav>

            <div class="mt-auto pt-4 border-t border-outline-variant">
                <a class="flex items-center text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl" href="/">
                    <span class="material-symbols-outlined mr-3">home</span>
                    <span class="font-body text-label-medium">Xem Trang chủ</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="w-full flex items-center text-error px-4 py-3 mx-2 hover:bg-error/5 rounded-xl transition-all text-left">
                        <span class="material-symbols-outlined mr-3">logout</span>
                        <span class="font-body text-label-medium font-bold">Đăng xuất</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-grow lg:ml-64 min-w-0 bg-surface">
            @yield('contentdashboard')
        </main>
    </div>

    @stack('scripts')
</body>

</html>
