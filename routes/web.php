<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\CampaignController as PublicCampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MidtransNotificationController;
use App\Http\Controllers\NewsController as PublicNewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Route Publik
|--------------------------------------------------------------------------
*/

Route::get(
    '/',
    [HomeController::class, 'index']
)->name('home');

Route::get(
    '/campaign',
    [PublicCampaignController::class, 'index']
)->name('campaigns.index');

Route::get(
    '/campaign/{campaign:slug}/donasi',
    [DonationController::class, 'create']
)->name('donations.create');

Route::post(
    '/campaign/{campaign:slug}/donasi',
    [DonationController::class, 'store']
)
    ->middleware('throttle:donation-submission')
    ->name('donations.store');

Route::get(
    '/donasi/{donation:invoice_number}/pembayaran',
    [DonationController::class, 'payment']
)->name('donations.payment');

Route::get(
    '/donasi/berhasil/{donation:invoice_number}',
    [DonationController::class, 'success']
)->name('donations.success');

Route::get(
    '/campaign/{campaign:slug}',
    [PublicCampaignController::class, 'show']
)->name('campaigns.show');

Route::get(
    '/berita',
    [PublicNewsController::class, 'index']
)->name('news.index');

Route::get(
    '/berita/{news:slug}',
    [PublicNewsController::class, 'show']
)->name('news.show');

/*
|--------------------------------------------------------------------------
| Webhook Midtrans
|--------------------------------------------------------------------------
*/

Route::post(
    '/midtrans/notification',
    [MidtransNotificationController::class, 'handle']
)->name('midtrans.notification');

/*
|--------------------------------------------------------------------------
| Route Halaman Statis
|--------------------------------------------------------------------------
*/

Route::get(
    '/tentang-kami',
    [PageController::class, 'about']
)->name('about');

Route::get(
    '/kontak',
    [PageController::class, 'contact']
)->name('contact');

/*
|--------------------------------------------------------------------------
| Route Reset Password
|--------------------------------------------------------------------------
*/

Route::get(
    '/admin/reset-password/{token}',
    [ForgotPasswordController::class, 'edit']
)
    ->middleware('guest')
    ->name('password.reset');


/*
|--------------------------------------------------------------------------
| Route Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        /*
        |--------------------------------------------------------------------------
        | Admin Belum Login
        |--------------------------------------------------------------------------
        */

        Route::middleware('guest')->group(function () {
            Route::get(
                '/login',
                [AuthController::class, 'showLogin']
            )->name('login');

            Route::post(
                '/login',
                [AuthController::class, 'login']
            )
                ->middleware('throttle:admin-login')
                ->name('login.process');

            Route::get(
                '/lupa-password',
                [ForgotPasswordController::class, 'create']
            )->name('password.request');

            Route::post(
                '/lupa-password',
                [ForgotPasswordController::class, 'store']
            )
                ->middleware('throttle:3,1')
                ->name('password.email');

            Route::post(
                '/reset-password',
                [ForgotPasswordController::class, 'update']
            )->name('password.update');
        });


        /*
        |--------------------------------------------------------------------------
        | Admin Sudah Login
        |--------------------------------------------------------------------------
        */

        Route::middleware(['auth', 'admin'])
            ->group(function () {
                Route::get(
                    '/dashboard',
                    [DashboardController::class, 'index']
                )->name('dashboard');

                Route::resource(
                    'categories',
                    CategoryController::class
                )->except('show');

                Route::resource(
                    'campaigns',
                    CampaignController::class
                )->except('show');

                Route::resource(
                    'news',
                    NewsController::class
                )->except('show');

                Route::get(
                    '/donations',
                    [AdminDonationController::class, 'index']
                )->name('donations.index');

                Route::get(
                    '/donations/{donation}',
                    [AdminDonationController::class, 'show']
                )->name('donations.show');

                Route::get(
                    '/donations/{donation}/payment-proof',
                    [AdminDonationController::class, 'paymentProof']
                )->name('donations.payment-proof');

                Route::patch(
                    '/donations/{donation}/status',
                    [
                        AdminDonationController::class,
                        'updateStatus',
                    ]
                )->name('donations.update-status');

                Route::get(
                    '/reports',
                    [ReportController::class, 'index']
                )->name('reports.index');

                Route::get(
                    '/reports/export',
                    [ReportController::class, 'export']
                )->name('reports.export');

                Route::get(
                    '/settings',
                    [SettingController::class, 'edit']
                )->name('settings.edit');

                Route::put(
                    '/settings',
                    [SettingController::class, 'update']
                )->name('settings.update');

                Route::get(
                    '/profile',
                    [ProfileController::class, 'edit']
                )->name('profile.edit');

                Route::put(
                    '/profile',
                    [ProfileController::class, 'update']
                )->name('profile.update');

                Route::post(
                    '/logout',
                    [AuthController::class, 'logout']
                )->name('logout');
            });
    });