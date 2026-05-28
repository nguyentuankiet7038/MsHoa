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
        }

        .accent-turquoise {
            color: #00B4D8;
        }

        .bg-accent-turquoise {
            background-color: #00B4D8;
        }

        .border-accent-turquoise {
            border-color: #00B4D8;
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
                    <a class="text-primary dark:text-inverse-primary border-b-2 border-primary dark:border-inverse-primary font-bold font-body text-label-large transition-colors" href="/courses">Courses</a>
                    <a class="text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-inverse-primary transition-colors font-body text-label-large" href="/registration">Registration</a>
                    <a class="text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-inverse-primary transition-colors font-body text-label-large" href="/support">Support</a>
                    <a class="text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-inverse-primary transition-colors font-body text-label-large" href="/dashboard">Dashboard</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center bg-surface-container px-3 py-1.5 rounded-full border border-outline-variant">
                    <span class="material-symbols-outlined text-outline">search</span>
                    <input class="bg-transparent border-none focus:ring-0 text-label-medium" placeholder="Search courses..." type="text" />
                </div>
                <button class="material-symbols-outlined text-on-surface-variant">notifications</button>
                <button class="material-symbols-outlined text-on-surface-variant">account_circle</button>
                <a href="/login" type="button" class="bg-primary text-on-primary px-6 py-2 rounded-full font-bold hover:opacity-80 transition-all">Login</a>
            </div>
        </nav>
    </header>


    <!-- Nội dung của từng trang sẽ được đổ vào đây -->
    @yield('content')


    <footer class="w-full py-12 px-6 flex flex-col md:flex-row justify-between items-start gap-12 bg-surface-container-highest dark:bg-inverse-surface border-t border-outline-variant">
        <div class="max-w-xs">
            <span class="text-xl font-headline font-black text-primary dark:text-inverse-primary mb-4 block">Ms. Hoa English</span>
            <p class="text-on-surface-variant dark:text-outline-variant text-label-medium mb-6">Leading English Education Center in Vietnam, dedicated to empowering students through language excellence and global connection.</p>
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
                <h5 class="font-bold text-on-surface dark:text-inverse-on-surface mb-4">Quick Links</h5>
                <ul class="space-y-2 text-label-medium text-on-surface-variant dark:text-outline-variant">
                    <li><a class="hover:text-primary transition-colors" href="#">Course Finder</a></li>
                    <li><a class="hover:text-primary transition-colors" href="#">Tuition Fees</a></li>
                    <li><a class="hover:text-primary transition-colors" href="#">Study Abroad</a></li>
                    <li><a class="hover:text-primary transition-colors" href="#">Online Platform</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold text-on-surface dark:text-inverse-on-surface mb-4">Support</h5>
                <ul class="space-y-2 text-label-medium text-on-surface-variant dark:text-outline-variant">
                    <li><a class="hover:text-primary transition-colors" href="#">FAQ</a></li>
                    <li><a class="hover:text-primary transition-colors" href="#">Contact Us</a></li>
                    <li><a class="hover:text-primary transition-colors" href="#">Career</a></li>
                    <li><a class="hover:text-primary transition-colors" href="#">Referral Program</a></li>
                </ul>
            </div>
            <div class="col-span-2 md:col-span-1">
                <h5 class="font-bold text-on-surface dark:text-inverse-on-surface mb-4">Contact</h5>
                <ul class="space-y-2 text-label-medium text-on-surface-variant dark:text-outline-variant">
                    <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">call</span> +84 123 456 789</li>
                    <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">mail</span> contact@mshoaenglish.com</li>
                    <li class="flex items-start gap-2"><span class="material-symbols-outlined text-sm">location_on</span> 123 Education Street, Hanoi, VN</li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- Copyright Bar -->
    <div class="w-full py-6 px-6 bg-surface-container-highest dark:bg-inverse-surface border-t border-outline-variant flex flex-col md:flex-row justify-between items-center gap-4">
        <span class="text-label-small text-on-surface-variant dark:text-outline-variant">© 2024 Ms. Hoa English Center. All rights reserved.</span>
        <div class="flex gap-6">
            <a class="text-label-small text-on-surface-variant dark:text-outline-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
            <a class="text-label-small text-on-surface-variant dark:text-outline-variant hover:text-primary transition-colors" href="#">Terms of Service</a>
            <a class="text-label-small text-on-surface-variant dark:text-outline-variant hover:text-primary transition-colors" href="#">Cookie Policy</a>
        </div>
    </div>
</body>

</html>