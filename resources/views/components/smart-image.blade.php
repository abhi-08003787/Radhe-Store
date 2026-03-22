{{-- Smart Image Component - Handles both Cloudinary URLs and local paths --}}
@props([
    'image' => null,
    'alt' => 'Image',
    'class' => '',
    'fallback' => 'https://res.cloudinary.com/demo/image/upload/v1/default-placeholder.jpg'
])

@php
    $imageUrl = $fallback;
    
    if ($image) {
        // Check if image is a full URL (Cloudinary)
        if (str_starts_with($image, 'http')) {
            $imageUrl = $image;
        }
        // Check if image is a local path
        else {
            $fullPath = storage_path('app/public/' . $image);
            if (file_exists($fullPath)) {
                $imageUrl = asset('storage/' . $image);
            }
        }
    }
@endphp

<img src="{{ $imageUrl }}" 
     alt="{{ $alt }}" 
     class="{{ $class }}" 
     onerror="this.src='{{ $fallback }}'" />
