<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;

class UserController extends Controller
{
    //
    public function account()
    {
        $user_id = auth()->id();
        
        $orders = Order::where('user_id', $user_id)->with('orderItems')->get();

        return view('user.account', ['orders' => $orders]);
    }
}
