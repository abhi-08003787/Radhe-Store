@extends('layouts.app')

@section('title', 'About Us - Radhe Store')

@section('content')
<div class="bg-[#FCF9F5]">
    {{-- Hero Section --}}
    <section class="relative h-[40vh] flex items-center justify-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?auto=format&fit=crop&q=80&w=2000" class="absolute inset-0 w-full h-full object-cover opacity-30" alt="About Banner">
        <div class="relative z-10 text-center px-4">
            <p class="text-[11px] tracking-[0.3em] uppercase text-[#D4AF37] font-semibold mb-3">Our Journey</p>
            <h1 class="serif text-4xl md:text-5xl text-[#2b0505]">About Radhe Store</h1>
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-white/0 to-[#FCF9F5]"></div>
    </section>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="max-w-3xl mx-auto">
            {{-- Our Story Section --}}
            <div>
                <p class="text-[11px] tracking-[0.25em] uppercase text-[#D4AF37] font-bold mb-4">Our Story</p>
                <h2 class="serif text-3xl md:text-4xl text-[#2b0505] mb-8 text-center">Heritage & Elegance in Every Piece</h2>
                <div class="space-y-6 text-black/70 leading-relaxed text-lg">
                    <p>
                        Founded with a passion for preserving traditional craftsmanship, Radhe Store brings you an exquisite collection of heritage jewelry. Every piece we create is a tribute to the royal era, blending timeless designs with modern elegance.
                    </p>
                    <p>
                        From the intricate detailing of our Rani Hars to the majestic presence of our Rajwadi sets, our jewelry is crafted for those who appreciate the finer things in life. We believe that jewelry is more than just an accessory; it's a reflection of your legacy and personal style.
                    </p>
                    <p>
                        Our artisans dedicate countless hours to ensuring each gemstone is perfectly set and every gold finish is flawless, providing you with pieces that can be passed down through generations.
                    </p>
                </div>
                
                <div class="mt-16 grid grid-cols-3 gap-8 text-center border-y border-black/5 py-12">
                    <div>
                        <p class="serif text-3xl text-[#D4AF37]">15+</p>
                        <p class="text-[10px] tracking-widest uppercase text-black/50 mt-2 font-bold">Years of Craft</p>
                    </div>
                    <div>
                        <p class="serif text-3xl text-[#D4AF37]">5k+</p>
                        <p class="text-[10px] tracking-widest uppercase text-black/50 mt-2 font-bold">Happy Brides</p>
                    </div>
                    <div>
                        <p class="serif text-3xl text-[#D4AF37]">100%</p>
                        <p class="text-[10px] tracking-widest uppercase text-black/50 mt-2 font-bold">Authentic</p>
                    </div>
                </div>

                <div class="mt-16 text-center">
                    <a href="{{ route('contact') }}" class="inline-block bg-[#2b0505] text-white px-10 py-5 text-xs font-bold uppercase tracking-[0.2em] rounded-2xl hover:bg-[#4a0a0a] transition-all transform hover:-translate-y-1 shadow-xl no-underline">
                        Get In Touch With Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- About page scripts if needed --}}
@endpush
