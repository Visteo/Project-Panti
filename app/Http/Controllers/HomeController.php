<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\News;
use App\Models\Setting;
use App\Models\Event;
use App\Models\Founder;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCampaigns = Campaign::with('category')
            ->withSum([
                'donations as collected_amount' => function ($query) {
                    $query->where('payment_status', 'paid');
                },
            ], 'amount')
            ->where('status', 'published')
            ->orderByDesc('is_featured')
            ->latest()
            ->limit(6)
            ->get();

        $statistics = [
            'campaigns' => Campaign::where(
                'status',
                'published'
            )->count(),

            'donations' => Donation::where(
                'payment_status',
                'paid'
            )->count(),

            'collected' => Donation::where(
                'payment_status',
                'paid'
            )->sum('amount'),
        ];

        $latestNews = News::where(
                'status',
                'published'
            )
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        $setting = Setting::first();

        $latestEvents = Event::published()
        ->orderByDesc('is_featured')
        ->orderByDesc('event_date')
        ->limit(3)
        ->get();

        $founders = Founder::active()
        ->ordered()
        ->limit(6)
        ->get();
        
        return view(
            'frontend.home',
            compact(
                'featuredCampaigns',
                'statistics',
                'latestNews',
                'setting',
                'latestEvents',
                'founders'
            )
        );
    }
}