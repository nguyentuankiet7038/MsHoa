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
    <title>Student Management - Admin Panel</title>
</head>
<body class="bg-surface text-on-surface">
    

        <main class="flex-grow lg:ml-64 p-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div>
                    <h1 class="text-3xl font-black text-on-surface">Student Management</h1>
                    <p class="text-on-surface/70 mt-1">Manage your students and their enrollment details.</p>
                </div>
                <a href="{{ route('admin.students.create') }}" class="flex items-center justify-center gap-2 px-6 py-4 bg-primary text-on-primary rounded-xl font-bold shadow-lg hover:brightness-110 transition-all active:scale-[0.98]">
                    <span class="material-symbols-outlined">person_add</span>
                    Add New Student
                </a>
            </div>

            <div class="bg-white border border-outline/10 rounded-3xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-surface-container-high border-b border-outline/10">
                            <tr>
                                <th class="px-6 py-4 text-sm font-bold text-on-surface">Student Name</th>
                                <th class="px-6 py-4 text-sm font-bold text-on-surface">Date of Birth</th>
                                <th class="px-6 py-4 text-sm font-bold text-on-surface">Parent Contact</th>
                                <th class="px-6 py-4 text-sm font-bold text-on-surface">Email</th>
                                <th class="px-6 py-4 text-sm font-bold text-on-surface text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline/10">
                            @forelse($students as $student)
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                            {{ substr($student->user->fullname, 0, 1) }}
                                        </div>
                                        <span class="font-bold text-on-surface">{{ $student->user->fullname }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-on-surface/70">{{ $student->dateofbirth }}</td>
                                <td class="px-6 py-4 text-on-surface/70">
                                    <p class="font-medium text-on-surface">{{ $student->parentname }}</p>
                                    <p class="text-xs">{{ $student->parentphone }}</p>
                                </td>
                                <td class="px-6 py-4 text-on-surface/70">{{ $student->user->email }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.students.edit', $student->studentid) }}" class="p-2 text-on-surface/70 hover:text-primary hover:bg-primary/10 rounded-lg transition-all">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </a>
                                        <form action="{{ route('admin.students.destroy', $student->studentid) }}" method="POST" onsubmit="return confirm('Delete this student?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-on-surface/70 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                                <span class="material-symbols-outlined text-xl">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-on-surface/50">No students found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-outline/10">
                    {{ $students->links() }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>