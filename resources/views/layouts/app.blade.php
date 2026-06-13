<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trung tâm Anh Ngữ - @yield('title')</title>
    <!-- Nhúng file CSS chuẩn -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Public Sans', sans-serif;
            background-color: #FFF5F2; /* Nền đỏ cam nhạt */
        }

        h1, h2, h3, h4, h5, h6 {
            color: #00C2CB !important; /* Tiêu đề xanh ngọc */
        }

        .text-primary {
            color: #00C2CB !important;
        }

        .accent-turquoise {
            color: #00C2CB;
        }

        /* Nút nhấn màu đỏ */
        .bg-accent-turquoise, .turquoise-primary {
            background-color: #dc2626 !important;
            color: white !important;
        }

        /* Nút không màu viền xanh ngọc bích */
        .border-accent-turquoise, .turquoise-border {
            border-color: #00C2CB !important;
            color: #00C2CB !important;
        }

        .turquoise-text {
            color: #00C2CB;
        }

        .bg-custom-turquoise\/10 {
            background-color: rgba(0, 194, 203, 0.1);
        }

        .text-custom-turquoise {
            color: #00C2CB;
        }

        .focus\:border-custom-turquoise:focus {
            border-color: #00C2CB;
        }

        .focus\:ring-custom-turquoise\/20:focus {
            --tw-ring-color: rgba(0, 194, 203, 0.2);
        }

        .shadow-custom-turquoise\/30 {
            --tw-shadow-color: rgba(0, 194, 203, 0.3);
            --tw-shadow: var(--tw-shadow-colored);
        }

        .tag-hot {
            background-color: #ba1a1a;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <!-- TopNavBar -->
        <nav class="sticky top-0 z-50 flex justify-between items-center w-full px-6 py-3 bg-surface dark:bg-surface-container border-b border-outline-variant dark:border-outline shadow-sm">
            <div class="flex items-center gap-8">
                <span class="text-xl font-headline font-black text-primary dark:text-inverse-primary">Ms. Hoa English</span>
                <div class="hidden md:flex gap-6">
                    <a class="text-primary dark:text-inverse-primary border-b-2 border-primary dark:border-inverse-primary font-bold font-body text-label-large transition-colors" href="/courses">Khóa học</a>
                    <a class="text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-inverse-primary transition-colors font-body text-label-large" href="/support">Hỗ trợ</a>
                    <a class="text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-inverse-primary transition-colors font-body text-label-large" href="/dashboard">Bảng điều khiển</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center bg-surface-container px-3 py-1.5 rounded-full border border-outline-variant">
                    <span class="material-symbols-outlined text-outline">search</span>
                    <input class="bg-transparent border-none focus:ring-0 text-label-medium" placeholder="Tìm kiếm khóa học..." type="text" />
                </div>
                <button class="material-symbols-outlined text-on-surface-variant">notifications</button>
                <div class="relative flex items-center">
                    <button id="account-toggle" class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">account_circle</button>
                    @include('layouts.account_circle.information')
                </div>
                <a href="/login" type="button" class="bg-primary text-on-primary px-6 py-2 rounded-full font-bold hover:opacity-80 transition-all">Đăng nhập</a>
            </div>
        </nav>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('account-toggle');
            const dropdown = document.getElementById('account-dropdown');

            if (toggle && dropdown) {
                toggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('hidden');
                });

                document.addEventListener('click', function(e) {
                    if (!dropdown.contains(e.target) && e.target !== toggle) {
                        dropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>


    <!-- Nội dung của từng trang sẽ được đổ vào đây -->
    @yield('content')


    <footer class="w-full py-12 px-6 flex flex-col md:flex-row justify-between items-start gap-12 bg-surface-container-highest dark:bg-inverse-surface border-t border-outline-variant">
        <div class="max-w-xs">
            <span class="text-xl font-headline font-black text-primary dark:text-inverse-primary mb-4 block">Ms. Hoa English</span>
            <p class="text-on-surface-variant dark:text-outline-variant text-label-medium mb-6">Trung tâm đào tạo tiếng Anh hàng đầu tại Việt Nam, tận tâm giúp học viên làm chủ ngôn ngữ và kết nối toàn cầu.</p>
            <div class="flex gap-4">
                <a class="w-10 h-10 rounded-full bg-surface-variant flex items-center justify-center hover:bg-primary hover:text-white transition-all" href="#">
                    <span class="material-symbols-outlined">social_leaderboard</span>
                </a>
                <a class="w-10 h-10 rounded-full bg-surface-variant flex items-center justify-center hover:bg-primary hover:text-white transition-all" href="#">
                    <span class="material-symbols-outlined">youtube_activity</span>
                </a>
                <a class="w-10 h-10 rounded-full bg-surface-variant flex items-center justify-center hover:bg-primary hover:text-white transition-all" href="#">
                    <span class="material-symbols-outlined">language</span>
                </a>
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-12 flex-grow">
            <div>
                <h5 class="font-bold text-on-surface dark:text-inverse-on-surface mb-4">Liên kết nhanh</h5>
                <ul class="space-y-2 text-label-medium text-on-surface-variant dark:text-outline-variant">
                    <li><a class="hover:text-primary transition-colors" href="#">Tìm khóa học</a></li>
                    <li><a class="hover:text-primary transition-colors" href="#">Học phí</a></li>
                    <li><a class="hover:text-primary transition-colors" href="#">Du học</a></li>
                    <li><a class="hover:text-primary transition-colors" href="#">Nền tảng trực tuyến</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold text-on-surface dark:text-inverse-on-surface mb-4">Hỗ trợ</h5>
                <ul class="space-y-2 text-label-medium text-on-surface-variant dark:text-outline-variant">
                    <li><a class="hover:text-primary transition-colors" href="#">Hỏi đáp</a></li>
                    <li><a class="hover:text-primary transition-colors" href="#">Liên hệ</a></li>
                    <li><a class="hover:text-primary transition-colors" href="#">Tuyển dụng</a></li>
                    <li><a class="hover:text-primary transition-colors" href="#">Chương trình giới thiệu</a></li>
                </ul>
            </div>
            <div class="col-span-2 md:col-span-1">
                <h5 class="font-bold text-on-surface dark:text-inverse-on-surface mb-4">Liên hệ</h5>
                <ul class="space-y-2 text-label-medium text-on-surface-variant dark:text-outline-variant">
                    <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">call</span> +84 123 456 789</li>
                    <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">mail</span> contact@mshoaenglish.com</li>
                    <li class="flex items-start gap-2"><span class="material-symbols-outlined text-sm">location_on</span> 123 Đường Giáo Dục, Hà Nội, VN</li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- Copyright Bar -->
    <div class="w-full py-6 px-6 bg-surface-container-highest dark:bg-inverse-surface border-t border-outline-variant flex flex-col md:flex-row justify-between items-center gap-4">
        <span class="text-label-small text-on-surface-variant dark:text-outline-variant">© 2024 Trung tâm Tiếng Anh Ms. Hoa. Bảo lưu mọi quyền.</span>
        <div class="flex gap-6">
            <a class="text-label-small text-on-surface-variant dark:text-outline-variant hover:text-primary transition-colors" href="#">Chính sách bảo mật</a>
            <a class="text-label-small text-on-surface-variant dark:text-outline-variant hover:text-primary transition-colors" href="#">Điều khoản dịch vụ</a>
            <a class="text-label-small text-on-surface-variant dark:text-outline-variant hover:text-primary transition-colors" href="#">Chính sách Cookie</a>
        </div>
    </div>
</body>

</html>