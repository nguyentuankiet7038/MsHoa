@extends('layouts.app')

@section('content')

<main class="max-w-[1440px] mx-auto p-6 grid grid-cols-1 lg:grid-cols-12 gap-6 min-h-[calc(100vh-140px)]">
<!-- Left Column: Support Interface (Bento Style) -->
<div class="lg:col-span-8 space-y-6">
<!-- Hero Header Section -->
<section class="bg-primary-container text-on-primary-container p-8 rounded-xl relative overflow-hidden">
<div class="relative z-10 max-w-xl">
<h1 class="text-3xl md:text-4xl font-black font-headline mb-4">How can we help your learning journey?</h1>
<p class="text-lg opacity-90 mb-6">Our dedicated support team is available 24/7 to assist with course selection, technical issues, or general inquiries about our English programs.</p>
<div class="flex flex-wrap gap-4">
<button class="support-bg-accent text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 hover:opacity-90 shadow-lg">
<span class="material-symbols-outlined">Radioactive</span>
                            Request Callback
                        </button>
<button class="bg-surface text-primary px-6 py-3 rounded-xl font-bold flex items-center gap-2 border border-outline-variant">
<span class="material-symbols-outlined">description</span>
                            View Documentation
                        </button>
</div>
</div>
<div class="absolute right-0 bottom-0 top-0 w-1/3 hidden md:block">
<img class="h-full w-full object-cover mix-blend-overlay opacity-50" data-alt="A smiling, professional young Asian woman wearing a headset and modern business casual attire. She is sitting in a brightly lit, contemporary office environment with soft focus greenery in the background. The lighting is warm and welcoming, reflecting a clean and friendly support service atmosphere with high-key whites and soft lavender accents." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCCgf0-35c0M8tlm-NhAZB2RWFrcatRToHqeqaL6oeiEmNiZ2bKTqJMHAp0b4sBe4vtqIjbLDbPNDINiilXLAvZ4ePlu29uQAysJ8HObYgovm2QxQ7a9kekxtqo9j5oR4OyyEa12iJ3vT5QYt2q6oOdl0Dd-_A28AHsH2TyHPwaB5H0O7RSOCNRL9XLUWKWFkkBldm6908lkhQAqkJ9s0-02P0k73qL6OO2fzFakeQdogCZR7r-VSWv9IPfS0qnr4Wl07ApEjnR91I"/>
</div>
</section>
<!-- Main Content Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<!-- FAQ Section -->
<div class="bg-white rounded-xl p-6 shadow-sm border border-surface-container-high">
<div class="flex items-center gap-3 mb-6">
<div class="support-bg-accent p-2 rounded-lg">
<span class="material-symbols-outlined text-white">quiz</span>
</div>
<h2 class="text-xl font-bold">Frequently Asked Questions</h2>
</div>
<div class="space-y-4">
@foreach($faqs as $faq)
<div class="group border-b border-outline-variant pb-4 cursor-pointer" onclick="this.querySelector('.faq-answer').classList.toggle('hidden')">
<div class="flex justify-between items-center group-hover:text-primary">
<span class="font-semibold">{{ $faq->question }}</span>
<span class="material-symbols-outlined">expand_more</span>
</div>
<div class="mt-2 text-on-surface-variant text-sm faq-answer hidden">{{ $faq->answer }}</div>
</div>
@endforeach
</div>
<button class="mt-6 text-primary font-bold text-sm hover:underline flex items-center gap-1">
                        View all 50+ topics
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
</button>
</div>
<!-- Callback Form Section -->
<div class="bg-surface-container-low rounded-xl p-6 shadow-sm border border-outline-variant">
<div class="flex items-center gap-3 mb-6">
<div class="bg-secondary-container p-2 rounded-lg">
<span class="material-symbols-outlined text-on-secondary-container">perm_phone_msg</span>
</div>
<h2 class="text-xl font-bold">Request Callback</h2>
</div>
<form class="space-y-4">
<div>
<label class="block text-sm font-medium mb-1.5 text-on-surface-variant">Full Name</label>
<input class="w-full bg-white border-outline-variant rounded-xl px-4 py-2.5 focus:ring-primary focus:border-primary" placeholder="John Doe" type="text"/>
</div>
<div>
<label class="block text-sm font-medium mb-1.5 text-on-surface-variant">Phone Number</label>
<input class="w-full bg-white border-outline-variant rounded-xl px-4 py-2.5 focus:ring-primary focus:border-primary" placeholder="+84 123 456 789" type="tel"/>
</div>
<div>
<label class="block text-sm font-medium mb-1.5 text-on-surface-variant">Inquiry Subject</label>
<select class="w-full bg-white border-outline-variant rounded-xl px-4 py-2.5 focus:ring-primary focus:border-primary">
<option>Course Registration</option>
<option>Technical Support</option>
<option>Payment Inquiry</option>
<option>Other</option>
</select>
</div>
<button class="w-full support-bg-accent text-white font-bold py-3 rounded-xl hover:opacity-90 transition-all shadow-md" type="submit">
                            Schedule Call
                        </button>
