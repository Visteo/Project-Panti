<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;

class DashboardController extends Controller
{
    public function index()
    {
        $statistics = [
            'campaigns' => Campaign::count(),

            'active_campaigns' => Campaign::where(
                'status',
                'published'
            )->count(),

            'donations' => Donation::count(),

            'collected_amount' => Donation::where(
                'payment_status',
                'paid'
            )->sum('amount'),
        ];

        $latestDonations = Donation::with('campaign')
            ->latest()
            ->limit(5)
            ->get();

        return view(
            'admin.dashboard',
            compact('statistics', 'latestDonations')
        );
    }
}