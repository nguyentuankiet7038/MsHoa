<!DOCTYPE html>
<html>
<head>
    <title>{{ $campaign->name }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        @if($template && $template->thumbnail_url)
            <img src="{{ $template->thumbnail_url }}" alt="{{ $template->name }}" style="width: 100%; border-radius: 10px 10px 0 0; margin-bottom: 20px;">
        @endif
        
        <h2 style="color: #4f378a;">{{ $campaign->name }}</h2>
        
        <p>Chào bạn,</p>
        
        <p>Chúng tôi có một thông báo mới dành cho bạn:</p>
        
        <div style="background-color: #f2ecf4; padding: 15px; border-left: 4px solid #4f378a; margin: 20px 0;">
            <strong>{{ $campaign->name }}</strong>
            <p>Loại chiến dịch: {{ $campaign->type }}</p>
        </div>

        <p>Để biết thêm chi tiết, vui lòng truy cập trang web của chúng tôi hoặc liên hệ bộ phận hỗ trợ.</p>
        
        <p>Trân trọng,<br>
        <strong>Đội ngũ Ms. Hoa English</strong></p>
        
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 12px; color: #777; text-align: center;">
            © 2024 Ms. Hoa English Center. All rights reserved.
        </p>
    </div>
</body>
</html>
