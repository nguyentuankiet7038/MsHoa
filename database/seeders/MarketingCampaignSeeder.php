<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketingCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MarketingCampaign::create([
            'name' => 'IELTS Foundation - New Intake',
            'type' => 'Newsletter',
            'status' => 'Sent',
            'recipients' => 4200,
            'open_rate' => 28.5,
            'click_rate' => 5.2,
            'sent_at' => now()->subDays(2),
        ]);

        \App\Models\MarketingCampaign::create([
            'name' => 'Summer Promotion 2024',
            'type' => 'Promotion',
            'status' => 'Drafting',
            'recipients' => 8500,
            'open_rate' => null,
            'click_rate' => null,
        ]);

        \App\Models\MarketingCampaign::create([
            'name' => 'Weekly English Tips #14',
            'type' => 'Educational',
            'status' => 'Sent',
            'recipients' => 12102,
            'open_rate' => 22.1,
            'click_rate' => 3.8,
            'sent_at' => now()->subDays(7),
        ]);

        \App\Models\MarketingCampaign::create([
            'name' => 'Back to School 2024',
            'type' => 'Promotion',
            'status' => 'Scheduled',
            'recipients' => 15000,
            'open_rate' => null,
            'click_rate' => null,
            'scheduled_at' => now()->addDays(14),
        ]);
    }
}
