<?php

namespace App\Http\Controllers;

use App\Models\HelpCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SupportController extends Controller
{
    public function index()
    {
        $faqs = HelpCenter::where('is_active', true)->orderBy('order')->get();
        return view('pages.support', compact('faqs'));
    }

    public function chat(Request $request)
    {
        $userMessage = $request->input('message');
        $apiKey = env('GROK_API_KEY');

        if (!$apiKey) {
            return response()->json(['error' => 'API Key chưa được cấu hình.'], 500);
        }

        // Lấy dữ liệu đào tạo làm context
        $trainingData = HelpCenter::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function ($item) {
                return "Q: {$item->question}\nA: {$item->answer}";
            })
            ->implode("\n\n");

        $systemPrompt = "Bạn là trợ lý ảo hỗ trợ khách hàng của Trung tâm Tiếng Anh Ms. Hoa. " .
            "Hãy sử dụng thông tin dưới đây để trả lời người dùng. Nếu thông tin không có trong tài liệu, hãy trả lời lịch sự và khuyên người dùng liên hệ hotline.\n\n" .
            "Thông tin đào tạo:\n" . $trainingData;

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.3-70b-versatile', // Hoặc model Grok cụ thể bạn muốn dùng
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $userMessage],
                ],
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'reply' => $data['choices'][0]['message']['content']
                ]);
            }

            return response()->json(['error' => 'Lỗi từ API AI: ' . $response->body()], 502);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }
}
