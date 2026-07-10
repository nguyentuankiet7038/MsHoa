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
                Khám phá các khóa học tại <span class="text-primary">Ms Hoa English</span>
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
                @php $currentCat = request('category', 'Tất cả'); @endphp
                @foreach(['Tất cả', 'TOEIC', 'IELTS'] as $cat)
                <a href="{{ request()->fullUrlWithQuery(['category' => $cat, 'page' => null]) }}" 
                   class="whitespace-nowrap px-6 py-2 rounded-full {{ $currentCat == $cat ? 'bg-primary text-on-primary font-bold' : 'bg-surface-container-high text-on-surface-variant font-medium hover:bg-primary-container hover:text-on-primary-container' }} text-sm transition-colors">
                    {{ $cat }}
                </a>
                @endforeach
            </div>
            <div class="flex items-center gap-4 w-full lg:w-auto">
                <div class="relative flex-grow lg:w-80">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">tune</span>
                    <select onchange="window.location.href=this.value" class="w-full pl-10 pr-4 py-2 rounded-xl bg-surface-container-low border border-outline-variant text-sm focus:ring-primary focus:border-primary appearance-none cursor-pointer">
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Sắp xếp: Mới nhất</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Giá: Thấp đến Cao</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Giá: Cao đến Thấp</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
    <!-- Course Grid -->
    <section class="py-12 px-6 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse ($courses as $course)
            <div class="group flex flex-col bg-surface rounded-2xl overflow-hidden border border-outline-variant hover:shadow-xl transition-all duration-300 relative">
                <div class="relative h-48 overflow-hidden">
                    <img alt="{{ $course->coursename }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $course->image }}" />
                    <div class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-sm px-2 py-1 rounded-lg text-primary font-bold text-xs border border-primary/20">{{ $course->level }}</div>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-on-surface mb-2 group-hover:text-primary transition-colors">{{$course->coursename}}</h3>
                    <p class="text-xs text-on-surface-variant line-clamp-2 mb-4">{{ $course->description }}</p>
                    <div class="mt-auto">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-xl font-black text-on-surface">{{ number_format($course->price) }}đ</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <a class="py-2 px-4 border border-primary text-primary rounded-xl text-center font-bold text-xs hover:bg-primary/5 transition-colors" href="{{route('courses.show', $course->courseid)}}">Chi tiết</a>
                            <a href="{{route('courses.show', $course->courseid)}}" class="py-2 px-4 bg-primary text-on-primary rounded-xl text-center font-bold text-xs hover:opacity-90 transition-opacity">Đăng ký</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center text-on-surface-variant">
                <span class="material-symbols-outlined text-6xl opacity-20 mb-4">search_off</span>
                <p class="text-lg font-bold">Không tìm thấy khóa học phù hợp.</p>
                <a href="{{ route('courses.index') }}" class="text-primary hover:underline mt-2 inline-block">Xem tất cả khóa học</a>
            </div>
            @endforelse
        </div>
        <!-- Pagination -->
        <div class="mt-16 flex flex-col items-center gap-4">
            <p class="text-sm text-on-surface-variant font-medium">
                Hiển thị {{ $courses->firstItem() ?? 0 }} đến {{ $courses->lastItem() ?? 0 }} của {{ $courses->total() }} khóa học
            </p>
            <div class="flex justify-center">
                {{ $courses->links() }}
            </div>
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
