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

    // Complete Cloudinary bypass - override all environment issues
    config([
        'livewire.temporary_file_upload.disk' => 'cloudinary',
        'filesystems.default' => 'cloudinary',
        'filesystems.disks.cloudinary.driver' => 'cloudinary',
        'filesystems.disks.cloudinary.cloud_name' => env('CLOUDINARY_CLOUD_NAME', 'default_cloud'),
        'filesystems.disks.cloudinary.api_key' => env('CLOUDINARY_API_KEY', 'default_key'),
        'filesystems.disks.cloudinary.api_secret' => env('CLOUDINARY_API_SECRET', 'default_secret'),
        'filesystems.disks.cloudinary.url' => env('CLOUDINARY_URL', 'cloudinary://default_key:default_secret@default_cloud'),
    ]);
}
}
