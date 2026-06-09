@extends('layouts.dashboard')

@section('contentdashboard')
<main class="p-8">
    <!-- Header -->
    <div class="mb-10">
        <div class="flex items-center gap-2 text-on-surface-variant mb-2">
            <a href="{{ route('admin.registrations.index') }}" class="hover:text-primary flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Back to list
            </a>
        </div>
        <h1 class="text-3xl font-headline font-black text-on-surface">Update Registration</h1>
        <p class="text-on-surface-variant mt-1">Change status for registration #{{ $registration->registrationid }}</p>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white rounded-[2rem] border border-outline-variant overflow-hidden shadow-sm">
            <div class="p-8 border-b border-outline-variant bg-surface-container-low">
                <h3 class="text-xl font-bold text-on-surface mb-6">Registration Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-on-surface-variant font-bold mb-1">Student</p>
                        <p class="font-semibold text-on-surface">{{ $registration->student->user->fullname ?? 'Unknown' }}</p>
                        <p class="text-sm text-on-surface-variant">{{ $registration->student->user->email ?? '' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-on-surface-variant font-bold mb-1">Course & Class</p>
                        <p class="font-semibold text-on-surface">{{ $registration->class->course->coursename ?? 'No Course' }}</p>
                        <p class="text-sm text-on-surface-variant">Class: {{ $registration->class->classname ?? 'No Class' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-on-surface-variant font-bold mb-1">Registration Date</p>
                        <p class="font-semibold text-on-surface">{{ \Carbon\Carbon::parse($registration->registration_date)->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-on-surface-variant font-bold mb-1">Current Status</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold capitalize bg-secondary-container text-on-secondary-container">
                            {{ $registration->status }}
                        </span>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.registrations.update', $registration->registrationid) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')
                
                <div class="mb-8">
                    <label for="status" class="block text-sm font-bold text-on-surface mb-4">Update Status</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach(['pending', 'approved', 'rejected', 'canceled'] as $status)
                        <label class="relative flex flex-col items-center gap-2 p-4 rounded-2xl border-2 cursor-pointer transition-all {{ $registration->status == $status ? 'border-primary bg-primary-container/10' : 'border-outline-variant hover:border-outline' }}">
                            <input type="radio" name="status" value="{{ $status }}" class="absolute opacity-0" {{ $registration->status == $status ? 'checked' : '' }}>
                            <span class="material-symbols-outlined {{ $registration->status == $status ? 'text-primary' : 'text-on-surface-variant' }}">
                                @if($status == 'pending') timer @elseif($status == 'approved') check_circle @elseif($status == 'rejected') cancel @else block @endif
                            </span>
                            <span class="text-xs font-bold capitalize {{ $registration->status == $status ? 'text-primary' : 'text-on-surface-variant' }}">{{ $status }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.registrations.index') }}" class="px-8 py-3 rounded-full font-bold text-on-surface-variant hover:bg-surface-container-high transition-all">
                        Cancel
                    </a>
                    <button type="submit" class="bg-primary text-on-primary px-10 py-3 rounded-full font-bold shadow-lg hover:brightness-110 transition-all active:scale-95">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<style>
    input[type="radio"]:checked + span {
        color: var(--primary);
    }
</style>
@endsection
