<?php

namespace App\Providers;

// PENTING: Jangan lupa tambahkan baris import ini
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        // Memaksa skema HTTPS jika aplikasi tidak berjalan di environment 'local'
        // Ini sangat penting agar CSS/JS terbaca dengan benar di Vercel
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}