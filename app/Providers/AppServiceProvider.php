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
        config(['livewire.temporary_file_upload.disk' => 'cloudinary']);
        config(['filesystems.default' => 'cloudinary']);
        \Illuminate\Support\Facades\URL::forceScheme('https');
    }
}
