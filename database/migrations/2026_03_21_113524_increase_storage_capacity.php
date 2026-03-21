<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update filesystem configuration for increased storage capacity
        config([
            'filesystems.disks.cloudinary.max_size' => 20480, // 20MB
            'livewire.temporary_file_upload.max_upload_time' => 10, // 10 minutes
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
