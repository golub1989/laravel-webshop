<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create()
    {
        return view('login.create');
    }

    public function store()
    {
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'msg' => 'Wrong email or password, try again!'
            ]);
        }
        return redirect()->to('/');
    }

    public function logout()
    {
        
    }
}
