<header class="sticky top-0 z-50 border-b border-black/5 bg-white/90 backdrop-blur-md">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Mobile Header -->
        <div class="flex md:hidden h-16 items-center justify-between">
            {{-- Hamburger Menu (Left) --}}
            <div class="flex-shrink-0">
                <button class="p-2 text-black/70 hover:text-[#D4AF37] transition-colors" onclick="toggleMobileMenu()">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            {{-- Centered Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center justify-center no-underline group">
                    <img src="{{ asset('images/logo/logo (2).jpeg') }}" 
                         alt="Radhe Store" 
                         class="h-10 w-auto object-contain group-hover:opacity-80 transition-opacity duration-300"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <!-- Fallback to text logo if image fails to load -->
                    <div class="hidden items-center gap-2">
                        <span class="h-8 w-8 rounded-full bg-gradient-to-tr from-[#D4AF37] via-[#f6e4a6] to-[#b88a2b] shadow-md"></span>
                        <span class="serif text-lg font-bold tracking-[0.2em] uppercase text-[#D4AF37]">Radhe Store</span>
                    </div>
                </a>
            </div>

            {{-- Shopping Bag Icon (Right) --}}
            <div class="flex-shrink-0">
                <a href="{{ Auth::check() ? route('cart.index') : route('login') }}" class="relative p-2 text-black/70 hover:text-[#D4AF37] transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    @if(Auth::check())
                        <span class="absolute -top-1 -right-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-[#D4AF37] text-[10px] font-bold text-white shadow-sm">
                            {{ count(session()->get('cart', [])) }}
                        </span>
                    @endif
                </a>
            </div>
        </div>

        <!-- Desktop Header -->
        <div class="hidden md:flex h-20 items-center justify-between">
            {{-- Logo Section (Left) --}}
            <div class="flex-1 flex justify-start">
                <a href="{{ route('home') }}" class="flex items-center gap-3 no-underline group">
                    <img src="{{ asset('images/logo/logo (2).jpeg') }}" width="250"
                         alt="Radhe Store" 
                         class="h-16 w-auto object-contain group-hover:scale-105 transition-transform duration-300 max-w-[140px] md:max-w-[180px]"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <!-- Radhe Store Text -->
                    <span class="serif text-xl md:text-2xl font-bold tracking-[0.1em] text-[#D4AF37] animate-fade-in-slide animate-shimmer-delayed hidden md:block">
                        Radhe Store
                    </span>
                    <!-- Fallback to text logo if image fails to load -->
                    <div class="hidden items-center gap-3">
                        <span class="h-8 md:h-10 w-8 md:w-10 rounded-full bg-gradient-to-tr from-[#D4AF37] via-[#f6e4a6] to-[#b88a2b] shadow-md group-hover:scale-110 transition-transform duration-300"></span>
                        <span class="serif text-lg md:text-xl font-bold tracking-[0.2em] uppercase text-[#D4AF37]">Radhe Store</span>
                    </div>
                </a>
            </div>

            {{-- Navigation Menu (Center) --}}
            <nav class="hidden md:flex items-center gap-8 lg:gap-12 text-[10px] font-bold tracking-[0.3em] uppercase">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#D4AF37]' : 'text-[#111111] hover:text-[#D4AF37]' }} no-underline transition-colors">Home</a>
                <a href="{{ route('shop.index') }}" class="{{ request()->routeIs('shop.index') ? 'text-[#D4AF37]' : 'text-[#111111] hover:text-[#D4AF37]' }} no-underline transition-colors">Shop</a>
                <a href="{{ Auth::check() ? route('cart.index') : route('login') }}" class="{{ request()->routeIs('cart.index') ? 'text-[#D4AF37]' : 'text-[#111111] hover:text-[#D4AF37]' }} no-underline transition-colors">Cart</a>
                <a href="{{ route('about') }}" id="nav-about" class="{{ request()->routeIs('about') ? 'text-[#D4AF37]' : 'text-[#111111] hover:text-[#D4AF37]' }} no-underline transition-colors">About</a>
                <a href="{{ route('contact') }}" id="nav-contact" class="{{ request()->routeIs('contact') ? 'text-[#D4AF37]' : 'text-[#111111] hover:text-[#D4AF37]' }} no-underline transition-colors">Contact</a>
            </nav>

            {{-- Utility Icons (Right) --}}
            <div class="flex-1 flex items-center justify-end gap-3 sm:gap-5">
                <button class="p-2 text-black/70 hover:text-[#D4AF37] transition-colors" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
                @auth
                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 p-2 text-black/70 hover:text-[#D4AF37] transition-colors" aria-label="User Menu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <span class="hidden sm:inline text-sm font-medium">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                            <div class="px-4 py-2 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </div>
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="p-2 text-black/70 hover:text-[#D4AF37] transition-colors" aria-label="Login">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </a>
                @endguest
                <a href="{{ Auth::check() ? route('cart.index') : route('login') }}" class="relative p-2 text-black/70 hover:text-[#D4AF37] transition-colors" aria-label="Cart">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h15l-1.5 9h-13z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l-2-2H2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 22a1 1 0 100-2 1 1 0 000 2zM18 22a1 1 0 100-2 1 1 0 000 2z"/>
                    </svg>
                    <span class="cart-count absolute -top-0 -right-0 inline-flex h-4 min-w-4 items-center justify-center rounded-full bg-[#7a0b0b] px-1 text-[9px] font-bold text-white shadow-sm">
                        {{ count(session()->get('cart', [])) }}
                    </span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white">
        <div class="px-4 py-4 space-y-3">
            <a href="{{ route('home') }}" class="block py-2 text-sm font-medium text-gray-700 hover:text-[#D4AF37] transition-colors">Home</a>
            <a href="{{ route('shop.index') }}" class="block py-2 text-sm font-medium text-gray-700 hover:text-[#D4AF37] transition-colors">Shop</a>
            <a href="{{ route('about') }}" class="block py-2 text-sm font-medium text-gray-700 hover:text-[#D4AF37] transition-colors">About</a>
            <a href="{{ route('contact') }}" class="block py-2 text-sm font-medium text-gray-700 hover:text-[#D4AF37] transition-colors">Contact</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block py-2 text-sm font-medium text-gray-700 hover:text-[#D4AF37] transition-colors">Account</a>
                <form action="{{ route('logout') }}" method="POST" class="block">
                    @csrf
                    <button type="submit" class="py-2 text-sm font-medium text-gray-700 hover:text-[#D4AF37] transition-colors text-left">Logout</button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="block py-2 text-sm font-medium text-gray-700 hover:text-[#D4AF37] transition-colors">Login</a>
            @endguest
        </div>
    </div>
</header>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
}
</script>
