@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
@if($errors->any())
    <div style="background: red; color: white; padding: 10px;">
        Hệ thống đang có lỗi: 
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    .login-card-glass {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
</style>

<main class="flex-grow flex items-center justify-center relative py-20 px-6">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 overflow-hidden -z-10">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary-fixed opacity-20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -right-24 w-64 h-64 bg-secondary-fixed opacity-30 rounded-full blur-3xl"></div>
    </div>

    <!-- Login Card -->
    <div class="w-full max-w-md login-card-glass p-8 md:p-10 rounded-xl shadow-xl border border-outline-variant">
        <div class="flex flex-col items-center mb-8">
            <div class="w-16 h-16 bg-brand-turquoise/10 flex items-center justify-center rounded-full mb-4">
                <span class="material-symbols-outlined text-brand-turquoise text-4xl" style="font-variation-settings: 'FILL' 1;">school</span>
            </div>
            <h1 class="text-2xl font-display font-bold text-on-surface">Chào mừng trở lại</h1>
            <p class="text-on-surface-variant text-sm mt-1">Truy cập bảng điều khiển học tập của bạn</p>
        </div>

        <!-- Bắt đầu form đăng nhập Laravel -->
        <form class="space-y-5" method="POST" action="/login">
            @csrf <!-- BẢO MẬT BẮT BUỘC CỦA LARAVEL (tạo token nhận diện form) -->

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-on-surface-variant block ml-1" for="email">Địa chỉ Email</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-lg">mail</span>
                    
                    <!-- Input Email (Đã thêm name="email" và hàm old() để giữ lại email nếu nhập sai mật khẩu) -->
                    <input class="w-full pl-10 pr-4 py-3 bg-surface border {{ $errors->any() ? 'border-red-500 ring-1 ring-red-500' : 'border-outline-variant' }} rounded-lg focus:ring-2 focus:ring-brand-turquoise focus:border-brand-turquoise transition-all outline-none text-on-surface placeholder:text-outline/60" 
                           id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required type="email"/>
                </div>
            </div>

            <div class="space-y-1.5">
                <div class="flex justify-between items-center px-1">
                    <label class="text-sm font-medium text-on-surface-variant block" for="password">Mật khẩu</label>
                    <a class="text-xs font-semibold text-primary hover:underline" href="#">Quên mật khẩu?</a>
                </div>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-lg">lock</span>
                    
                    <!-- Input Password (Đã thêm name="password") -->
                    <input class="w-full pl-10 pr-4 py-3 bg-surface border {{ $errors->any() ? 'border-red-500 ring-1 ring-red-500' : 'border-outline-variant' }} rounded-lg focus:ring-2 focus:ring-brand-turquoise focus:border-brand-turquoise transition-all outline-none text-on-surface placeholder:text-outline/60" 
                           id="password" name="password" placeholder="••••••••" required type="password"/>
                </div>
                
                <!-- Báo lỗi động từ Laravel Controller -->
                @error('err')
                    <div class="text-red-500 text-xs mt-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">error</span> 
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="w-full py-3.5 bg-brand-turquoise hover:bg-opacity-90 text-white font-bold rounded-lg shadow-lg shadow-brand-turquoise/20 active:scale-[0.98] transition-all flex items-center justify-center gap-2 mt-4" type="submit">
                Đăng nhập
                <span class="material-symbols-outlined text-lg">login</span>
            </button>
        </form>
        <!-- Kết thúc form -->

        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-outline-variant"></div>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-white px-2 text-on-surface-variant font-medium">Hoặc tiếp tục với</span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <button class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-outline-variant rounded-xl hover:bg-surface-container transition-all" type="button">
                <img alt="Logo Google" class="w-5 h-5" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBK58qfgY5ZVynkcmgPPFjT3PzYHsPV01O3jqlJ3ggEYlLQPXTc1yzkGtEsOkeJNlx_DygjSlfDlVeX_3p5aPhU5bKbvWIQRGDCqjHufqJTzRMoCXkibHor9H_X7P0El2_b5ff-hE6cgbZVSadaH4cjKDG67kHzXaS-0kENnTKV8V8mf3eurl6zJJ2LN5i5sETyV0YI3giZqmH77-HMQmSL4bLJtdjfbC0g_0g-WZB01rjqx2_S6EF_RCaWy6l1z3dYKw_TR-cr_Hc"/>
                <span class="text-sm font-bold text-on-surface">Tiếp tục với Google</span>
            </button>
            <button class="flex items-center justify-center gap-2 py-3 px-4 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors active:scale-95">
                <svg class="w-5 h-5 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
                </svg>
                <span class="text-sm font-semibold text-on-surface">Facebook</span>
            </button>
        </div>

        <div class="mt-8 text-center">
            <p class="text-on-surface-variant text-sm">
                Mới sử dụng Ms. Hoa English? 
                <a class="text-primary font-bold hover:underline ml-1" href="/register">Đăng ký ngay</a>
            </p>
        </div>
    </div>
</main>

<script>
    // Đã xóa phần JS cản trở submit form (e.preventDefault)
    // Chỉ giữ lại hiệu ứng bóng mờ (background elements movement) chạy theo chuột rất đẹp của bạn
    document.addEventListener('mousemove', (e) => {
        const moveX = (e.clientX - window.innerWidth / 2) / 50;
        const moveY = (e.clientY - window.innerHeight / 2) / 50;
        
        const bubbles = document.querySelectorAll('.rounded-full.blur-3xl');
        bubbles.forEach((bubble, index) => {
            const speed = index === 0 ? 1 : 1.5;
            bubble.style.transform = `translate(${moveX * speed}px, ${moveY * speed}px)`;
        });
    });
</script>
@endsection