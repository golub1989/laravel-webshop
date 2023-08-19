<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {

        $user = auth()->id();
        $cart = Cart::where('user_id', $user)->with('cartItems.product')->first();

        if (!$user) {
            return redirect()->to('/login');
        }

        $order = Order::create([
            'user_id' => $user,
        ]);

        foreach ($cart->cartItems as $cartItem) {
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
            ]);
        }

        $cart->cartItems()->delete();

        //return redirect()->route('order.show', $order->id)->with('success', 'Order placed successfully.');
        return redirect()->to('show');
    }

    public function show()
    {

        $user_id = auth()->id();
        
        $orders = Order::where('user_id', $user_id)->with('orderItems')->first();
        

        //return view('cart.viewCart', ['cart' => $cart]);
        return view('order.show', ['orders' => $orders]);
    }
}
