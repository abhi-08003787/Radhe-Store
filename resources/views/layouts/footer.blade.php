<footer class="bg-white text-gray-600 py-12">
    <div class="container mx-auto px-4">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            
            <!-- Column 1: Logo & Contact -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3 mb-4">
                    <img src="{{ asset('images/logo/logo (2).jpeg') }}" 
                         alt="Radhe Store" 
                         class="h-14 w-auto object-contain"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <!-- Radhe Store Text -->
                    <span class="serif text-lg font-bold tracking-[0.1em] text-[#D4AF37] animate-reveal-scroll">
                        Radhe Store
                    </span>
                    <!-- Fallback to text logo if image fails to load -->
                    <div class="hidden items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-tr from-[#D4AF37] via-[#f6e4a6] to-[#b88a2b] rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-sm">RS</span>
                        </div>
                        <span class="text-xl font-bold text-[#2b0505]">Radhe Store</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <h4 class="text-sm font-semibold text-gray-900 mb-3 text-center md:text-left">Contact Us</h4>
                    <p class="text-sm">Email: radhestore@gmail.com</p>
                    <p class="text-sm">Phone: +91 9106258956</p>
                    <p class="text-sm">Address: NIRDOSHANAND SOCIETY JASDAN RAJKOT ROAD AT VIRNAGAR</p>
                </div>
            </div>
            
            <!-- Column 2: Company -->
            <div class="space-y-4">
                <h4 class="text-sm font-semibold text-gray-900 mb-3 text-center md:text-left">Company</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('about') }}" class="text-sm hover:text-[#D4AF37] transition-colors">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-sm hover:text-[#D4AF37] transition-colors">Contact Us</a></li>
                    <li><a href="{{ route('shop.index') }}" class="text-sm hover:text-[#D4AF37] transition-colors">Shop</a></li>
                </ul>
            </div>
            
            <!-- Column 3: Shop -->
            <div class="space-y-4">
                <h4 class="text-sm font-semibold text-gray-900 mb-3 text-center md:text-left">Shop</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('shop.index') }}" class="text-sm hover:text-[#D4AF37] transition-colors">All Products</a></li>
                    <li><a href="{{ route('shop.index', ['sort' => 'newest']) }}" class="text-sm hover:text-[#D4AF37] transition-colors">New Arrivals</a></li>
                    <li><a href="{{ route('shop.index', ['sort' => 'popular']) }}" class="text-sm hover:text-[#D4AF37] transition-colors">Best Sellers</a></li>
                    <li><a href="{{ route('cart.index') }}" class="text-sm hover:text-[#D4AF37] transition-colors">Shopping Cart</a></li>
                </ul>
            </div>
            
           <!-- Column 4: Help -->
            <div class="space-y-4">
                <h4 class="text-sm font-semibold text-gray-900 mb-3 text-center md:text-left">Help</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('order.track') }}" class="text-sm hover:text-[#D4AF37] transition-colors">Track Order</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="text-sm hover:text-[#D4AF37] transition-colors">My Account</a></li>
                    @endauth
                    <li><a href="{{ route('page.show', 'shipping-info') }}" class="text-sm hover:text-[#D4AF37] transition-colors">Shipping Info</a></li>
                    <li><a href="{{ route('page.show', 'return-policy') }}" class="text-sm hover:text-[#D4AF37] transition-colors">Return & Refund Policy</a></li>
                    <li><a href="{{ route('page.show', 'faq') }}" class="text-sm hover:text-[#D4AF37] transition-colors">FAQ</a></li>
                </ul>
            </div>
        </div>
        
       
                <!-- Copyright -->
                <div class="text-center md:text-right">
                    <p class="text-sm text-gray-500">
                            {{ date('Y') }} Radhe Store. All rights reserved.
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        Made with <span class="text-[#D4AF37]">♥</span> in India
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
