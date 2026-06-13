@extends ("layouts.app")

@section("title", "Đăng ký")

@section("content")
<!-- Main Registration Content -->
<main class="flex-grow flex items-center justify-center py-12 px-4 relative overflow-hidden">
    <!-- Abstract Background Accents -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary-container/10 rounded-full blur-3xl -mr-48 -mt-48 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-tertiary-container/10 rounded-full blur-3xl -ml-32 -mb-32 pointer-events-none"></div>
    <div class="max-w-md w-full z-10">
        <!-- Central Registration Card -->
        <div class="bg-surface-container-lowest rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-outline-variant/30 p-8 md:p-10">
            <header class="text-center mb-10">
                <h1 class="text-3xl font-display font-black tracking-tight text-on-surface mb-2">Tạo tài khoản</h1>
                <p class="text-on-surface-variant text-sm">Tham gia cộng đồng tiếng Anh hàng đầu tại Việt Nam.</p>
            </header>
            <form class="space-y-5" action="/register" method="POST">
                @csrf
                <!-- Full Name -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant ml-1" for="full_name">Họ và tên</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">person</span>
                        <input class="w-full pl-10 pr-4 py-3 bg-surface-container rounded-lg border-transparent focus:border-primary focus:ring-0 transition-all text-on-surface placeholder:text-outline/60" id="full_name" name="full_name" placeholder="Nguyen Van A" type="text" />
                    </div>
                    @error('full_name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <!-- Email -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant ml-1" for="email">Địa chỉ Email</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">mail</span>
                        <input class="w-full pl-10 pr-4 py-3 bg-surface-container rounded-lg border-transparent focus:border-primary focus:ring-0 transition-all text-on-surface placeholder:text-outline/60" id="email" name="email" placeholder="name@example.com" type="email" />
                    </div>
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <!-- Phone -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant ml-1" for="phone">Số điện thoại</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">call</span>
                        <input class="w-full pl-10 pr-4 py-3 bg-surface-container rounded-lg border-transparent focus:border-primary focus:ring-0 transition-all text-on-surface placeholder:text-outline/60" id="phone" name="phone" placeholder="090 123 4567" type="tel" />
                    </div>
                    @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <!-- Password -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant ml-1" for="password">Mật khẩu</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">lock</span>
                        <input class="w-full pl-10 pr-12 py-3 bg-surface-container rounded-lg border-transparent focus:border-primary focus:ring-0 transition-all text-on-surface placeholder:text-outline/60" id="password" name="password" placeholder="••••••••" type="password" />
                        <button class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors" type="button">
                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                        </button>
                    </div>
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex items-start gap-3 py-2">
                    <input class="mt-1 rounded border-outline-variant text-primary focus:ring-primary/20" id="terms" type="checkbox" />
                    <label class="text-xs text-on-surface-variant leading-relaxed" for="terms">
                        Bằng cách đăng ký, bạn đồng ý với <a class="text-primary font-semibold hover:underline" href="#">Điều khoản dịch vụ</a> và <a class="text-primary font-semibold hover:underline" href="#">Chính sách bảo mật</a> của chúng tôi.
                    </label>
                </div>
                <button class="w-full btn-turquoise py-4 rounded-lg font-bold shadow-lg shadow-primary/10 active:scale-[0.98] transition-all flex justify-center items-center gap-2" type="submit">
                    Đăng ký
                    <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                </button>
            </form>
            <div class="relative my-8 text-center">
                <span class="bg-surface-container-lowest px-4 text-xs font-bold text-outline-variant uppercase tracking-[0.2em] relative z-10">Hoặc tiếp tục với</span>
                <hr class="absolute top-1/2 w-full border-outline-variant/30" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <button type="button" class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-outline-variant rounded-xl hover:bg-surface-container transition-all">
                    <img alt="Google" class="w-5 h-5" data-alt="Biểu tượng logo chữ 'G' nhiều màu chính thức của Google được tách biệt trên nền trắng tròn sạch sẽ, được thể hiện ở độ phân giải cao với tính thẩm mỹ thương hiệu hiện đại." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBiaf46naPN8soKnyqr3-SG_WY7twwOpjUGxQ6ZYiZLPDgIOwyT31Lq7Pyo6Oh-HetQztqKnj1xA2rbMTOv7mP-KiZzWh9lT0R0wJKL0upjW6rRpayrCtitZAT1og4f6LJ23xezCJsLTIswF3R3T55ThfJObAKkhqDuxZtCGSVnuD3LZON1S0oG6auIwN27yhuNXh_ItrzYIGJRG27p64w5AQXH7iLVAW4kREWfW8SrIueB3podhf3OsENhhfHnnQ4BAjq5UYRbIlQ" />
                    <span class="text-sm font-bold text-on-surface">Đăng ký bằng Google</span>
                </button>
                <button class="flex items-center justify-center gap-2 py-3 bg-[#1877F2] text-white rounded-lg hover:brightness-110 transition-colors active:scale-95">
                    <svg class="w-5 h-5 fill-current" viewbox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
                    </svg>
                    <span class="text-sm font-semibold">Facebook</span>
                </button>
            </div>
            <p class="text-center mt-10 text-on-surface-variant text-sm">
                Đã có tài khoản? <a class="text-primary font-bold hover:underline" href="#">Đăng nhập</a>
            </p>
        </div>
        <!-- Promotion / Trust Badge -->
        <div class="mt-8 flex justify-center items-center gap-6">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-tertiary text-[20px]" style="font-variation-settings: 'FILL' 1;">verified</span>
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-tighter">Chương trình tiếng Anh chuẩn quốc tế</span>
            </div>
            <div class="w-px h-4 bg-outline-variant"></div>
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-error text-[20px]" style="font-variation-settings: 'FILL' 1;">favorite</span>
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-tighter">Hơn 1 triệu học viên hài lòng</span>
            </div>
        </div>
    </div>
</main>
@endsection