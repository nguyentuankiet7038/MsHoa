@extends('layouts.app')

@section('title', 'Chi tiết khóa học')

@section('content')
    <main>
<!-- Hero Section -->
<!-- Course Highlights Bento Grid -->
<section class="py-20 bg-surface-container-lowest">
<div class="container mx-auto px-6">
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
<div class="p-8 bg-surface-container rounded-3xl border border-outline-variant flex flex-col items-center text-center">
<span class="material-symbols-outlined text-4xl turquoise-text mb-4">calendar_today</span>
<h3 class="font-bold text-on-surface mb-1">Duration</h3>
<p class="text-on-surface-variant">12 Weeks</p>
</div>
<div class="p-8 bg-surface-container rounded-3xl border border-outline-variant flex flex-col items-center text-center">
<span class="material-symbols-outlined text-4xl turquoise-text mb-4">trending_up</span>
<h3 class="font-bold text-on-surface mb-1">Level</h3>
<p class="text-on-surface-variant">Advanced (6.0+ start)</p>
</div>
<div class="p-8 bg-surface-container rounded-3xl border border-outline-variant flex flex-col items-center text-center">
<span class="material-symbols-outlined text-4xl turquoise-text mb-4">schedule</span>
<h3 class="font-bold text-on-surface mb-1">Schedule</h3>
<p class="text-on-surface-variant">Mon/Wed/Fri (18:30 - 20:30)</p>
</div>
<div class="p-8 bg-surface-container rounded-3xl border border-outline-variant flex flex-col items-center text-center">
<span class="material-symbols-outlined text-4xl turquoise-text mb-4">laptop_mac</span>
<h3 class="font-bold text-on-surface mb-1">Format</h3>
<p class="text-on-surface-variant">Hybrid/Offline</p>
</div>
</div>
</div>
</section>
<!-- Main Content Layout -->
<section class="py-20">
<div class="container mx-auto px-6 flex flex-col lg:flex-row gap-12">
<!-- Content Left -->
<div class="lg:w-2/3 space-y-20">
<!-- Curriculum -->
<div>
<h2 class="text-3xl font-display font-black text-on-surface mb-8">Detailed Curriculum</h2>
<div class="space-y-4">
<div class="group bg-surface border border-outline-variant rounded-2xl overflow-hidden">
<div class="p-6 flex justify-between items-center cursor-pointer hover:bg-surface-container transition-colors">
<div class="flex items-center gap-4">
<span class="w-10 h-10 flex items-center justify-center rounded-full bg-primary-container text-on-primary-container font-bold">01</span>
<span class="text-lg font-bold">Module 1: Listening Mastery</span>
</div>
<span class="material-symbols-outlined text-on-surface-variant">expand_more</span>
</div>
<div class="px-20 pb-6 text-on-surface-variant">
<ul class="list-disc space-y-2">
<li>Advanced note-taking techniques for Section 4</li>
<li>Decoding complex accents and rapid speech patterns</li>
<li>Mastering multiple-choice questions in academic contexts</li>
</ul>
</div>
</div>
<div class="group bg-surface border border-outline-variant rounded-2xl overflow-hidden">
<div class="p-6 flex justify-between items-center cursor-pointer hover:bg-surface-container transition-colors">
<div class="flex items-center gap-4">
<span class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-highest text-on-surface-variant font-bold">02</span>
<span class="text-lg font-bold">Module 2: Advanced Speaking Strategies</span>
</div>
<span class="material-symbols-outlined text-on-surface-variant">expand_more</span>
</div>
</div>
<div class="group bg-surface border border-outline-variant rounded-2xl overflow-hidden">
<div class="p-6 flex justify-between items-center cursor-pointer hover:bg-surface-container transition-colors">
<div class="flex items-center gap-4">
<span class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-highest text-on-surface-variant font-bold">03</span>
<span class="text-lg font-bold">Module 3: Academic Writing Band 8.0 Logic</span>
</div>
<span class="material-symbols-outlined text-on-surface-variant">expand_more</span>
</div>
</div>
</div>
</div>
<!-- Benefits -->
<div>
<h2 class="text-3xl font-display font-black text-on-surface mb-8">Why choose this course?</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="space-y-3">
<div class="w-12 h-12 bg-custom-turquoise/10 flex items-center justify-center rounded-xl">
<span class="material-symbols-outlined turquoise-text">verified_user</span>
</div>
<h4 class="font-bold">Expert Feedback</h4>
<p class="text-sm text-on-surface-variant">Detailed 1-on-1 correction for every writing and speaking assignment by 8.5+ IELTS mentors.</p>
</div>
<div class="space-y-3">
<div class="w-12 h-12 bg-custom-turquoise/10 flex items-center justify-center rounded-xl">
<span class="material-symbols-outlined turquoise-text">analytics</span>
</div>
<h4 class="font-bold">Mock Tests</h4>
<p class="text-sm text-on-surface-variant">Weekly full-length simulations with real exam conditions and computerized scoring reports.</p>
</div>
<div class="space-y-3">
<div class="w-12 h-12 bg-custom-turquoise/10 flex items-center justify-center rounded-xl">
<span class="material-symbols-outlined turquoise-text">groups</span>
</div>
<h4 class="font-bold">Community Support</h4>
<p class="text-sm text-on-surface-variant">Access to our private discord for peer learning and daily speaking practice challenges.</p>
</div>
</div>
</div>
<!-- Instructor -->
<div class="p-8 bg-surface-container-high rounded-3xl flex flex-col md:flex-row items-center gap-8 border-2 border-primary/10">
<div class="w-48 h-48 rounded-2xl overflow-hidden shrink-0 border-4 border-white shadow-lg">
<img class="w-full h-full object-cover" data-alt="A professional and charismatic female educator in her late 30s with a confident smile. She is dressed in smart business casual attire, standing in a brightly lit modern office environment with a library of academic books in the blurred background. The image is crisp, high-resolution, and projects an aura of expertise and approachability. The soft, natural lighting emphasizes her credentials as a top-tier IELTS specialist." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCO4y2LKX86KplfgjRgoi2mQs4_jTPW7h2LwHib6rVnnfJ2m-wK8R8yrw-l0TCbVHsqj8H7RpEfoT6OLwHHrQXt9COxIClf_aK07jT-70AwQYiESstbQf5PhTFeNOMmghQNwBfcYKxtuD5EIGUwBeOhzB7MT8_Ah1OjFDip1IdMEa7g9-ppd8nd7PxDrbYZK8P5QZLY0YbFid-oTAI-fV-xLMMHnGieUD2TFpNVnVlFA1A6VTq-5bG0mdRLsFxfPr5KgZnsdqNYrZc"/>
</div>
<div class="flex-1">
<span class="text-primary font-bold text-sm tracking-widest uppercase">Giảng viên tiêu biểu</span>
<h3 class="text-3xl font-display font-black text-on-surface mt-1 mb-2">Ms. Hoa</h3>
<p class="font-bold text-on-surface-variant mb-4">IELTS 8.5 | 10+ Years Experience</p>
<p class="text-on-surface-variant leading-relaxed">Pioneer in communicative language teaching with over a decade of helping 20,000+ students achieve their target IELTS scores. Known for her analytical approach to the writing section and motivational coaching style.</p>
</div>
</div>
<!-- Reviews -->
<div>
<h2 class="text-3xl font-display font-black text-on-surface mb-8">Testimonials</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="p-6 bg-white rounded-2xl border border-outline-variant shadow-sm">
<div class="flex gap-1 mb-4 text-tertiary">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<p class="text-on-surface-variant italic mb-4">"The intensive 12-week course was exactly what I needed. The strategies for Speaking Part 2 helped me move from a 6.0 to a 7.5 in just one attempt!"</p>
<p class="font-bold text-on-surface">— Minh Hoang, IELTS 8.0</p>
</div>
<div class="p-6 bg-white rounded-2xl border border-outline-variant shadow-sm">
<div class="flex gap-1 mb-4 text-tertiary">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<p class="text-on-surface-variant italic mb-4">"Ms. Hoa's feedback on my essays was incredibly precise. I finally understood the logic behind the coherence and cohesion marking criteria."</p>
<p class="font-bold text-on-surface">— Thu Thuy, IELTS 7.5</p>
</div>
</div>
</div>
</div>
<!-- Sticky Sidebar -->
<aside class="lg:w-1/3">
<div class="sticky top-24 p-8 bg-white rounded-3xl border-2 border-outline-variant shadow-2xl space-y-6">
<div class="flex justify-between items-start">
<div>
<span class="px-3 py-1 bg-error/10 text-error text-xs font-bold rounded-full">-20% Limited Time</span>
<div class="mt-2 flex items-baseline gap-2">
<span class="text-4xl font-display font-black text-on-surface">12.000.000đ</span>
<span class="text-on-surface-variant line-through text-sm">15.000.000đ</span>
</div>
</div>
</div>
<div class="space-y-4">
<div class="flex items-center gap-3 text-sm text-on-surface-variant">
<span class="material-symbols-outlined text-custom-turquoise">check_circle</span>
<span>36 interactive intensive sessions</span>
</div>
<div class="flex items-center gap-3 text-sm text-on-surface-variant">
<span class="material-symbols-outlined text-custom-turquoise">check_circle</span>
<span>Original course materials &amp; books</span>
</div>
<div class="flex items-center gap-3 text-sm text-on-surface-variant">
<span class="material-symbols-outlined text-custom-turquoise">check_circle</span>
<span>Unlimited lab access for 6 months</span>
</div>
<div class="flex items-center gap-3 text-sm text-on-surface-variant">
<span class="material-symbols-outlined text-custom-turquoise">check_circle</span>
<span>Exam fee sponsorship (Top students)</span>
</div>
</div>
<button class="w-full py-4 turquoise-primary text-white font-bold rounded-xl text-lg hover:brightness-110 active:scale-95 transition-all shadow-lg shadow-custom-turquoise/30">Enroll Now</button>
<div class="p-4 bg-surface-container rounded-xl text-center">
<p class="text-xs text-on-surface-variant">Secure Payment with:</p>
<div class="flex justify-center gap-4 mt-2 opacity-50">
<span class="material-symbols-outlined">credit_card</span>
<span class="material-symbols-outlined">account_balance</span>
<span class="material-symbols-outlined">qr_code_2</span>
</div>
</div>
</div>
</aside>
</div>
</section>
</main>
@endsection