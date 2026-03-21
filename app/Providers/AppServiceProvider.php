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

    // Force Cloudinary settings at runtime for Render deployment
    config([
        'filesystems.default' => 'cloudinary',
        'filesystems.disks.cloudinary.driver' => 'cloudinary',
        'filesystems.disks.cloudinary.cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'filesystems.disks.cloudinary.api_key' => env('CLOUDINARY_API_KEY'),
        'filesystems.disks.cloudinary.api_secret' => env('CLOUDINARY_API_SECRET'),
        'filesystems.disks.cloudinary.url' => env('CLOUDINARY_URL'),
        'livewire.temporary_file_upload.disk' => 'cloudinary',
        'livewire.temporary_file_upload.rules' => 'file|max:20480',
        'livewire.temporary_file_upload.max_upload_time' => 10,
    ]);
}
}