</form>
</div>
</div>
</div>
<!-- Right Column: Live Chat Interface -->
<div class="lg:col-span-4 h-full">
<div class="bg-white rounded-xl shadow-xl border border-outline-variant h-full flex flex-col overflow-hidden sticky top-24">
<!-- Chat Header -->
<div class="support-bg-accent p-4 flex justify-between items-center text-white">
<div class="flex items-center gap-3">
<div class="relative">
<img class="w-10 h-10 rounded-full border-2 border-white object-cover" data-alt="A professional profile portrait of a female support agent with a friendly smile, wearing a professional navy blazer. She is set against a clean, softly blurred office background. The lighting is professional and vibrant, highlighting her approachable expression and clear, bright eyes." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD-wyOJG0KdhPrVQTkFLCgJ5_mrQid2tV-a6hrVhFkrPMgoTgZaBKo9ZjxCC6shMwrTOUtsKVoxG-yXPrGTbCPSbeWqangaLXDZBkcLsHu3_hIfiG52cwAT1qY0TsXiq0VXGCIQlNO2ftNvUq1C5j1DgS-xQnTNDJtEVYLDWGNnFnZEa6LiJXtQw7-EdgQcxi2Ne9aPFZ-z3UcuWSvhxwzS9h5RFiF8K7Re_5XOi7AjdMZ6hjhGIkIfW5qSqyeLUS0s2ekpPy_r5Vw"/>
<div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
</div>
<div>
<p class="font-bold leading-tight">Sarah from Support</p>
<p class="text-xs opacity-80">Online | Typical response &lt; 2m</p>
</div>
</div>
<div class="flex gap-2">
<span class="material-symbols-outlined cursor-pointer">settings</span>
<span class="material-symbols-outlined cursor-pointer">close</span>
</div>
</div>
<!-- Chat Messages Area -->
<div class="flex-1 overflow-y-auto p-4 space-y-4 bg-surface-container-lowest">
<div class="text-center">
<span class="text-[10px] text-outline font-bold uppercase tracking-widest bg-surface-container px-3 py-1 rounded-full">Today</span>
</div>
<!-- Agent Message -->
<div class="flex gap-2 max-w-[85%]">
<div class="flex-shrink-0">
<img class="w-6 h-6 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA3cOlqIHyWQLQuP2hqvHSPXUlA15EUYKtL4c-LNj3vBTgQQdEXnzX8OCjk6B4HVQot57YtVbhPWYQqe2rBgMJ04pyeOuo1j09PepzhsWxbUiIgFpXiaa16OH9Zht4SaAXOzKNVw9tiR4bv76Bi4MMipg18Gdzbdz-4P_KmlImADyfVutNgzzz7LOg0qpDAzRZNe3d1pZPN9jEeVsRzs9yk8N7uaYjvmIQ0fKnWiAXVr6AwnskC9f7L3LyZKNIl7gm71D-MavCnlLM"/>
</div>
<div class="bg-surface-container p-3 rounded-2xl rounded-tl-none text-sm text-on-surface">
                            Hi there! I'm Sarah. How can I assist you with your English learning journey today?
                            <span class="block text-[10px] text-outline mt-1">14:02</span>
</div>
</div>
<!-- User Message -->
<div class="flex flex-row-reverse gap-2 max-w-[85%] ml-auto">
<div class="support-bg-accent p-3 rounded-2xl rounded-tr-none text-sm text-white">
                            Hello! I'm interested in the IELTS Mastery course. Could you tell me about the next start date?
                            <span class="block text-[10px] opacity-70 mt-1 text-right">14:05</span>
</div>
</div>
<!-- Agent Message -->
<div class="flex gap-2 max-w-[85%]">
<div class="flex-shrink-0">
<img class="w-6 h-6 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDHh8yU66GJmH03ZsnkiTF99A0_QGhVdG-ToLjRsyt-bY12bhXeTEmbKpr4f0d9-sAZQ-D6T7KDTUX9J1e7nHGqBTzeCq9CRqU6pRSOrzbXw196piKl4CXmjn2XYLQpOgp2mYZ_oYw_JrxN_qdFf_XMG2yYg-NOIikzDJOG6iqdvIVHrq8pNQvU65XS1djm-7plOUjQsnBl8grOt_nO5tAVMhWrsRmcNAFVjLd_cBgdznTogwsVQ9rpKkpEZf-ctu143N7ikO9KSjc"/>
</div>
<div class="bg-surface-container p-3 rounded-2xl rounded-tl-none text-sm text-on-surface">
                            Of course! The next batch for IELTS Mastery begins on Monday, October 14th. We have both morning and evening sessions available.
                            <span class="block text-[10px] text-outline mt-1">14:06</span>
</div>
</div>
<!-- Typing Indicator -->
<div class="flex gap-2 items-center text-outline italic text-xs">
<div class="flex gap-1">
<div class="w-1 h-1 bg-outline rounded-full"></div>
<div class="w-1 h-1 bg-outline rounded-full"></div>
<div class="w-1 h-1 bg-outline rounded-full"></div>
</div>
                        Sarah is typing...
                    </div>
</div>
<!-- Chat Input Area -->
<div class="p-4 bg-white border-t border-outline-variant">
<div class="relative flex items-center bg-surface-container-high rounded-2xl p-2">
<input id="chat-input" class="flex-1 bg-transparent border-none focus:ring-0 text-sm py-1" placeholder="Type a message..." type="text"/>
<button id="send-btn" class="p-2 support-bg-accent text-white rounded-xl shadow-md">
<span class="material-symbols-outlined">send</span>
</button>
</div>
<div class="mt-2 flex gap-4 text-[10px] text-outline justify-center font-medium">
<span class="flex items-center gap-1"><span class="material-symbols-outlined text-[12px]">security</span> Encrypted</span>
<span class="flex items-center gap-1"><span class="material-symbols-outlined text-[12px]">bolt</span> Quick Response</span>
</div>
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