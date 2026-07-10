<div class="container mx-auto px-4 py-8 max-w-5xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tất cả thông báo</h1>
        <button onclick="markAllAsReadPage()" class="text-primary hover:underline font-bold text-sm">Đánh dấu tất cả đã đọc</button>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="divide-y divide-gray-100">
            @forelse($notifications as $notif)
                @php
                    $dataObj = $notif->data;
                    $dotColor = 'bg-primary';
                    if (($dataObj['type'] ?? '') === 'success') $dotColor = 'bg-green-500';
                    if (($dataObj['type'] ?? '') === 'danger') $dotColor = 'bg-red-500';
                    if (($dataObj['type'] ?? '') === 'warning') $dotColor = 'bg-orange-500';
                @endphp
                <div class="p-4 flex items-start gap-4 hover:bg-gray-50 cursor-pointer transition-colors {{ $notif->read_at ? 'opacity-70' : 'bg-blue-50/30' }}" onclick="markAsReadAndGo('{{ $notif->id }}', '{{ $dataObj['link'] ?? '#' }}')">
                    <div class="w-3 h-3 mt-1.5 rounded-full flex-shrink-0 {{ $dotColor }}"></div>
                    <div class="flex-1">
                        <p class="text-base font-bold text-gray-900">{{ $dataObj['title'] ?? 'Thông báo' }}</p>
                        <p class="text-sm text-gray-600 mt-1">{{ $dataObj['message'] ?? '' }}</p>
                        @if(isset($dataObj['action_by']))
                            <p class="text-xs text-gray-500 mt-2 font-medium">Bởi: {{ $dataObj['action_by'] }}</p>
                        @endif
                    </div>
                    <div class="text-xs text-gray-400 font-medium whitespace-nowrap">
                        {{ $notif->created_at->diffForHumans() }}
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-500">
                    Bạn chưa có thông báo nào.
                </div>
            @endforelse
        </div>
    </div>
    
    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
</div>

<script>
    function markAsReadAndGo(id, link) {
        fetch(`/api/notifications/${id}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(() => {
            if (link && link !== '#') {
                window.location.href = link;
            } else {
                window.location.reload();
            }
        });
    }

    function markAllAsReadPage() {
        fetch('/api/notifications/read-all', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(() => {
            window.location.reload();
        });
    }
</script>
