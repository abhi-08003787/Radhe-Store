<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Shipping Information',
                'slug' => 'shipping-info',
                'content' => '<h2>Delivery Time</h2><p>Standard delivery takes <strong>5-7 business days</strong> across India. We work with reliable courier partners to ensure your order reaches you safely and on time.</p><h2>Shipping Charges</h2><p>Enjoy <strong>FREE shipping</strong> on all orders above ₹499. For orders below ₹499, a nominal shipping charge will be applied at checkout.</p><h2>Order Tracking</h2><p>Once your order is dispatched, tracking details will be sent to you via <strong>SMS and Email</strong>. You can use these details to track your package in real-time.</p><h2>Service Areas</h2><p>We deliver <strong>all over India</strong>. Whether you are in a metro city or a remote town, we will make sure your order reaches you.</p>',
                'is_active' => true,
            ],
            [
                'title' => 'FAQ',
                'slug' => 'faq',
                'content' => '<h2>Frequently Asked Questions</h2><h3>How can I track my order?</h3><p>You can track your order using our Track Order page. Simply enter your order ID and email address to get real-time updates. Additionally, we send tracking details via SMS and email once your order is dispatched.</p><h3>Do you offer Cash on Delivery (COD)?</h3><p>Yes, we offer Cash on Delivery (COD) on most pin codes across India. You can select COD as your payment method during checkout for a convenient payment experience.</p><h3>What is your return policy?</h3><p>We offer returns only on damaged or wrong products with a mandatory unboxing video. Returns must be requested within 24 hours of delivery, and the product must be in its original packaging. Please read our complete Return & Refund Policy for more details.</p><h3>How long does delivery take?</h3><p>Standard delivery usually takes 5-7 business days across India. We work with reliable courier partners to ensure your jewelry reaches you safely and on time.</p><h3>Can I change my delivery address after placing an order?</h3><p>Yes, you can change your delivery address within 12 hours of placing your order. Simply contact our customer support team with your order number, and we will update the address for you.</p>',
                'is_active' => true,
            ],
            [
                'title' => 'Return & Refund Policy',
                'slug' => 'return-policy',
                'content' => '<h2>Return Policy</h2><p>Returns are only accepted for damaged or wrong products. Returns must be requested within 24 hours of delivery. The product must be unused and in its original packaging.</p><h2>Unboxing Video Requirement</h2><p>An unboxing video is mandatory for any return or refund claims. Without a proper unboxing video, we will not be able to process any return or refund requests.</p><h2>Refund Policy</h2><p>Once the return is received and inspected, we will process your refund. Refunds will be issued to the original payment method within 5-7 business days. Shipping charges are non-refundable.</p><h2>Contact Us</h2><p>For any questions regarding our return and refund policy, please contact us at radhestore@gmail.com or call +91 9106258956.</p>',
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
