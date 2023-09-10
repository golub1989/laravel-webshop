<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{

    public CartController $cartController;

    public function __construct(CartController $cartController)
    {
        $this->cartController = $cartController;
    }
    public function create()
    {
        return view('login.create');
    }

    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $cartCount = $request->session()->get('cartCount', 0);
            $request->session()->put('cartCount', $cartCount);
            return redirect()->to('/');
        }
        return redirect()->back()->withInput($request->only('email'))->withErrors(['email' => ''])->withErrors(['password' => 'Wrong email or password!']);
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->cartController->clear();
        $request->session()->forget('cartCount');
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}