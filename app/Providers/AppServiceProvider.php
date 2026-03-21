<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
    \Illuminate\Support\Facades\URL::forceScheme('https');

    // Very Important: Make sure Livewire temporary directory is not being used locally
    config(['livewire.temporary_file_upload.disk' => 'cloudinary']);
}
}
