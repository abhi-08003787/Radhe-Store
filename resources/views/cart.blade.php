@extends('layouts.app')

@section('title', 'Shopping Bag - Radhe Store')

@section('content')
<div class="bg-[#FCF9F5] min-h-screen py-12 md:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        
        {{-- Progress Bar --}}
        <div class="mb-16 md:mb-24">
            <div class="flex items-center justify-center max-w-3xl mx-auto px-4">
                <div class="flex flex-col items-center gap-4 flex-1 relative">
                    <div class="w-12 h-12 rounded-full bg-[#2b0505] text-white flex items-center justify-center font-bold text-sm z-10 shadow-xl shadow-black/10">01</div>
                    <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-[#2b0505]">Shopping Bag</span>
                    <div class="absolute left-1/2 top-6 w-full h-[1px] bg-[#2b0505]/20"></div>
                </div>
                <div class="flex flex-col items-center gap-4 flex-1 relative">
                    <div class="w-12 h-12 rounded-full border border-black/10 bg-white text-black/30 flex items-center justify-center font-bold text-sm z-10">02</div>
                    <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-black/30">Shipping</span>
                    <div class="absolute left-1/2 top-6 w-full h-[1px] bg-black/10"></div>
                </div>
                <div class="flex flex-col items-center gap-4 flex-1">
                    <div class="w-12 h-12 rounded-full border border-black/10 bg-white text-black/30 flex items-center justify-center font-bold text-sm z-10">03</div>
                    <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-black/30">Confirmation</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            {{-- Product List (8 Columns) --}}
            <div class="lg:col-span-8">
                <div class="bg-white rounded-[2rem] md:rounded-[3rem] shadow-2xl shadow-black/[0.03] border border-black/5 overflow-hidden">
                    <div class="p-8 md:p-14">
                        <div class="flex items-end justify-between mb-12">
                            <div>
                                <h2 class="serif text-4xl md:text-5xl text-[#2b0505] mb-3">Shopping Bag</h2>
                                <p class="text-sm text-black/40 font-medium">Manage your selected treasures</p>
                            </div>
                            <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-[#D4AF37] border-b border-[#D4AF37]/30 pb-1" id="cart-count-display">
                                {{ count($cart) }} Items
                            </span>
                        </div>
                        
                        <div id="cart-items-container">
                            @if(count($cart) > 0)
                                <div class="hidden md:grid grid-cols-12 gap-4 mb-8 pb-6 border-b border-black/5 text-[10px] font-bold tracking-[0.2em] uppercase text-black/30">
                                    <div class="col-span-6">Product Details</div>
                                    <div class="col-span-2 text-center">Price</div>
                                    <div class="col-span-2 text-center">Quantity</div>
                                    <div class="col-span-2 text-right">Subtotal</div>
                                </div>

                                <div class="space-y-0" id="cart-items-list">
                                    @foreach($cart as $id => $details)
                                        <div class="cart-item-row group grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-4 py-10 border-b border-black/5 last:border-0 items-center transition-all" data-id="{{ $id }}">
                                            {{-- Image & Name --}}
                                            <div class="col-span-1 md:col-span-6 flex items-center gap-8">
                                                <div class="relative w-28 h-28 md:w-32 md:h-32 rounded-3xl overflow-hidden bg-[#FCF9F5] border border-black/5 flex-shrink-0 group-hover:shadow-lg transition-all duration-500">
                                                    <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : 'https://images.unsplash.com/photo-1610216705422-caa3fcb6d158?auto=format&fit=crop&q=80&w=200' }}" 
                                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $details['name'] }}">
                                                </div>
                                                <div class="flex flex-col gap-2">
                                                    <h4 class="serif text-xl md:text-2xl text-[#2b0505] leading-tight">{{ $details['name'] }}</h4>
                                                    <div class="flex items-center gap-4">
                                                        <span class="text-[10px] font-bold tracking-widest uppercase text-black/20">SKU: RS-{{ str_pad($id, 4, '0', STR_PAD_LEFT) }}</span>
                                                        <button onclick="removeFromCart({{ $id }})" class="text-[10px] font-bold tracking-widest uppercase text-[#7a0b0b] hover:text-red-600 transition-colors flex items-center gap-1.5">
                                                            <i class="bi bi-trash3"></i> Remove
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Price --}}
                                            <div class="col-span-1 md:col-span-2 text-left md:text-center">
                                                <span class="text-[10px] font-bold tracking-widest uppercase text-black/20 md:hidden block mb-1">Price</span>
                                                <span class="text-lg font-bold text-[#2b0505]">₹{{ number_format($details['price'], 0) }}</span>
                                            </div>

                                            {{-- Quantity --}}
                                            <div class="col-span-1 md:col-span-2 flex justify-start md:justify-center">
                                                <div>
                                                    <span class="text-[10px] font-bold tracking-widest uppercase text-black/20 md:hidden block mb-1">Quantity</span>
                                                    <div class="inline-flex items-center rounded-2xl border border-black/5 bg-[#FCF9F5] p-1.5 shadow-inner">
                                                        <button onclick="updateQuantity({{ $id }}, {{ $details['quantity'] - 1 }})" class="w-10 h-10 flex items-center justify-center rounded-xl hover:bg-white hover:shadow-md transition-all text-[#2b0505] active:scale-90">
                                                            <i class="bi bi-dash-lg"></i>
                                                        </button>
                                                        <span class="w-12 text-center text-sm font-bold text-[#2b0505]" id="qty-{{ $id }}">{{ $details['quantity'] }}</span>
                                                        <button onclick="updateQuantity({{ $id }}, {{ $details['quantity'] + 1 }})" class="w-10 h-10 flex items-center justify-center rounded-xl hover:bg-white hover:shadow-md transition-all text-[#2b0505] active:scale-90">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Subtotal --}}
                                            <div class="col-span-1 md:col-span-2 text-left md:text-right">
                                                <span class="text-[10px] font-bold tracking-widest uppercase text-black/20 md:hidden block mb-1">Subtotal</span>
                                                <span class="text-xl font-bold text-[#D4AF37] item-subtotal" id="subtotal-{{ $id }}">₹{{ number_format($details['price'] * $details['quantity'], 0) }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="py-32 text-center">
                                    <div class="w-24 h-24 bg-[#FCF9F5] rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
                                        <i class="bi bi-bag-x text-4xl text-black/10"></i>
                                    </div>
                                    <h3 class="serif text-3xl text-[#2b0505] mb-4">Your bag is empty</h3>
                                    <p class="text-black/40 mb-10 max-w-xs mx-auto text-sm leading-relaxed">Discover our exquisite collection of heritage jewelry and find something special.</p>
                                    <a href="{{ route('shop.index') }}" class="inline-block bg-[#2b0505] text-white px-10 py-4 rounded-2xl text-[10px] font-bold tracking-[0.2em] uppercase hover:bg-[#4a0a0a] transition-all shadow-xl shadow-black/10">
                                        Explore Collections
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                {{-- Additional Info --}}
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white/50 border border-black/5 rounded-3xl p-6 flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#D4AF37]/10 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-truck text-[#D4AF37] text-xl"></i>
                        </div>
                        <div>
                            <h5 class="text-xs font-bold tracking-widest uppercase text-[#2b0505] mb-1">Complimentary Shipping</h5>
                            <p class="text-[11px] text-black/50 leading-relaxed">Enjoy free insured shipping on all orders above ₹5,000 across India.</p>
                        </div>
                    </div>
                    <div class="bg-white/50 border border-black/5 rounded-3xl p-6 flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#D4AF37]/10 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-patch-check text-[#D4AF37] text-xl"></i>
                        </div>
                        <div>
                            <h5 class="text-xs font-bold tracking-widest uppercase text-[#2b0505] mb-1">Authenticity Guaranteed</h5>
                            <p class="text-[11px] text-black/50 leading-relaxed">Every piece comes with a certificate of authenticity and hallmark.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cart Totals (4 Columns) --}}
            <div class="lg:col-span-4 lg:sticky lg:top-32">
                <div class="bg-[#2b0505] rounded-[3rem] p-10 md:p-12 text-white shadow-2xl shadow-black/20 relative overflow-hidden">
                    {{-- Decorative Element --}}
                    <div class="absolute -right-12 -top-12 w-48 h-48 bg-white/5 rounded-full blur-3xl"></div>
                    
                    <h3 class="serif text-3xl mb-12 relative">Order Summary</h3>
                    
                    <div class="space-y-8 relative">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-white/40">Subtotal</span>
                            <span class="text-xl font-medium" id="summary-subtotal">₹{{ number_format($subtotal, 0) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-white/40">Estimated Shipping</span>
                            <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-[#D4AF37]">Complimentary</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-white/40">Tax (Incl.)</span>
                            <span class="text-sm font-medium">₹0</span>
                        </div>
                        
                        <div class="pt-8 border-t border-white/10 mt-8">
                            <div class="flex justify-between items-end mb-12">
                                <span class="serif text-2xl">Grand Total</span>
                                <div class="text-right">
                                    <span class="block text-3xl font-bold text-[#D4AF37]" id="summary-total">₹{{ number_format($subtotal, 0) }}</span>
                                    <span class="text-[9px] text-white/30 tracking-widest uppercase">Prices inclusive of all taxes</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('checkout.index') }}" class="w-full bg-[#D4AF37] text-[#2b0505] py-6 rounded-2xl text-xs font-bold tracking-[0.3em] uppercase hover:bg-white transition-all transform hover:-translate-y-1 shadow-xl active:scale-95 flex items-center justify-center gap-4 group no-underline">
                                Proceed to Checkout
                                <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="mt-12 flex items-center justify-center gap-4 py-4 px-6 rounded-2xl bg-white/5 border border-white/5">
                        <i class="bi bi-shield-lock text-[#D4AF37]"></i>
                        <span class="text-[9px] font-bold tracking-[0.2em] uppercase text-white/40">100% Secure Checkout</span>
                    </div>
                </div>
                
                {{-- Continue Shopping Link --}}
                <div class="mt-8 text-center">
                    <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 text-[10px] font-bold tracking-[0.2em] uppercase text-black/30 hover:text-[#2b0505] transition-colors group">
                        <i class="bi bi-arrow-left transition-transform group-hover:-translate-x-1"></i>
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateQuantity(id, quantity) {
        if (quantity < 1) return removeFromCart(id);

        const qtyDisplay = document.getElementById(`qty-${id}`);
        const subtotalDisplay = document.getElementById(`subtotal-${id}`);
        const summarySubtotal = document.getElementById('summary-subtotal');
        const summaryTotal = document.getElementById('summary-total');
        const cartCountDisplay = document.getElementById('cart-count-display');
        const headerCartCount = document.querySelector('.cart-count'); // Assuming header has this class

        fetch("{{ route('cart.update') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ id: id, quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update specific item UI
                if (qtyDisplay) qtyDisplay.innerText = quantity;
                if (subtotalDisplay) subtotalDisplay.innerText = data.item_subtotal;
                
                // Update summary UI
                if (summarySubtotal) summarySubtotal.innerText = data.subtotal;
                if (summaryTotal) summaryTotal.innerText = data.subtotal;
                
                // Update counts
                if (cartCountDisplay) cartCountDisplay.innerText = `${data.cart_count} Items`;
                if (headerCartCount) headerCartCount.innerText = data.cart_count;

                // Update the onclick handlers for the buttons to reflect new quantity
                const buttons = document.querySelectorAll(`[data-id="${id}"] button`);
                buttons.forEach(btn => {
                    if (btn.getAttribute('onclick')?.includes('updateQuantity')) {
                        const isPlus = btn.querySelector('.bi-plus-lg');
                        btn.setAttribute('onclick', `updateQuantity(${id}, ${isPlus ? quantity + 1 : quantity - 1})`);
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error updating quantity:', error);
            // Fallback to reload if AJAX fails
            location.reload();
        });
    }

    function removeFromCart(id) {
        if (!confirm('Are you sure you want to remove this exquisite piece from your selection?')) return;

        fetch("{{ route('cart.remove') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const itemRow = document.querySelector(`.cart-item-row[data-id="${id}"]`);
                if (itemRow) {
                    itemRow.style.opacity = '0';
                    itemRow.style.transform = 'translateX(20px)';
                    setTimeout(() => {
                        itemRow.remove();
                        
                        // Update summary
                        document.getElementById('summary-subtotal').innerText = data.subtotal;
                        document.getElementById('summary-total').innerText = data.subtotal;
                        document.getElementById('cart-count-display').innerText = `${data.cart_count} Items`;
                        
                        const headerCartCount = document.querySelector('.cart-count');
                        if (headerCartCount) headerCartCount.innerText = data.cart_count;

                        // If cart is empty, reload to show empty state
                        if (data.cart_count === 0) {
                            location.reload();
                        }
                    }, 500);
                } else {
                    location.reload();
                }
            }
        })
        .catch(error => {
            console.error('Error removing item:', error);
            location.reload();
        });
    }
</script>
@endpush
