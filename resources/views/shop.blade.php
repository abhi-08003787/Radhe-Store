@extends('layouts.app')

@section('title', 'Shop - Radhe Store')

@section('content')
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
        <div class="flex flex-col gap-12">
            {{-- Header Section --}}
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8">
                <div class="max-w-2xl">
                    <p class="text-[11px] tracking-[0.25em] uppercase text-[#D4AF37] font-bold mb-3">Radhe Collections</p>
                    <h1 class="serif text-4xl sm:text-5xl text-[#2b0505]">
                        {{ isset($category) ? $category->name : 'Shop All Jewelry' }}
                    </h1>
                    <p class="mt-4 text-sm text-black/60 leading-relaxed">
                        @if(isset($category))
                            Discover our exquisite range of {{ $category->name }} — each piece is a masterpiece of heritage craftsmanship and royal elegance.
                        @else
                            Explore our full collection of heritage-inspired jewelry. From majestic bridal sets to delicate statement pieces, find the perfect reflection of your legacy.
                        @endif
                    </p>
                </div>

                <form class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-center" method="GET" action="{{ route('shop.index') }}">
                    <div class="relative group">
                        <input
                            type="search"
                            name="q"
                            value="{{ $search ?? request('q') }}"
                            placeholder="Search products..."
                            class="w-full sm:w-72 rounded-2xl border border-black/10 bg-white px-6 py-3.5 text-sm outline-none focus:border-[#D4AF37] transition-all shadow-sm group-hover:shadow-md"
                        />
                        <i class="bi bi-search absolute right-5 top-1/2 -translate-y-1/2 text-black/30 group-hover:text-[#D4AF37] transition-colors"></i>
                    </div>
                    <div class="flex gap-3">
                        <select name="sort" class="flex-1 sm:flex-none rounded-2xl border border-black/10 bg-white px-6 py-3.5 text-[10px] font-bold tracking-[0.2em] uppercase outline-none focus:border-[#D4AF37] transition-all cursor-pointer">
                            @php($sortValue = $sort ?? request('sort', 'newest'))
                            <option value="newest" @selected($sortValue === 'newest')>Newest First</option>
                            <option value="oldest" @selected($sortValue === 'oldest')>Oldest First</option>
                            <option value="price_asc" @selected($sortValue === 'price_asc')>Price: Low to High</option>
                            <option value="price_desc" @selected($sortValue === 'price_desc')>Price: High to Low</option>
                            <option value="name_asc" @selected($sortValue === 'name_asc')>Name: A–Z</option>
                            <option value="name_desc" @selected($sortValue === 'name_desc')>Name: Z–A</option>
                        </select>
                        <button type="submit" class="bg-[#2b0505] text-white px-8 py-3.5 text-[10px] font-bold tracking-[0.2em] uppercase rounded-2xl hover:bg-[#4a0a0a] transition-all transform active:scale-95">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[300px_minmax(0,1fr)] gap-12">
                {{-- Sidebar Filters --}}
                <aside class="hidden lg:block space-y-8">
                    <form action="{{ route('shop.index') }}" method="GET" class="sticky top-28 space-y-8">
                        <input type="hidden" name="q" value="{{ $search ?? request('q') }}">
                        <input type="hidden" name="sort" value="{{ $sort ?? request('sort', 'newest') }}">
                        <input type="hidden" name="category" value="{{ $activeCategory }}">
                        
                        {{-- Categories --}}
                        <div class="bg-white rounded-3xl border border-black/5 p-8 shadow-sm">
                            <h3 class="text-[11px] font-bold tracking-[0.25em] uppercase text-[#2b0505] mb-6">Categories</h3>
                            <div class="space-y-4">
                                <a href="{{ route('shop.index', array_merge(request()->query(), ['category' => null, 'page' => null])) }}" 
                                   class="flex items-center group no-underline {{ !$activeCategory ? 'text-[#b08d57] font-bold' : 'text-black/60' }} hover:text-[#b08d57] transition-colors">
                                    <span class="text-sm">All Categories</span>
                                </a>
                                @foreach(($availableCategories ?? collect()) as $cat)
                                    <a href="{{ route('shop.index', array_merge(request()->query(), ['category' => $cat, 'page' => null])) }}" 
                                       class="flex items-center group no-underline {{ $activeCategory === $cat ? 'text-[#b08d57] font-bold' : 'text-black/60' }} hover:text-[#b08d57] transition-colors">
                                        <span class="text-sm">{{ $cat }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Price Range --}}
                        <div class="bg-white rounded-3xl border border-black/5 p-8 shadow-sm">
                            <h3 class="text-[11px] font-bold tracking-[0.25em] uppercase text-[#2b0505] mb-6">Price Range</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <span class="text-[9px] font-bold uppercase tracking-widest text-black/30 ml-1">Min</span>
                                    <input type="number" name="min" value="{{ $min ?? request('min') }}" placeholder="0" class="w-full rounded-xl border border-black/10 bg-[#FCF9F5] px-4 py-3 text-sm outline-none focus:border-[#D4AF37] transition-colors">
                                </div>
                                <div class="space-y-2">
                                    <span class="text-[9px] font-bold uppercase tracking-widest text-black/30 ml-1">Max</span>
                                    <input type="number" name="max" value="{{ $max ?? request('max') }}" placeholder="99k+" class="w-full rounded-xl border border-black/10 bg-[#FCF9F5] px-4 py-3 text-sm outline-none focus:border-[#D4AF37] transition-colors">
                                </div>
                            </div>
                            <button type="submit" class="mt-6 w-full py-4 text-[10px] font-bold tracking-[0.2em] uppercase bg-[#2b0505] text-white rounded-2xl hover:bg-[#4a0a0a] transition-all">
                                Apply Range
                            </button>
                        </div>

                        <a href="{{ route('shop.index') }}" class="block text-center text-[10px] font-bold tracking-[0.25em] uppercase text-black/40 hover:text-[#D4AF37] transition-colors no-underline">
                            Reset All Filters
                        </a>
                    </form>
                </aside>

                {{-- Products Grid --}}
                <section>
                    <div class="flex items-center justify-between mb-8">
                        <p class="text-[10px] font-bold tracking-widest uppercase text-black/40">
                            Showing {{ $products->count() }} of {{ method_exists($products, 'total') ? $products->total() : $products->count() }} Masterpieces
                        </p>
                        <div class="lg:hidden">
                            {{-- Mobile Filter Toggle --}}
                            <button class="flex items-center gap-2 text-[10px] font-bold tracking-widest uppercase text-[#2b0505]">
                                <i class="bi bi-sliders"></i> Filters
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @forelse($products as $product)
                            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-black/5 group relative">
                                <div class="aspect-square overflow-hidden relative">
                                    <x-cloudinary-image :image="$product->image" :alt="$product->name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    @if($product->categoryRel)
                                        <div class="absolute top-3 left-3">
                                            <span class="bg-white/90 backdrop-blur-sm text-[#2b0505] text-[8px] font-bold uppercase tracking-widest px-2 py-1 rounded-full shadow-sm">
                                                {{ $product->categoryRel->name }}
                                            </span>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="bg-white text-[#2b0505] h-10 w-10 rounded-full flex items-center justify-center shadow-lg transform translate-y-10 group-hover:translate-y-0 transition-transform duration-500 hover:bg-[#D4AF37] hover:text-white">
                                                <i class="bi bi-cart-plus text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="p-4 text-center">
                                    <h5 class="serif text-sm text-[#2b0505] mb-2 font-medium leading-tight line-clamp-2">{{ $product->name }}</h5>
                                    <div class="flex items-center justify-center gap-2 mb-4">
                                        @if($product->sale_price)
                                            <span class="text-gray-400 text-xs line-through">₹{{ number_format($product->regular_price, 0) }}</span>
                                            <span class="text-[#D4AF37] font-bold text-sm">₹{{ number_format($product->sale_price, 0) }}</span>
                                        @else
                                            <span class="text-[#D4AF37] font-bold text-sm">₹{{ number_format($product->regular_price, 0) }}</span>
                                        @endif
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <form action="{{ route('cart.add') }}" method="POST" class="contents">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="py-2 text-[8px] font-bold tracking-[0.2em] uppercase bg-[#2b0505] text-white rounded-lg hover:bg-[#4a0a0a] transition-all">
                                                Add to Cart
                                            </button>
                                        </form>
                                        <a href="{{ route('product.details', $product->slug) }}" class="py-2 text-[8px] font-bold tracking-[0.2em] uppercase border border-black/10 text-black/60 rounded-lg hover:bg-black/5 transition-all no-underline flex items-center justify-center">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-black/10">
                                <i class="bi bi-search text-4xl text-black/10 mb-4 block"></i>
                                <h3 class="serif text-2xl text-black/30">No products found</h3>
                                <p class="text-black/40 text-sm mt-2">Try adjusting your filters or search terms.</p>
                                <a href="{{ route('shop.index') }}" class="mt-8 inline-block text-[10px] font-bold tracking-widest uppercase text-[#D4AF37] hover:underline">
                                    Clear all filters
                                </a>
                            </div>
                        @endforelse
                    </div>

                    @if (method_exists($products, 'links'))
                        <div class="mt-16">
                            {{ $products->links() }}
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const shopSwiper = new Swiper('.shop-swiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.shop-swiper-next',
                prevEl: '.shop-swiper-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 2,
                },
                1280: {
                    slidesPerView: 3,
                },
            }
        });

        // Add to Cart Function
        window.addToCart = function(productId) {
            fetch("{{ route('cart.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Product added to cart!');
                    // Update cart count in header if needed
                    const cartCountElement = document.querySelector('.cart-count');
                    if (cartCountElement) {
                        cartCountElement.innerText = data.cart_count;
                    }
                }
            });
        }
    });
</script>
@endpush
