@extends('layouts.app')

@section('content')

<div class="flex min-h-screen">
<!-- SideNavBar -->
<aside class="hidden lg:flex flex-col w-64 h-screen fixed left-0 top-0 pt-20 pb-4 bg-surface-container-low border-r border-outline-variant z-40">
<div class="px-6 mb-8">
<div class="flex items-center space-x-3 mb-2">
<div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold">MH</div>
<div>
<p class="text-sm font-headline font-bold text-on-surface">Admin Panel</p>
<p class="text-xs text-on-surface-variant">Management Suite</p>
</div>
</div>
</div>
<nav class="flex-1 space-y-1">
<a class="flex items-center {{ request()->routeIs('dashboard') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant' }} rounded-xl font-bold px-4 py-3 mx-2 transition-transform active:scale-95" href="{{ route('dashboard') }}">
<span class="material-symbols-outlined mr-3">dashboard</span>
<span class="font-body text-label-medium">Overview</span>
</a>
<a class="flex items-center {{ request()->routeIs('admin.courses*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant' }} px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-transform active:scale-95" href="{{ route('admin.courses') }}">
<span class="material-symbols-outlined mr-3">menu_book</span>
<span class="font-body text-label-medium">Course Catalog</span>
</a>
<a class="flex items-center {{ request()->routeIs('admin.students.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant' }} px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-transform active:scale-95" href="{{ route('admin.students.index') }}">
<span class="material-symbols-outlined mr-3">group</span>
<span class="font-body text-label-medium">Student List</span>
</a>
<a class="flex items-center {{ request()->routeIs('admin.teachers.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant' }} px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-transform active:scale-95" href="{{ route('admin.teachers.index') }}">
<span class="material-symbols-outlined mr-3">person</span>
<span class="font-body text-label-medium">Teachers List</span>
</a>
<a class="flex items-center text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-transform active:scale-95" href="#">
<span class="material-symbols-outlined mr-3">mail</span>
<span class="font-body text-label-medium">Marketing</span>
</a>
<a class="flex items-center text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-transform active:scale-95" href="#">
<span class="material-symbols-outlined mr-3">payments</span>
<span class="font-body text-label-medium">Payments</span>
</a>
<a class="flex items-center text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-transform active:scale-95" href="#">
<span class="material-symbols-outlined mr-3">support_agent</span>
<span class="font-body text-label-medium">Help Center</span>
</a>
</nav>
<div class="px-4 mb-6">
<button class="w-full bg-primary text-on-primary py-3 rounded-full font-bold flex items-center justify-center gap-2 hover:opacity-90 transition-all">
<span class="material-symbols-outlined text-sm">add</span>
                    New Campaign
                </button>
</div>
<div class="mt-auto pt-4 border-t border-outline-variant">
<a class="flex items-center text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl" href="#">
<span class="material-symbols-outlined mr-3">settings</span>
<span class="font-body text-label-medium">Settings</span>
</a>
<a class="flex items-center text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl" href="#">
<span class="material-symbols-outlined mr-3">logout</span>
<span class="font-body text-label-medium">Sign Out</span>
</a>
</div>
</aside>
<!-- Main Canvas -->

@yield('contentdashboard')
</div>
@endsection