@extends('layouts.app')

@section('title', 'Xác thực OTP')

@section('content')
<div class="bg-surface py-16 flex items-center justify-center min-h-[70vh]">
    <div class="container max-w-md mx-auto">
        <div class="bg-white rounded-3xl shadow-xl border border-outline-variant p-8">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-3xl">mark_email_read</span>
                </div>
                <h2 class="text-2xl font-black text-on-surface">Xác nhận Email</h2>
                <p class="text-sm text-outline mt-2">Vui lòng nhập mã OTP 6 số đã được gửi đến email của bạn. Mã sẽ hết hạn sau 5 phút.</p>
            </div>

            @if(session('success'))
                <div class="bg-success/20 text-success border border-success/30 px-4 py-3 rounded-xl mb-6 text-center font-bold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-error/20 text-error border border-error/30 px-4 py-3 rounded-xl mb-6 text-center font-bold text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('otp.verify') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <input type="text" name="otp" id="otp" class="w-full px-4 py-4 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-black text-center tracking-[1em] text-2xl text-on-surface" placeholder="------" maxlength="6" required autocomplete="off" autofocus>
                </div>

                <button type="submit" class="w-full btn btn--primary py-4 rounded-xl shadow-lg hover:-translate-y-1 transition-all font-bold text-lg flex items-center justify-center gap-2">
                    <span>Xác nhận</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </form>

            <div class="mt-8 text-center border-t border-outline-variant pt-6">
                <p class="text-sm text-outline mb-2">Chưa nhận được mã?</p>
                <button type="button" id="resend-btn" class="text-primary font-bold hover:underline disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:no-underline transition-all" disabled>
                    Gửi lại mã (<span id="countdown">30</span>s)
                </button>
                <div id="resend-msg" class="text-xs font-bold mt-2 hidden"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const resendBtn = document.getElementById('resend-btn');
    const countdownSpan = document.getElementById('countdown');
    const resendMsg = document.getElementById('resend-msg');
    let timeLeft = 30;

    // Countdown logic
    const timer = setInterval(() => {
        timeLeft--;
        countdownSpan.textContent = timeLeft;
        if (timeLeft <= 0) {
            clearInterval(timer);
            resendBtn.disabled = false;
            resendBtn.innerHTML = 'Gửi lại mã';
        }
    }, 1000);

    // Resend AJAX Request
    resendBtn.addEventListener('click', function() {
        if (resendBtn.disabled) return;
        
        resendBtn.disabled = true;
        resendBtn.innerHTML = '<span class="material-symbols-outlined animate-spin text-sm align-middle">autorenew</span> Đang gửi...';
        resendMsg.classList.add('hidden');

        fetch("{{ route('otp.resend') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            resendMsg.classList.remove('hidden');
            if (data.success) {
                resendMsg.textContent = data.message;
                resendMsg.className = 'text-xs font-bold mt-2 text-success';
                // Reset timer
                timeLeft = 30;
                resendBtn.innerHTML = 'Gửi lại mã (<span id="countdown">30</span>s)';
                const newTimer = setInterval(() => {
                    timeLeft--;
                    document.getElementById('countdown').textContent = timeLeft;
                    if (timeLeft <= 0) {
                        clearInterval(newTimer);
                        resendBtn.disabled = false;
                        resendBtn.innerHTML = 'Gửi lại mã';
                    }
                }, 1000);
            } else {
                resendMsg.textContent = data.message;
                resendMsg.className = 'text-xs font-bold mt-2 text-error';
                resendBtn.disabled = false;
                resendBtn.innerHTML = 'Gửi lại mã';
            }
        })
        .catch(error => {
            resendMsg.classList.remove('hidden');
            resendMsg.textContent = 'Có lỗi xảy ra. Vui lòng thử lại sau.';
            resendMsg.className = 'text-xs font-bold mt-2 text-error';
            resendBtn.disabled = false;
            resendBtn.innerHTML = 'Gửi lại mã';
        });
    });
});
</script>
@endsection
