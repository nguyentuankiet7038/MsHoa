<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MarketingCampaign;
use App\Models\MarketingTemplate;
use App\Models\User;
use App\Mail\CampaignMail;
use Illuminate\Support\Facades\Mail;

class MarketingController extends Controller
{
    public function index() {
        $campaigns = MarketingCampaign::latest()->get();
        $templates = MarketingTemplate::all();
        
        $activeSubscribers = User::where('role', 'student')->count();
        $avgOpenRate = MarketingCampaign::whereNotNull('open_rate')->avg('open_rate') ?? 0;
        $avgClickRate = MarketingCampaign::whereNotNull('click_rate')->avg('click_rate') ?? 0;

        return view('admin.marketing.index', compact(
            'campaigns', 
            'templates', 
            'activeSubscribers', 
            'avgOpenRate', 
            'avgClickRate'
        ));
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Promotion,Educational,Newsletter',
            'status' => 'required|in:Sent,Drafting,Scheduled',
        ]);

        MarketingCampaign::create($validated);

        return redirect()->back()->with('success', 'Campaign created successfully.');
    }

    public function update(Request $request, MarketingCampaign $campaign) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Promotion,Educational,Newsletter',
            'status' => 'required|in:Sent,Drafting,Scheduled',
        ]);

        $campaign->update($validated);

        return redirect()->back()->with('success', 'Campaign updated successfully.');
    }

    public function destroy(MarketingCampaign $campaign) {
        $campaign->delete();
        return redirect()->back()->with('success', 'Campaign deleted successfully.');
    }

    public function broadcast(Request $request, MarketingCampaign $campaign) {
        $templateId = $request->input('template_id');
        $template = $templateId ? MarketingTemplate::find($templateId) : null;
        
        $students = User::where('role', 'student')->get();
        
        if ($students->isEmpty()) {
            return redirect()->back()->with('error', 'No students found to send emails to.');
        }

        foreach ($students as $student) {
            Mail::to($student->email)->send(new CampaignMail($campaign, $template));
        }

        $campaign->update([
            'status' => 'Sent',
            'sent_at' => now(),
            'recipients' => $students->count(),
        ]);

        if ($template) {
            $template->update(['last_used_at' => now()]);
        }

        return redirect()->back()->with('success', 'Broadcast sent successfully to ' . $students->count() . ' students.');
    }
}
