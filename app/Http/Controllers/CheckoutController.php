<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('message', 'Your cart is empty.');
        }

        foreach ($cart as $id => $quantity) {
            $product = \App\Models\products::find($id);
            Order::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => $quantity,
                'total_price' => $product->price * $quantity,
            ]);
        }

        session()->forget('cart');

        return view('checkout.success')->with('success', 'Your order has been placed successfully.');
    }
}
