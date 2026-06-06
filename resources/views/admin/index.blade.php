@extends('layouts.dashboard')
@section('contentdashboard')
<main class="flex-1 lg:ml-64 p-6 bg-surface-bright">
<div class="max-w-7xl mx-auto">
<header class="mb-8">
<h1 class="text-3xl font-headline font-extrabold text-on-surface">Dashboard Overview</h1>
<p class="text-on-surface-variant">Welcome back, Admin. Here's what's happening at the center today.</p>
</header>
<!-- Statistical Cards Bento Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
<div class="bg-surface-container-lowest p-6 rounded-full border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
<div class="flex justify-between items-start mb-4">
<div class="p-2 bg-primary-container rounded-xl text-on-primary-container">
<span class="material-symbols-outlined">group</span>
</div>
<span class="text-xs font-bold text-tertiary bg-tertiary-fixed px-2 py-1 rounded-full">+12%</span>
</div>
<h3 class="text-on-surface-variant text-sm font-medium">Total Students</h3>
<p class="text-2xl font-black text-on-surface mt-1">2,482</p>
</div>
<div class="bg-surface-container-lowest p-6 rounded-full border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
<div class="flex justify-between items-start mb-4">
<div class="p-2 bg-secondary-container rounded-xl text-on-secondary-container">
<span class="material-symbols-outlined">menu_book</span>
</div>
<span class="text-xs font-bold text-on-secondary-fixed-variant bg-secondary-fixed px-2 py-1 rounded-full">48 Active</span>
</div>
<h3 class="text-on-surface-variant text-sm font-medium">Active Courses</h3>
<p class="text-2xl font-black text-on-surface mt-1">156</p>
</div>
<div class="bg-surface-container-lowest p-6 rounded-full border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
<div class="flex justify-between items-start mb-4">
<div class="p-2 bg-tertiary-container rounded-xl text-on-tertiary-container">
<span class="material-symbols-outlined">payments</span>
</div>
<span class="text-xs font-bold text-tertiary bg-tertiary-fixed px-2 py-1 rounded-full">+8.4%</span>
</div>
<h3 class="text-on-surface-variant text-sm font-medium">Monthly Revenue</h3>
<p class="text-2xl font-black text-on-surface mt-1">$42,500</p>
</div>
<div class="bg-surface-container-lowest p-6 rounded-full border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
<div class="flex justify-between items-start mb-4">
<div class="p-2 bg-error-container rounded-xl text-on-error-container">
<span class="material-symbols-outlined">support_agent</span>
</div>
<span class="text-xs font-bold text-on-error-container bg-error-container px-2 py-1 rounded-full">3 Urgent</span>
</div>
<h3 class="text-on-surface-variant text-sm font-medium">Support Tickets</h3>
<p class="text-2xl font-black text-on-surface mt-1">14</p>
</div>
</div>
<!-- Secondary Row: Charts and Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
<!-- Chart Placeholder Section -->
<div class="lg:col-span-2 bg-surface-container-lowest p-6 rounded-full border border-outline-variant shadow-sm">
<div class="flex justify-between items-center mb-6">
<h2 class="text-lg font-bold text-on-surface">Registration Trends</h2>
<select class="bg-surface-container text-sm border-none rounded-lg focus:ring-primary">
<option>Last 6 Months</option>
<option>Year to Date</option>
</select>
</div>
<div class="h-64 flex items-end justify-between px-4 pb-2 border-b border-outline-variant">
<!-- Simulated Chart Bars -->
<div class="w-12 bg-primary rounded-t-lg transition-all hover:opacity-80" style="height: 40%"></div>
<div class="w-12 bg-primary-container rounded-t-lg transition-all hover:opacity-80" style="height: 65%"></div>
<div class="w-12 bg-primary rounded-t-lg transition-all hover:opacity-80" style="height: 55%"></div>
<div class="w-12 bg-primary-container rounded-t-lg transition-all hover:opacity-80" style="height: 85%"></div>
<div class="w-12 bg-primary rounded-t-lg transition-all hover:opacity-80" style="height: 75%"></div>
<div class="w-12 bg-tertiary-container rounded-t-lg transition-all hover:opacity-80" style="height: 95%"></div>
</div>
<div class="flex justify-between mt-2 text-xs text-on-surface-variant px-4">
<span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span>
</div>
</div>
<!-- Recent Activity -->
<div class="bg-surface-container-lowest p-6 rounded-full border border-outline-variant shadow-sm flex flex-col">
<h2 class="text-lg font-bold text-on-surface mb-6">Recent Activity</h2>
<div class="space-y-6 flex-1 overflow-y-auto pr-2">
<div class="flex gap-4">
<div class="w-10 h-10 rounded-full bg-secondary-container flex-shrink-0 flex items-center justify-center">
<span class="material-symbols-outlined text-on-secondary-container text-sm">person_add</span>
</div>
<div>
<p class="text-sm font-bold text-on-surface">New student registration</p>
<p class="text-xs text-on-surface-variant">Minh Anh joined TOEIC Breakthrough</p>
<p class="text-[10px] text-outline mt-1 uppercase font-bold tracking-wider">2 mins ago</p>
</div>
</div>
<div class="flex gap-4">
<div class="w-10 h-10 rounded-full bg-tertiary-container flex-shrink-0 flex items-center justify-center">
<span class="material-symbols-outlined text-on-tertiary-container text-sm">payments</span>
</div>
<div>
<p class="text-sm font-bold text-on-surface">Payment received</p>
<p class="text-xs text-on-surface-variant">Invoice #INV-4928 confirmed</p>
<p class="text-[10px] text-outline mt-1 uppercase font-bold tracking-wider">1 hour ago</p>
</div>
</div>
<div class="flex gap-4">
<div class="w-10 h-10 rounded-full bg-primary-container flex-shrink-0 flex items-center justify-center">
<span class="material-symbols-outlined text-on-primary-container text-sm">campaign</span>
</div>
<div>
<p class="text-sm font-bold text-on-surface">Campaign launched</p>
<p class="text-xs text-on-surface-variant">'Summer Intensive' is now live</p>
<p class="text-[10px] text-outline mt-1 uppercase font-bold tracking-wider">4 hours ago</p>
</div>
</div>
</div>
<button class="mt-6 text-primary text-sm font-bold hover:underline">View All Activities</button>
</div>
</div>
<!-- Custom Bento Section: Top Teachers / Featured Courses -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<div class="lg:col-span-2 relative overflow-hidden h-64 rounded-full group">
<img class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A modern, high-energy language school classroom where a diverse group of enthusiastic students is engaged in a collaborative learning activity. The room is filled with bright, natural morning light, emphasizing a clean and professional academic environment. The color palette is composed of soft purples and clean whites, reflecting the center's sophisticated and modern identity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBK58qfgY5ZVynkcmgPPFjT3PzYHsPV01O3jqlJ3ggEYlLQPXTc1yzkGtEsOkeJNlx_DygjSlfDlVeX_3p5aPhU5bKbvWIQRGDCqjHufqJTzRMoCXkibHor9H_X7P0El2_b5ff-hE6cgbZVSadaH4cjKDG67kHzXaS-0kENnTKV8V8mf3eurl6zJJ2LN5i5sETyV0YI3giZqmH77-HMQmSL4bLJtdjfbC0g_0g-WZB01rjqx2_S6EF_RCaWy6l1z3dYKw_TR-cr_Hc"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent"></div>
<div class="absolute bottom-6 left-8">
<h3 class="text-2xl font-black text-white">Teacher Excellence Award</h3>
<p class="text-white/80 max-w-md">Celebrating 98% student satisfaction for the Q2 Academic Season.</p>
<button class="mt-4 bg-white text-primary px-6 py-2 rounded-full font-bold text-sm">View Rankings</button>
</div>
</div>
<div class="bg-surface-container-high p-8 rounded-full flex flex-col justify-center items-center text-center">
<div class="w-20 h-20 bg-primary text-on-primary rounded-full flex items-center justify-center mb-4">
<span class="material-symbols-outlined text-4xl" data-weight="fill">verified</span>
</div>
<h4 class="text-xl font-bold text-on-surface">Course Quality</h4>
<p class="text-on-surface-variant mt-2 text-sm">All course materials updated to latest 2024 standards.</p>
<div class="mt-4 flex -space-x-3">
<div class="w-10 h-10 rounded-full border-2 border-white bg-secondary-container"></div>
<div class="w-10 h-10 rounded-full border-2 border-white bg-tertiary-container"></div>
<div class="w-10 h-10 rounded-full border-2 border-white bg-primary-container"></div>
<div class="w-10 h-10 rounded-full border-2 border-white bg-surface-variant flex items-center justify-center text-[10px] font-bold">+12</div>
</div>
</div>
</div>
</div>
</main>
@endsection