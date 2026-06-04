<?php

namespace App\Http\Controllers\Public;

use App\Models\News;
use Illuminate\View\View;

class NewsController
{
    public function index(): View
    {
        $news = News::where('status', 'published')->latest()->paginate(9);
        return view('public.news.index', compact('news'));
    }

    public function show(string $slug): View
    {
        $news = News::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('public.news.show', compact('news'));
    }
}
