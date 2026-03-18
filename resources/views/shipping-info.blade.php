@extends('layouts.app')

@section('title', 'Shipping Information - Radhe Store')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <h1 class="serif text-3xl md:text-4xl text-[#2b0505] mb-8 text-center">Shipping Information</h1>
        
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
            <div class="prose max-w-none">
                <p class="text-gray-600 mb-8">
                    At Radhe Store, we strive to deliver your beautiful jewelry to you as quickly and safely as possible. Here's everything you need to know about our shipping process.
                </p>

                <!-- Delivery Time -->
                <div class="flex items-start space-x-4 mb-8">
                    <div class="flex-shrink-0 w-12 h-12 bg-[#D4AF37] rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-[#2b0505] mb-2">Delivery Time</h2>
                        <p class="text-gray-600">
                            Standard delivery takes <strong>5-7 business days</strong> across India. We work with reliable courier partners to ensure your order reaches you safely and on time.
                        </p>
                    </div>
                </div>

                <!-- Shipping Charges -->
                <div class="flex items-start space-x-4 mb-8">
                    <div class="flex-shrink-0 w-12 h-12 bg-[#D4AF37] rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-[#2b0505] mb-2">Free Shipping</h2>
                        <p class="text-gray-600">
                            Enjoy <strong>FREE shipping</strong> on all orders above ₹499. For orders below ₹499, a nominal shipping charge will be applied at checkout.
                        </p>
                    </div>
                </div>

                <!-- Order Tracking -->
                <div class="flex items-start space-x-4 mb-8">
                    <div class="flex-shrink-0 w-12 h-12 bg-[#D4AF37] rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-[#2b0505] mb-2">Order Tracking</h2>
                        <p class="text-gray-600">
                            Once your order is dispatched, tracking details will be sent to you via <strong>SMS and Email</strong>. You can use these details to track your package in real-time.
                        </p>
                    </div>
                </div>

                <!-- Service Areas -->
                <div class="flex items-start space-x-4 mb-8">
                    <div class="flex-shrink-0 w-12 h-12 bg-[#D4AF37] rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-[#2b0505] mb-2">Service Areas</h2>
                        <p class="text-gray-600">
                            We deliver <strong>all over India</strong>. Whether you're in a metro city or a remote town, we'll make sure your order reaches you.
                        </p>
                    </div>
                </div>

                <!-- Packaging -->
                <div class="flex items-start space-x-4 mb-8">
                    <div class="flex-shrink-0 w-12 h-12 bg-[#D4AF37] rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-[#2b0505] mb-2">Secure Packaging</h2>
                        <p class="text-gray-600">
                            All orders are carefully packed in premium, tamper-proof packaging to ensure your jewelry arrives in perfect condition.
                        </p>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-[#FCF9F5] p-6 rounded-lg mt-8">
                    <h3 class="text-lg font-semibold text-[#2b0505] mb-4">Need Help?</h3>
                    <p class="text-gray-600 mb-4">
                        If you have any questions about shipping or need assistance with your order, please contact us:
                    </p>
                    <div class="space-y-2">
                        <p class="text-gray-700"><strong>Email:</strong> radhestore@gmail.com</p>
                        <p class="text-gray-700"><strong>Phone:</strong> +91 9106258956</p>
                        <p class="text-gray-700"><strong>Address:</strong> NIRDOSHANAND SOCIETY JASDAN RAJKOT ROAD AT VIRNAGAR</p>
                    </div>
                </div>

                <p class="text-sm text-gray-500 mt-8 pt-8 border-t border-gray-200">
                    Last updated: {{ date('F Y') }}. Shipping policies are subject to change based on courier partner availability and seasonal demands.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
