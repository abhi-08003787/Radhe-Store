<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackController extends Controller
{
    public function index()
    {
        return view('order-track');
    }

    public function showTrackForm()
    {
        return view('order-track');
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string',
            'email' => 'required|email',
        ]);

        $orderId = $request->input('order_id');
        $email = $request->input('email');

        // Find order by id and email through user relationship
        $order = Order::where('id', $orderId)
            ->whereHas('user', function($query) use ($email) {
                $query->where('email', $email);
            })
            ->first();

        // Check if order exists
        if (!$order) {
            return back()->with('error', 'Order ID or Email is incorrect.')->withInput();
        }

        // Load order with items and products
        $order->load(['items.product']);

        return view('order-track', [
            'trackedOrder' => $order,
            'searchedOrderId' => $orderId,
            'searchedEmail' => $email
        ]);
    }

    /**
     * Update order status with timestamp
     */
    public static function updateStatusWithTimestamp(Order $order, string $status): void
    {
        $order->status = $status;
        
        // Set timestamp based on status
        switch ($status) {
            case 'pending':
                if (!$order->placed_at) {
                    $order->placed_at = now();
                }
                break;
            case 'processing':
                if (!$order->processing_at) {
                    $order->processing_at = now();
                }
                break;
            case 'shipped':
                if (!$order->shipped_at) {
                    $order->shipped_at = now();
                }
                break;
            case 'delivered':
                if (!$order->delivered_at) {
                    $order->delivered_at = now();
                }
                break;
        }
        
        $order->save();
    }
}
