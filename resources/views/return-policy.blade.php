@extends('layouts.app')

@section('title', 'Return & Refund Policy - Radhe Store')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <h1 class="serif text-3xl md:text-4xl text-[#2b0505] mb-8 text-center">Return & Refund Policy</h1>
        
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
            <div class="prose max-w-none">
                <p class="text-gray-600 mb-6">
                    At Radhe Store, we strive to provide you with the best quality products and services. Please read our return and refund policy carefully before making a purchase.
                </p>

                <h2 class="text-xl font-semibold text-[#2b0505] mb-4 mt-8">Return Policy</h2>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                    <p class="font-semibold text-red-700 mb-2">Important Notice:</p>
                    <p class="text-red-700">Returns are only accepted for damaged or wrong products.</p>
                </div>
                
                <ul class="list-disc pl-6 space-y-2 text-gray-600 mb-6">
                    <li>Returns must be requested within 24 hours of delivery.</li>
                    <li>The product must be unused and in its original packaging.</li>
                    <li>Damaged or defective items must be reported immediately upon receipt.</li>
                    <li>Wrong product deliveries must be reported within 24 hours.</li>
                </ul>

                <h2 class="text-xl font-semibold text-[#2b0505] mb-4 mt-8">Unboxing Video Requirement</h2>
                <div class="bg-[#FCF9F5] border border-[#D4AF37] p-4 mb-6 rounded-lg">
                    <p class="font-semibold text-[#D4AF37] mb-2">📹 Mandatory Unboxing Video:</p>
                    <p class="text-gray-700">An unboxing video is mandatory for any return or refund claims. Without a proper unboxing video, we will not be able to process any return or refund requests.</p>
                </div>
                
                <ul class="list-disc pl-6 space-y-2 text-gray-600 mb-6">
                    <li>The video must clearly show the package being opened.</li>
                    <li>The product condition must be visible throughout the unboxing.</li>
                    <li>The video must not be edited or cut.</li>
                    <li>Submit the video along with your return request.</li>
                </ul>

                <h2 class="text-xl font-semibold text-[#2b0505] mb-4 mt-8">Refund Policy</h2>
                <ul class="list-disc pl-6 space-y-2 text-gray-600 mb-6">
                    <li>Once the return is received and inspected, we will process your refund.</li>
                    <li>Refunds will be issued to the original payment method within 5-7 business days.</li>
                    <li>Shipping charges are non-refundable.</li>
                    <li>For Cash on Delivery orders, refunds will be processed via bank transfer.</li>
                </ul>

                <h2 class="text-xl font-semibold text-[#2b0505] mb-4 mt-8">Non-Returnable Items</h2>
                <ul class="list-disc pl-6 space-y-2 text-gray-600 mb-6">
                    <li>Products damaged due to misuse or mishandling.</li>
                    <li>Items without original packaging and tags.</li>
                    <li>Products showing signs of wear and tear.</li>
                    <li>Customized or personalized orders.</li>
                </ul>

                <h2 class="text-xl font-semibold text-[#2b0505] mb-4 mt-8">How to Request a Return</h2>
                <ol class="list-decimal pl-6 space-y-2 text-gray-600 mb-6">
                    <li>Contact our customer service within 24 hours of delivery.</li>
                    <li>Provide your order number and reason for return.</li>
                    <li>Submit the mandatory unboxing video.</li>
                    <li>Wait for our team to review and approve your request.</li>
                    <li>Once approved, ship the product back to us in original packaging.</li>
                </ol>

                <h2 class="text-xl font-semibold text-[#2b0505] mb-4 mt-8">Contact Us</h2>
                <p class="text-gray-600 mb-4">
                    For any questions regarding our return and refund policy, please contact us:
                </p>
                <div class="bg-[#FCF9F5] p-4 rounded-lg">
                    <p class="text-gray-700"><strong>Email:</strong> radhestore@gmail.com</p>
                    <p class="text-gray-700"><strong>Phone:</strong> +91 9106258956</p>
                    <p class="text-gray-700"><strong>Address:</strong> NIRDOSHANAND SOCIETY JASDAN RAJKOT ROAD AT VIRNAGAR</p>
                </div>

                <p class="text-sm text-gray-500 mt-8 pt-8 border-t border-gray-200">
                    This policy is effective as of {{ date('F Y') }} and may be updated from time to time. Please check this page regularly for any changes.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
