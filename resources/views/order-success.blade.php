@extends('layouts.app')

@section('title', 'Order Confirmation - Radhe Store')

@section('content')
<div class="bg-[#FCF9F5] min-h-screen py-20 flex items-center justify-center">
    <div class="mx-auto max-w-3xl px-4">
        <div class="text-center mb-12">
            <div class="w-20 h-20 bg-[#D4AF37] rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl shadow-[#D4AF37]/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="serif text-4xl text-[#2b0505] mb-3">
                @if($order->status === 'pending_verification')
                    Order Placed - Awaiting Verification
                @else
                    Order Confirmed
                @endif
            </h1>
            <p class="text-[11px] text-[#D4AF37] font-bold tracking-[0.3em] uppercase">
                @if($order->status === 'pending_verification')
                    Your UPI payment is being verified. We'll confirm your order shortly.
                @else
                    Your selection is being prepared
                @endif
            </p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-black/[0.03] border border-black/5 overflow-hidden">
            <div class="p-8 md:p-12">
                <div class="space-y-6 mb-10 pb-6 border-b border-black/5">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold tracking-widest uppercase text-black/20 block mb-1">Order Number</span>
                            <span class="text-sm font-bold text-[#2b0505]">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] font-bold tracking-widest uppercase text-black/20 block mb-1">Date</span>
                            <span class="text-sm font-bold text-[#2b0505]">{{ $order->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold tracking-widest uppercase text-black/20 block mb-1">Payment Method</span>
                            <span class="text-sm font-bold text-[#2b0505]">
                                @if($order->payment_method === 'upi')
                                    <span class="inline-flex items-center gap-2">
                                        <svg class="w-4 h-4 text-[#D4AF37]" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-2-13.5v6l5.25 3.15.75.45L13 14.5v-8z"/>
                                        </svg>
                                        PhonePe / UPI
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2">
                                        <svg class="w-4 h-4 text-[#D4AF37]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        Cash on Delivery
                                    </span>
                                @endif
                            </span>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] font-bold tracking-widest uppercase text-black/20 block mb-1">Status</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                @if($order->status === 'pending') bg-orange-100 text-orange-800
                                @elseif($order->status === 'pending_verification') bg-yellow-100 text-yellow-800
                                @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                @if($order->status === 'pending_verification')
                                    Pending Verification
                                @else
                                    {{ ucfirst($order->status) }}
                                @endif
                            </span>
                        </div>
                    </div>
                    
                    @if($order->transaction_id)
                    <div class="bg-[#FCF9F5] p-4 rounded-lg border border-black/5">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-[10px] font-bold tracking-widest uppercase text-black/20 block mb-1">Transaction ID</span>
                                <span class="text-sm font-mono font-bold text-[#D4AF37]">{{ $order->transaction_id }}</span>
                            </div>
                            <button onclick="copyTransactionId('{{ $order->transaction_id }}')" class="p-2 text-black/40 hover:text-[#D4AF37] transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Order Items Table --}}
                <div class="space-y-8 mb-10">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-6">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden bg-[#FCF9F5] border border-black/5 flex-shrink-0">
                                <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://images.unsplash.com/photo-1610216705422-caa3fcb6d158?auto=format&fit=crop&q=80&w=200' }}" 
                                     class="w-full h-full object-cover" alt="{{ $item->product->name }}">
                            </div>
                            <div class="flex-1">
                                <h4 class="serif text-lg text-[#2b0505] mb-1">{{ $item->product->name }}</h4>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-black/40 font-medium">Qty: {{ $item->quantity }}</span>
                                    <span class="text-sm font-bold text-[#2b0505]">₹{{ number_format($item->price * $item->quantity, 0) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="space-y-4 pt-8 border-t border-black/5">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-black/40 font-medium">Subtotal</span>
                        <span class="text-[#2b0505] font-bold">₹{{ number_format($order->total_amount, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-black/40 font-medium">Shipping</span>
                        <span class="text-green-600 font-bold uppercase text-[10px] tracking-widest">Free</span>
                    </div>
                    <div class="pt-6 border-t border-black/5 flex justify-between items-center">
                        <span class="serif text-xl text-[#2b0505]">Grand Total</span>
                        <span class="text-2xl font-bold text-[#D4AF37]">₹{{ number_format($order->total_amount, 0) }}</span>
                    </div>
                </div>

                <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-6">
                    <button onclick="downloadInvoice()" class="w-full sm:w-auto bg-[#D4AF37] text-white px-10 py-5 rounded-2xl text-[10px] font-bold tracking-[0.2em] uppercase hover:bg-[#b88a2b] transition-all shadow-xl shadow-black/10 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Invoice
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

@push('scripts')
<script>
function copyTransactionId(transactionId) {
    navigator.clipboard.writeText(transactionId).then(() => {
        // Show success feedback
        const button = event.target.closest('button');
        const originalHTML = button.innerHTML;
        button.innerHTML = '<svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
        
        setTimeout(() => {
            button.innerHTML = originalHTML;
        }, 2000);
    });
}

function downloadInvoice() {
    // Create invoice content
    const orderData = {
        orderId: '#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}',
        date: '{{ $order->created_at->format('M d, Y') }}',
        paymentMethod: '{{ $order->payment_method === "upi" ? "PhonePe / UPI" : "Cash on Delivery" }}',
        status: '{{ ucfirst($order->status) }}',
        totalAmount: '₹{{ number_format($order->total_amount, 0) }}',
        transactionId: '{{ $order->transaction_id ?? "N/A" }}',
        items: [
            @foreach($order->items as $item)
            {
                name: '{{ $item->product->name }}',
                quantity: {{ $item->quantity }},
                price: '₹{{ number_format($item->price * $item->quantity, 0) }}'
            },
            @endforeach
        ]
    };

    // Generate invoice HTML
    const invoiceHTML = `
        <div style="font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; border: 1px solid #ddd;">
            <div style="text-align: center; margin-bottom: 30px;">
                <h1 style="color: #2b0505; margin: 0;">Radhe Store</h1>
                <p style="color: #D4AF37; margin: 5px 0; font-size: 12px; text-transform: uppercase; letter-spacing: 2px;">Invoice</p>
            </div>
            
            <div style="display: flex; justify-content: space-between; margin-bottom: 30px; padding: 15px; background: #f9f9f9;">
                <div>
                    <p style="margin: 5px 0; font-size: 12px; color: #666;">Order Number</p>
                    <p style="margin: 0; font-weight: bold;">${orderData.orderId}</p>
                </div>
                <div>
                    <p style="margin: 5px 0; font-size: 12px; color: #666;">Date</p>
                    <p style="margin: 0; font-weight: bold;">${orderData.date}</p>
                </div>
                <div>
                    <p style="margin: 5px 0; font-size: 12px; color: #666;">Payment Method</p>
                    <p style="margin: 0; font-weight: bold;">${orderData.paymentMethod}</p>
                </div>
            </div>
            
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <thead>
                    <tr style="background: #2b0505; color: white;">
                        <th style="padding: 10px; text-align: left;">Item</th>
                        <th style="padding: 10px; text-align: center;">Quantity</th>
                        <th style="padding: 10px; text-align: right;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    ${orderData.items.map(item => `
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px;">${item.name}</td>
                            <td style="padding: 10px; text-align: center;">${item.quantity}</td>
                            <td style="padding: 10px; text-align: right; font-weight: bold;">${item.price}</td>
                        </tr>
                    `).join('')}
                </tbody>
                <tfoot>
                    <tr style="background: #f9f9f9;">
                        <td colspan="2" style="padding: 15px; text-align: right; font-weight: bold;">Total Amount:</td>
                        <td style="padding: 15px; text-align: right; font-weight: bold; color: #D4AF37; font-size: 18px;">${orderData.totalAmount}</td>
                    </tr>
                </tfoot>
            </table>
            
            @if($order->transaction_id)
            <div style="margin-top: 20px; padding: 15px; background: #FCF9F5; border: 1px solid #ddd;">
                <p style="margin: 5px 0; font-size: 12px; color: #666;">Transaction ID</p>
                <p style="margin: 0; font-family: monospace; font-weight: bold; color: #D4AF37;">${orderData.transactionId}</p>
            </div>
            @endif
            
            <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 10px; color: #666;">
                <p>Thank you for shopping at Radhe Store!</p>
                <p>Heritage & Elegance • Traditional Jewelry</p>
            </div>
        </div>
    `;

    // Create a temporary window and print
    const printWindow = window.open('', '_blank');
    printWindow.document.write(invoiceHTML);
    printWindow.document.close();
    
    // Wait for content to load, then print
    printWindow.onload = function() {
        printWindow.print();
        printWindow.close();
    };
}
</script>
@endpush
@endsection
