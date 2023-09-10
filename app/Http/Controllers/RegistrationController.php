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
        $validator = $this->validate(request(), ['name' => 'required', 'email' => 'required|unique:users', 'password' => 'required|min:8']);

        if (!$validator) {
            return redirect()->back()->withErrors($validator);
        }
        $user = User::create(request(['name', 'email', 'password']));

        Auth::login($user);

        return redirect()->to('/login');
    }
}