<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function loginPage() {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Add condition to prevent customer login
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'is_customer' => false // ← Block customers
        ])) {
            return redirect()->route('dashboard');
        }

        // Check if credentials are valid BUT user is a customer
        $user = User::where('email', $request->email)->first();
        if ($user && $user->is_customer && Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Unauthorized login for customers']);
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });
        Auth::logout();
        return redirect()->route('login');
    }

}
