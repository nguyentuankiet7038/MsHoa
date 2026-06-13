@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

<main>
    <!-- Hero Section -->
    <section class="relative w-full min-h-[819px] flex items-center px-6 md:px-12 py-20 overflow-hidden bg-surface-container-low">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover opacity-20" data-alt="Một phòng học tiếng Anh hiện đại, rộng rãi và tươi sáng với những cửa sổ lớn đón ánh sáng tự nhiên. Nhiều học viên trẻ tuổi từ các quốc gia khác nhau đang hào hứng thảo luận nhóm, mỉm cười và cầm sổ tay. Không gian toát lên vẻ chuyên nghiệp nhưng ấm cúng, sử dụng bảng màu sáng với các điểm nhấn nhẹ nhàng màu tím và xanh ngọc, phù hợp với bộ nhận diện thương hiệu của một trung tâm giáo dục uy tín." src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-Anh-Ngu-MsHoa.png" />
        </div>
        <div class="relative z-10 max-w-3xl">
            <h1 class="text-5xl md:text-7xl font-black text-on-surface mb-6 leading-tight">Làm chủ tiếng Anh.<br /><span class="text-primary">Làm chủ định mệnh.</span></h1>
            <p class="text-xl text-on-surface-variant mb-10 max-w-xl">Tham gia cùng hơn 50.000 học viên đã thay đổi sự nghiệp với các chương trình IELTS và Giao tiếp chuyên sâu của Ms. Hoa.</p>
            <div class="flex flex-wrap gap-4">
                <button class="bg-accent-turquoise text-white px-8 py-4 rounded-full font-bold text-lg hover:brightness-110 transition-all shadow-lg flex items-center gap-2">
                    Bắt đầu ngay hôm nay
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
                <button class="border-2 border-primary text-primary px-8 py-4 rounded-full font-bold text-lg hover:bg-primary hover:text-on-primary transition-all">
                    Xem lịch học
                </button>
            </div>
        </div>
    </section>
    <!-- Course Grid (Bento Style) -->
    <section class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-black text-on-surface">Khóa học nổi bật</h2>
                <p class="text-on-surface-variant">Bắt đầu hành trình của bạn với lộ trình học chuẩn quốc tế.</p>
            </div>
            <a href="{{ route('courses.index') }}" class="text-primary font-bold flex items-center gap-1 hover:underline">
                Xem tất cả khóa học
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
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
                            <span class="text-outline text-xs flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">schedule</span> 12 Tuần</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 group-hover:text-primary transition-colors course-name">{{ $courses[0]->coursename }}</h3>
                        <p class="text-on-surface-variant text-sm mb-6 course-description">{{ Str::limit($courses[0]->description, 150) }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-black text-on-surface course-price">{{ number_format($courses[0]->price) }}đ</span>
                        <a href="{{ route('courses.show', $courses[0]->courseid) }}" class="bg-accent-turquoise text-white px-6 py-3 rounded-full font-bold hover:brightness-110 transition-all">Đăng ký ngay</a>
                    </div>
                </div>
            </div>
            @endif

            @foreach($courses->slice(1, 3) as $index => $course)
            <div id="course-{{ $index + 1 }}" class="md:col-span-4 bg-white rounded-[2rem] overflow-hidden shadow-md border border-outline-variant flex flex-col hover:shadow-lg transition-all group transition-opacity duration-500">
                <div class="h-48 relative">
                    <img class="w-full h-full object-cover course-image" src="{{ $course->image }}" alt="{{ $course->coursename }}" />
                    @if($loop->first)
                    <span class="absolute top-4 left-4 bg-green-600 text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest">Mới</span>
                    @endif
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2 group-hover:text-primary transition-colors course-name">{{ $course->coursename }}</h3>
                        <p class="text-on-surface-variant text-sm mb-4 course-description">{{ Str::limit($course->description, 100) }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-black text-on-surface course-price">{{ number_format($course->price) }}đ</span>
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
                <h3 class="text-2xl font-black mb-2">Bạn chưa biết bắt đầu từ đâu?</h3>
                <p class="mb-6 opacity-80">Làm bài kiểm tra đầu vào miễn phí trong 15 phút để nhận lộ trình học cá nhân hóa.</p>
                <button class="bg-white text-primary px-8 py-3 rounded-full font-bold hover:bg-surface-container-high transition-all">Kiểm tra trình độ</button>
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
                    if (price) price.textContent = new Intl.NumberFormat().format(course.price) + 'đ';
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
    <section class="bg-white py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-black text-black mb-4">Câu chuyện thành công</h2>
                <p class="text-black/70 max-w-2xl mx-auto">Lắng nghe những học viên đã đạt được ước mơ thông qua các chương trình học của chúng tôi.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($feedbacks as $feedback)
                <!-- Testimonial -->
                <div class="bg-white p-8 rounded-[2rem] shadow-lg border border-outline-variant flex flex-col">
                    <div class="flex text-yellow-400 mb-6">
                        @for($i = 1; $i <= 5; $i++)
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ $i <= $feedback->ratingscore ? 1 : 0 }};">star</span>
                        @endfor
                    </div>
                    <p class="text-black italic mb-8 flex-grow">"{{ $feedback->comment }}"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-[#00C2CB] overflow-hidden flex items-center justify-center text-white font-bold text-xl">
                            {{ substr($feedback->student->user->fullname ?? 'S', 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-black">{{ $feedback->student->user->fullname ?? 'Unknown Student' }}</h4>
                            <p class="text-xs text-black/60">{{ $feedback->course->coursename ?? 'General Student' }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-black/50">
                    Chưa có cảm nhận nào. Hãy là người đầu tiên chia sẻ hành trình của bạn!
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Latest News -->
    <section class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <h2 class="text-3xl font-black text-on-surface mb-12">Tin tức mới nhất</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="group cursor-pointer">
                <div class="aspect-video rounded-2xl overflow-hidden mb-4 border border-outline-variant">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Hình ảnh phong cách thiết kế poster sự kiện trao học bổng rực rỡ, với các học viên đang hào hứng ăn mừng trong một hội trường hiện đại. Pháo hoa giấy nhiều màu sắc đang rơi, và một màn hình kỹ thuật số lớn ở phía sau hiển thị chữ 'Chúc mừng' với kiểu chữ trang nhã. Không khí lễ hội và tràn đầy năng lượng." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1tYvhdz3m5DfQAh_U0fA-QHkWgzBkMDvZIXP6y4NufD1GmPrghjciCPJI2XoQDk9VWXgL-gg_kXeXpCW1IcxIfMKilwlavolquAfiB7GN34j609AR66xRWHVahs-XnliZriPwSRJ3Hei_5dTF8-gWdUJYR5cOCq1drV_n4HGVRxul9x3Zlf6xSbaDFTKiVSzPQ5wZvbNRbRlGxbaamqq8NRAqfWtVQ2jVTtl7eZ6PazcS7eHB7GK9dR6CJTk4u5LOIfKN3hztXlQ" />
                </div>
                <span class="text-primary text-xs font-bold uppercase mb-2 block">Sự kiện</span>
                <h4 class="text-lg font-bold text-on-surface leading-snug group-hover:text-primary transition-colors">Công bố Học bổng Global Excellence 2024</h4>
                <p class="text-sm text-on-surface-variant mt-2">15 tháng 3, 2024</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-video rounded-2xl overflow-hidden mb-4 border border-outline-variant">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Một không gian làm việc sạch sẽ, tối giản với một chiếc máy tính bảng hiển thị ứng dụng giáo dục, một cuốn sổ tay và một cặp tai nghe hiện đại. Ánh sáng mềm mại và tập trung, tạo ra bầu không khí học thuật và công nghệ. Bố cục gọn gàng và tinh tế." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDAMr91lx6K332Ev8Nj5Ur8Uuo14fkD9kY0Q674gnlp3aCKoJ5tayNp390j9rxqO8o9YXCnDgu8cmODzD8D0y_2PwdFPyWLIcCvXd_CjvQavq1dGGo9MijGD7gNwmpTkqkDciVMc83gTVni3YMvtsDPQuneiGbtwBEhWGiUx5Zl6DeZBg9BsGUiCQxcjja6rFz8I5AUSUnFkU6M__E_sMOp4QG0WI0Vg7T_a0xbGfL7Y8P9LoDchVSB7z_UPz-koZOCBh7m5daZx-M" />
                </div>
                <span class="text-primary text-xs font-bold uppercase mb-2 block">Mẹo & Thủ thuật</span>
                <h4 class="text-lg font-bold text-on-surface leading-snug group-hover:text-primary transition-colors">5 bí quyết cải thiện phát âm tiếng Anh</h4>
                <p class="text-sm text-on-surface-variant mt-2">12 tháng 3, 2024</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-video rounded-2xl overflow-hidden mb-4 border border-outline-variant">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Một giáo viên đứng trước lớp học đang sử dụng bảng trắng tương tác với các sơ đồ từ vựng tiếng Anh đầy màu sắc. Các học viên xuất hiện một phần ở tiền cảnh, cho thấy một môi trường học tập tích cực. Hình ảnh tươi sáng và hướng tới công nghệ." src="https://lh3.googleusercontent.com/aida-public/AB6AXuC70BjGpoxJlEsMrWePGBE6FD3VFDycMOeIsmSvHoIVy1FGTlOXKFt9IEzKxyt70dhWw9Jatsup8KHanHCq-D7xCkOgUma1VK4C_qe50CHTNGpzWpoKzZmUv1lQ0BO-y8tD7_MXMDTaed5seGT9w0_rGW2E8CyPd1AnU8Oz6wGeiHEs7TtcPxuC0carWRsSl46zvfGJ42x5BbQ0196v1asqGWUh5CQW-jzXeyBQlPc4c4eQFmMyU8OqOoqJntcn1lo-yLHbsulBg00" />
                </div>
                <span class="text-primary text-xs font-bold uppercase mb-2 block">Học thuật</span>
                <h4 class="text-lg font-bold text-on-surface leading-snug group-hover:text-primary transition-colors">Ra mắt lộ trình học 'Cambridge Primary' mới</h4>
                <p class="text-sm text-on-surface-variant mt-2">10 tháng 3, 2024</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-video rounded-2xl overflow-hidden mb-4 border border-outline-variant">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Cận cảnh một chiếc micro cao cấp và một chiếc máy tính xách tay trong bối cảnh phòng thu podcast. Ánh sáng kịch tính và ấm áp, với đèn nền màu tím và xanh dương tinh tế. Hình ảnh đại diện cho việc ra mắt một loạt podcast giáo dục mới." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBauUVDdsUL6HTCCshViPmBKvGxYyiI0NmKkRyRKWy94lSoNK49bRAD3e-dUnU2DPclynCVGR8KKkL0reGHgAKD3M1BLlHLgSc-NnhaXZzZI9oZc11aCHOvFO7uSW9iH3JNKs66j3DcpepV3Jfd2dnODLqMbAZ5vxnmob1QLBS5mSKHS4ek--Pxhv90DFBDf07XXe4Y5YEtJd2Z6pkrO6LLhwMtDvwAwvC9Tfq2UPlvl_bgrAyVTGgmTbkkQWkd88cnf_4zSmpCCwY" />
                </div>
                <span class="text-primary text-xs font-bold uppercase mb-2 block">Truyền thông</span>
                <h4 class="text-lg font-bold text-on-surface leading-snug group-hover:text-primary transition-colors">Ms. Hoa Podcast: Tập 45 cùng giám khảo IELTS</h4>
                <p class="text-sm text-on-surface-variant mt-2">08 tháng 3, 2024</p>
            </div>
        </div>
    </section>
</main>
@endsection
