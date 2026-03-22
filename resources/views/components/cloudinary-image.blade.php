{{-- Display Cloudinary images with fallback --}}
@if($product->image)
    <img src="{{ $product->image }}" 
         alt="{{ $product->name }}" 
         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
         onerror="this.src='https://res.cloudinary.com/demo/image/upload/v1/default-product.jpg'" />
@else
    <img src="https://res.cloudinary.com/demo/image/upload/v1/default-product.jpg" 
         alt="{{ $product->name }}" 
         class="w-full h-full object-cover" />
@endif

{{-- Category Image Display --}}
@if($category->image)
    <img src="{{ $category->image }}" 
         alt="{{ $category->name }}" 
         class="w-full h-full object-cover" 
         onerror="this.src='https://res.cloudinary.com/demo/image/upload/v1/default-category.jpg'" />
@else
    <img src="https://res.cloudinary.com/demo/image/upload/v1/default-category.jpg" 
         alt="{{ $category->name }}" 
         class="w-full h-full object-cover" />
@endif
