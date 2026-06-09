@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

<main>
    <!-- Hero Section -->
    <section class="relative w-full min-h-[819px] flex items-center px-6 md:px-12 py-20 overflow-hidden bg-surface-container-low">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover opacity-20" data-alt="A bright and spacious modern English language learning classroom with large windows letting in natural sunlight. Several diverse young adult students are engaged in an enthusiastic group discussion, smiling and holding notebooks. The aesthetic is professional yet warm, using a clean light-mode palette with subtle purple and turquoise accents to match a prestigious educational center's brand identity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCSAIYERgnq4roATMF2addyD8rJwzpmQeXs2mBeXdR-Dh4-kt5rLFDgt0HJ3eSPkIS-4PpnIVs3XQaZwrsTL33aX4BQuP4wfaRNHjxanF8dYLeWTdcQY2UfG9y67378YaB-3VUWxVOKvd-tkC8FzLZGJp36vTPMU10bi17CsWmNxIBjO4Yzp6DCfYIm40whgRq29JzsUdX43aNLv35Mw1TN-CDesNUSS4FS0XPR0D1UfcB6j69Cw7hzd1gGvgxFiOjz6JsUnUAXzNA" />
        </div>
        <div class="relative z-10 max-w-3xl">
            <h1 class="text-5xl md:text-7xl font-black text-on-surface mb-6 leading-tight">Master English.<br /><span class="text-primary">Master Your Destiny.</span></h1>
            <p class="text-xl text-on-surface-variant mb-10 max-w-xl">Join over 50,000 students who have transformed their careers with Ms. Hoa's expert IELTS and Communication programs.</p>
            <div class="flex flex-wrap gap-4">
                <button class="bg-accent-turquoise text-white px-8 py-4 rounded-full font-bold text-lg hover:brightness-110 transition-all shadow-lg flex items-center gap-2">
                    Get Started Today
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
                <button class="border-2 border-primary text-primary px-8 py-4 rounded-full font-bold text-lg hover:bg-primary hover:text-on-primary transition-all">
                    View Schedule
                </button>
            </div>
        </div>
    </section>
    <!-- Course Grid (Bento Style) -->
    <section class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-black text-on-surface">Prominent Courses</h2>
                <p class="text-on-surface-variant">Start your journey with our world-class curriculum.</p>
            </div>
            <button class="text-primary font-bold flex items-center gap-1 hover:underline">
                View all courses
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6" id="course-container">
            <!-- Course 1: Featured Large -->
            @if(isset($courses[0]))
            <div id="course-0" class="md:col-span-8 bg-white rounded-[2rem] overflow-hidden shadow-xl border border-outline-variant flex flex-col md:flex-row group transition-opacity duration-500">
                <div class="md:w-1/2 relative h-64 md:h-full">
                    <img class="w-full h-full object-cover course-image" src="{{ $courses[0]->image }}" alt="{{ $courses[0]->coursename }}" />
                    <span class="absolute top-4 left-4 tag-hot px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest">Hot</span>
                </div>
                <div class="md:w-1/2 p-8 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-primary-fixed text-on-primary-fixed px-3 py-1 rounded-full text-xs font-bold course-level">{{ $courses[0]->level }}</span>
                            <span class="text-outline text-xs flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">schedule</span> 12 Weeks</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 group-hover:text-primary transition-colors course-name">{{ $courses[0]->coursename }}</h3>
                        <p class="text-on-surface-variant text-sm mb-6 course-description">{{ Str::limit($courses[0]->description, 150) }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-black text-on-surface course-price">${{ number_format($courses[0]->price) }}</span>
                        <a href="{{ route('courses.show', $courses[0]->courseid) }}" class="bg-accent-turquoise text-white px-6 py-3 rounded-full font-bold hover:brightness-110 transition-all">Enroll Now</a>
                    </div>
                </div>
            </div>
            @endif

            @foreach($courses->slice(1, 3) as $index => $course)
            <div id="course-{{ $index + 1 }}" class="md:col-span-4 bg-white rounded-[2rem] overflow-hidden shadow-md border border-outline-variant flex flex-col hover:shadow-lg transition-all group transition-opacity duration-500">
                <div class="h-48 relative">
                    <img class="w-full h-full object-cover course-image" src="{{ $course->image }}" alt="{{ $course->coursename }}" />
                    @if($loop->first)
                    <span class="absolute top-4 left-4 bg-green-600 text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest">New</span>
                    @endif
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2 group-hover:text-primary transition-colors course-name">{{ $course->coursename }}</h3>
                        <p class="text-on-surface-variant text-sm mb-4 course-description">{{ Str::limit($course->description, 100) }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-black text-on-surface course-price">${{ number_format($course->price) }}</span>
                        <a href="{{ route('courses.show', $course->courseid) }}" class="bg-accent-turquoise text-white p-3 rounded-full hover:brightness-110 transition-all">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- CTA Banner -->
            <div class="md:col-span-4 bg-primary rounded-[2rem] p-8 text-on-primary flex flex-col justify-center items-center text-center">
                <span class="material-symbols-outlined text-5xl mb-4" style="font-variation-settings: 'FILL' 1;">stars</span>
                <h3 class="text-2xl font-black mb-2">Not sure where to start?</h3>
                <p class="mb-6 opacity-80">Take our free 15-minute placement test and get a personalized learning path.</p>
                <button class="bg-white text-primary px-8 py-3 rounded-full font-bold hover:bg-surface-container-high transition-all">Test Your Level</button>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const allCourses = @json($courses);
                let currentIndex = 0;
                const itemsPerPage = 4;

                if (allCourses.length <= itemsPerPage) return;

                function updateCourseElement(el, course) {
                    if (!el || !course) return;
                    
                    const img = el.querySelector('.course-image');
                    const name = el.querySelector('.course-name');
                    const desc = el.querySelector('.course-description');
                    const price = el.querySelector('.course-price');
                    const level = el.querySelector('.course-level');
                    const link = el.querySelector('a');

                    if (img) {
                        img.src = course.image;
                        img.alt = course.coursename;
                    }
                    if (name) name.textContent = course.coursename;
                    if (desc) {
                        const limit = el.id === 'course-0' ? 150 : 100;
                        desc.textContent = course.description.length > limit ? course.description.substring(0, limit) + '...' : course.description;
                    }
                    if (price) price.textContent = '$' + new Intl.NumberFormat().format(course.price);
                    if (level) level.textContent = course.level;
                    if (link) link.href = `/course/${course.courseid}`;
                }

                function rotate() {
                    currentIndex = (currentIndex + itemsPerPage) % allCourses.length;
                    
                    for (let i = 0; i < itemsPerPage; i++) {
                        const el = document.getElementById(`course-${i}`);
                        if (!el) continue;

                        const courseIndex = (currentIndex + i) % allCourses.length;
                        const course = allCourses[courseIndex];

                        // Fade out
                        el.style.opacity = '0';
                        
                        setTimeout(() => {
                            updateCourseElement(el, course);
                            // Fade in
                            el.style.opacity = '1';
                        }, 500);
                    }
                }

                setInterval(rotate, 30000); // 30 seconds
            });
        </script>
    </section>
    <!-- Testimonials -->
    <section class="bg-surface-container-highest py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-black text-on-surface mb-4">Success Stories</h2>
                <p class="text-on-surface-variant max-w-2xl mx-auto">Hear from our students who achieved their dreams through our English programs.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($feedbacks as $feedback)
                <!-- Testimonial -->
                <div class="bg-surface p-8 rounded-[2rem] shadow-sm flex flex-col">
                    <div class="flex text-primary mb-6">
                        @for($i = 1; $i <= 5; $i++)
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ $i <= $feedback->ratingscore ? 1 : 0 }};">star</span>
                        @endfor
                    </div>
                    <p class="text-on-surface italic mb-8 flex-grow">"{{ $feedback->comment }}"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-primary-fixed overflow-hidden flex items-center justify-center text-on-primary-fixed font-bold text-xl">
                            {{ substr($feedback->student->user->fullname ?? 'S', 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-on-surface">{{ $feedback->student->user->fullname ?? 'Unknown Student' }}</h4>
                            <p class="text-xs text-on-surface-variant">{{ $feedback->course->coursename ?? 'General Student' }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-on-surface-variant">
                    No testimonials yet. Be the first to share your journey!
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Latest News -->
    <section class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <h2 class="text-3xl font-black text-on-surface mb-12">Latest News</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="group cursor-pointer">
                <div class="aspect-video rounded-2xl overflow-hidden mb-4 border border-outline-variant">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A vibrant scholarship event poster design style image featuring excited students celebrating in a modern auditorium. Colorful confetti is falling, and a large digital screen in the background displays 'Congratulations' in elegant typography. The atmosphere is festive and high-energy." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1tYvhdz3m5DfQAh_U0fA-QHkWgzBkMDvZIXP6y4NufD1GmPrghjciCPJI2XoQDk9VWXgL-gg_kXeXpCW1IcxIfMKilwlavolquAfiB7GN34j609AR66xRWHVahs-XnliZriPwSRJ3Hei_5dTF8-gWdUJYR5cOCq1drV_n4HGVRxul9x3Zlf6xSbaDFTKiVSzPQ5wZvbNRbRlGxbaamqq8NRAqfWtVQ2jVTtl7eZ6PazcS7eHB7GK9dR6CJTk4u5LOIfKN3hztXlQ" />
                </div>
                <span class="text-primary text-xs font-bold uppercase mb-2 block">Events</span>
                <h4 class="text-lg font-bold text-on-surface leading-snug group-hover:text-primary transition-colors">Announcing the 2024 Global Excellence Scholarship</h4>
                <p class="text-sm text-on-surface-variant mt-2">March 15, 2024</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-video rounded-2xl overflow-hidden mb-4 border border-outline-variant">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A clean, minimalist workspace featuring a tablet showing an educational app, a notebook, and a pair of modern headphones. The lighting is soft and focused, creating a studious and technological mood. The composition is uncluttered and sophisticated." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDAMr91lx6K332Ev8Nj5Ur8Uuo14fkD9kY0Q674gnlp3aCKoJ5tayNp390j9rxqO8o9YXCnDgu8cmODzD8D0y_2PwdFPyWLIcCvXd_CjvQavq1dGGo9MijGD7gNwmpTkqkDciVMc83gTVni3YMvtsDPQuneiGbtwBEhWGiUx5Zl6DeZBg9BsGUiCQxcjja6rFz8I5AUSUnFkU6M__E_sMOp4QG0WI0Vg7T_a0xbGfL7Y8P9LoDchVSB7z_UPz-koZOCBh7m5daZx-M" />
                </div>
                <span class="text-primary text-xs font-bold uppercase mb-2 block">Tips &amp; Tricks</span>
                <h4 class="text-lg font-bold text-on-surface leading-snug group-hover:text-primary transition-colors">5 Secrets to Improving Your English Pronunciation</h4>
                <p class="text-sm text-on-surface-variant mt-2">March 12, 2024</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-video rounded-2xl overflow-hidden mb-4 border border-outline-variant">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A teacher at the front of a classroom using an interactive whiteboard with colorful English vocabulary diagrams. The students are partially visible in the foreground, indicating an engaged learning environment. The image is bright and technologically forward." src="https://lh3.googleusercontent.com/aida-public/AB6AXuC70BjGpoxJlEsMrWePGBE6FD3VFDycMOeIsmSvHoIVy1FGTlOXKFt9IEzKxyt70dhWw9Jatsup8KHanHCq-D7xCkOgUma1VK4C_qe50CHTNGpzWpoKzZmUv1lQ0BO-y8tD7_MXMDTaed5seGT9w0_rGW2E8CyPd1AnU8Oz6wGeiHEs7TtcPxuC0carWRsSl46zvfGJ42x5BbQ0196v1asqGWUh5CQW-jzXeyBQlPc4c4eQFmMyU8OqOoqJntcn1lo-yLHbsulBg00" />
                </div>
                <span class="text-primary text-xs font-bold uppercase mb-2 block">Academics</span>
                <h4 class="text-lg font-bold text-on-surface leading-snug group-hover:text-primary transition-colors">New 'Cambridge Primary' Curriculum Launched</h4>
                <p class="text-sm text-on-surface-variant mt-2">March 10, 2024</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-video rounded-2xl overflow-hidden mb-4 border border-outline-variant">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A close-up of a high-end microphone and a laptop in a podcast studio setting. The lighting is dramatic and warm, with subtle purple and blue backlight. The image represents the launch of a new educational podcast series." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBauUVDdsUL6HTCCshViPmBKvGxYyiI0NmKkRyRKWy94lSoNK49bRAD3e-dUnU2DPclynCVGR8KKkL0reGHgAKD3M1BLlHLgSc-NnhaXZzZI9oZc11aCHOvFO7uSW9iH3JNKs66j3DcpepV3Jfd2dnODLqMbAZ5vxnmob1QLBS5mSKHS4ek--Pxhv90DFBDf07XXe4Y5YEtJd2Z6pkrO6LLhwMtDvwAwvC9Tfq2UPlvl_bgrAyVTGgmTbkkQWkd88cnf_4zSmpCCwY" />
                </div>
                <span class="text-primary text-xs font-bold uppercase mb-2 block">Media</span>
                <h4 class="text-lg font-bold text-on-surface leading-snug group-hover:text-primary transition-colors">Ms. Hoa Podcast: Episode 45 with IELTS Examiners</h4>
                <p class="text-sm text-on-surface-variant mt-2">March 08, 2024</p>
            </div>
        </div>
    </section>
</main>
@endsection