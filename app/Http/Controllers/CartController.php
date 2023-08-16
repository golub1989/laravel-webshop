<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    public function cart()
    {
        return view('cart.cart');
    }
    public function addToCart(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->to('/login');
        }

        $cart = Cart::where('user_id', $user->id)->firstOrCreate(['user_id' => $user->id]);
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cartItem = CartItems::where('cart_id', $cart->id)->where('product_id', $product_id)->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
        } else {
            CartItems::create([
                'cart_id' => $cart->id,
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart.viewCart');

    }

    public function viewCart()
    {
        $cart = Cart::where('user_id', auth()->id())->with('cartItems')->first();
       
        return response()->json(['cart' => $cart]);



        return view('cart.viewCart', ['cart' => $cart]);
    }
}
