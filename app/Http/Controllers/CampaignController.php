<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        $campaigns = Campaign::with('category')
            ->withSum([
                'donations as collected_amount' => function ($query) {
                    $query->where('payment_status', 'paid');
                }
            ], 'amount')
            ->where('status', 'published')
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->category, function ($query, $category) {
                $query->whereHas('category', function ($query) use ($category) {
                    $query->where('slug', $category);
                });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view(
            'frontend.campaigns.index',
            compact('campaigns', 'categories')
        );
    }

    public function show(Campaign $campaign)
    {
        abort_unless(
            $campaign->status === 'published',
            404
        );

        $campaign->load([
            'category',
            'paidDonations' => function ($query) {
                $query->latest()->limit(10);
            }
        ]);

        $collectedAmount = $campaign->paidDonations()
            ->sum('amount');

        $progressPercentage = $campaign->target_amount > 0
            ? min(
                ($collectedAmount / $campaign->target_amount) * 100,
                100
            )
            : 0;

        return view(
            'frontend.campaigns.show',
            compact(
                'campaign',
                'collectedAmount',
                'progressPercentage'
            )
        );
    }
}