<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Help Center Management | Ms. Hoa English</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Public Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="flex min-h-screen">
        <!-- Sidebar placeholder or include if layout exists -->
        <aside class="w-64 bg-white border-r border-slate-200 hidden lg:block">
            <div class="p-6">
                <h1 class="text-xl font-bold text-indigo-600">Ms. Hoa English</h1>
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 text-slate-600 hover:bg-slate-100 rounded-lg">
                    <span class="material-symbols-outlined">dashboard</span> Dashboard
                </a>
                <a href="{{ route('marketing.admin') }}" class="flex items-center gap-3 p-3 text-slate-600 hover:bg-slate-100 rounded-lg">
                    <span class="material-symbols-outlined">mail</span> Marketing
                </a>
                <a href="{{ route('admin.help-center.index') }}" class="flex items-center gap-3 p-3 bg-indigo-50 text-indigo-600 rounded-lg font-bold">
                    <span class="material-symbols-outlined">support_agent</span> AI Help Center
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-8">
            <div class="max-w-5xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-bold">AI Help Center</h2>
                        <p class="text-slate-500">Đào tạo AI Grok bằng cách cung cấp các câu hỏi và câu trả lời mẫu.</p>
                    </div>
                    <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="bg-indigo-600 text-white px-6 py-2 rounded-full font-bold hover:bg-indigo-700 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined">add</span> Thêm Nội Dung
                    </button>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4 font-bold text-sm">Thứ tự</th>
                                <th class="px-6 py-4 font-bold text-sm">Câu hỏi</th>
                                <th class="px-6 py-4 font-bold text-sm">Câu trả lời</th>
                                <th class="px-6 py-4 font-bold text-sm">Trạng thái</th>
                                <th class="px-6 py-4 font-bold text-sm text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($faqs as $faq)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 text-sm">{{ $faq->order }}</td>
                                <td class="px-6 py-4 font-medium">{{ Str::limit($faq->question, 50) }}</td>
                                <td class="px-6 py-4 text-slate-500 text-sm">{{ Str::limit($faq->answer, 100) }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.help-center.toggle', $faq->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1 rounded-full text-xs font-bold {{ $faq->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-600' }}">
                                            {{ $faq->is_active ? 'Đang hoạt động' : 'Đã khóa' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-3">
                                        <button onclick="openEditModal({{ $faq }})" class="text-slate-400 hover:text-indigo-600">
                                            <span class="material-symbols-outlined">edit</span>
                                        </button>
                                        <form action="{{ route('admin.help-center.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Xác nhận xóa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-400 hover:text-red-600">
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
        </main>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl p-8">
            <h3 class="text-xl font-bold mb-6">Thêm nội dung đào tạo mới</h3>
            <form action="{{ route('admin.help-center.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold mb-2">Câu hỏi (User query)</label>
                    <input type="text" name="question" required class="w-full rounded-xl border-slate-200 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Câu trả lời (AI response context)</label>
                    <textarea name="answer" rows="4" required class="w-full rounded-xl border-slate-200 focus:ring-indigo-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Thứ tự ưu tiên</label>
                    <input type="number" name="order" value="0" class="w-full rounded-xl border-slate-200 focus:ring-indigo-500">
                </div>
                <div class="flex justify-end gap-4 mt-8">
                    <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="px-6 py-2 text-slate-500 font-bold">Hủy</button>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-full font-bold">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl p-8">
            <h3 class="text-xl font-bold mb-6">Chỉnh sửa nội dung</h3>
            <form id="editForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-bold mb-2">Câu hỏi</label>
                    <input type="text" id="edit_question" name="question" required class="w-full rounded-xl border-slate-200 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Câu trả lời</label>
                    <textarea id="edit_answer" name="answer" rows="4" required class="w-full rounded-xl border-slate-200 focus:ring-indigo-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Thứ tự ưu tiên</label>
                    <input type="number" id="edit_order" name="order" class="w-full rounded-xl border-slate-200 focus:ring-indigo-500">
                </div>
                <div class="flex justify-end gap-4 mt-8">
                    <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-6 py-2 text-slate-500 font-bold">Hủy</button>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-full font-bold">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(faq) {
            document.getElementById('editForm').action = '/dashboard/help-center/' + faq.id;
            document.getElementById('edit_question').value = faq.question;
            document.getElementById('edit_answer').value = faq.answer;
            document.getElementById('edit_order').value = faq.order;
            document.getElementById('editModal').classList.remove('hidden');
        }
    </script>
</body>
</html>
