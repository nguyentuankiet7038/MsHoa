<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#4f378a",
                        "on-primary": "#ffffff",
                        "surface": "#fdf7ff",
                        "on-surface": "#1d1b20",
                        "outline": "#7a7582",
                        "surface-container-low": "#f8f2fa",
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    }
                }
            }
        }
    </script>
    <title>Edit Course - Admin Panel</title>
</head>
<body class="bg-surface text-on-surface">
    <div class="min-h-screen flex flex-col items-center justify-center p-6">
        <div class="w-full max-w-2xl bg-white rounded-3xl shadow-xl overflow-hidden border border-outline/10">
            <div class="bg-primary p-8 text-on-primary">
                <div class="flex items-center gap-4 mb-2">
                    <a href="{{ route('admin.courses') }}" class="p-2 hover:bg-white/10 rounded-full transition-colors">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </a>
                    <h1 class="text-3xl font-black">Edit Course</h1>
                </div>
                <p class="text-white/80">Update the details of "{{ $course->coursename }}".</p>
            </div>

            <form action="{{ route('admin.courses.update', $course->courseid) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface/70" for="coursename">Course Name</label>
                        <input type="text" name="coursename" id="coursename" value="{{ $course->coursename }}" required class="w-full px-4 py-3 rounded-xl border border-outline/30 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface/70" for="level">Level</label>
                        <select name="level" id="level" required class="w-full px-4 py-3 rounded-xl border border-outline/30 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                            <option value="Beginner" {{ $course->level == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="Intermediate" {{ $course->level == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="Advanced" {{ $course->level == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                            <option value="TOEIC" {{ $course->level == 'TOEIC' ? 'selected' : '' }}>TOEIC</option>
                            <option value="IELTS" {{ $course->level == 'IELTS' ? 'selected' : '' }}>IELTS</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface/70" for="description">Description</label>
                    <textarea name="description" id="description" rows="4" required class="w-full px-4 py-3 rounded-xl border border-outline/30 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ $course->description }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface/70" for="price">Price (VNĐ)</label>
                        <input type="number" name="price" id="price" value="{{ $course->price }}" required class="w-full px-4 py-3 rounded-xl border border-outline/30 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface/70" for="status">Status</label>
                        <select name="status" id="status" required class="w-full px-4 py-3 rounded-xl border border-outline/30 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                            <option value="Active" {{ $course->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $course->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="Upcoming" {{ $course->status == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface/70" for="image">Course Image (Leave blank to keep current)</label>
                    <div class="flex items-center gap-4">
                        @if($course->image)
                            <div class="w-20 h-20 rounded-xl overflow-hidden border border-outline/30">
                                <img src="{{ asset($course->image) }}" class="w-full h-full object-cover" alt="Current image">
                            </div>
                        @endif
                        <div class="flex-1">
                            <label class="flex flex-col items-center justify-center w-full h-20 border-2 border-outline/30 border-dashed rounded-xl cursor-pointer bg-surface-container-low hover:bg-surface-container transition-all">
                                <div class="flex flex-col items-center justify-center">
                                    <span class="material-symbols-outlined text-outline">cloud_upload</span>
                                    <p class="text-xs text-outline font-medium">Click to change image</p>
                                </div>
                                <input type="file" name="image" id="image" class="hidden" />
                            </label>
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex gap-4">
                    <button type="submit" class="flex-1 bg-primary text-on-primary py-4 rounded-xl font-bold shadow-lg hover:brightness-110 transition-all active:scale-[0.98]">
                        Update Course
                    </button>
                    <a href="{{ route('admin.courses') }}" class="px-8 py-4 rounded-xl font-bold border border-outline/30 hover:bg-surface-container-low transition-all">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>