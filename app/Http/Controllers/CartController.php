<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;


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
        
        $user_id = auth()->id();
        
        $cart = Cart::where('user_id', $user_id)->with('cartItems')->first();
        

        return view('cart.viewCart', ['cart' => $cart]);
    }

    public function delete()
    {
        $user = auth()->user();

        if ($user) {
            $cart = $user->cart;
    
                \DB::table('cart_items')->where('cart_id', $cart->id)->delete();
                
                //$cart->delete();
                
                return view('cart.viewCart', []);
        
            
        }
    }
}
