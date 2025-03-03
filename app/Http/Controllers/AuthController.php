<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

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
        if (Auth::attempt($request->only('email', 'password') + ['is_customer' => false])) {
            return redirect()->route('dashboard');
        }

        // Check if credentials are valid BUT user is a customer
        $user = User::where('email', $request->email)->first();
        if ($user && $user->is_customer && Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Unauthorized login for customers']);
        }

        logger('Session ID before error flash: ' . session()->getId());

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

    public function updatePasswordPage(Request $request)
{
    $token = $request->query('token');

    if (!$token) {
        return redirect()->route('login');
    }

    $user = User::where('password_reset_token', $token)->first();

    if (!$user) {
        return redirect()->route('login')->withErrors('Invalid token');
    }

    if (!$user->password_reset_sent_at) {
        return redirect()->route('login')->withErrors('Invalid token');
    }

    $tokenSentAt = Carbon::parse($user->password_reset_sent_at);
    if (now()->diffInHours($tokenSentAt) > 5) {
        return redirect()->route('login')->withErrors('Token expired');
    }

    return view('password-reset', ['token' => $token]);
}

public function updatePassword(Request $request, $token)
{
    $validated = $request->validate([
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = User::where('password_reset_token', $token)->first();

    if (!$user) {
        return redirect()->route('login')->withErrors('Invalid token');
    }

    if (!$user->password_reset_sent_at) {
        return redirect()->route('login')->withErrors('Invalid token');
    }

    $tokenSentAt = Carbon::parse($user->password_reset_sent_at);
    if (now()->diffInHours($tokenSentAt) > 5) {
        return redirect()->route('login')->withErrors('Token expired');
    }

    try {
        $user->update([
            'password' => Hash::make($validated['new_password']),
            'password_reset_token	' => null,
            'password_reset_sent_at' => null,
        ]);
    } catch (\Exception $e) {
        logger()->error('Password update error: ' . $e->getMessage());
        return redirect()->route('login')->withErrors('Failed to update password');
    }

    return redirect()->route('login')->with('status', 'Password updated successfully');
}

    


}
