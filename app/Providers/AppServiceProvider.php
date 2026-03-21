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
    // HTTPS ફોર્સ કરવા માટે
    \Illuminate\Support\Facades\URL::forceScheme('https');

    // ગમે તે થાય, સ્ટોરેજ ક્લાઉડિનરી જ રહેવું જોઈએ
    config([
        'filesystems.default' => 'cloudinary',
        'filesystems.disks.cloudinary.driver' => 'cloudinary',
        'livewire.temporary_file_upload.disk' => 'cloudinary',
    ]);
}
}
