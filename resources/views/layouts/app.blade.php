<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Radhe Store - Heritage Jewelry')</title>
    
    {{-- Favicon --}}
    <link rel="icon" type="image/jpeg" href="{{ asset('images/favicon.jpeg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    {{-- Scripts --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <style>
        @keyframes fadeInSlide {
            0% {
                opacity: 0;
                transform: translateX(-20px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes shimmer {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
                text-shadow: 0 0 10px rgba(212, 175, 55, 0.5);
            }
        }
        
        @keyframes revealScroll {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-slide {
            animation: fadeInSlide 1s ease-out forwards;
        }
        
        .animate-shimmer {
            animation: shimmer 2s ease-in-out infinite;
        }
        
        /* Apply shimmer every 5 seconds */
        .animate-shimmer-delayed {
            animation: shimmer 2s ease-in-out infinite;
            animation-delay: 5s;
        }
        
        .animate-reveal-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s ease-out;
        }
        
        .animate-reveal-scroll.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Custom serif font class */
        .serif {
            font-family: 'Playfair Display', serif;
        }
    </style>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .serif { font-family: 'Playfair Display', serif; }
        
        /* Smooth Scrolling */
        html { scroll-behavior: smooth; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #D4AF37; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #b88a2b; }

        /* Premium Slider Styles */
        .animate-item {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .slide.active .animate-item {
            opacity: 1;
            transform: translateY(0);
        }
        .delay-1 { transition-delay: 0.2s; }
        .delay-2 { transition-delay: 0.4s; }
        .delay-3 { transition-delay: 0.6s; }

        .animate-image {
            transform: scale(1.1);
            transition: transform 6s ease-out;
        }
        .slide.active .animate-image {
            transform: scale(1);
        }

        .pagination-number .line {
            width: 0;
            height: 2px;
            background-color: #D4AF37;
            transition: width 0.5s ease;
        }
        .pagination-number .number.active + .line {
            width: 100%;
        }
        .pagination-number:hover .line {
            width: 50%;
        }

        /* Swiper Custom Pagination */
        .swiper-pagination-custom .swiper-pagination-bullet {
            width: 40px;
            height: 3px;
            background: #2b0505;
            border-radius: 0;
            opacity: 0.1;
            transition: all 0.3s ease;
        }
        .swiper-pagination-custom .swiper-pagination-bullet-active {
            opacity: 1;
            background: #D4AF37;
            width: 60px;
        }

        /* Premium CTA Styling */
        .premium-cta .cta-line {
            transform-origin: center;
        }
        .premium-cta:hover .cta-line {
            background-color: #D4AF37;
        }
    </style>
    <!-- QR Code Library -->
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[#FCF9F5] text-[#111111] antialiased">
    
    @include('layouts.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Scroll Reveal Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Footer text reveal animation on scroll
            const footerTextElement = document.querySelector('.animate-reveal-scroll');
            
            if (footerTextElement) {
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };
                
                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);
                
                observer.observe(footerTextElement);
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
