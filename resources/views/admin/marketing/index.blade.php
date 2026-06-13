@extends('layouts.dashboard')

@section('title', 'Trung tâm Tiếp thị')

@section('contentdashboard')
<div class="p-8">
    <div class="max-w-7xl mx-auto space-y-10">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-headline font-extrabold text-on-surface tracking-tight">Trung tâm Tiếp thị</h2>
                <p class="text-on-surface-variant mt-1">Thiết kế, triển khai và phân tích các chiến dịch truyền thông của bạn.</p>
            </div>
            <button onclick="document.getElementById('createModal').classList.remove('hidden')" class="bg-[#26A69A] hover:bg-[#00897B] text-white px-6 py-4 rounded-full font-bold flex items-center gap-3 shadow-lg active:scale-95 transition-all">
                <span class="material-symbols-outlined">add</span>
                Tạo chiến dịch mới
            </button>
        </div>

        <!-- Bento Grid Metrics & Featured -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2 bg-primary-container p-8 rounded-3xl flex flex-col justify-between overflow-hidden relative group">
                <div class="z-10">
                    <span class="text-on-primary-container text-sm font-bold uppercase tracking-widest">Người đăng ký đang hoạt động</span>
                    <h3 class="text-4xl font-headline font-black text-white mt-2">{{ number_format($activeSubscribers) }}</h3>
                    <div class="mt-4 flex items-center gap-2 text-on-primary-container text-sm">
                        <span class="material-symbols-outlined text-sm">trending_up</span>
                        <span>Số lượng thực tế các học sinh đã đăng ký</span>
                    </div>
                </div>
                <div class="absolute -right-10 -bottom-10 opacity-20">
                    <span class="material-symbols-outlined text-[160px]" style="font-variation-settings: 'FILL' 1;">mail</span>
                </div>
            </div>
            <div class="bg-surface-container-high p-6 rounded-3xl flex flex-col items-center justify-center text-center">
                <span class="text-on-surface-variant text-sm font-bold">Tỷ lệ mở TB</span>
                <p class="text-3xl font-headline font-bold text-primary mt-1">{{ number_format($avgOpenRate, 1) }}%</p>
                <div class="w-full bg-outline-variant h-1 mt-4 rounded-full overflow-hidden">
                    <div class="bg-primary h-full" style="width: {{ $avgOpenRate }}%"></div>
                </div>
            </div>
            <div class="bg-surface-container-high p-6 rounded-3xl flex flex-col items-center justify-center text-center">
                <span class="text-on-surface-variant text-sm font-bold">Tỷ lệ nhấp TB</span>
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
                    Các chiến dịch gần đây
                </h3>
            </div>
            <div class="bg-white rounded-3xl overflow-hidden border border-outline-variant shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-surface-container-high">
                            <tr>
                                <th class="px-6 py-4 font-bold text-sm text-on-surface-variant">Tên chiến dịch</th>
                                <th class="px-6 py-4 font-bold text-sm text-on-surface-variant">Trạng thái</th>
                                <th class="px-6 py-4 font-bold text-sm text-on-surface-variant">Người nhận</th>
                                <th class="px-6 py-4 font-bold text-sm text-on-surface-variant">Tỷ lệ mở</th>
                                <th class="px-6 py-4 font-bold text-sm text-on-surface-variant text-right">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @foreach($campaigns as $campaign)
                            <tr class="hover:bg-surface-container-highest transition-colors">
                                <td class="px-6 py-4 font-medium">{{ $campaign->name }}</td>
                                <td class="px-6 py-4">
                                    @if($campaign->status == 'Sent')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full">Đã gửi</span>
                                    @elseif($campaign->status == 'Drafting')
                                        <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full">Đang soạn thảo</span>
                                    @else
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full">{{ $campaign->status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-on-surface-variant">{{ number_format($campaign->recipients) }}</td>
                                <td class="px-6 py-4 font-bold text-primary">{{ $campaign->open_rate ? $campaign->open_rate . '%' : '--' }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button onclick="openBroadcastModal({{ $campaign->id }}, '{{ $campaign->name }}')" class="flex items-center gap-1 bg-[#26A69A] text-white px-3 py-1 rounded-full text-xs font-bold hover:opacity-90 transition-all">
                                            <span class="material-symbols-outlined text-sm">send</span>
                                            Quảng bá
                                        </button>
                                        <button onclick="openEditModal({{ $campaign->id }}, '{{ $campaign->name }}', '{{ $campaign->type }}', '{{ $campaign->status }}')" class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg">
                                            <span class="material-symbols-outlined">edit</span>
                                        </button>
                                        <form action="{{ route('admin.marketing.destroy', $campaign->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn không?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg">
                                                <span class="material-symbols-outlined">delete</span>
                                            </button>
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

        <!-- Template Library -->
        <section class="pb-12">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-headline font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">auto_awesome_motion</span>
                    Thư viện mẫu
                </h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($templates as $template)
                <div class="group cursor-pointer">
                    <div class="relative aspect-[3/4] rounded-3xl overflow-hidden mb-3 border border-outline-variant shadow-sm transition-transform group-hover:-translate-y-2">
                        <img class="w-full h-full object-cover" src="{{ $template->thumbnail_url }}" alt="{{ $template->name }}"/>
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                            <button class="bg-white text-primary px-4 py-2 rounded-full font-bold text-sm">Sử dụng mẫu</button>
                        </div>
                    </div>
                    <h4 class="font-bold text-sm">{{ $template->name }}</h4>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>

<!-- Modals -->
<div id="createModal" class="fixed inset-0 bg-black/50 z-[100] hidden flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-surface w-full max-w-md rounded-3xl p-8 shadow-2xl">
        <h3 class="text-2xl font-headline font-bold mb-6">Tạo chiến dịch mới</h3>
        <form action="{{ route('admin.marketing.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold mb-2">Tên chiến dịch</label>
                <input type="text" name="name" required class="w-full rounded-xl border-outline-variant focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Loại</label>
                <select name="type" required class="w-full rounded-xl border-outline-variant focus:border-primary">
                    <option value="Promotion">Khuyến mãi</option>
                    <option value="Educational">Giáo dục</option>
                    <option value="Newsletter">Bản tin</option>
                </select>
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" onclick="document.getElementById('createModal').classList.add('hidden')" class="px-6 py-2 rounded-full font-bold text-on-surface-variant hover:bg-surface-container-high">Hủy</button>
                <button type="submit" class="px-6 py-2 bg-primary text-on-primary rounded-full font-bold">Tạo</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="fixed inset-0 bg-black/50 z-[100] hidden flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-surface w-full max-w-md rounded-3xl p-8 shadow-2xl">
        <h3 class="text-2xl font-headline font-bold mb-6">Chỉnh sửa chiến dịch</h3>
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-bold mb-2">Tên chiến dịch</label>
                <input type="text" id="edit_name" name="name" required class="w-full rounded-xl border-outline-variant focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Loại</label>
                <select id="edit_type" name="type" required class="w-full rounded-xl border-outline-variant focus:border-primary">
                    <option value="Promotion">Khuyến mãi</option>
                    <option value="Educational">Giáo dục</option>
                    <option value="Newsletter">Bản tin</option>
                </select>
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-6 py-2 rounded-full font-bold text-on-surface-variant hover:bg-surface-container-high">Hủy</button>
                <button type="submit" class="px-6 py-2 bg-primary text-on-primary rounded-full font-bold">Cập nhật</button>
            </div>
        </form>
    </div>
</div>

<div id="broadcastModal" class="fixed inset-0 bg-black/50 z-[100] hidden flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-surface w-full max-w-md rounded-3xl p-8 shadow-2xl">
        <h3 class="text-2xl font-headline font-bold mb-2">Phát sóng chiến dịch</h3>
        <p id="broadcast_campaign_name" class="text-primary font-bold mb-6"></p>
        <form id="broadcastForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold mb-2">Chọn mẫu (Tùy chọn)</label>
                <select name="template_id" class="w-full rounded-xl border-outline-variant focus:border-primary">
                    <option value="">Không dùng mẫu (Chỉ văn bản)</option>
                    @foreach($templates as $template)
                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                    @endforeach
                </select>
            </div>
            <p class="text-xs text-on-surface-variant bg-surface-container p-3 rounded-xl italic">
                * Điều này sẽ gửi email đến tất cả các học sinh đang hoạt động.
            </p>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" onclick="document.getElementById('broadcastModal').classList.add('hidden')" class="px-6 py-2 rounded-full font-bold text-on-surface-variant hover:bg-surface-container-high">Hủy</button>
                <button type="submit" class="px-6 py-2 bg-[#26A69A] text-white rounded-full font-bold">Gửi phát sóng ngay</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openEditModal(id, name, type, status) {
        document.getElementById('editForm').action = '/dashboard/marketing/' + id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_type').value = type;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function openBroadcastModal(id, name) {
        document.getElementById('broadcastForm').action = '/dashboard/marketing/' + id + '/broadcast';
        document.getElementById('broadcast_campaign_name').innerText = name;
        document.getElementById('broadcastModal').classList.remove('hidden');
    }
</script>
@endpush
@endsection
