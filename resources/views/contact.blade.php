@extends('layouts.app')

@section('title', 'Contact Us - Radhe Store')

@section('content')
<div class="bg-[#FCF9F5]">
    {{-- Hero Section --}}
    <section class="relative h-[30vh] flex items-center justify-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1450297350677-623de575f31c?auto=format&fit=crop&q=80&w=2000" class="absolute inset-0 w-full h-full object-cover opacity-20" alt="Contact Banner">
        <div class="relative z-10 text-center px-4">
            <p class="text-[11px] tracking-[0.3em] uppercase text-[#D4AF37] font-semibold mb-3">Connect With Us</p>
            <h1 class="serif text-4xl md:text-5xl text-[#2b0505]">Contact Our Team</h1>
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-white/0 to-[#FCF9F5]"></div>
    </section>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 md:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            {{-- Contact Information --}}
            <div class="space-y-12">
                <div>
                    <p class="text-[11px] tracking-[0.25em] uppercase text-[#D4AF37] font-bold mb-4">Get In Touch</p>
                    <h2 class="serif text-3xl md:text-4xl text-[#2b0505] mb-6">We'd Love to Hear From You</h2>
                    <p class="text-black/70 leading-relaxed max-w-md">
                        Whether you have a question about our collections, pricing, or custom orders, our team is ready to assist you with personalized attention.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <h4 class="text-[10px] font-bold tracking-widest uppercase text-[#2b0505]">Our Boutique</h4>
                        <p class="text-sm text-black/60 leading-relaxed">
                            NIRDOSHANAND SOCIETY<br>
                           JASDAN RAJKOT ROAD<br>
                           AT VIRNAGAR 360060
                        </p>
                    </div>
                    <div class="space-y-3">
                        <h4 class="text-[10px] font-bold tracking-widest uppercase text-[#2b0505]">Customer Service</h4>
                        <p class="text-sm text-black/60 leading-relaxed">
                            radhestore@gmail.com<br>
                            +91 9106258956<br>
                            Mon - Sat: 10am - 8pm
                        </p>
                    </div>
                </div>

                <div class="pt-8 border-t border-black/5">
                    <h4 class="text-[10px] font-bold tracking-widest uppercase text-[#2b0505] mb-6">Follow Our Story</h4>
                    <div class="flex gap-6">
                        <a href="https://www.instagram.com/radhestore/" target="_blank" class="text-black/40 hover:text-[#D4AF37] transition-colors text-2xl" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.facebook.com/radhestore/" target="_blank" class="text-black/40 hover:text-[#D4AF37] transition-colors text-2xl" title="Facebook"><i class="bi bi-facebook"></i></a>
                      
                    </div>
                </div>
            </div>

            {{-- Contact Form Section --}}
            <div class="bg-white rounded-[40px] shadow-[0_20px_50px_rgba(0,0,0,0.05)] p-8 md:p-12 border border-black/5">
                @if(session('success'))
                    <div class="mb-8 p-5 rounded-2xl bg-green-50 text-green-700 text-sm border border-green-100 flex items-center gap-3">
                        <i class="bi bi-check-circle-fill text-lg"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="text-[10px] tracking-widest uppercase font-bold text-black/60 ml-1">Full Name</label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                class="w-full rounded-2xl border border-black/10 bg-[#FCF9F5] px-5 py-4 text-sm outline-none focus:border-[#D4AF37] transition-colors"
                                placeholder="Enter your name">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="phone" class="text-[10px] tracking-widest uppercase font-bold text-black/60 ml-1">Phone Number</label>
                            <input type="text" id="phone" name="phone" required value="{{ old('phone') }}"
                                class="w-full rounded-2xl border border-black/10 bg-[#FCF9F5] px-5 py-4 text-sm outline-none focus:border-[#D4AF37] transition-colors"
                                placeholder="+91 00000 00000">
                            @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="text-[10px] tracking-widest uppercase font-bold text-black/60 ml-1">Email Address</label>
                        <input type="email" id="email" name="email" required value="{{ old('email') }}"
                            class="w-full rounded-2xl border border-black/10 bg-[#FCF9F5] px-5 py-4 text-sm outline-none focus:border-[#D4AF37] transition-colors"
                            placeholder="your@email.com">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="message" class="text-[10px] tracking-widest uppercase font-bold text-black/60 ml-1">Your Message</label>
                        <textarea id="message" name="message" rows="5" required
                            class="w-full rounded-2xl border border-black/10 bg-[#FCF9F5] px-5 py-4 text-sm outline-none focus:border-[#D4AF37] transition-colors resize-none"
                            placeholder="How can we help you?">{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" 
                        class="w-full rounded-2xl bg-[#2b0505] py-5 text-xs font-bold tracking-[0.25em] uppercase text-white hover:bg-[#4a0a0a] transition-all transform hover:-translate-y-0.5 shadow-lg active:scale-95 mt-4">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Thank You!',
        text: 'Your message has been received. We will get back to you soon.',
        confirmButtonColor: '#D4AF37',
        confirmButtonText: 'OK',
        background: '#FCF9F5',
        iconColor: '#D4AF37'
    });
</script>
@endif
@endpush
