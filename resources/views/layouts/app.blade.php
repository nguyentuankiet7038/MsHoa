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
                    <a href="/" class="navbar__brand">Ms Hoa English</a>
                    <ul class="navbar__menu">
                        <li><a href="/courses" class="navbar__link">Khóa học</a></li>
                        <li><a href="/support" class="navbar__link">Hỗ trợ</a></li>
                        @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'consultant']))
                        <li><a href="/dashboard" class="navbar__link">Bảng điều khiển</a></li>
                        @endif
                    </ul>
                </div>
                <div class="navbar__actions">
                    <!-- <div class="navbar__search">
                        <span class="material-symbols-outlined">search</span>
                        <input type="text" placeholder="Tìm kiếm khóa học..." />
                    </div> -->
                    @auth
                    <div style="position: relative; display: flex; align-items: center;">
                        <button id="notif-toggle-student" onclick="toggleNotificationsStudent()" class="navbar__icon-btn" style="position: relative;">
                            <span class="material-symbols-outlined">notifications</span>
                            <span id="notif-badge-student" style="position: absolute; top: -5px; right: -5px; background: #e3342f; color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 10px; font-weight: bold; display: flex; align-items: center; justify-content: center; display: none;">0</span>
                        </button>
                        <!-- Dropdown Menu -->
                        <div id="notif-menu-student" style="position: absolute; right: 0; top: 100%; margin-top: 10px; width: 320px; background: #ffffff; border: 1px solid #ece6ee; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); display: none; flex-direction: column; z-index: 999; max-height: 400px;">
                            <div style="padding: 15px; border-bottom: 1px solid #ece6ee; display: flex; justify-content: space-between; align-items: center; background: #fdf7ff; border-radius: 12px 12px 0 0;">
                                <h4 style="margin: 0; font-size: 14px; font-weight: bold; color: #1d1b20;">Thông báo</h4>
                                <button onclick="markAllAsReadStudent()" style="font-size: 12px; color: #00C2CB; background: none; border: none; cursor: pointer; padding: 0;">Đánh dấu đã đọc</button>
                            </div>
                            <div id="notif-list-student" style="overflow-y: auto; padding: 5px; flex: 1;">
                                <div style="padding: 15px; text-align: center; font-size: 13px; color: #666;">Đang tải...</div>
                            </div>
                            <div style="padding: 10px; border-top: 1px solid #ece6ee; text-align: center; background: #fdf7ff; border-radius: 0 0 12px 12px;">
                                <a href="{{ route('notifications.index') }}" style="font-size: 13px; font-weight: bold; color: #00C2CB; text-decoration: none;">Xem tất cả thông báo</a>
                            </div>
                        </div>
                    </div>
                    @endauth

                    <div style="position: relative; display: flex; align-items: center;">
                        <button id="account-toggle" class="navbar__icon-btn">
                            <span class="material-symbols-outlined">account_circle</span>
                        </button>
                        @include('layouts.account_circle.information')
                    </div>
                    @guest
                    <a href="/login" class="btn btn--primary">Đăng nhập</a>
                    @endguest
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
                    <span class="footer__brand">Ms Hoa English</span>
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
                <span class="footer__copyright">© 2024 Trung tâm Tiếng Anh Ms Hoa. Bảo lưu mọi quyền.</span>
                <div class="footer__legal">
                    <a href="#" class="footer__link">Chính sách bảo mật</a>
                    <a href="#" class="footer__link">Điều khoản dịch vụ</a>
                    <a href="#" class="footer__link">Chính sách Cookie</a>
                </div>
            </div>
        </div>
    </footer>

    @auth
    <script>
        // --- Notification System for Student ---
        let notifMenuStudent = document.getElementById('notif-menu-student');
        let notifBadgeStudent = document.getElementById('notif-badge-student');
        let notifListStudent = document.getElementById('notif-list-student');

        function toggleNotificationsStudent() {
            if(notifMenuStudent.style.display === 'none') {
                notifMenuStudent.style.display = 'flex';
                fetchNotificationsStudent();
            } else {
                notifMenuStudent.style.display = 'none';
            }
        }

        // Đóng menu khi click ra ngoài
        document.addEventListener('click', function(event) {
            const toggleBtn = document.getElementById('notif-toggle-student');
            if (notifMenuStudent && toggleBtn && !notifMenuStudent.contains(event.target) && !toggleBtn.contains(event.target)) {
                notifMenuStudent.style.display = 'none';
            }
        });

        function fetchNotificationsStudent() {
            fetch('/api/notifications/unread')
                .then(res => res.json())
                .then(data => {
                    if (data.count > 0) {
                        notifBadgeStudent.textContent = data.count > 99 ? '99+' : data.count;
                        notifBadgeStudent.style.display = 'flex';
                    } else {
                        notifBadgeStudent.style.display = 'none';
                    }

                    if (data.notifications.length === 0) {
                        notifListStudent.innerHTML = '<div style="padding: 15px; text-align: center; font-size: 13px; color: #666;">Không có thông báo mới</div>';
                        return;
                    }

                    let html = '';
                    data.notifications.forEach(n => {
                        let dataObj = n.data;
                        let dotColor = '#00C2CB';
                        if (dataObj.type === 'success') dotColor = '#38c172';
                        if (dataObj.type === 'danger') dotColor = '#e3342f';
                        if (dataObj.type === 'warning') dotColor = '#f6993f';

                        html += `
                            <div style="padding: 10px; border-bottom: 1px solid #f1f1f1; cursor: pointer; display: flex; align-items: flex-start; gap: 10px;" 
                                 onmouseover="this.style.backgroundColor='#fdf7ff'" 
                                 onmouseout="this.style.backgroundColor='transparent'"
                                 onclick="markAsReadStudent('${n.id}', '${dataObj.link || '#'}')">
                                <div style="width: 8px; height: 8px; border-radius: 50%; background-color: ${dotColor}; margin-top: 6px; flex-shrink: 0;"></div>
                                <div>
                                    <div style="font-size: 13px; font-weight: bold; color: #1d1b20;">${dataObj.title}</div>
                                    <div style="font-size: 12px; color: #666; margin-top: 2px;">${dataObj.message}</div>
                                </div>
                            </div>
                        `;
                    });
                    notifListStudent.innerHTML = html;
                })
                .catch(err => console.error(err));
        }

        function markAsReadStudent(id, link) {
            fetch(`/api/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }).then(() => {
                if (link && link !== '#') {
                    window.location.href = link;
                } else {
                    fetchNotificationsStudent();
                }
            });
        }

        function markAllAsReadStudent() {
            fetch('/api/notifications/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }).then(() => {
                fetchNotificationsStudent();
                notifMenuStudent.style.display = 'none';
            });
        }

        // Polling every 15 seconds
        setInterval(fetchNotificationsStudent, 15000);
        document.addEventListener('DOMContentLoaded', fetchNotificationsStudent);
    </script>
    @endauth
</body>

</html>