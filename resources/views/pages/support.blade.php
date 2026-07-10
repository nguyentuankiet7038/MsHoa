@extends('layouts.app')

@section('content')

<main class="support-page max-w-[1440px] mx-auto p-6 grid grid-cols-1 lg:grid-cols-12 gap-6 min-h-[calc(100vh-140px)]">
    <!-- Left Column: Support Interface (Bento Style) -->
    <div class="lg:col-span-8">
    <section class="relative h-[600px] overflow-hidden rounded-xl">

        <!-- Video nền -->
        <iframe
            class="absolute inset-0 w-full h-full"
            src="https://www.youtube.com/embed/bsGAk7seAB8?autoplay=1&mute=1&loop=1&playlist=bsGAk7seAB8&controls=0&rel=0"
            title="YouTube video"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen>
        </iframe>

        <!-- Lớp phủ tối -->
        <!-- <div class="absolute inset-0 bg-black/50"></div> -->

        <!-- Nội dung -->
        <!-- <div class="relative z-10 p-8 text-white max-w-xl">
            <h1 class="text-4xl font-bold mb-4">
                Chúng tôi có thể giúp gì cho hành trình học tập của bạn?
            </h1>

            <p class="text-lg">
                Đội ngũ hỗ trợ của chúng tôi sẵn sàng 24/7...
            </p>
        </div> -->

    </section>
</div>
    <!-- Right Column: Live Chat Interface -->
    <div class="lg:col-span-4">
        <div class="bg-white rounded-xl shadow-xl border border-outline-variant flex flex-col overflow-hidden sticky top-24 h-[600px]">
            <!-- Chat Header -->
            <div class="support-bg-accent p-4 flex justify-between items-center text-white">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <img class="w-10 h-10 rounded-full border-2 border-white object-cover" data-alt="Một bức chân dung hồ sơ chuyên nghiệp của một nữ nhân viên hỗ trợ với nụ cười thân thiện, mặc áo blazer màu xanh navy lịch sự. Cô ấy đứng trên nền văn phòng sạch sẽ, được làm mờ nhẹ. Ánh sáng chuyên nghiệp và rực rỡ, làm nổi bật biểu cảm dễ gần và đôi mắt sáng, tinh anh của cô." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD-wyOJG0KdhPrVQTkFLCgJ5_mrQid2tV-a6hrVhFkrPMgoTgZaBKo9ZjxCC6shMwrTOUtsKVoxG-yXPrGTbCPSbeWqangaLXDZBkcLsHu3_hIfiG52cwAT1qY0TsXiq0VXGCIQlNO2ftNvUq1C5j1DgS-xQnTNDJtEVYLDWGNnFnZEa6LiJXtQw7-EdgQcxi2Ne9aPFZ-z3UcuWSvhxwzS9h5RFiF8K7Re_5XOi7AjdMZ6hjhGIkIfW5qSqyeLUS0s2ekpPy_r5Vw" />
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                    </div>
                    <div>
                        <p class="font-bold leading-tight">Bộ phận Hỗ trợ</p>
                        <p class="text-xs opacity-80"> Phản hồi trong < 2 phút</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <span class="material-symbols-outlined cursor-pointer">settings</span>
                    <span class="material-symbols-outlined cursor-pointer">close</span>
                </div>
            </div>
            <!-- Chat Messages Area -->
            <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-surface-container-lowest">
                <!-- Typing Indicator -->
                <div class="flex gap-2 items-center text-outline italic text-xs">
                    <div class="flex gap-1">
                        <div class="w-1 h-1 bg-outline rounded-full"></div>
                        <div class="w-1 h-1 bg-outline rounded-full"></div>
                        <div class="w-1 h-1 bg-outline rounded-full"></div>
                    </div>
                    Sarah đang nhập...
                </div>
            </div>
            <!-- Chat Input Area -->
            <div class="p-4 bg-white border-t border-outline-variant">
                <div class="relative flex items-center bg-surface-container-high rounded-2xl p-2">
                    <input id="chat-input" class="flex-1 bg-transparent border-none focus:ring-0 text-sm py-1" placeholder="Nhập tin nhắn..." type="text" />
                    <button id="send-btn" class="p-2 support-bg-accent text-white rounded-xl shadow-md">
                        <span class="material-symbols-outlined">send</span>
                    </button>
                </div>
                <!-- <div class="mt-2 flex gap-4 text-[10px] text-outline justify-center font-medium">
                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[12px]">security</span> Được mã hóa</span>
                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[12px]">bolt</span> Phản hồi nhanh</span>
                </div> -->
            </div>
        </div>
    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatInput = document.getElementById('chat-input');
    const sendBtn = document.getElementById('send-btn');
    const messagesArea = document.querySelector('.flex-1.overflow-y-auto.p-4.space-y-4');
    const typingIndicator = document.querySelector('.flex.gap-2.items-center.text-outline.italic.text-xs');

    function appendMessage(role, text) {
        const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        let html = '';
        if (role === 'user') {
            html = `
                <div class="flex flex-row-reverse gap-2 max-w-[85%] ml-auto">
                    <div class="support-bg-accent p-3 rounded-2xl rounded-tr-none text-sm text-white">
                        ${text}
                        <span class="block text-[10px] opacity-70 mt-1 text-right">${time}</span>
                    </div>
                </div>
            `;
        } else {
            html = `
                <div class="flex gap-2 max-w-[85%]">
                    <div class="flex-shrink-0">
                        <img class="w-6 h-6 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD-wyOJG0KdhPrVQTkFLCgJ5_mrQid2tV-a6hrVhFkrPMgoTgZaBKo9ZjxCC6shMwrTOUtsKVoxG-yXPrGTbCPSbeWqangaLXDZBkcLsHu3_hIfiG52cwAT1qY0TsXiq0VXGCIQlNO2ftNvUq1C5j1DgS-xQnTNDJtEVYLDWGNnFnZEa6LiJXtQw7-EdgQcxi2Ne9aPFZ-z3UcuWSvhxwzS9h5RFiF8K7Re_5XOi7AjdMZ6hjhGIkIfW5qSqyeLUS0s2ekpPy_r5Vw"/>
                    </div>
                    <div class="bg-surface-container p-3 rounded-2xl rounded-tl-none text-sm text-on-surface">
                        ${text}
                        <span class="block text-[10px] text-outline mt-1">${time}</span>
                    </div>
                </div>
            `;
        }
        typingIndicator.insertAdjacentHTML('beforebegin', html);
        messagesArea.scrollTop = messagesArea.scrollHeight;
    }

    async function sendMessage() {
        const message = chatInput.value.trim();
        if (!message) return;

        appendMessage('user', message);
        chatInput.value = '';
        typingIndicator.classList.remove('hidden');

        try {
            const response = await fetch('{{ route('support.chat') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            typingIndicator.classList.add('hidden');

            if (data.reply) {
                appendMessage('agent', data.reply);
            } else if (data.error) {
                appendMessage('agent', 'Lỗi: ' + data.error);
            }
        } catch (error) {
            typingIndicator.classList.add('hidden');
            appendMessage('agent', 'Có lỗi xảy ra khi kết nối với AI.');
        }
    }

    sendBtn.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') sendMessage();
    });

    // Hide typing indicator initially if needed
    typingIndicator.classList.add('hidden');
});
</script>

@endsection
