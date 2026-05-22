@extends('layouts.app')

@section('title', 'Danh sách khóa học')

@section('content')
<main class="min-h-screen">
    <!-- Hero Section -->
    <section class="relative py-20 px-6 bg-gradient-to-br from-primary-fixed to-surface overflow-hidden">
        <div class="absolute top-0 right-0 w-1/3 h-full opacity-10 pointer-events-none">
            <div class="w-full h-full bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-primary to-transparent"></div>
        </div>
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl md:text-6xl font-headline font-black text-on-primary-fixed leading-tight mb-6">
                Khám phá các khóa học tại <span class="text-primary">Ms. Hoa English</span>
            </h1>
            <p class="text-lg md:text-xl text-on-surface-variant max-w-2xl mx-auto mb-10">
                Chương trình đào tạo tiếng Anh chuẩn quốc tế, giúp bạn chinh phục mọi mục tiêu sự nghiệp và học tập.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <div class="glass-card flex items-center gap-3 px-6 py-4 rounded-xl shadow-sm border border-outline-variant/30">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                    <div class="text-left">
                        <div class="font-bold text-on-surface">100% Cam kết</div>
                        <div class="text-xs text-on-surface-variant">Đạt chuẩn đầu ra</div>
                    </div>
                </div>
                <div class="glass-card flex items-center gap-3 px-6 py-4 rounded-xl shadow-sm border border-outline-variant/30">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">groups</span>
                    <div class="text-left">
                        <div class="font-bold text-on-surface">500k+ Học viên</div>
                        <div class="text-xs text-on-surface-variant">Đã tin tưởng theo học</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Filter & Search Section -->
    <section class="sticky top-[64px] z-40 bg-surface/90 backdrop-blur-md border-b border-outline-variant py-4 px-6 shadow-sm">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-2 overflow-x-auto w-full lg:w-auto pb-2 lg:pb-0 scrollbar-hide">
                <button class="whitespace-nowrap px-6 py-2 rounded-full bg-primary text-on-primary font-bold text-sm">Tất cả</button>
                <button class="whitespace-nowrap px-6 py-2 rounded-full bg-surface-container-high text-on-surface-variant font-medium text-sm hover:bg-primary-container hover:text-on-primary-container transition-colors">TOEIC</button>
                <button class="whitespace-nowrap px-6 py-2 rounded-full bg-surface-container-high text-on-surface-variant font-medium text-sm hover:bg-primary-container hover:text-on-primary-container transition-colors">IELTS</button>
                <button class="whitespace-nowrap px-6 py-2 rounded-full bg-surface-container-high text-on-surface-variant font-medium text-sm hover:bg-primary-container hover:text-on-primary-container transition-colors">Giao tiếp</button>
                <button class="whitespace-nowrap px-6 py-2 rounded-full bg-surface-container-high text-on-surface-variant font-medium text-sm hover:bg-primary-container hover:text-on-primary-container transition-colors">Tiếng Anh trẻ em</button>
            </div>
            <div class="flex items-center gap-4 w-full lg:w-auto">
                <div class="relative flex-grow lg:w-80">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">tune</span>
                    <select class="w-full pl-10 pr-4 py-2 rounded-xl bg-surface-container-low border border-outline-variant text-sm focus:ring-primary focus:border-primary appearance-none">
                        <option>Sắp xếp: Mới nhất</option>
                        <option>Giá: Thấp đến Cao</option>
                        <option>Giá: Cao đến Thấp</option>
                        <option>Phổ biến nhất</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
    <!-- Course Grid -->
    <section class="py-12 px-6 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <!-- Course Card 1 -->
            <div class="group flex flex-col bg-surface rounded-2xl overflow-hidden border border-outline-variant hover:shadow-xl transition-all duration-300 relative">
                <div class="relative h-48 overflow-hidden">
                    <img alt="TOEIC Mastery" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A professional, high-energy classroom setting with a diverse group of students engaged in learning English. The environment is modern with clean white walls and turquoise accent furniture, illuminated by bright natural sunlight coming through a window. A friendly female teacher is explaining concepts on a digital whiteboard, embodying a modern and sophisticated light-mode UI aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCuYpeSfpZYg9QK3PKO5avVjTYJLF7DtFSaIiIH4EELnNoJJ3qrs3C4eGGFP0D-b9Iq1xmrXH6OrelmNOnDjuxLkp-s3fMcyKnrDkiZjMCWeYKLjp9RbCJ3pFTxK5nuB404lD6p3J7VXoshUCXrnrDGKK0wdgK6BEUnSb-COZH8mcs2L9W0TillbMbjHjC1GHFvU9UEOpmo7hYa0RBx7M6qc-jUJ0-MGeWVi2XVT9A7L72nbilYAz2cbIQpYu8BVP8TjjyA49R5gHQ" />
                    <div class="absolute top-3 left-3 bg-error text-on-error text-[10px] font-black px-2 py-1 rounded-sm uppercase tracking-widest">Hot</div>
                    <div class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-sm px-2 py-1 rounded-lg text-primary font-bold text-xs border border-primary/20">TOEIC</div>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors">TOEIC Mastery 750+</h3>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">schedule</span> 6 Tháng
                        </span>
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">bar_chart</span> Nâng cao
                        </span>
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">school</span> Offline
                        </span>
                    </div>
                    <div class="mt-auto">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-xl font-black text-on-surface">5.500.000đ</span>
                            <span class="text-sm text-outline line-through">7.200.000đ</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <button class="py-2 px-4 border border-primary text-primary rounded-xl font-bold text-xs hover:bg-primary/5 transition-colors">Chi tiết</button>
                            <button class="py-2 px-4 bg-primary text-on-primary rounded-xl font-bold text-xs hover:opacity-90 transition-opacity">Đăng ký</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Course Card 2 -->
            <div class="group flex flex-col bg-surface rounded-2xl overflow-hidden border border-outline-variant hover:shadow-xl transition-all duration-300 relative">
                <div class="relative h-48 overflow-hidden">
                    <img alt="IELTS Intensive" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A close-up shot of an open English workbook with a stylish pen and a cup of matcha tea on a minimalist light wood desk. The lighting is soft and airy, creating a focused and academic atmosphere. Subtle turquoise accents appear in the notebook's cover design. The scene is clean, modern, and perfectly suited for a premium educational brand's digital presence." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDHX0Qz4LcGIpYg1MlG_s1ieFTIE22ARABh20BGqRSusL9waWpTga_Niv7OieEcj7dTuMAyK9UjSAekMOuCsdqzy_6FjW_tdsqhWe296CxH3_i6y3EIBixZLPo5mI9vLglvklPPdT8OOqc5llcxjI-tDt8AfZSzzyAUR0kXXcqjZRTrYnfHGjq_SHVVyXTjjn-KeQgHq2x1k3-LYPjfiLlqq82qJuAJOMk5P5q1Ke37ODxVflgs1Ysv0ysSLp4hKlUTHVwQ8E17w5w" />
                    <div class="absolute top-3 left-3 bg-primary text-on-primary text-[10px] font-black px-2 py-1 rounded-sm uppercase tracking-widest">New</div>
                    <div class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-sm px-2 py-1 rounded-lg text-primary font-bold text-xs border border-primary/20">IELTS</div>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors">IELTS Intensive 7.5+</h3>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">schedule</span> 8 Tháng
                        </span>
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">bar_chart</span> Chuyên sâu
                        </span>
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">laptop_mac</span> Online
                        </span>
                    </div>
                    <div class="mt-auto">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-xl font-black text-on-surface">12.000.000đ</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <button class="py-2 px-4 border border-primary text-primary rounded-xl font-bold text-xs hover:bg-primary/5 transition-colors">Chi tiết</button>
                            <button class="py-2 px-4 bg-primary text-on-primary rounded-xl font-bold text-xs hover:opacity-90 transition-opacity">Đăng ký</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Course Card 3 -->
            <div class="group flex flex-col bg-surface rounded-2xl overflow-hidden border border-outline-variant hover:shadow-xl transition-all duration-300 relative">
                <div class="relative h-48 overflow-hidden">
                    <img alt="Giao tiếp" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A vibrant shot of three young professionals from different ethnic backgrounds laughing and chatting while holding coffee cups in a modern, plant-filled lounge. The scene captures authentic human connection and effective communication. The colors are bright with soft shadows, maintaining a high-key light mode look with delicate primary color highlights in the decor." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCStlI16A9nrqm4SegT9z7zxAU7NdnQ5LSywYj6zGscUqByLcgBjUmW9L2GtRXR2vrn6TReAccA06XqOYfRJ1F-J_qtGFrnIzYbE8enetYVXEqPrI-9NJW9JuG_QNCcLWjrj-UdU9lEOmPJ-hfgl5u0Bv1moPYUd5B26HpEBwquJFCguczZS7alQW9SOB_SG09o-ND94VAQ6CJ1IK3dLoyLJmrg-TL_qwD_FN8i_FrD5NbOxByiCoYEXQxwnoj-FrIhf0pn7bvuINc" />
                    <div class="absolute top-3 left-3 bg-error text-on-error text-[10px] font-black px-2 py-1 rounded-sm uppercase tracking-widest">-20%</div>
                    <div class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-sm px-2 py-1 rounded-lg text-primary font-bold text-xs border border-primary/20">Giao tiếp</div>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors">English for Career</h3>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">schedule</span> 3 Tháng
                        </span>
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">bar_chart</span> Mọi trình độ
                        </span>
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">groups</span> Nhóm nhỏ
                        </span>
                    </div>
                    <div class="mt-auto">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-xl font-black text-on-surface">3.200.000đ</span>
                            <span class="text-sm text-outline line-through">4.000.000đ</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <button class="py-2 px-4 border border-primary text-primary rounded-xl font-bold text-xs hover:bg-primary/5 transition-colors">Chi tiết</button>
                            <button class="py-2 px-4 bg-primary text-on-primary rounded-xl font-bold text-xs hover:opacity-90 transition-opacity">Đăng ký</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Course Card 4 -->
            <div class="group flex flex-col bg-surface rounded-2xl overflow-hidden border border-outline-variant hover:shadow-xl transition-all duration-300 relative">
                <div class="relative h-48 overflow-hidden">
                    <img alt="Kids" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A bright, cheerful classroom for children with colorful posters and educational toys. Two young children are smiling as they point to colorful English flashcards on a table. The lighting is warm and joyful, creating an inviting educational atmosphere. The color scheme is vibrant yet balanced, dominated by clean whites and energetic turquoise accents." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAOi3og2PnmsRbP7ymDtiqAhjezMxulV98FGVlvU4XpIuuq4z7mZz-FmdTRm31yeX0gU8ZukqQepunJ-5t2Sz_B9xGyA3P4ijQE-AeJ_GNh5ZKGV5gfoUp-iNkkY2a85h6tC1Ke7YC8C5jt3rCO12R6nj6vBeqNp5r35yX767ROWJbtLoRfIbgHNRCSvOjJ1jsTzOL5g5dyRLMzz4NSFK6-xlnkGhn-LWQzVnAlc-2r-sbFbbVRnZbwyhF4tANhKHabLrF0DtfDzU8" />
                    <div class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-sm px-2 py-1 rounded-lg text-primary font-bold text-xs border border-primary/20">Tiếng Anh trẻ em</div>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors">Junior English Star</h3>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">schedule</span> 12 Tháng
                        </span>
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">face</span> 6-12 tuổi
                        </span>
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">celebration</span> Vui vẻ
                        </span>
                    </div>
                    <div class="mt-auto">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-xl font-black text-on-surface">8.900.000đ</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <button class="py-2 px-4 border border-primary text-primary rounded-xl font-bold text-xs hover:bg-primary/5 transition-colors">Chi tiết</button>
                            <button class="py-2 px-4 bg-primary text-on-primary rounded-xl font-bold text-xs hover:opacity-90 transition-opacity">Đăng ký</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Repeating for grid fill -->
            <!-- Card 5 -->
            <div class="group flex flex-col bg-surface rounded-2xl overflow-hidden border border-outline-variant hover:shadow-xl transition-all duration-300 relative">
                <div class="relative h-48 overflow-hidden">
                    <img alt="Student Success" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A candid photo of a happy university student with a backpack walking through a sunlit campus hallway, holding a stack of books and a laptop. The mood is aspirational and successful. The image has a clean, high-contrast look with bright whites and soft secondary color tones, perfectly aligned with a professional and modern light-mode interface." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCVwYc5M7pAj5ycnJG5zvCCnm49aWLkBFKbF3fJf7kT1Gf0_m-PE2ktfUcN-vHZ3d7UeUdSMTRdZY3x583F0HCgm7U1s1C5zvsiGb3j4iipZNCGl6QbA2eh3XG-72Lgh9OAHhwCIB_TSnj3s5ps8dH9_rQJDnVDArulG_Wv5Fnwtm_dOIS3vSQlGKk-CHn-EiVJy8By50yFSIa2I-hA3jB6RQTgAi8j2rRKlVqN803mQ4xXeKmMCCcGYcaJ_RiAFZldh2gEegxkebE" />
                    <div class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-sm px-2 py-1 rounded-lg text-primary font-bold text-xs border border-primary/20">TOEIC</div>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors">TOEIC Speaking &amp; Writing</h3>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">schedule</span> 2 Tháng
                        </span>
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">bar_chart</span> Chuyên biệt
                        </span>
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">edit</span> Kỹ năng
                        </span>
                    </div>
                    <div class="mt-auto">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-xl font-black text-on-surface">4.800.000đ</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <button class="py-2 px-4 border border-primary text-primary rounded-xl font-bold text-xs hover:bg-primary/5 transition-colors">Chi tiết</button>
                            <button class="py-2 px-4 bg-primary text-on-primary rounded-xl font-bold text-xs hover:opacity-90 transition-opacity">Đăng ký</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="group flex flex-col bg-surface rounded-2xl overflow-hidden border border-outline-variant hover:shadow-xl transition-all duration-300 relative">
                <div class="relative h-48 overflow-hidden">
                    <img alt="Advanced English" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="An overhead flat lay of a clean workspace featuring a sleek laptop, a planner, a cup of coffee, and some minimalist stationery on a white marble surface. The composition is artistic and professional, with a cool-toned lighting setup. Accents of primary turquoise are found in the planner and stationery, creating a cohesive and high-end brand feel." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA5pZxiMJ0SZDjGQQPcAF0yafMVi3uzx_hIEioIpKNhrY1COU13u8A8hVmm_fNYW9Ft-vLkx5VVaTZWQXoVnd0Hqh6RA7W6wszJ93pE91x9odXqP9ZhlBaFAwzO90CZJmD6bv5-vHa5KsTX5Y34DLPURFzPDYjs6OeJlmNh6MeITn-_ztY0imWFAJvtCIMZOT78TFRhyZiX7synFcbmu1Jep-iMeXce8jmvtzQeYb8bUz36SMtzo_lK9liQNJ__dhQaabks2kEV-PI" />
                    <div class="absolute top-3 left-3 bg-error text-on-error text-[10px] font-black px-2 py-1 rounded-sm uppercase tracking-widest">Sale</div>
                    <div class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-sm px-2 py-1 rounded-lg text-primary font-bold text-xs border border-primary/20">IELTS</div>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors">IELTS Basic to Advanced</h3>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">schedule</span> 14 Tháng
                        </span>
                        <span class="bg-surface-container-high px-2 py-1 rounded-md text-[10px] font-medium text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">bar_chart</span> Lộ trình dài
                        </span>
                    </div>
                    <div class="mt-auto">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-xl font-black text-on-surface">18.500.000đ</span>
                            <span class="text-sm text-outline line-through">22.000.000đ</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <button class="py-2 px-4 border border-primary text-primary rounded-xl font-bold text-xs hover:bg-primary/5 transition-colors">Chi tiết</button>
                            <button class="py-2 px-4 bg-primary text-on-primary rounded-xl font-bold text-xs hover:opacity-90 transition-opacity">Đăng ký</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <div class="mt-16 flex justify-center items-center gap-2">
            <button class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center hover:bg-surface-container transition-colors disabled:opacity-30">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="w-10 h-10 rounded-full bg-primary text-on-primary font-bold">1</button>
            <button class="w-10 h-10 rounded-full border border-outline-variant font-medium hover:bg-surface-container transition-colors">2</button>
            <button class="w-10 h-10 rounded-full border border-outline-variant font-medium hover:bg-surface-container transition-colors">3</button>
            <span class="px-2 text-outline">...</span>
            <button class="w-10 h-10 rounded-full border border-outline-variant font-medium hover:bg-surface-container transition-colors">12</button>
            <button class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center hover:bg-surface-container transition-colors">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </div>
    </section>
    <!-- Newsletter / CTA -->
    <section class="bg-surface-container-high py-16 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-headline font-black text-on-surface mb-4">Chưa tìm thấy lộ trình phù hợp?</h2>
            <p class="text-on-surface-variant mb-8">Để lại thông tin để chuyên gia tư vấn của Ms. Hoa English liên hệ và xây dựng lộ trình cá nhân hóa cho bạn.</p>
            <form class="flex flex-col sm:flex-row gap-3">
                <input class="flex-grow px-6 py-3 rounded-xl border border-outline-variant bg-surface focus:ring-primary focus:border-primary" placeholder="Họ và tên của bạn" type="text" />
                <input class="flex-grow px-6 py-3 rounded-xl border border-outline-variant bg-surface focus:ring-primary focus:border-primary" placeholder="Số điện thoại hoặc Email" type="email" />
                <button class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold hover:opacity-90 transition-opacity">Nhận tư vấn ngay</button>
            </form>
        </div>
    </section>
</main>
@endsection