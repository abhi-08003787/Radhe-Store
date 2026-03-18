@extends('layouts.app')

@section('title', 'FAQ - Radhe Store')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <h1 class="serif text-3xl md:text-4xl text-[#2b0505] mb-8 text-center">Frequently Asked Questions</h1>
        
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="accordion-item">
                        <button class="w-full px-6 py-4 text-left bg-[#FCF9F5] hover:bg-[#f0f0f0] transition-colors flex justify-between items-center focus:outline-none" onclick="toggleAccordion(this)">
                            <span class="font-semibold text-[#2b0505]">How can I track my order?</span>
                            <svg class="w-5 h-5 text-[#D4AF37] transform transition-transform accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="accordion-content hidden px-6 py-4 bg-white border-t border-gray-200">
                            <p class="text-gray-600">You can track your order using our 'Track Order' page. Simply enter your order ID and email address to get real-time updates. Additionally, we send tracking details via SMS and email once your order is dispatched.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="accordion-item">
                        <button class="w-full px-6 py-4 text-left bg-[#FCF9F5] hover:bg-[#f0f0f0] transition-colors flex justify-between items-center focus:outline-none" onclick="toggleAccordion(this)">
                            <span class="font-semibold text-[#2b0505]">Do you offer Cash on Delivery (COD)?</span>
                            <svg class="w-5 h-5 text-[#D4AF37] transform transition-transform accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="accordion-content hidden px-6 py-4 bg-white border-t border-gray-200">
                            <p class="text-gray-600">Yes, we offer Cash on Delivery (COD) on most pin codes across India. You can select COD as your payment method during checkout for a convenient payment experience.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="accordion-item">
                        <button class="w-full px-6 py-4 text-left bg-[#FCF9F5] hover:bg-[#f0f0f0] transition-colors flex justify-between items-center focus:outline-none" onclick="toggleAccordion(this)">
                            <span class="font-semibold text-[#2b0505]">What is your return policy?</span>
                            <svg class="w-5 h-5 text-[#D4AF37] transform transition-transform accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="accordion-content hidden px-6 py-4 bg-white border-t border-gray-200">
                            <p class="text-gray-600">We offer returns only on damaged or wrong products with a mandatory unboxing video. Returns must be requested within 24 hours of delivery, and the product must be in its original packaging. Please read our complete Return & Refund Policy for more details.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="accordion-item">
                        <button class="w-full px-6 py-4 text-left bg-[#FCF9F5] hover:bg-[#f0f0f0] transition-colors flex justify-between items-center focus:outline-none" onclick="toggleAccordion(this)">
                            <span class="font-semibold text-[#2b0505]">How long does delivery take?</span>
                            <svg class="w-5 h-5 text-[#D4AF37] transform transition-transform accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="accordion-content hidden px-6 py-4 bg-white border-t border-gray-200">
                            <p class="text-gray-600">Standard delivery usually takes 5-7 business days across India. We work with reliable courier partners to ensure your jewelry reaches you safely and on time. Express delivery options may be available at checkout.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="accordion-item">
                        <button class="w-full px-6 py-4 text-left bg-[#FCF9F5] hover:bg-[#f0f0f0] transition-colors flex justify-between items-center focus:outline-none" onclick="toggleAccordion(this)">
                            <span class="font-semibold text-[#2b0505]">Can I change my delivery address after placing an order?</span>
                            <svg class="w-5 h-5 text-[#D4AF37] transform transition-transform accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="accordion-content hidden px-6 py-4 bg-white border-t border-gray-200">
                            <p class="text-gray-600">Yes, you can change your delivery address within 12 hours of placing your order. Simply contact our customer support team with your order number, and we'll update the address for you.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Help Section -->
            <div class="mt-12 p-6 bg-[#FCF9F5] rounded-lg">
                <h3 class="text-xl font-semibold text-[#2b0505] mb-4">Still Have Questions?</h3>
                <p class="text-gray-600 mb-6">
                    Can't find the answer you're looking for? Our customer support team is here to help you with any questions about your orders, products, or services.
                </p>
                <div class="flex flex-col md:flex-row gap-4">
                    <a href="{{ route('contact') }}" class="flex-1 bg-[#D4AF37] text-white px-6 py-3 rounded-lg text-center font-medium hover:bg-[#b88a2b] transition-colors">
                        Contact Support
                    </a>
                    <a href="{{ route('shipping.info') }}" class="flex-1 bg-white border border-[#D4AF37] text-[#D4AF37] px-6 py-3 rounded-lg text-center font-medium hover:bg-[#FCF9F5] transition-colors">
                        Shipping Info
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleAccordion(button) {
    const content = button.nextElementSibling;
    const icon = button.querySelector('.accordion-icon');
    
    // Toggle content
    content.classList.toggle('hidden');
    
    // Rotate icon
    if (content.classList.contains('hidden')) {
        icon.style.transform = 'rotate(0deg)';
    } else {
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>
@endsection
