@extends('layouts.app')

@section('title', 'Checkout - Radhe Store')

@section('content')
<div class="bg-white min-h-screen py-12 md:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- Shipping Details (7 Columns) --}}
            <div class="lg:col-span-7">
                <h2 class="serif text-3xl text-[#2b0505] mb-8">Shipping Information</h2>
                <form id="checkout-form" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input type="text" name="first_name" placeholder="First Name" class="w-full rounded-0 border-gray-300 focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                        <input type="text" name="last_name" placeholder="Last Name" class="w-full rounded-0 border-gray-300 focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                    </div>
                    <input type="text" name="address" placeholder="Address" class="w-full rounded-0 border-gray-300 focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <input type="text" name="city" placeholder="City" class="w-full rounded-0 border-gray-300 focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                        <input type="text" name="state" placeholder="State" class="w-full rounded-0 border-gray-300 focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                        <input type="text" name="zip" placeholder="ZIP Code" class="w-full rounded-0 border-gray-300 focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input type="email" name="email" placeholder="Email Address" class="w-full rounded-0 border-gray-300 focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                        <input type="tel" name="phone" placeholder="Phone Number" class="w-full rounded-0 border-gray-300 focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                    </div>
                </form>
            </div>

            {{-- Order Summary (5 Columns) --}}
            <div class="lg:col-span-5">
                @php
                    $shipping = $subtotal >= 999 ? 0 : 80;
                    $total = $subtotal + $shipping;
                @endphp
                <div class="bg-[#FCF9F5] p-8 rounded-lg">
                    <h3 class="serif text-2xl text-[#2b0505] mb-6">Your Order</h3>
                    <div class="space-y-4">
                        @foreach($cart as $id => $details)
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : asset('images/payments/phonepe_qr.jpeg') }}" 
                                         alt="PhonePe QR Code" 
                                         class="w-16 h-16 object-cover rounded-md">
                                    <div>
                                        <p class="font-bold">{{ $details['name'] }}</p>
                                        <p class="text-sm text-gray-500">Quantity: {{ $details['quantity'] }}</p>
                                    </div>
                                </div>
                                <p class="font-bold">₹{{ number_format($details['price'] * $details['quantity'], 2) }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-200 space-y-4">
                        <div class="flex justify-between">
                            <p class="text-gray-600">Subtotal</p>
                            <p class="font-bold">₹{{ number_format($subtotal, 2) }}</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-gray-600">Shipping</p>
                            <p class="font-bold">
                                @if($shipping == 0)
                                    <span class="text-green-600">Free</span>
                                @else
                                    ₹{{ number_format($shipping, 2) }}
                                @endif
                            </p>
                        </div>
                        @if($shipping == 0)
                            <p class="text-xs text-green-600">Free shipping on orders above ₹999</p>
                        @endif
                        <div class="flex justify-between text-lg">
                            <p class="font-bold">Total</p>
                            <p class="font-bold text-[#D4AF37]">₹{{ number_format($total, 2) }}</p>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h4 class="serif text-xl text-[#2b0505] mb-4">Payment Method</h4>
                        <div class="space-y-4">
                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-[#FCF9F5] transition-colors">
                                <input type="radio" name="payment_method" value="cod" checked class="form-radio text-[#D4AF37] focus:ring-[#D4AF37]" onchange="togglePaymentMethod()">
                                <span class="ml-4 font-bold">Cash on Delivery</span>
                            </label>
                            
                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-[#FCF9F5] transition-colors">
                                <input type="radio" name="payment_method" value="upi" class="form-radio text-[#D4AF37] focus:ring-[#D4AF37]" onchange="togglePaymentMethod()">
                                <div class="ml-4 flex items-center gap-3">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8zm-2-13.5v6l5.25 3.15.75.45L13 14.5v-8z"/>
                                    </svg>
                                    <div>
                                        <p class="font-bold">PhonePe / UPI Scanner</p>
                                        <p class="text-xs text-gray-500">Pay instantly with UPI</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <button id="place-order-btn" class="w-full mt-8 bg-[#2b0505] text-white py-4 rounded-lg text-sm font-bold tracking-widest uppercase hover:bg-[#4a0a0a] transition-all">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- UPI QR Code Modal -->
<div id="upi-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full p-6 relative">
        <button onclick="closeUpiModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        
        <div class="text-center">
            <div class="mb-4">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-tr from-[#D4AF37] via-[#f6e4a6] to-[#b88a2b] rounded-full">
                    <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8zm-2-13.5v6l5.25 3.15.75.45L13 14.5v-8z"/>
                    </svg>
                </div>
            </div>
            
            <h3 class="serif text-2xl text-[#2b0505] mb-2">Scan to Pay</h3>
            <p class="text-gray-600 mb-6">Use any UPI app to scan this QR code</p>
            
            <!-- Total Amount Display -->
            <div class="bg-[#2b0505] text-white p-4 rounded-lg mb-6">
                <p class="text-sm text-white/80 mb-1">Total Amount</p>
                <p class="text-3xl font-bold text-[#D4AF37]">₹{{ number_format($total, 2) }}</p>
                @if($shipping > 0)
                    <p class="text-xs text-white/60 mt-1">Includes ₹{{ number_format($shipping, 2) }} shipping</p>
                @else
                    <p class="text-xs text-green-400 mt-1">Free shipping applied!</p>
                @endif
            </div>
            
            <!-- QR Code Display -->
            <div class="bg-white p-6 rounded-lg mb-6 shadow-lg border border-gray-200">
                <div class="w-56 h-56 mx-auto">
                    <div id="qrcode" class="w-full h-full flex items-center justify-center">
                        <!-- QR code will be generated here -->
                    </div>
                </div>
                <p class="text-xs text-gray-500 text-center mt-2">Scan with any UPI app</p>
            </div>
            
            <!-- Account Details -->
            <div class="bg-[#FCF9F5] p-4 rounded-lg mb-6">
                <p class="text-sm text-gray-600 mb-1">UPI ID:</p>
                <p class="font-mono font-bold text-[#D4AF37] mb-3">chiragradadiya568-1@oksbi</p>
                <p class="text-sm text-gray-600 mb-1">Account Name:</p>
                <p class="font-bold text-[#2b0505]">Radadiya Chirag Jayantibhai</p>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button onclick="initiateUpiPayment()" class="flex-1 bg-[#D4AF37] text-white py-3 rounded-lg font-medium hover:bg-[#b88a2b] transition-colors">
                    Pay Now
                </button>
                <button onclick="closeUpiModal()" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-300 transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// UPI Modal Functions
function closeUpiModal() {
    document.getElementById('upi-modal').classList.add('hidden');
}

function generateQRCode() {
    try {
        const upiId = 'chiragradadiya568-1@oksbi';
        const payeeName = 'Radadiya Chirag Jayantibhai';
        const amount = '{{ number_format($total, 2) }}';
        const currency = 'INR';
        const transactionNote = 'Radhe Store Payment';
        
        // Construct UPI URL with fixed amount
        const upiUrl = `upi://pay?pa=${upiId}&pn=${encodeURIComponent(payeeName)}&am=${amount}&cu=${currency}&tn=${encodeURIComponent(transactionNote)}`;
        
        // Clear existing QR code
        const qrcodeContainer = document.getElementById('qrcode');
        if (!qrcodeContainer) {
            console.error('QR code container not found');
            return;
        }
        
        qrcodeContainer.innerHTML = '';
        
        // Generate new QR code
        if (typeof QRCode !== 'undefined') {
            new QRCode(qrcodeContainer, {
                text: upiUrl,
                width: 224,
                height: 224,
                colorDark: '#2b0505',
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.H
            });
            
            // Store UPI URL for mobile deep link
            qrcodeContainer.dataset.upiUrl = upiUrl;
            console.log('QR code generated successfully');
        } else {
            console.error('QRCode library not loaded');
            qrcodeContainer.innerHTML = '<p class="text-red-500 text-sm">QR Code Error</p>';
        }
    } catch (error) {
        console.error('Error generating QR code:', error);
        const qrcodeContainer = document.getElementById('qrcode');
        if (qrcodeContainer) {
            qrcodeContainer.innerHTML = '<p class="text-red-500 text-sm">QR Code Generation Failed</p>';
        }
    }
}

function initiateUpiPayment() {
    const upiId = 'chiragradadiya568-1@oksbi';
    const payeeName = 'Radadiya Chirag Jayantibhai';
    const amount = '{{ number_format($total, 2) }}';
    const transactionNote = 'Radhe Store Payment';
    
    // Check if mobile device
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        // Mobile - redirect to UPI deep link
        const upiUrl = `upi://pay?pa=${upiId}&pn=${encodeURIComponent(payeeName)}&am=${amount}&cu=INR&tn=${encodeURIComponent(transactionNote)}`;
        window.location.href = upiUrl;
    } else {
        // Desktop - show QR modal
        document.getElementById('upi-modal').classList.remove('hidden');
        generateQRCode();
    }
}

function togglePaymentMethod() {
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
    const placeOrderBtn = document.getElementById('place-order-btn');
    
    if (paymentMethod === 'upi') {
        placeOrderBtn.innerText = 'Pay with UPI';
        placeOrderBtn.classList.add('bg-[#D4AF37]');
        placeOrderBtn.classList.remove('bg-[#2b0505]');
    } else {
        placeOrderBtn.innerText = 'Place Order';
        placeOrderBtn.classList.remove('bg-[#D4AF37]');
        placeOrderBtn.classList.add('bg-[#2b0505]');
    }
}

document.getElementById('place-order-btn').addEventListener('click', function(e) {
    e.preventDefault();
    
    const form = document.getElementById('checkout-form');
    const formData = new FormData(form);
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
    
    formData.append('payment_method', paymentMethod);

    // Disable button to prevent multiple clicks
    const btn = this;
    const originalText = btn.innerText;
    btn.disabled = true;
    
    if (paymentMethod === 'upi') {
        // UPI Payment - trigger deep link or modal
        btn.innerText = 'Opening Payment...';
        initiateUpiPayment();
        btn.disabled = false;
        btn.innerText = originalText;
    } else {
        // Cash on Delivery - submit directly
        btn.innerText = 'Processing...';
        
        fetch('{{ route("checkout.placeOrder") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect to order success page
                window.location.href = data.redirect_url;
            } else {
                alert(data.message || 'Something went wrong. Please check your details.');
                btn.disabled = false;
                btn.innerText = originalText;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
            btn.disabled = false;
            btn.innerText = originalText;
        });
    }
});
</script>
@endpush
