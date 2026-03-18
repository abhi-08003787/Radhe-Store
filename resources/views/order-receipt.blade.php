@extends('layouts.app')

@section('title', 'Order Receipt - Radhe Store')

@section('content')
<div class="bg-[#FCF9F5] min-h-screen py-20 flex items-center justify-center">
    <div class="mx-auto max-w-4xl px-4">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl shadow-green-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="serif text-4xl text-[#2b0505] mb-3">Payment Received</h1>
            <p class="text-[11px] text-green-600 font-bold tracking-[0.3em] uppercase">Order Under Verification</p>
            <p class="text-gray-600 mb-8">Thank you for your payment! Your order has been received and is being verified.</p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-black/[0.03] border border-black/5 overflow-hidden">
            <div class="p-8 md:p-12">
                <!-- Order Header -->
                <div class="flex items-center justify-between mb-8 pb-6 border-b border-black/5">
                    <div>
                        <span class="text-[10px] font-bold tracking-widest uppercase text-black/20 block mb-1">Order Number</span>
                        <span class="text-sm font-bold text-[#2b0505]">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] font-bold tracking-widest uppercase text-black/20 block mb-1">Date & Time</span>
                        <span class="text-sm font-bold text-[#2b0505]">{{ $order->created_at->format('M d, Y - h:i A') }}</span>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="bg-green-50 p-6 rounded-lg mb-8 border border-green-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="serif text-xl text-[#2b0505] mb-2">Payment Information</h3>
                            <div class="space-y-2">
                                <div class="flex items-center gap-3">
                                    <span class="text-sm text-gray-600">Payment Method:</span>
                                    <span class="font-bold text-[#2b0505]">
                                        <span class="inline-flex items-center gap-2">
                                            <svg class="w-4 h-4 text-[#D4AF37]" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8-3.59 8-8 8zm-2-13.5v6l5.25 3.15.75.45L13 14.5v-8z"/>
                                            </svg>
                                            PhonePe / UPI
                                        </span>
                                    </span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-sm text-gray-600">Transaction ID:</span>
                                    <span class="font-mono font-bold text-[#D4AF37]">{{ $order->transaction_id }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-sm text-gray-600">Amount Paid:</span>
                                    <span class="font-bold text-[#D4AF37]">₹{{ number_format($order->total_amount, 0) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-bold">
                                ✓ Payment Received
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="mb-8">
                    <h3 class="serif text-xl text-[#2b0505] mb-4">Customer Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Name</p>
                            <p class="font-bold text-[#2b0505]">{{ $order->shipping_address['first_name'] }} {{ $order->shipping_address['last_name'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Email</p>
                            <p class="font-bold text-[#2b0505]">{{ $order->shipping_address['email'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Phone</p>
                            <p class="font-bold text-[#2b0505]">{{ $order->shipping_address['phone'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Shipping Address</p>
                            <p class="font-bold text-[#2b0505]">{{ $order->shipping_address['address'] }}, {{ $order->shipping_address['city'] }}, {{ $order->shipping_address['state'] }} - {{ $order->shipping_address['zip'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="mb-8">
                    <h3 class="serif text-xl text-[#2b0505] mb-4">Order Items</h3>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-[#FCF9F5] border border-black/5 flex-shrink-0">
                                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://images.unsplash.com/photo-1610216705422-caa3fcb6d158?auto=format&fit=crop&q=80&w=200' }}" 
                                         class="w-full h-full object-cover" alt="{{ $item->product->name }}">
                                </div>
                                <div class="flex-1">
                                    <h4 class="serif text-lg text-[#2b0505] mb-1">{{ $item->product->name }}</h4>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Qty: {{ $item->quantity }}</span>
                                        <span class="text-sm font-bold text-[#2b0505]">₹{{ number_format($item->price * $item->quantity, 0) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Total Summary -->
                <div class="bg-[#FCF9F5] p-6 rounded-lg border border-black/5">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-black/40 font-medium">Subtotal</span>
                            <span class="text-[#2b0505] font-bold">₹{{ number_format($order->total_amount, 0) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-black/40 font-medium">Shipping</span>
                            <span class="text-green-600 font-bold uppercase text-[10px] tracking-widest">Free</span>
                        </div>
                        <div class="pt-4 border-t border-black/5 flex justify-between items-center">
                            <span class="serif text-xl text-[#2b0505]">Total Paid</span>
                            <span class="text-2xl font-bold text-green-600">₹{{ number_format($order->total_amount, 0) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Important Information -->
                <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200">
                    <h3 class="serif text-xl text-[#2b0505] mb-3 text-yellow-800">Important Information</h3>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-700">
                            <span class="font-bold text-yellow-800">Verification Status:</span> Your payment has been received and is currently being verified by our team. This typically takes 5-10 minutes.
                        </p>
                        <p class="text-sm text-gray-700">
                            <span class="font-bold text-yellow-800">Next Steps:</span> You will receive an email confirmation once your payment is verified. You can track your order status in your dashboard.
                        </p>
                        <p class="text-sm text-gray-700">
                            <span class="font-bold text-yellow-800">Order Status:</span> <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">Pending Verification</span>
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-6">
                    <button onclick="window.print()" class="w-full sm:w-auto bg-[#D4AF37] text-white px-10 py-5 rounded-2xl text-[10px] font-bold tracking-[0.2em] uppercase hover:bg-[#b88a2b] transition-all shadow-xl shadow-black/10 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 00-2-2v8a2 2 0 002 2h2m2 4h10a2 2 0 002-2v8a2 2 0 002-2z"/>
                        </svg>
                        Print Receipt
                    </button>
                    <a href="{{ route('shop.index') }}" class="w-full sm:w-auto bg-[#2b0505] text-white px-10 py-5 rounded-2xl text-[10px] font-bold tracking-[0.2em] uppercase hover:bg-[#4a0a0a] transition-all shadow-xl shadow-black/10">
                        Continue Shopping
                    </a>
                    <a href="{{ route('home') }}" class="w-full sm:w-auto border border-black/10 text-[#2b0505] px-10 py-5 rounded-2xl text-[10px] font-bold tracking-[0.2em] uppercase hover:bg-black hover:text-white transition-all">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mt-12 text-black/20 text-[9px] font-bold tracking-[0.4em] uppercase">
            Radhe Store • Heritage & Elegance
        </div>
    </div>
</div>
@endsection
