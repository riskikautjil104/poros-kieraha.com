<?php

use App\Http\Controllers\Api\V1\AdController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\MiscellaneousController;
use App\Http\Controllers\Api\V1\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mobile REST API Routes
|--------------------------------------------------------------------------
|
| Base URL Prefix: /apikuporos (configured in bootstrap/app.php)
| Full Version 1 Prefix: /apikuporos/v1/...
|
*/

Route::prefix('v1')->middleware(['track.visitor'])->group(function () {

    // 1. All-in-one Home Feed
    Route::get('/home', [HomeController::class, 'index'])->name('api.v1.home');

    // 2. News Articles
    Route::get('/news', [NewsController::class, 'index'])->name('api.v1.news.index');
    Route::get('/news/{slug}', [NewsController::class, 'show'])->name('api.v1.news.show');

    // 3. Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('api.v1.categories.index');
    Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('api.v1.categories.show');

    // 4. Tags
    Route::get('/tags', [MiscellaneousController::class, 'tags'])->name('api.v1.tags');

    // 5. Ads & Banners
    Route::get('/ads', [AdController::class, 'index'])->name('api.v1.ads.index');
    Route::post('/ads/{id}/click', [AdController::class, 'click'])->name('api.v1.ads.click');

    // 6. Comments
    Route::get('/news/{slug}/comments', [CommentController::class, 'index'])->name('api.v1.comments.index');
    Route::post('/news/{slug}/comments', [CommentController::class, 'store'])->name('api.v1.comments.store');

    // 7. Multimedia & Partners
    Route::get('/videos', [MiscellaneousController::class, 'videos'])->name('api.v1.videos');
    Route::get('/partners', [MiscellaneousController::class, 'partners'])->name('api.v1.partners');

    // 8. Newsletter
    Route::post('/newsletter', [MiscellaneousController::class, 'newsletter'])->name('api.v1.newsletter');

    // 9. Public Stats & Client Connection Info
    Route::get('/stats', [MiscellaneousController::class, 'stats'])->name('api.v1.stats');

    // 10. Authentication (Mobile App)
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('api.v1.auth.login');
        Route::post('/register', [AuthController::class, 'register'])->name('api.v1.auth.register');
        Route::post('/google', [AuthController::class, 'googleLogin'])->name('api.v1.auth.google');
        Route::get('/me', [AuthController::class, 'me'])->name('api.v1.auth.me');
        Route::post('/logout', [AuthController::class, 'logout'])->name('api.v1.auth.logout');
    });
});
