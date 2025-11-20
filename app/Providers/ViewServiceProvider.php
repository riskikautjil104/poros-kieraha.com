<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Banner;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Share categories ke semua view
        View::composer('*', function ($view) {
            $globalCategories = Category::withCount('news')
                ->orderBy('name')
                ->get();
            
            $view->with('globalCategories', $globalCategories);
        });
        
        // Share active banners ke layout guest
        View::composer('layouts.guest', function ($view) {
            $activeBanners = Banner::active()->ordered()->get();
            $view->with('activeBanners', $activeBanners);
        });
    }
}