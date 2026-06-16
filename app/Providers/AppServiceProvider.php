<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useTailwind();

        // Ép trình duyệt tải CSS/JS bằng HTTPS trên môi trường production (Render)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
