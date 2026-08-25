<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news = News::with('author')
            ->where('status', 'published')
            ->when($request->search, function ($query, $search) {
                $query->where(
                    'title',
                    'like',
                    "%{$search}%"
                );
            })
            ->orderByDesc('published_at')
            ->paginate(9)
            ->withQueryString();

        return view(
            'frontend.news.index',
            compact('news')
        );
    }

    public function show(News $news)
    {
        abort_unless(
            $news->status === 'published',
            404
        );

        $news->load('author');

        $otherNews = News::where(
                'status',
                'published'
            )
            ->where('id', '!=', $news->id)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view(
            'frontend.news.show',
            compact('news', 'otherNews')
        );
    }
}