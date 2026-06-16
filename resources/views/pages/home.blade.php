@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <img class="hero__bg" src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-Anh-Ngu-MsHoa.png" alt="Ms Hoa Background">
        <div class="container">
            <div class="hero__content">
                <h1 class="hero__title">Làm chủ tiếng Anh.<br /><span class="hero__title--highlight">Làm chủ định mệnh.</span></h1>
                <p class="hero__desc">Tham gia cùng hơn 50.000 học viên đã thay đổi sự nghiệp với các chương trình IELTS và Giao tiếp chuyên sâu của Ms. Hoa.</p>
                <div class="hero__actions">
                    <button class="btn btn--primary">
                        Bắt đầu ngay hôm nay
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                    <button class="btn btn--secondary">Xem lịch học</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Section -->
    <section class="course-section">
        <div class="container">
            <div class="section-header">
                <div>
                    <h2 class="section-header__title">Khóa học nổi bật</h2>
                    <p class="section-header__subtitle">Bắt đầu hành trình của bạn với lộ trình học chuẩn quốc tế.</p>
                </div>
                <a href="{{ route('courses.index') }}" class="section-header__link">
                    Xem tất cả khóa học
                    <span class="material-symbols-outlined">chevron_right</span>
                </a>
            </div>

            <div class="course-grid" id="course-container">
                <!-- Course 1: Featured Large -->
                @if(isset($courses[0]))
                <div id="course-0" class="course-card course-card--large">
                    <div class="course-card__image-wrapper">
                        <img class="course-card__image course-image" src="{{ $courses[0]->image }}" alt="{{ $courses[0]->coursename }}" />
                        <span class="course-card__badge tag-hot">Hot</span>
                    </div>
                    <div class="course-card__content">
                        <div class="course-card__meta">
                            <span class="course-card__level course-level">{{ $courses[0]->level }}</span>
                            <span class="course-card__time"><span class="material-symbols-outlined" style="font-size:16px;">schedule</span> 12 Tuần</span>
                        </div>
                        <h3 class="course-card__title course-name">{{ $courses[0]->coursename }}</h3>
                        <p class="course-card__desc course-description">{{ Str::limit($courses[0]->description, 150) }}</p>
                        <div class="course-card__footer">
                            <span class="course-card__price course-price">{{ number_format($courses[0]->price) }}đ</span>
                            <a href="{{ route('courses.show', $courses[0]->courseid) }}" class="btn btn--primary">Đăng ký ngay</a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Other Courses -->
                @foreach($courses->slice(1, 3) as $index => $course)
                <div id="course-{{ $index + 1 }}" class="course-card course-card--normal">
                    <div class="course-card__image-wrapper">
                        <img class="course-card__image course-image" src="{{ $course->image }}" alt="{{ $course->coursename }}" />
                        @if($loop->first)
                        <span class="course-card__badge tag-new">Mới</span>
                        @endif
                    </div>
                    <div class="course-card__content">
                        <h3 class="course-card__title course-name">{{ $course->coursename }}</h3>
                        <p class="course-card__desc course-description">{{ Str::limit($course->description, 100) }}</p>
                        <div class="course-card__footer">
                            <span class="course-card__price course-price">{{ number_format($course->price) }}đ</span>
                            <a href="{{ route('courses.show', $course->courseid) }}" class="course-card__btn-icon">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- CTA Banner -->
                <div class="cta-banner">
                    <span class="material-symbols-outlined cta-banner__icon">stars</span>
                    <h3 class="cta-banner__title">Bạn chưa biết bắt đầu từ đâu?</h3>
                    <p class="cta-banner__desc">Làm bài kiểm tra đầu vào miễn phí trong 15 phút để nhận lộ trình học cá nhân hóa.</p>
                    <button class="btn btn--outline" style="border-radius: 50px;">Kiểm tra trình độ</button>
                </div>
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
                        const limit = el.classList.contains('course-card--large') ? 150 : 100;
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

    <!-- Testimonials Section -->
    <section class="testimonial-section">
        <div class="container">
            <div class="testimonial-section__header">
                <h2 class="section-header__title">Câu chuyện thành công</h2>
                <p class="section-header__subtitle">Lắng nghe những học viên đã đạt được ước mơ thông qua các chương trình học của chúng tôi.</p>
            </div>
            
            <div class="testimonial-grid">
                @forelse($feedbacks as $feedback)
                <div class="testimonial-card">
                    <div class="testimonial-card__rating">
                        @for($i = 1; $i <= 5; $i++)
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ $i <= $feedback->ratingscore ? 1 : 0 }};">star</span>
                        @endfor
                    </div>
                    <p class="testimonial-card__comment">"{{ $feedback->comment }}"</p>
                    <div class="testimonial-card__author">
                        <div class="testimonial-card__avatar">
                            {{ substr($feedback->student->user->fullname ?? 'S', 0, 1) }}
                        </div>
                        <div>
                            <div class="testimonial-card__name">{{ $feedback->student->user->fullname ?? 'Unknown Student' }}</div>
                            <div class="testimonial-card__course">{{ $feedback->course->coursename ?? 'General Student' }}</div>
                        </div>
                    </div>
                </div>
                @empty
                <div style="grid-column: span 3; text-align: center; color: var(--color-text-muted);">
                    Chưa có cảm nhận nào. Hãy là người đầu tiên chia sẻ hành trình của bạn!
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section">
        <div class="container">
            <h2 class="section-header__title" style="margin-bottom: 40px;">Tin tức mới nhất</h2>
            <div class="news-grid">
                <div class="news-card">
                    <div class="news-card__image-wrapper">
                        <img class="news-card__image" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1tYvhdz3m5DfQAh_U0fA-QHkWgzBkMDvZIXP6y4NufD1GmPrghjciCPJI2XoQDk9VWXgL-gg_kXeXpCW1IcxIfMKilwlavolquAfiB7GN34j609AR66xRWHVahs-XnliZriPwSRJ3Hei_5dTF8-gWdUJYR5cOCq1drV_n4HGVRxul9x3Zlf6xSbaDFTKiVSzPQ5wZvbNRbRlGxbaamqq8NRAqfWtVQ2jVTtl7eZ6PazcS7eHB7GK9dR6CJTk4u5LOIfKN3hztXlQ" alt="News Image" />
                    </div>
                    <span class="news-card__category">Sự kiện</span>
                    <h4 class="news-card__title">Công bố Học bổng Global Excellence 2024</h4>
                    <p class="news-card__date">15 tháng 3, 2024</p>
                </div>
                
                <div class="news-card">
                    <div class="news-card__image-wrapper">
                        <img class="news-card__image" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDAMr91lx6K332Ev8Nj5Ur8Uuo14fkD9kY0Q674gnlp3aCKoJ5tayNp390j9rxqO8o9YXCnDgu8cmODzD8D0y_2PwdFPyWLIcCvXd_CjvQavq1dGGo9MijGD7gNwmpTkqkDciVMc83gTVni3YMvtsDPQuneiGbtwBEhWGiUx5Zl6DeZBg9BsGUiCQxcjja6rFz8I5AUSUnFkU6M__E_sMOp4QG0WI0Vg7T_a0xbGfL7Y8P9LoDchVSB7z_UPz-koZOCBh7m5daZx-M" alt="News Image" />
                    </div>
                    <span class="news-card__category">Mẹo & Thủ thuật</span>
                    <h4 class="news-card__title">5 bí quyết cải thiện phát âm tiếng Anh</h4>
                    <p class="news-card__date">12 tháng 3, 2024</p>
                </div>
                
                <div class="news-card">
                    <div class="news-card__image-wrapper">
                        <img class="news-card__image" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC70BjGpoxJlEsMrWePGBE6FD3VFDycMOeIsmSvHoIVy1FGTlOXKFt9IEzKxyt70dhWw9Jatsup8KHanHCq-D7xCkOgUma1VK4C_qe50CHTNGpzWpoKzZmUv1lQ0BO-y8tD7_MXMDTaed5seGT9w0_rGW2E8CyPd1AnU8Oz6wGeiHEs7TtcPxuC0carWRsSl46zvfGJ42x5BbQ0196v1asqGWUh5CQW-jzXeyBQlPc4c4eQFmMyU8OqOoqJntcn1lo-yLHbsulBg00" alt="News Image" />
                    </div>
                    <span class="news-card__category">Học thuật</span>
                    <h4 class="news-card__title">Ra mắt lộ trình học 'Cambridge Primary' mới</h4>
                    <p class="news-card__date">10 tháng 3, 2024</p>
                </div>
                
                <div class="news-card">
                    <div class="news-card__image-wrapper">
                        <img class="news-card__image" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBauUVDdsUL6HTCCshViPmBKvGxYyiI0NmKkRyRKWy94lSoNK49bRAD3e-dUnU2DPclynCVGR8KKkL0reGHgAKD3M1BLlHLgSc-NnhaXZzZI9oZc11aCHOvFO7uSW9iH3JNKs66j3DcpepV3Jfd2dnODLqMbAZ5vxnmob1QLBS5mSKHS4ek--Pxhv90DFBDf07XXe4Y5YEtJd2Z6pkrO6LLhwMtDvwAwvC9Tfq2UPlvl_bgrAyVTGgmTbkkQWkd88cnf_4zSmpCCwY" alt="News Image" />
                    </div>
                    <span class="news-card__category">Truyền thông</span>
                    <h4 class="news-card__title">Ms. Hoa Podcast: Tập 45 cùng giám khảo IELTS</h4>
                    <p class="news-card__date">08 tháng 3, 2024</p>
                </div>
            </div>
        </div>
    </section>
@endsection
