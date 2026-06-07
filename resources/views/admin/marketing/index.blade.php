<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Email Marketing Dashboard | Ms. Hoa English</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary-container": "#e0d2ff",
                        "surface-container-high": "#ece6ee",
                        "inverse-primary": "#cfbcff",
                        "on-secondary-fixed-variant": "#4b4263",
                        "inverse-on-surface": "#f5eff7",
                        "on-tertiary-fixed-variant": "#594400",
                        "surface-container-highest": "#e6e0e9",
                        "on-surface-variant": "#494551",
                        "surface": "#fdf7ff",
                        "secondary-container": "#e1d4fd",
                        "on-secondary-fixed": "#1f1635",
                        "surface-container-low": "#f8f2fa",
                        "surface-bright": "#fdf7ff",
                        "primary": "#4f378a",
                        "surface-variant": "#e6e0e9",
                        "on-background": "#1d1b20",
                        "surface-dim": "#ded8e0",
                        "on-error-container": "#93000a",
                        "on-tertiary": "#ffffff",
                        "on-secondary-container": "#645a7d",
                        "primary-fixed": "#e9ddff",
                        "error-container": "#ffdad6",
                        "surface-container": "#f2ecf4",
                        "primary-fixed-dim": "#cfbcff",
                        "on-primary-fixed-variant": "#4f378a",
                        "outline": "#7a7582",
                        "on-primary": "#ffffff",
                        "on-tertiary-fixed": "#241a00",
                        "primary-container": "#6750a4",
                        "on-error": "#ffffff",
                        "on-secondary": "#ffffff",
                        "tertiary-fixed": "#ffdf93",
                        "secondary": "#63597c",
                        "secondary-fixed-dim": "#cdc0e9",
                        "surface-tint": "#6750a4",
                        "tertiary-container": "#c9a74d",
                        "tertiary-fixed-dim": "#e7c365",
                        "tertiary": "#765b00"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Public Sans"],
                        "display": ["Public Sans"],
                        "body": ["Public Sans"],
                        "label": ["Public Sans"]
                    }
                }
            }
        }
    </script>
