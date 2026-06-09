@extends('layouts.dashboard')
@section('contentdashboard')
<!-- Main Canvas -->
<main class="flex-1 lg:ml-64 p-6 bg-surface-bright">
    <div class="max-w-7xl mx-auto">
        <header class="mb-8">
            <h1 class="text-3xl font-headline font-extrabold text-on-surface">Dashboard Overview</h1>
            <p class="text-on-surface-variant">Welcome back, Admin. Here's what's happening at the center today.</p>
        </header>
        <!-- Statistical Cards Bento Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-primary-container rounded-xl text-on-primary-container">
                        <span class="material-symbols-outlined">group</span>
                    </div>
                    <span class="text-xs font-bold text-tertiary bg-tertiary-fixed px-2 py-1 rounded-full">Total</span>
                </div>
                <h3 class="text-on-surface-variant text-sm font-medium">Total Students</h3>
                <p class="text-2xl font-black text-on-surface mt-1">{{ number_format($totalStudents) }}</p>
            </div>
            <div class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-secondary-container rounded-xl text-on-secondary-container">
                        <span class="material-symbols-outlined">menu_book</span>
                    </div>
                    <span class="text-xs font-bold text-on-secondary-fixed-variant bg-secondary-fixed px-2 py-1 rounded-full">{{ $activeCourses }} Active</span>
                </div>
                <h3 class="text-on-surface-variant text-sm font-medium">Active Courses</h3>
                <p class="text-2xl font-black text-on-surface mt-1">{{ $activeCourses }}</p>
            </div>
            <div class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-tertiary-container rounded-xl text-on-tertiary-container">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <span class="text-xs font-bold text-tertiary bg-tertiary-fixed px-2 py-1 rounded-full">This Month</span>
                </div>
                <h3 class="text-on-surface-variant text-sm font-medium">Monthly Revenue</h3>
                <p class="text-2xl font-black text-on-surface mt-1">${{ number_format($monthlyRevenue) }}</p>
            </div>
            <div class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-error-container rounded-xl text-on-error-container">
                        <span class="material-symbols-outlined">how_to_reg</span>
                    </div>
                    <span class="text-xs font-bold text-on-error-container bg-error-container px-2 py-1 rounded-full">{{ $pendingRegistrations }} New</span>
                </div>
                <h3 class="text-on-surface-variant text-sm font-medium">Pending Reg.</h3>
                <p class="text-2xl font-black text-on-surface mt-1">{{ $pendingRegistrations }}</p>
            </div>
        </div>
        <!-- Secondary Row: Charts and Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Chart Placeholder Section -->
            <div class="lg:col-span-2 bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-on-surface">Registration Trends</h2>
                    <select class="bg-surface-container text-sm border-none rounded-lg focus:ring-primary">
                        <option>Last 6 Months</option>
                    </select>
                </div>
                <div class="h-64">
                    <canvas id="registrationChart"></canvas>
                </div>
            </div>
            <!-- Recent Activity -->
            <div class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant shadow-sm flex flex-col">
                <h2 class="text-lg font-bold text-on-surface mb-6">Recent Activity</h2>
                <div class="space-y-6 flex-1 overflow-y-auto pr-2">
                    @forelse($activities as $activity)
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-full bg-{{ $activity['color'] }}-container flex-shrink-0 flex items-center justify-center">
                            <span class="material-symbols-outlined text-on-{{ $activity['color'] }}-container text-sm">{{ $activity['icon'] }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-on-surface">{{ $activity['title'] }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $activity['desc'] }}</p>
                            <p class="text-[10px] text-outline mt-1 uppercase font-bold tracking-wider">{{ $activity['time'] }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-on-surface-variant text-center py-8">No recent activities found.</p>
                    @endforelse
                </div>
                <button class="mt-6 text-primary text-sm font-bold hover:underline">View All Activities</button>
            </div>
        </div>
        <!-- Custom Bento Section: Top Teachers / Featured Courses -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 relative overflow-hidden h-64 rounded-3xl group">
                <img class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBK58qfgY5ZVynkcmgPPFjT3PzYHsPV01O3jqlJ3ggEYlLQPXTc1yzkGtEsOkeJNlx_DygjSlfDlVeX_3p5aPhU5bKbvWIQRGDCqjHufqJTzRMoCXkibHor9H_X7P0El2_b5ff-hE6cgbZVSadaH4cjKDG67kHzXaS-0kENnTKV8V8mf3eurl6zJJ2LN5i5sETyV0YI3giZqmH77-HMQmSL4bLJtdjfbC0g_0g-WZB01rjqx2_S6EF_RCaWy6l1z3dYKw_TR-cr_Hc" />
                <div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent"></div>
                <div class="absolute bottom-6 left-8">
                    <h3 class="text-2xl font-black text-white">Teacher Excellence Award</h3>
                    <p class="text-white/80 max-w-md">Celebrating 98% student satisfaction for the Q2 Academic Season.</p>
                    <button class="mt-4 bg-white text-primary px-6 py-2 rounded-full font-bold text-sm">View Rankings</button>
                </div>
            </div>
            <div class="bg-surface-container-high p-8 rounded-3xl flex flex-col justify-center items-center text-center">
                <div class="w-20 h-20 bg-primary text-on-primary rounded-full flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-4xl">verified</span>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('registrationChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'New Registrations',
                data: {!! json_encode($data) !!},
                borderColor: '#4f378a',
                backgroundColor: 'rgba(79, 55, 138, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: '#4f378a'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endsection
