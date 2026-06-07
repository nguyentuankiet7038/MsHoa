<?php

namespace App\Http\Controllers;

use App\Models\HelpCenter;
use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
    public function index()
    {
        $faqs = HelpCenter::orderBy('order')->get();
        return view('admin.help-center.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'order' => 'nullable|integer',
        ]);

        HelpCenter::create($request->all());

        return redirect()->back()->with('success', 'Thêm nội dung đào tạo AI thành công!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'order' => 'nullable|integer',
        ]);

        $faq = HelpCenter::findOrFail($id);
        $faq->update($request->all());

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        $faq = HelpCenter::findOrFail($id);
        $faq->delete();

        return redirect()->back()->with('success', 'Xóa thành công!');
    }

    public function toggleStatus($id)
    {
        $faq = HelpCenter::findOrFail($id);
        $faq->is_active = !$faq->is_active;
        $faq->save();

        return redirect()->back()->with('success', 'Thay đổi trạng thái thành công!');
    }
}
