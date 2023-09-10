<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function account()
    {

        $user = auth()->user();

        return view('user.account', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            $user->update(['password' => Hash::make($request->new_password)]);
            return redirect()->route('home')->with('success', 'Password changed.');
        } else {
            return back()->withErrors(['current_password' => 'Incorrect current password']);
        }



        return redirect()->to('/login');
    }
}