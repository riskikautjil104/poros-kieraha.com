<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

// <?php

// use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\Admin\UserController;
// use App\Http\Controllers\Admin\CategoryController;
// use App\Http\Controllers\Admin\NewsController;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// // Admin & Penulis Routes
// Route::middleware(['auth', 'verified'])->group(function () {
    
//     // Dashboard
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
//     // Profile
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
//     // Admin Routes
//     Route::prefix('admin')->name('admin.')->group(function () {
        
//         // News - Admin & Penulis bisa akses
//         Route::resource('news', NewsController::class);
        
//         // Admin Only Routes
//         Route::middleware(['role:admin'])->group(function () {
//             Route::resource('users', UserController::class);
//             Route::resource('categories', CategoryController::class);
//         });
//     });
// });

// require __DIR__.'/auth.php';
// <?php

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
// ============================================
// 🌐 FRONTEND PUBLIC ROUTES (Bisa Diakses Semua Orang)
// ============================================
Route::middleware('security.headers')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
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
Route::middleware(['auth', 'rate.limit.comments'])->group(function () {
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
Route::middleware(['auth', 'verified', 'role:admin,penulis'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Admin Routes (Admin & Penulis)
Route::middleware(['auth', 'role:admin,penulis'])->prefix('admin')->name('admin.')->group(function () {
    
    // News (Admin & Penulis bisa akses)
    Route::resource('news', NewsController::class);

    Route::resource('tags', TagController::class);
    
    // Categories (Admin Only)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('categories', CategoryController::class);
    });
    
    // Users (Admin Only)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('banners', \App\Http\Controllers\Admin\BannerController::class);
        Route::resource('ads', AdController::class);
    Route::get('ads/{ad}/click', [AdController::class, 'click'])->name('ads.click');
    });
});

Route::get('/ad/{ad}/click', [AdController::class, 'click'])->name('ad.click');

require __DIR__.'/auth.php';
