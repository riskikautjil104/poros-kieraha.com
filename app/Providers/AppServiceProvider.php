<?php

namespace App\Providers;
use App\Models\Category;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('frontend.layout', function ($view) {
            $globalCategories = Category::withCount([
                'news' => function($query) {
                    $query->published();
                }
            ])
            ->having('news_count', '>', 0)
            ->orderBy('news_count', 'desc')
            ->get();
            $view->with('globalCategories', $globalCategories);
        });
    }
}
