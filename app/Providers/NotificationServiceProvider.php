<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Menggunakan View Composer untuk mengirim data notifikasi ke header
        View::composer('layouts.partials.header', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $notifications = collect(); // Membuat koleksi kosong
                $notificationCount = 0;

                // Logika notifikasi untuk Admin dan Manajer
                if (in_array($user->role, ['admin', 'manager'])) {
                    $notifications = Product::whereColumn('stock', '<=', 'minimum_stock')->get();
                    $notificationCount = $notifications->count();
                }

                // Logika notifikasi untuk Staff
                elseif ($user->role === 'staff') {
                    $notifications = StockTransaction::where('status', 'pending')->get();
                    $notificationCount = $notifications->count();
                }

                $view->with(compact('notifications', 'notificationCount'));
            }
        });
    }
}