<?php

namespace App\Http\Controllers;

use App\Models\Founder;

class PageController extends Controller
{
    public function about()
    {
        $founders = Founder::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'frontend.pages.about',
            compact('founders')
        );
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }
}