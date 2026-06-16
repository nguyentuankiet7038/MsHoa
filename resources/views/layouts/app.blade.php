<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trung tâm Anh Ngữ - @yield('title')</title>
    <!-- Nhúng file CSS chuẩn và JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts: Baloo Bhaina 2 cho Headings và Open Sans cho Body text -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaina+2:wght@700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    
    <!-- Custom Style BEM (Thêm tham số v=time để tránh lỗi cache trình duyệt) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
</head>

<body>
    <!-- HEADER BEM -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <div class="navbar__left">
                    <a href="/" class="navbar__brand">Ms. Hoa English</a>
                    <ul class="navbar__menu">
                        <li><a href="/courses" class="navbar__link">Khóa học</a></li>
                        <li><a href="/support" class="navbar__link">Hỗ trợ</a></li>
                        <li><a href="/dashboard" class="navbar__link">Bảng điều khiển</a></li>
                    </ul>
                </div>
                <div class="navbar__actions">
                    <div class="navbar__search">
                        <span class="material-symbols-outlined">search</span>
                        <input type="text" placeholder="Tìm kiếm khóa học..." />
                    </div>
                    <button class="navbar__icon-btn">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <div style="position: relative; display: flex; align-items: center;">
                        <button id="account-toggle" class="navbar__icon-btn">
                            <span class="material-symbols-outlined">account_circle</span>
                        </button>
                        <!-- Include drop-down logic if any -->
                        @include('layouts.account_circle.information')
                    </div>
                    <a href="/login" class="btn btn--primary">Đăng nhập</a>
                </div>
            </nav>
        </div>
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
    <main class="page-content">
        @yield('content')
    </main>

    <!-- FOOTER BEM -->
    <footer class="footer">
        <div class="container">
            <div class="footer__grid">
                <!-- Column 1 -->
                <div class="footer__column">
                    <span class="footer__brand">Ms. Hoa English</span>
                    <p class="footer__desc">Trung tâm đào tạo tiếng Anh hàng đầu tại Việt Nam, tận tâm giúp học viên làm chủ ngôn ngữ và kết nối toàn cầu.</p>
                    <div class="footer__socials">
                        <a href="#" class="footer__social-link"><span class="material-symbols-outlined">social_leaderboard</span></a>
                        <a href="#" class="footer__social-link"><span class="material-symbols-outlined">youtube_activity</span></a>
                        <a href="#" class="footer__social-link"><span class="material-symbols-outlined">language</span></a>
                    </div>
                </div>
                
                <!-- Column 2 -->
                <div class="footer__column">
                    <h5 class="footer__title">Liên kết nhanh</h5>
                    <ul>
                        <li class="footer__item"><a href="#" class="footer__link">Tìm khóa học</a></li>
                        <li class="footer__item"><a href="#" class="footer__link">Học phí</a></li>
                        <li class="footer__item"><a href="#" class="footer__link">Du học</a></li>
                        <li class="footer__item"><a href="#" class="footer__link">Nền tảng trực tuyến</a></li>
                    </ul>
                </div>

                <!-- Column 3 -->
                <div class="footer__column">
                    <h5 class="footer__title">Hỗ trợ</h5>
                    <ul>
                        <li class="footer__item"><a href="#" class="footer__link">Hỏi đáp</a></li>
                        <li class="footer__item"><a href="#" class="footer__link">Liên hệ</a></li>
                        <li class="footer__item"><a href="#" class="footer__link">Tuyển dụng</a></li>
                        <li class="footer__item"><a href="#" class="footer__link">Chương trình giới thiệu</a></li>
                    </ul>
                </div>

                <!-- Column 4 -->
                <div class="footer__column">
                    <h5 class="footer__title">Liên hệ</h5>
                    <ul>
                        <li class="footer__contact-item">
                            <span class="material-symbols-outlined footer__contact-icon">call</span>
                            <span>+84 123 456 789</span>
                        </li>
                        <li class="footer__contact-item">
                            <span class="material-symbols-outlined footer__contact-icon">mail</span>
                            <span>contact@mshoaenglish.com</span>
                        </li>
                        <li class="footer__contact-item">
                            <span class="material-symbols-outlined footer__contact-icon">location_on</span>
                            <span>123 Đường Giáo Dục, Hà Nội, VN</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="footer__bottom">
                <span class="footer__copyright">© 2024 Trung tâm Tiếng Anh Ms. Hoa. Bảo lưu mọi quyền.</span>
                <div class="footer__legal">
                    <a href="#" class="footer__link">Chính sách bảo mật</a>
                    <a href="#" class="footer__link">Điều khoản dịch vụ</a>
                    <a href="#" class="footer__link">Chính sách Cookie</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>