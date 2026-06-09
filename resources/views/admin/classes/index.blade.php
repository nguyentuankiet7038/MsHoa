@extends('layouts.dashboard')

@section('contentdashboard')
<main class="p-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-3xl font-headline font-black text-on-surface">Class Management</h1>
            <p class="text-on-surface-variant mt-1">Organize classes and manage student assignments.</p>
        </div>
        <div class="flex gap-4">
            <button onclick="openAutoArrangeModal()" class="flex items-center justify-center gap-2 px-6 py-4 bg-secondary text-on-secondary rounded-xl font-bold shadow-lg hover:brightness-105 transition-all active:scale-95">
                <span class="material-symbols-outlined">auto_fix</span>
                Auto Arrange
            </button>
            <a href="{{ route('admin.classes.create') }}" class="flex items-center justify-center gap-2 px-6 py-4 bg-primary text-on-primary rounded-xl font-bold shadow-lg hover:brightness-105 transition-all active:scale-95">
                <span class="material-symbols-outlined">add_circle</span>
                New Class
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-surface-container-lowest border border-outline-variant rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-surface-container-high border-b border-outline-variant">
                    <tr>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Class Name</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Course</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Teacher</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface">Schedule</th>
                        <th class="px-6 py-4 text-label-large font-bold text-on-surface text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($classes as $class)
                    <tr class="hover:bg-surface-container transition-colors group">
                        <td class="px-6 py-4">
                            <p class="font-bold text-on-surface">{{ $class->classname }}</p>
                            <p class="text-xs text-on-surface-variant">Dates: {{ $class->start_date }} to {{ $class->end_date }}</p>
                        </td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $class->course->coursename ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-sm">person</span>
                                <span class="text-sm font-medium">{{ $class->teacher->user->fullname ?? 'Unassigned' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm bg-surface-variant px-3 py-1 rounded-full text-on-surface-variant font-medium">
                                {{ $class->schedule }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.classes.show', $class->classid) }}" class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary-fixed rounded-lg">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                                <a href="{{ route('admin.classes.edit', $class->classid) }}" class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary-fixed rounded-lg">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                                <form action="{{ route('admin.classes.destroy', $class->classid) }}" method="POST" onsubmit="return confirm('Delete this class?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error-container rounded-lg">
                                        <span class="material-symbols-outlined text-[red]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-on-surface-variant">No classes found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-surface-container-low border-t border-outline-variant">
            {{ $classes->links() }}
        </div>
    </div>
</main>

<!-- Auto Arrange Modal -->
<div id="autoArrangeModal" class="fixed inset-0 bg-black/50 z-[100] hidden flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-[2.5rem] p-8 max-w-lg w-full shadow-2xl flex flex-col max-h-[85vh]">
        <div class="flex-shrink-0 mb-6">
            <h3 class="text-2xl font-black text-on-surface">Auto Arrange Classes</h3>
            <p class="text-on-surface-variant text-sm mt-1">Select classes to automatically assign approved students and available teachers.</p>
        </div>
        
        <form id="autoArrangeForm" class="flex flex-col min-h-0 flex-grow">
            @csrf
            <div class="space-y-3 overflow-y-auto pr-2 custom-scrollbar flex-grow min-h-0 mb-6" style="overscroll-behavior: contain;">
                @foreach($classes as $class)
                <label class="flex items-center gap-4 p-4 rounded-2xl border border-outline-variant hover:border-primary hover:bg-primary-container/5 transition-all cursor-pointer group">
                    <input type="checkbox" name="class_ids[]" value="{{ $class->classid }}" class="w-5 h-5 rounded-full border-outline-variant text-primary focus:ring-primary">
                    <div class="flex-grow">
                        <p class="font-bold text-on-surface group-hover:text-primary transition-colors">{{ $class->classname }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs px-2 py-0.5 bg-surface-variant rounded text-on-surface-variant">{{ $class->course->coursename }}</span>
                            <span class="text-xs text-outline flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">schedule</span>
                                {{ $class->schedule }}
                            </span>
                        </div>
                    </div>
                </label>
                @endforeach
            </div>
            
            <div class="flex justify-end gap-3 pt-6 border-t border-outline-variant flex-shrink-0">
                <button type="button" onclick="closeAutoArrangeModal()" class="px-8 py-3 font-bold text-on-surface-variant hover:bg-surface-container-high rounded-full transition-all">Cancel</button>
                <button type="submit" class="bg-primary text-on-primary px-10 py-3 rounded-full font-bold shadow-lg hover:brightness-110 transition-all active:scale-95 flex items-center gap-2">
                    <span class="material-symbols-outlined">magic_button</span>
                    Start Auto
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e6e0e9;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #4f378a;
    }
</style>

<script>
    function openAutoArrangeModal() {
        const modal = document.getElementById('autoArrangeModal');
        modal.classList.remove('hidden');
    }
    function closeAutoArrangeModal() {
        const modal = document.getElementById('autoArrangeModal');
        modal.classList.add('hidden');
    }
    
    document.getElementById('autoArrangeModal').addEventListener('click', function(e) {
        if (e.target === this) closeAutoArrangeModal();
    });

    document.getElementById('autoArrangeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch('{{ route('admin.classes.autoArrange') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Auto-arrangement completed successfully!');
                location.reload();
            }
        })
        .catch(err => {
            console.error(err);
            alert('An error occurred during auto-arrangement.');
        });
    });
</script>
@endsection
