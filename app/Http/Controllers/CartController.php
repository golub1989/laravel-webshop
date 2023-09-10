<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItems;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{

    public function cart()
    {
        return view('cart.cart');
    }
    public function addToCart(Request $request)
    {
        $user = Auth::user();

        $sessionCart = \session()->get('cart', []);

        if (!$user) {
            return redirect()->to('/login');
        }

        $cart = Cart::where('user_id', $user->id)->firstOrCreate(['user_id' => $user->id]);
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        CartItems::create([
            'cart_id' => $cart->id,
            'product_id' => $product_id,
            'quantity' => $quantity,
        ]);

        $sessionCart[$product_id] = [
            'quantity' => $quantity,
        ];

        \session()->put('cart', $sessionCart);
        $cartCount = count($sessionCart);

        session(['cartCount' => $cartCount]);

        return \response()->json(['quantity' => $quantity, 'cartCount' => $cartCount]);

    }

    public function getCartCount()
    {
        $cartCount = session('cartCount', 0);
        return \response()->json(['cartCount' => $cartCount]);
    }

    public function changeQuantity(Request $request)
    {

        $user = Auth::user();
        $sessionCart = \session()->get('cart', []);

        $cart = Cart::where('user_id', $user->id)->firstOrCreate(['user_id' => $user->id]);

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cartItem = CartItems::where('cart_id', $cart->id)->where('product_id', $product_id)->first();

        if ($cartItem) {
            $action = $request->input('action');

            if ($action === 'increment') {
                $cartItem->update(['quantity' => $cartItem->quantity + 1]);
            } else if ($action === 'decrement') {
                $cartItem->update(['quantity' => $cartItem->quantity - 1]);
            }

            \session()->put('cart', $sessionCart);
            $cartCount = count($sessionCart);

            session(['cartCount' => $cartCount]);


            return response()->json(['quantity' => $cartItem->quantity, 'cartCount' => $cartCount]);
        }

        return response()->json(['quantity' => 0]);
    }

    public function viewCart()
    {
        $user_id = auth()->id();

        $cart = Cart::where('user_id', $user_id)->with('cartItems')->first();

        return view('cart.viewCart', ['cart' => $cart]);
    }

    public function destroy($cartItemId)
    {
        $sessionCart = \session()->get('cart', []);

        $item = CartItems::findOrFail($cartItemId);
        $item->delete();

        if (isset($sessionCart[$item->product_id])) {
            unset($sessionCart[$item->product_id]);
        }
        \session()->put('cart', $sessionCart);
        $cartCount = count($sessionCart);

        //session()->forget('cartCount');
        \session(['cartCount' => $cartCount]);
        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        $user_id = auth()->id();

        $cart = Cart::where('user_id', $user_id)->first();

        if ($cart) {
            $cart->cartItems()->delete();
            session()->forget('cartCount');
            \session()->forget('cart');
            //session()->flush();

            return redirect()->back()->with('success', 'Cart cleared.');
        }

        return redirect()->back()->with('error', 'No cart found.');
    }
}