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
                        "surface-container-high": "#ece6ee",
                        "surface-container-highest": "#e6e0e9",
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
    <title>Edit Student - Admin Panel</title>
</head>
<body class="bg-surface text-on-surface">
    <nav class="sticky top-0 z-50 flex justify-between items-center w-full px-6 py-3 bg-surface border-b border-outline/10 shadow-sm">
        <div class="flex items-center gap-8">
            <span class="text-xl font-black text-primary">Ms. Hoa English</span>
            <div class="hidden md:flex gap-6">
                <a class="text-sm font-medium text-on-surface/70 hover:text-primary transition-colors" href="{{ route('home') }}">Home</a>
                <a class="text-sm font-bold text-primary border-b-2 border-primary" href="{{ route('dashboard') }}">Dashboard</a>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <span class="material-symbols-outlined text-on-surface/70 cursor-pointer">account_circle</span>
        </div>
    </nav>

    <div class="flex">
        <aside class="hidden lg:flex flex-col w-64 h-[calc(100vh-64px)] fixed left-0 top-16 pt-8 pb-4 bg-surface-container-low border-r border-outline/10">
            <nav class="flex-grow space-y-1">
                <a class="flex items-center gap-3 text-on-surface/70 px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-sm font-medium">Overview</span>
                </a>
                <a class="flex items-center gap-3 text-on-surface/70 px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all" href="{{ route('admin.courses') }}">
                    <span class="material-symbols-outlined">menu_book</span>
                    <span class="text-sm font-medium">Courses</span>
                </a>
                <a class="flex items-center gap-3 text-on-surface/70 px-4 py-3 mx-2 hover:bg-surface-container-high rounded-xl transition-all" href="{{ route('admin.teachers.index') }}">
                    <span class="material-symbols-outlined">person</span>
                    <span class="text-sm font-medium">Teachers</span>
                </a>
                <a class="flex items-center gap-3 bg-primary/10 text-primary px-4 py-3 mx-2 rounded-xl transition-all font-bold" href="{{ route('admin.students.index') }}">
                    <span class="material-symbols-outlined">group</span>
                    <span class="text-sm">Students</span>
                </a>
            </nav>
        </aside>

        <main class="flex-grow lg:ml-64 p-8">
            <div class="mb-10">
                <a href="{{ route('admin.students.index') }}" class="flex items-center gap-2 text-primary font-bold mb-4 hover:underline">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Back to Students
                </a>
                <h1 class="text-3xl font-black text-on-surface">Edit Student</h1>
                <p class="text-on-surface/70 mt-1">Update student profile and account details.</p>
            </div>

            <div class="max-w-4xl bg-white border border-outline/10 rounded-3xl p-8 shadow-sm">
                <form action="{{ route('admin.students.update', $student->studentid) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface">Full Name</label>
                            <input type="text" name="fullname" required value="{{ old('fullname', $student->user->fullname) }}" class="w-full px-4 py-3 rounded-xl border border-outline/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Enter student's full name">
                            @error('fullname') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface">Email Address</label>
                            <input type="email" name="email" required value="{{ old('email', $student->user->email) }}" class="w-full px-4 py-3 rounded-xl border border-outline/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="email@example.com">
                            @error('email') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface">Password (leave blank to keep current)</label>
                            <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-outline/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Min. 6 characters">
                            @error('password') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone', $student->user->phone) }}" class="w-full px-4 py-3 rounded-xl border border-outline/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Enter phone number">
                            @error('phone') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface">Date of Birth</label>
                            <input type="date" name="dateofbirth" required value="{{ old('dateofbirth', $student->dateofbirth) }}" class="w-full px-4 py-3 rounded-xl border border-outline/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                            @error('dateofbirth') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface">Gender</label>
                            <select name="gender" required class="w-full px-4 py-3 rounded-xl border border-outline/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $student->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-sm font-bold text-on-surface">Address</label>
                            <textarea name="address" required rows="2" class="w-full px-4 py-3 rounded-xl border border-outline/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Enter full address">{{ old('address', $student->address) }}</textarea>
                            @error('address') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface">Parent/Guardian Name</label>
                            <input type="text" name="parentname" required value="{{ old('parentname', $student->parentname) }}" class="w-full px-4 py-3 rounded-xl border border-outline/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Enter parent name">
                            @error('parentname') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface">Parent Phone Number</label>
                            <input type="text" name="parentphone" required value="{{ old('parentphone', $student->parentphone) }}" class="w-full px-4 py-3 rounded-xl border border-outline/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Enter parent phone">
                            @error('parentphone') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end gap-4">
                        <a href="{{ route('admin.students.index') }}" class="px-8 py-4 border border-outline/20 text-on-surface/70 rounded-xl font-bold hover:bg-surface-container-low transition-all">Cancel</a>
                        <button type="submit" class="px-8 py-4 bg-primary text-on-primary rounded-xl font-bold shadow-lg hover:brightness-110 transition-all active:scale-[0.98]">Update Student</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>