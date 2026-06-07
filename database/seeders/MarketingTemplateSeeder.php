<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketingTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MarketingTemplate::create([
            'name' => 'Minimalist Update',
            'thumbnail_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDsZJkLZYLD7A-zhJAZ6IN5eTIsjer4T24pdjuDMok5fKiXu6fM3b2c2bL216t_Rq12m_xUsS1YBZb-l04xaiCUANc4SxU1h0wv5SggyWKMCkIGXrjmVTIpIVNUdZ6_NG9JCLR5-ZQCC9JUPHLlzJ5UfSlAW_-IQ2u0sHHDwnr68u0TjP4FnDXE8jAGwn_ees-FgCEK7AMITo_uQMGu4qs2I8jVCQb5kJCUxAOhFDQeHYiZUzt0jTV9U0zfnspDYzOQs9OElXt6yYM',
            'category' => 'Newsletter',
            'last_used_at' => now()->subDays(2),
        ]);

        \App\Models\MarketingTemplate::create([
            'name' => 'Flash Sale Promo',
            'thumbnail_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuABNOiqOqlWAjseVQoMjqGcbHduySGsVYuBZcsmijL3kikpCLlvaYOR1UIKFt5zLzczWUfYQfRxn2G4b4rbZZHJFOHYs4VazFuj3ITKy5fOLrU6YFN-Gal6Z2d2bCxqHcB1M_yO2-vB4RaQdYSK5EpsUDYGGiv5YJEiTNsnfUx6U0dFJ7nXlByeCpI5YMPThVvm4Nl4dEohax18B7Sz8gMNGsgp5prBcJFATcRAb2EX7LtN_TVysx2828XTaGzioksY8lQ52YfnthA',
            'category' => 'Promotion',
            'last_used_at' => now()->subWeeks(1),
        ]);

        \App\Models\MarketingTemplate::create([
            'name' => 'Weekly Knowledge',
            'thumbnail_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBr0Ty4WXenJsymzvPIJP80ZlKjC1bjZOsxVwpCuoX8nj7jvUAmLjkeGnioR8RTGeQNB1jqWwFaFivI5w4u6ypK7JECjJwFXiZLm4HF9JISaLTvf4I5g2x0QbemGh6DIWYebRnWHXuHoObnolH9zRRe51SarRBpugdP7801i1nHaS2gt23Ld1klggBDq73CwgL1h2LXc7tCidJHvctRQ48CW3EV-cCMMWASwQtBE3Vo6q0tavE789TLgmkhM8y8zDQak9xicKg0Qe8',
            'category' => 'Educational',
            'last_used_at' => null,
        ]);
    }
}
