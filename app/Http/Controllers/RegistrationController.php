<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store()
    {

    
        
        $this->validate(request(), ['name' => 'required', 'email' => 'required|email', 'password' => 'required']);

        $user = User::create(request(['name', 'email', 'password']));
        Auth::login($user);

        return redirect()->to('/login');
    }
}
