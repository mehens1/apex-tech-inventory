<?php

namespace App\Http\Controllers\Api;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('apex-solar-inventory')->plainTextToken;
            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user,
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Invalid email or password',
        ], 401);

    }

    public function register(Request $request) {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'phone' => 'required|numeric|digits_between:10,15|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_customer' => true,
        ]);

        Auth::login($user);
        $token = $user->createToken('apex-solar-inventory')->plainTextToken;
        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });
        Auth::logout();
        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
        ], 200);
    }
}
