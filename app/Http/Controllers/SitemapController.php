<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML sitemap.
     */
    public function index(): Response
    {
        $news = News::published()->latest('published_at')->get();
        $categories = Category::all();

        return response()->view('sitemap', compact('news', 'categories'))
            ->header('Content-Type', 'text/xml');
    }
}
