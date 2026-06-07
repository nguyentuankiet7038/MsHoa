<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                        "tertiary-fixed-dim": "#e7c365"
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }

        body {
            font-family: 'Public Sans', sans-serif;
            background-color: #fdf7ff;
        }
    </style>

<body class="bg-surface text-on-surface">
   
    <div class="flex">
        
        <!-- Main Content Area -->
        <main class="flex-grow lg:ml-64 p-8">
            <!-- Header & Actions -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div>
                    <h1 class="text-3xl font-headline font-black text-on-surface">Course Management</h1>
                    <p class="text-on-surface-variant mt-1">Manage and organize English learning programs for your students.</p>
                </div>
                <a href="{{ route('admin.courses.create') }}" class="flex items-center justify-center gap-2 px-6 py-4 bg-[#00C2CB] text-white rounded-xl font-bold shadow-lg hover:brightness-105 transition-all active:scale-95">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add_circle</span>
                    Add New Course
                </a>
            </div>
            <!-- Bento Filter & Grid -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-8">
                <!-- Filter Section -->
                <form action="{{ route('admin.courses') }}" method="GET" class="md:col-span-12 lg:col-span-4 bg-surface-container p-6 rounded-3xl flex flex-col justify-center border border-outline-variant">
                    <div class="flex items-center justify-between mb-4">
                        <span class="font-bold text-on-surface">Filters</span>
                        <button type="submit" class="material-symbols-outlined text-primary">search</button>
                    </div>
                    <div class="space-y-4">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search courses..." class="w-full rounded-full border-outline-variant bg-surface text-sm focus:ring-primary focus:border-primary">
                        <div class="flex flex-wrap gap-2">
                            <select name="level" class="text-xs rounded-full border-outline-variant bg-surface py-1">
                                <option value="All">All Levels</option>
                                <option value="Beginner" {{ request('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="Intermediate" {{ request('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="Advanced" {{ request('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                            <select name="status" class="text-xs rounded-full border-outline-variant bg-surface py-1">
                                <option value="All">All Status</option>
                                <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <a href="{{ route('admin.courses') }}" class="text-xs text-on-surface-variant hover:text-primary underline flex items-center">Reset</a>
                        </div>
                    </div>
                </form>
                <!-- Stats/Briefing -->
                <div class="md:col-span-6 lg:col-span-4 bg-primary-container text-on-primary-container p-6 rounded-3xl flex items-center justify-between border border-primary">
                    <div>
                        <p class="text-sm font-medium opacity-80 uppercase tracking-widest">Active Courses</p>
                        <p class="text-4xl font-black">{{ $stats['active'] }}</p>
                        <p class="text-xs opacity-70">Total: {{ $stats['total'] }}</p>
                    </div>
                    <span class="material-symbols-outlined text-5xl opacity-40">school</span>
                </div>
                <div class="md:col-span-6 lg:col-span-4 bg-tertiary-container text-on-tertiary-container p-6 rounded-3xl flex items-center justify-between border border-tertiary">
                    <div>
                        <p class="text-sm font-medium opacity-80 uppercase tracking-widest">TOEIC & IELTS</p>
                        <p class="text-4xl font-black">{{ $stats['toeic'] + $stats['ielts'] }}</p>
                        <p class="text-xs opacity-70">T: {{ $stats['toeic'] }} | I: {{ $stats['ielts'] }}</p>
                    </div>
                    <span class="material-symbols-outlined text-5xl opacity-40">trending_up</span>
                </div>
            </div>
            <!-- Courses Table Container -->
            <div class="bg-surface-container-lowest border border-outline-variant rounded-full overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-surface-container-high border-b border-outline-variant">
                            <tr>
                                <th class="px-6 py-4 text-label-large font-bold text-on-surface">Course Name</th>
                                <th class="px-6 py-4 text-label-large font-bold text-on-surface">Duration</th>
                                <th class="px-6 py-4 text-label-large font-bold text-on-surface">Price</th>
                                <th class="px-6 py-4 text-label-large font-bold text-on-surface">Status</th>
                                <th class="px-6 py-4 text-label-large font-bold text-on-surface text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @if(count($courses) > 0)
                            @foreach($courses as $course)
                            <!-- Course Item -->
                            <tr class="hover:bg-surface-container transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-surface-variant overflow-hidden flex-shrink-0">
                                            @if($course->image)
                                                <img class="w-full h-full object-cover" src="{{ asset($course->image) }}" alt="{{ $course->coursename }}" />
                                            @else
                                                <div class="w-full h-full bg-primary-container flex items-center justify-center text-on-primary-container">
                                                    <span class="material-symbols-outlined">book</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-on-surface">{{$course->coursename}}</p>
                                            <p class="text-xs text-on-surface-variant">Level: {{$course->level}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-on-surface-variant">12 Weeks</td>
                                <td class="px-6 py-4 font-semibold text-primary">{{ number_format($course->price, 0, ',', '.') }} VNĐ</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $course->status == 'Active' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{$course->status}}</span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.courses.edit', $course->courseid) }}" class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary-fixed rounded-lg">
                                            <span class="material-symbols-outlined">edit</span>
                                        </a>

                                        <form action="{{ route('admin.courses.destroy', $course->courseid) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error-container rounded-lg">
                                                <span class="material-symbols-outlined">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-on-surface-variant">No courses found.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="px-6 py-4 bg-surface-container-low flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-on-surface-variant">
                        Showing {{ $courses->firstItem() ?? 0 }} to {{ $courses->lastItem() ?? 0 }} of {{ $courses->total() }} courses
                    </p>
                    <div class="pagination-links">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Footer -->
    <footer class="w-full py-8 px-6 flex flex-col md:flex-row justify-between items-center gap-4 bg-surface-container-highest">
        <div class="flex flex-col items-center md:items-start">
            <span class="text-md font-headline font-bold text-on-surface">Ms. Hoa English Center</span>
            <p class="font-body text-label-small text-on-surface-variant">© 2024 Ms. Hoa English Center. All rights reserved.</p>
        </div>
        <div class="flex gap-6">
            <a class="font-body text-label-small text-on-surface-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
            <a class="font-body text-label-small text-on-surface-variant hover:text-primary transition-colors" href="#">Terms of Service</a>
            <a class="font-body text-label-small text-on-surface-variant hover:text-primary transition-colors" href="#">Cookie Policy</a>
        </div>
    </footer>
</body>

</html>