<style>
        body { font-family: 'Public Sans', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-surface text-on-surface">
<!-- TopNavBar -->
<header class="sticky top-0 z-50 flex justify-between items-center w-full px-6 py-3 bg-surface border-b border-outline-variant shadow-sm">
<div class="flex items-center gap-8">
<h1 class="text-xl font-headline font-black text-primary">Ms. Hoa English</h1>
<nav class="hidden md:flex gap-6 items-center">
<a class="font-body text-label-large text-on-surface-variant hover:text-primary transition-colors" href="#">Courses</a>
<a class="font-body text-label-large text-on-surface-variant hover:text-primary transition-colors" href="#">Registration</a>
<a class="font-body text-label-large text-on-surface-variant hover:text-primary transition-colors" href="#">Support</a>
<a class="font-body text-label-large text-primary border-b-2 border-primary font-bold transition-colors" href="#">Dashboard</a>
</nav>
</div>
<div class="flex items-center gap-4">
<button class="material-symbols-outlined text-on-surface-variant hover:text-primary">notifications</button>
<button class="material-symbols-outlined text-on-surface-variant hover:text-primary">account_circle</button>
<button class="bg-primary text-on-primary px-4 py-2 rounded-xl font-bold text-sm">Login</button>
</div>
</header>
<div class="flex min-h-screen">
<!-- SideNavBar -->
<aside class="hidden lg:flex flex-col w-64 h-screen fixed left-0 top-0 pt-16 pb-4 bg-surface-container-low border-r border-outline-variant z-40">
<div class="px-6 py-6">
<p class="text-lg font-headline font-bold text-on-surface">Admin Panel</p>
<p class="text-xs text-on-surface-variant">Management Suite</p>
</div>
<nav class="flex-1 space-y-1">
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all active:scale-95" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-body text-label-medium">Overview</span>
</a>
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all active:scale-95" href="#">
<span class="material-symbols-outlined">menu_book</span>
<span class="font-body text-label-medium">Course Catalog</span>
</a>
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all active:scale-95" href="#">
<span class="material-symbols-outlined">group</span>
<span class="font-body text-label-medium">Student List</span>
</a>
<a class="flex items-center gap-3 bg-secondary-container text-on-secondary-container px-4 py-3 mx-2 rounded-xl font-bold transition-all active:scale-95" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">mail</span>
<span class="font-body text-label-medium">Marketing</span>
</a>
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all active:scale-95" href="#">
<span class="material-symbols-outlined">payments</span>
<span class="font-body text-label-medium">Payments</span>
</a>
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all active:scale-95" href="{{ route('admin.help-center.index') }}">
<span class="material-symbols-outlined">support_agent</span>
<span class="font-body text-label-medium">Help Center</span>
</a>
</nav>
<div class="px-4 py-4">
<button class="w-full bg-primary-container text-on-primary-container py-3 rounded-xl font-bold flex items-center justify-center gap-2 shadow-sm hover:opacity-90 active:scale-95 transition-all">
<span class="material-symbols-outlined">add</span>
                    New Campaign
                </button>
</div>
<div class="mt-auto border-t border-outline-variant pt-4">
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">settings</span>
<span class="font-body text-label-medium">Settings</span>
</a>
<a class="flex items-center gap-3 text-on-surface-variant px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">logout</span>
<span class="font-body text-label-medium">Sign Out</span>
</a>
</div>
</aside>
<!-- Main Content Area -->
<main class="lg:ml-64 flex-1 p-6 lg:p-10">
<div class="max-w-7xl mx-auto space-y-10">
<!-- Success/Error Messages -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
<div>
<h2 class="text-3xl font-headline font-extrabold text-on-surface tracking-tight">Marketing Hub</h2>
<p class="text-on-surface-variant mt-1">Design, deploy, and analyze your communication campaigns.</p>
</div>
<button onclick="document.getElementById('createModal').classList.remove('hidden')" class="bg-[#26A69A] hover:bg-[#00897B] text-white px-6 py-4 rounded-full font-bold flex items-center gap-3 shadow-lg active:scale-95 transition-all">
<span class="material-symbols-outlined">add</span>
                        Create New Campaign
                    </button>
</div>

<!-- Create Modal -->
<div id="createModal" class="fixed inset-0 bg-black/50 z-[100] hidden flex items-center justify-center p-4">
    <div class="bg-surface w-full max-w-md rounded-3xl p-8 shadow-2xl">
        <h3 class="text-2xl font-headline font-bold mb-6">Create New Campaign</h3>
        <form action="{{ route('admin.marketing.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold mb-2">Campaign Name</label>
                <input type="text" name="name" required class="w-full rounded-xl border-outline-variant focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Type</label>
                <select name="type" required class="w-full rounded-xl border-outline-variant focus:border-primary">
                    <option value="Promotion">Promotion</option>
                    <option value="Educational">Educational</option>
                    <option value="Newsletter">Newsletter</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Initial Status</label>
                <select name="status" required class="w-full rounded-xl border-outline-variant focus:border-primary">
                    <option value="Drafting">Drafting</option>
                    <option value="Scheduled">Scheduled</option>
                    <option value="Sent">Sent (Manual Entry)</option>
                </select>
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" onclick="document.getElementById('createModal').classList.add('hidden')" class="px-6 py-2 rounded-full font-bold text-on-surface-variant hover:bg-surface-container-high">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-primary text-on-primary rounded-full font-bold">Create</button>
            </div>
        </form>
    </div>
</div>

<!-- Bento Grid Metrics & Featured -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
<div class="md:col-span-2 bg-primary-container p-8 rounded-full flex flex-col justify-between overflow-hidden relative group">
<div class="z-10">
<span class="text-on-primary-container text-sm font-bold uppercase tracking-widest">Active Subscribers (Students)</span>
<h3 class="text-4xl font-headline font-black text-white mt-2">{{ number_format($activeSubscribers) }}</h3>
<div class="mt-4 flex items-center gap-2 text-on-primary-container text-sm">
<span class="material-symbols-outlined text-sm">trending_up</span>
<span>Actual count of registered students</span>
</div>
</div>
<div class="absolute -right-10 -bottom-10 opacity-20">
<span class="material-symbols-outlined text-[160px]" style="font-variation-settings: 'FILL' 1;">mail</span>
</div>
</div>
<div class="bg-surface-container-high p-6 rounded-full flex flex-col items-center justify-center text-center">
<span class="text-on-surface-variant text-sm font-bold">Avg. Open Rate</span>
<p class="text-3xl font-headline font-bold text-primary mt-1">{{ number_format($avgOpenRate, 1) }}%</p>
<div class="w-full bg-outline-variant h-1 mt-4 rounded-full overflow-hidden">
<div class="bg-primary h-full" style="width: {{ $avgOpenRate }}%"></div>
</div>
</div>
<div class="bg-surface-container-high p-6 rounded-full flex flex-col items-center justify-center text-center">
<span class="text-on-surface-variant text-sm font-bold">Avg. Click Rate</span>
<p class="text-3xl font-headline font-bold text-secondary mt-1">{{ number_format($avgClickRate, 1) }}%</p>
<div class="w-full bg-outline-variant h-1 mt-4 rounded-full overflow-hidden">
<div class="bg-secondary h-full" style="width: {{ $avgClickRate * 2 }}%"></div>
</div>
</div>
</div>
<!-- Recent Campaigns Section -->
<section>
<div class="flex items-center justify-between mb-6">
<h3 class="text-xl font-headline font-bold flex items-center gap-2">
<span class="material-symbols-outlined text-primary">history</span>
                            Recent Campaigns
                        </h3>
<button class="text-primary font-bold text-sm hover:underline">View All</button>
</div>
<div class="bg-surface-container-low rounded-[2rem] overflow-hidden border border-outline-variant">
<div class="overflow-x-auto">
<table class="w-full text-left">
<thead class="bg-surface-container-high">
<tr>
<th class="px-6 py-4 font-bold text-sm text-on-surface-variant">Campaign Name</th>
<th class="px-6 py-4 font-bold text-sm text-on-surface-variant">Status</th>
<th class="px-6 py-4 font-bold text-sm text-on-surface-variant">Recipients</th>
<th class="px-6 py-4 font-bold text-sm text-on-surface-variant">Open Rate</th>
<th class="px-6 py-4 font-bold text-sm text-on-surface-variant">Click Rate</th>
<th class="px-6 py-4 font-bold text-sm text-on-surface-variant text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
@foreach($campaigns as $campaign)
<tr class="hover:bg-surface-container-highest transition-colors">
<td class="px-6 py-4 font-medium">{{ $campaign->name }}</td>
<td class="px-6 py-4">
    @if($campaign->status == 'Sent')
        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full">Sent</span>
    @elseif($campaign->status == 'Drafting')
        <span class="px-3 py-1 bg-primary-fixed text-primary text-xs font-bold rounded-full">Drafting</span>
    @else
        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full">{{ $campaign->status }}</span>
    @endif
</td>
<td class="px-6 py-4 text-on-surface-variant">{{ number_format($campaign->recipients) }}</td>
<td class="px-6 py-4 font-bold text-primary">{{ $campaign->open_rate ? $campaign->open_rate . '%' : '--' }}</td>
<td class="px-6 py-4 font-bold text-secondary">{{ $campaign->click_rate ? $campaign->click_rate . '%' : '--' }}</td>
<td class="px-6 py-4 text-right">
    <div class="flex items-center justify-end gap-2">
        <button onclick="openBroadcastModal({{ $campaign->id }}, '{{ $campaign->name }}')" class="flex items-center gap-1 bg-[#26A69A] text-white px-3 py-1 rounded-full text-xs font-bold hover:opacity-90 transition-all">
            <span class="material-symbols-outlined text-sm">send</span>
            Promote
        </button>
        <button onclick="openEditModal({{ $campaign->id }}, '{{ $campaign->name }}', '{{ $campaign->type }}', '{{ $campaign->status }}')" class="material-symbols-outlined text-on-surface-variant hover:text-primary">edit</button>
        <form action="{{ route('admin.marketing.destroy', $campaign->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="material-symbols-outlined text-on-surface-variant hover:text-error">delete</button>
        </form>
    </div>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</section>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black/50 z-[100] hidden flex items-center justify-center p-4">
    <div class="bg-surface w-full max-w-md rounded-3xl p-8 shadow-2xl">
        <h3 class="text-2xl font-headline font-bold mb-6">Edit Campaign</h3>
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-bold mb-2">Campaign Name</label>
                <input type="text" id="edit_name" name="name" required class="w-full rounded-xl border-outline-variant focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Type</label>
                <select id="edit_type" name="type" required class="w-full rounded-xl border-outline-variant focus:border-primary">
                    <option value="Promotion">Promotion</option>
                    <option value="Educational">Educational</option>
                    <option value="Newsletter">Newsletter</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Status</label>
                <select id="edit_status" name="status" required class="w-full rounded-xl border-outline-variant focus:border-primary">
                    <option value="Drafting">Drafting</option>
                    <option value="Scheduled">Scheduled</option>
                    <option value="Sent">Sent</option>
                </select>
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-6 py-2 rounded-full font-bold text-on-surface-variant hover:bg-surface-container-high">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-primary text-on-primary rounded-full font-bold">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Broadcast Modal -->
<div id="broadcastModal" class="fixed inset-0 bg-black/50 z-[100] hidden flex items-center justify-center p-4">
    <div class="bg-surface w-full max-w-md rounded-3xl p-8 shadow-2xl">
        <h3 class="text-2xl font-headline font-bold mb-2">Broadcast Campaign</h3>
        <p id="broadcast_campaign_name" class="text-primary font-bold mb-6"></p>
        <form id="broadcastForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold mb-2">Select Template (Optional)</label>
                <select name="template_id" class="w-full rounded-xl border-outline-variant focus:border-primary">
                    <option value="">No Template (Text Only)</option>
                    @foreach($templates as $template)
                        <option value="{{ $template->id }}">{{ $template->name }} ({{ $template->category }})</option>
                    @endforeach
                </select>
            </div>
            <p class="text-xs text-on-surface-variant bg-surface-container p-3 rounded-xl italic">
                * This will send an email to all active students ({{ $activeSubscribers }} recipients).
            </p>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" onclick="document.getElementById('broadcastModal').classList.add('hidden')" class="px-6 py-2 rounded-full font-bold text-on-surface-variant hover:bg-surface-container-high">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-[#26A69A] text-white rounded-full font-bold">Send Broadcast Now</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, name, type, status) {
        document.getElementById('editForm').action = '/dashboard/marketing/' + id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_type').value = type;
        document.getElementById('edit_status').value = status;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function openBroadcastModal(id, name) {
        document.getElementById('broadcastForm').action = '/dashboard/marketing/' + id + '/broadcast';
        document.getElementById('broadcast_campaign_name').innerText = name;
        document.getElementById('broadcastModal').classList.remove('hidden');
    }
</script>
<!-- Template Library -->
<section class="pb-12">
<div class="flex items-center justify-between mb-6">
<h3 class="text-xl font-headline font-bold flex items-center gap-2">
<span class="material-symbols-outlined text-primary">auto_awesome_motion</span>
                            Template Library
                        </h3>
<div class="flex gap-2">
<button class="px-4 py-2 bg-surface-container text-on-surface rounded-full text-xs font-bold">Promotion</button>
<button class="px-4 py-2 bg-primary text-on-primary rounded-full text-xs font-bold">Educational</button>
<button class="px-4 py-2 bg-surface-container text-on-surface rounded-full text-xs font-bold">Newsletters</button>
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
<!-- Dynamic Template Cards -->
@foreach($templates as $template)
<div class="group cursor-pointer">
<div class="relative aspect-[3/4] rounded-full overflow-hidden mb-3 border border-outline-variant shadow-sm transition-transform group-hover:-translate-y-2">
<img class="w-full h-full object-cover" src="{{ $template->thumbnail_url }}" alt="{{ $template->name }}"/>
<div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
<button class="bg-white text-primary px-4 py-2 rounded-full font-bold text-sm">Use Template</button>
</div>
</div>
<h4 class="font-bold text-sm">{{ $template->name }}</h4>
<p class="text-xs text-on-surface-variant">
    @if($template->last_used_at)
        Last used {{ $template->last_used_at->diffForHumans() }}
    @else
        Never used
    @endif
</p>
</div>
@endforeach
<!-- Create New Placeholder -->
<div class="group cursor-pointer">
<div class="relative aspect-[3/4] rounded-full border-2 border-dashed border-outline-variant mb-3 flex flex-col items-center justify-center bg-surface-container-low transition-colors group-hover:bg-surface-container-high">
<span class="material-symbols-outlined text-4xl text-outline mb-2">add_circle</span>
<span class="text-sm font-bold text-outline">Custom Design</span>
</div>
<h4 class="font-bold text-sm text-center">Start from Scratch</h4>
</div>
</div>
</section>
</div>
</main>
</div>
<!-- Footer -->
<footer class="w-full py-8 px-6 flex flex-col md:flex-row justify-between items-center gap-4 bg-surface-container-highest border-t border-outline-variant mt-auto">
<div class="flex flex-col items-center md:items-start gap-1">
<span class="text-md font-headline font-bold text-on-surface">Ms. Hoa English Center</span>
<p class="font-body text-label-small text-on-surface-variant">© 2024 Ms. Hoa English Center. All rights reserved.</p>
</div>
<div class="flex gap-6">
<a class="font-body text-label-small text-on-surface-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
<a class="font-body text-label-small text-on-surface-variant hover:text-primary transition-colors" href="#">Terms of Service</a>
<a class="font-body text-label-small text-on-surface-variant hover:text-primary transition-colors" href="#">Cookie Policy</a>
</div>
</footer>
</body></html>