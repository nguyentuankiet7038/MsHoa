@extends('layouts.dashboard')

@section('title', 'Quản lý Hỗ trợ AI')

@section('contentdashboard')
<div class="p-8">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-headline font-black text-on-surface">Trung tâm Trợ giúp AI</h2>
                <p class="text-on-surface-variant">Đào tạo AI Grok bằng cách cung cấp các câu hỏi và câu trả lời mẫu.</p>
            </div>
            <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="bg-primary text-on-primary px-6 py-3 rounded-full font-bold hover:opacity-90 transition-all flex items-center gap-2 shadow-lg">
                <span class="material-symbols-outlined">add</span> Thêm Nội Dung
            </button>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-outline-variant overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container-high border-b border-outline-variant">
                        <tr>
                            <th class="px-6 py-4 font-bold text-sm">Thứ tự</th>
                            <th class="px-6 py-4 font-bold text-sm">Câu hỏi</th>
                            <th class="px-6 py-4 font-bold text-sm">Câu trả lời</th>
                            <th class="px-6 py-4 font-bold text-sm">Trạng thái</th>
                            <th class="px-6 py-4 font-bold text-sm text-right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @foreach($faqs as $faq)
                        <tr class="hover:bg-surface transition-colors">
                            <td class="px-6 py-4 text-sm">{{ $faq->order }}</td>
                            <td class="px-6 py-4 font-bold">{{ Str::limit($faq->question, 50) }}</td>
                            <td class="px-6 py-4 text-on-surface-variant text-sm">{{ Str::limit($faq->answer, 100) }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.help-center.toggle', $faq->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-1 rounded-full text-xs font-bold {{ $faq->is_active ? 'bg-green-100 text-green-700' : 'bg-surface-variant text-on-surface-variant' }}">
                                        {{ $faq->is_active ? 'Đang hoạt động' : 'Đã khóa' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button onclick="openEditModal({{ $faq }})" class="p-2 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-all">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <form action="{{ route('admin.help-center.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Xác nhận xóa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-on-surface-variant hover:text-error hover:bg-error/10 rounded-lg transition-all">
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
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 bg-black/50 z-[100] hidden flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white w-full max-w-lg rounded-3xl p-8 shadow-2xl">
        <h3 class="text-2xl font-black mb-6">Thêm nội dung đào tạo</h3>
        <form action="{{ route('admin.help-center.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold mb-2">Câu hỏi</label>
                <input type="text" name="question" required class="w-full rounded-xl border-outline-variant focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Câu trả lời</label>
                <textarea name="answer" rows="4" required class="w-full rounded-xl border-outline-variant focus:ring-primary focus:border-primary"></textarea>
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Thứ tự ưu tiên</label>
                <input type="number" name="order" value="0" class="w-full rounded-xl border-outline-variant focus:ring-primary focus:border-primary">
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="px-6 py-2 text-on-surface-variant font-bold">Hủy</button>
                <button type="submit" class="px-8 py-2 bg-primary text-on-primary rounded-full font-bold shadow-md">Lưu lại</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black/50 z-[100] hidden flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white w-full max-w-lg rounded-3xl p-8 shadow-2xl">
        <h3 class="text-2xl font-black mb-6">Chỉnh sửa nội dung</h3>
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-bold mb-2">Câu hỏi</label>
                <input type="text" id="edit_question" name="question" required class="w-full rounded-xl border-outline-variant focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Câu trả lời</label>
                <textarea id="edit_answer" name="answer" rows="4" required class="w-full rounded-xl border-outline-variant focus:ring-primary focus:border-primary"></textarea>
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Thứ tự ưu tiên</label>
                <input type="number" id="edit_order" name="order" class="w-full rounded-xl border-outline-variant focus:ring-primary focus:border-primary">
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-6 py-2 text-on-surface-variant font-bold">Hủy</button>
                <button type="submit" class="px-8 py-2 bg-primary text-on-primary rounded-full font-bold shadow-md">Cập nhật</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openEditModal(faq) {
        document.getElementById('editForm').action = '/dashboard/help-center/' + faq.id;
        document.getElementById('edit_question').value = faq.question;
        document.getElementById('edit_answer').value = faq.answer;
        document.getElementById('edit_order').value = faq.order;
        document.getElementById('editModal').classList.remove('hidden');
    }
</script>
@endpush
@endsection
