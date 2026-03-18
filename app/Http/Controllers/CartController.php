<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('cart', compact('cart', 'subtotal'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);
        $quantity = $request->quantity ?? 1;

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->sale_price ?? $product->regular_price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    /**
     * Store a product in the cart (alias for add).
     */
    public function store(Request $request)
    {
        return $this->add($request);
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                $cart[$request->id]["quantity"] = max(1, $request->quantity);
                session()->put('cart', $cart);
            }
            
            return $this->getCartResponse($request->id);
        }
    }

    /**
     * Remove item from cart.
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            
            return $this->getCartResponse();
        }
    }

    /**
     * Helper to return dynamic cart data for AJAX.
     */
    private function getCartResponse($updatedId = null)
    {
        $cart = session()->get('cart', []);
        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        $itemSubtotal = 0;
        if ($updatedId && isset($cart[$updatedId])) {
            $itemSubtotal = $cart[$updatedId]['price'] * $cart[$updatedId]['quantity'];
        }

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'subtotal' => '₹' . number_format($subtotal, 0),
            'item_subtotal' => '₹' . number_format($itemSubtotal, 0),
            'cart_count' => count($cart)
        ]);
    }
}
