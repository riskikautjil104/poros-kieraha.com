<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsPublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\SitemapController;
// ============================================
// 🌐 FRONTEND PUBLIC ROUTES (Bisa Diakses Semua Orang)
// ============================================
Route::middleware(['security.headers', 'track.visitor'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
    Route::get('/berita', [NewsPublicController::class, 'index'])->name('news.index');
    Route::get('/berita/{news:slug}', [NewsPublicController::class, 'show'])->name('news.show');
    Route::get('/kategori/{category:slug}', [NewsPublicController::class, 'category'])->name('news.category');
    Route::get('/cari', [NewsPublicController::class, 'search'])->name('news.search');


    // Newsletter Routes
    Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');
    Route::post('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
});


Route::get('/welcome', function () {
    return view('welcome');
});

// Comment Routes (harus login)
Route::middleware(['auth', 'rate.limit.comments', 'is.verified'])->group(function () {
    Route::post('/berita/{news}/comment', [NewsPublicController::class, 'storeComment'])->name('news.comment');
});


// ============================================
// 🔐 ADMIN & AUTH ROUTES
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard (Admin & Penulis only)
Route::middleware(['auth', 'is.verified', 'role:admin,penulis'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Proteksi agar user yang belum verified tidak diarahkan ke home setelah login
// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', function () {
//         return redirect()->route('home');
//     });
// });



// Admin Routes (Admin & Penulis)
Route::middleware(['auth', 'is.verified', 'role:admin,penulis'])->prefix('admin')->name('admin.')->group(function () {

    // News (Admin & Penulis bisa akses)
    Route::resource('news', NewsController::class);

    Route::resource('tags', TagController::class);

    // YouTube Videos (Admin saja)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('youtube-videos', \App\Http\Controllers\Admin\YoutubeVideoController::class);
    });

    // Categories (Admin Only)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('categories', CategoryController::class);
    });

    // Partners (Admin Only)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);
    });

    // Users (Admin Only)

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/verify', [UserController::class, 'verify'])->name('users.verify');
        Route::resource('banners', \App\Http\Controllers\Admin\BannerController::class);
        Route::resource('ads', AdController::class);
        Route::get('ads/{ad}/click', [AdController::class, 'click'])->name('ads.click');
    });
});

Route::get('/ad/{ad}/click', [AdController::class, 'click'])->name('ad.click');

require __DIR__ . '/auth.php';
