<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (count($cart) == 0) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('checkout', compact('cart', 'subtotal'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'payment_method' => 'required|string|in:cod,upi',
            'transaction_id' => 'required_if:payment_method,upi|string|max:255',
        ]);

        $cart = session()->get('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $subtotal,
            'status' => $request->payment_method === 'upi' ? 'pending_verification' : 'pending',
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'shipping_address' => json_encode($request->only(['first_name', 'last_name', 'address', 'city', 'state', 'zip', 'phone', 'email'])),
            'phone' => $request->phone,
        ]);

        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        // Clear the cart after successful order
        Session::forget('cart');

        $paymentMethod = $request->payment_method;
        $message = $paymentMethod === 'upi' 
            ? 'Order placed successfully via UPI payment!' 
            : 'Order placed successfully via Cash on Delivery!';

        return response()->json([
            'success' => true, 
            'payment_method' => $paymentMethod, 
            'message' => $message,
            'order_id' => $order->id,
            'redirect_url' => route('order.success', ['id' => $order->id])
        ]);
    }

    public function success(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $order = Order::with('items.product')->findOrFail($id);
        } else {
            $order = Order::with('items.product')->latest()->first();
        }

        if (!$order) {
            return redirect()->route('shop.index')->with('error', 'Order not found.');
        }
        
        return view('order-success', compact('order'));
    }

    public function receipt(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $order = Order::with('items.product')->findOrFail($id);
        } else {
            $order = Order::with('items.product')->latest()->first();
        }

        if (!$order) {
            return redirect()->route('shop.index')->with('error', 'Order not found.');
        }
        
        return view('order-receipt', compact('order'));
    }
}
