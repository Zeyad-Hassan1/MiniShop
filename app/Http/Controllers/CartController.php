<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $products = products::whereIn('id', array_keys($cart))->get();

        return view('cart.index', compact('products', 'cart'));
    }

    public function add(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        session()->put('cart', $cart);

        return response()->json(['success' => 'Product added to cart successfully!', 'cartCount' => count($cart)]);
    }
    public function purchase(){
        if(!Auth::check()){
            return redirect()->route('login')->with('message', 'please login to complete your purchase');
        }
        return redirect()->route('confirmation.form');
    }
    public function increase($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]++;
        }

        session()->put('cart', $cart);

        return back();
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id] > 1) {
                $cart[$id]--;
            } else {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);

        return back();
    }
}
