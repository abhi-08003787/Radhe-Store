@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-[#D4AF37] to-[#b88a2b] px-6 py-8">
                <h1 class="text-3xl font-bold text-white">My Dashboard</h1>
                <p class="text-white/90 mt-2">Welcome back, {{ $user->name }}!</p>
            </div>
            
            <!-- Content -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Profile Information -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Profile Information</h2>
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm text-gray-500">Name</span>
                                <p class="text-gray-900 font-medium">{{ $user->name }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Email</span>
                                <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Member Since</span>
                                <p class="text-gray-900 font-medium">{{ $user->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Orders -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Recent Orders</h2>
                        @if($orders->count() > 0)
                            <div class="space-y-3">
                                @foreach($orders as $order)
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <p class="text-xs text-gray-500 mb-1">Order ID / Order Number</p>
                                                <p class="font-medium text-gray-900">{{ $order->id }}</p>
                                                <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-medium text-gray-900">₹{{ number_format($order->total_amount, 2) }}</p>
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                                       ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                       'bg-gray-100 text-gray-800') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">You haven't placed any orders yet.</p>
                        @endif
                    </div>
                </div>
                
                <!-- Help & Support Section -->
                <div class="mt-8">
                    <div class="bg-gradient-to-r from-[#FCF9F5] to-[#f6e4a6] rounded-lg p-6 border border-[#D4AF37]/20">
                        <h2 class="text-xl font-semibold text-[#2b0505] mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Help & Support
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Track Order -->
                            <a href="{{ route('order.track') }}" class="bg-white rounded-lg p-4 border border-gray-200 hover:border-[#D4AF37] hover:shadow-md transition-all group">
                                <div class="flex items-center mb-3">
                                    <div class="w-10 h-10 bg-[#D4AF37]/10 rounded-lg flex items-center justify-center group-hover:bg-[#D4AF37]/20 transition-colors">
                                        <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">Track Order</h3>
                                <p class="text-sm text-gray-600">Check your order status</p>
                            </a>

                            <!-- Shipping Info -->
                            <a href="{{ route('page.show', 'shipping-info') }}" class="bg-white rounded-lg p-4 border border-gray-200 hover:border-[#D4AF37] hover:shadow-md transition-all group">
                                <div class="flex items-center mb-3">
                                    <div class="w-10 h-10 bg-[#D4AF37]/10 rounded-lg flex items-center justify-center group-hover:bg-[#D4AF37]/20 transition-colors">
                                        <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">Shipping Info</h3>
                                <p class="text-sm text-gray-600">Delivery details & times</p>
                            </a>

                            <!-- Return Policy -->
                            <a href="{{ route('page.show', 'return-policy') }}" class="bg-white rounded-lg p-4 border border-gray-200 hover:border-[#D4AF37] hover:shadow-md transition-all group">
                                <div class="flex items-center mb-3">
                                    <div class="w-10 h-10 bg-[#D4AF37]/10 rounded-lg flex items-center justify-center group-hover:bg-[#D4AF37]/20 transition-colors">
                                        <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">Return Policy</h3>
                                <p class="text-sm text-gray-600">Returns & refunds info</p>
                            </a>

                            <!-- FAQ -->
                            <a href="{{ route('page.show', 'faq') }}" class="bg-white rounded-lg p-4 border border-gray-200 hover:border-[#D4AF37] hover:shadow-md transition-all group">
                                <div class="flex items-center mb-3">
                                    <div class="w-10 h-10 bg-[#D4AF37]/10 rounded-lg flex items-center justify-center group-hover:bg-[#D4AF37]/20 transition-colors">
                                        <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">FAQ</h3>
                                <p class="text-sm text-gray-600">Frequently asked questions</p>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('shop.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#D4AF37] hover:bg-[#b88a2b] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4AF37]">
                        Continue Shopping
                    </a>
                    <a href="{{ route('cart.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4AF37]">
                        View Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
