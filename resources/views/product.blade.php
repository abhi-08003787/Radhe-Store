@extends('layouts.app')

@section('title', $product->name . ' - Radhe Store')

@section('content')
<div class="bg-[#FCF9F5]">
    {{-- Breadcrumb --}}
    <div class="container mx-auto px-4 py-4">
        <nav class="text-sm">
            <a href="{{ route('home') }}" class="text-black/60 hover:text-[#D4AF37]">Home</a>
            <span class="mx-2 text-black/30">/</span>
            <a href="{{ route('shop.index') }}" class="text-black/60 hover:text-[#D4AF37]">Shop</a>
            <span class="mx-2 text-black/30">/</span>
            <span class="text-[#2b0505]">{{ $product->name }}</span>
        </nav>
    </div>

    {{-- Product Details --}}
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Product Image --}}
            <div class="relative">
                <div class="aspect-[4/5] rounded-3xl overflow-hidden bg-white shadow-lg">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1610216705422-caa3fcb6d158?auto=format&fit=crop&q=80&w=1000' }}" 
                         class="w-full h-full object-cover" 
                         alt="{{ $product->name }}">
                </div>
                @if($product->categoryRel)
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-sm text-[#2b0505] text-[9px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-full shadow-sm">
                            {{ $product->categoryRel->name }}
                        </span>
                    </div>
                @endif
            </div>

            {{-- Product Info --}}
            <div class="space-y-6">
                <div>
                    <h1 class="serif text-3xl md:text-4xl text-[#2b0505] mb-4">{{ $product->name }}</h1>
                    <div class="flex items-center gap-3 mb-4">
                        @if($product->sale_price)
                            <span class="text-black/30 text-lg line-through">₹{{ number_format($product->regular_price, 0) }}</span>
                            <span class="text-[#D4AF37] text-2xl font-bold">₹{{ number_format($product->sale_price, 0) }}</span>
                        @else
                            <span class="text-[#D4AF37] text-2xl font-bold">₹{{ number_format($product->regular_price, 0) }}</span>
                        @endif
                    </div>
                    <p class="text-black/60 leading-relaxed">{{ $product->description }}</p>
                </div>

                {{-- Add to Cart --}}
                <div class="pt-6 border-t border-black/10">
                    <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="flex items-center gap-4">
                            <label class="text-sm font-semibold text-[#2b0505]">Quantity:</label>
                            <div class="flex items-center border border-black/10 rounded-xl overflow-hidden">
                                <button type="button" onclick="this.parentElement.querySelector('input').stepDown()" class="px-4 py-2 bg-white hover:bg-gray-50 transition-colors">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}" class="w-16 text-center border-x border-black/10 py-2 outline-none">
                                <button type="button" onclick="this.parentElement.querySelector('input').stepUp()" class="px-4 py-2 bg-white hover:bg-gray-50 transition-colors">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 bg-[#2b0505] text-white rounded-2xl font-bold tracking-widest uppercase hover:bg-[#4a0a0a] transition-all transform hover:-translate-y-0.5 shadow-lg">
                            Add to Cart
                        </button>
                    </form>
                </div>

                {{-- Product Specifications --}}
                @if($product->style_id || $product->sla_days || $product->hsn_code || $product->weight || $product->gst_percentage)
                <div class="pt-6 border-t border-black/10">
                    <h3 class="text-lg font-bold text-[#2b0505] mb-4">Product Specifications</h3>
                    <div class="bg-white rounded-2xl border border-black/5 overflow-hidden">
                        <table class="w-full">
                            <tbody>
                                @if($product->style_id)
                                <tr class="border-b border-black/5">
                                    <td class="px-6 py-4 text-sm text-black/60 font-medium w-1/3">Style ID</td>
                                    <td class="px-6 py-4 text-sm text-[#2b0505] font-semibold">{{ $product->style_id }}</td>
                                </tr>
                                @endif
                                
                                @if($product->sla_days)
                                <tr class="border-b border-black/5">
                                    <td class="px-6 py-4 text-sm text-black/60 font-medium w-1/3">Dispatch Time (SLA)</td>
                                    <td class="px-6 py-4 text-sm text-[#2b0505] font-semibold">{{ $product->sla_days }} Days</td>
                                </tr>
                                @endif
                                
                                @if($product->hsn_code)
                                <tr class="border-b border-black/5">
                                    <td class="px-6 py-4 text-sm text-black/60 font-medium w-1/3">HSN Code</td>
                                    <td class="px-6 py-4 text-sm text-[#2b0505] font-semibold">{{ $product->hsn_code }}</td>
                                </tr>
                                @endif
                                
                                @if($product->weight)
                                <tr class="border-b border-black/5">
                                    <td class="px-6 py-4 text-sm text-black/60 font-medium w-1/3">Weight</td>
                                    <td class="px-6 py-4 text-sm text-[#2b0505] font-semibold">{{ number_format($product->weight, 2) }}g</td>
                                </tr>
                                @endif
                                
                                @if($product->gst_percentage)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-black/60 font-medium w-1/3">GST</td>
                                    <td class="px-6 py-4 text-sm text-[#2b0505] font-semibold">{{ number_format($product->gst_percentage, 2) }}%</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                {{-- Product Meta --}}
                <div class="pt-6 border-t border-black/10 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-black/60">SKU:</span>
                        <span class="font-semibold text-[#2b0505]">{{ $product->SKU }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-black/60">Stock Status:</span>
                        <span class="font-semibold {{ $product->stock_status === 'instock' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock_status === 'instock' ? 'In Stock' : 'Out of Stock' }}
                        </span>
                    </div>
                    @if($product->quantity > 0)
                        <div class="flex justify-between text-sm">
                            <span class="text-black/60">Available:</span>
                            <span class="font-semibold text-[#2b0505]">{{ $product->quantity }} items</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <div class="container mx-auto px-4 py-12 border-t border-black/10">
            <h2 class="serif text-2xl text-[#2b0505] mb-8">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    @include('partials.product-card', ['product' => $relatedProduct])
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
