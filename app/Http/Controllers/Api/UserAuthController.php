<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordRest;
use App\Http\Controllers\EmailController;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required|min:8',
        ]);

        $fieldType = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $credentials = [$fieldType => $request->identifier, 'password' => $request->password];

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials. Please check your email/phone and password.',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => Auth::user(),
        ], 200);
    }

    public function register(Request $request) {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|digits_between:10,15|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_customer' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => "$user->firstName, you have been registered successfully!",
        ], 201);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            Auth::logout();

            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to log out.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function profile()
    {
        return response()->json([
            'success' => true,
            'user' => Auth::user(),
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found!',
            ], 404);
        }

        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
        ]);

        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!',
            'user' => $user,
        ], 200);
    }

    public function forgetPassword(Request $request) 
    {
        if (Auth::check()) {
            return $this->changePassword($request);
        }

        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found!',
            ], 404);
        }

        $token = substr(JWTAuth::fromUser($user), 0, 255);

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate token!',
            ], 500);
        }

        $user->password_reset_token = $token;
        $user->password_reset_sent_at = now();
        $user->save();
        
        $resetUrl = url('/api/reset-password?/?token=' . $token);

        $emailController = new EmailController();
        $emailController->resetpassword($resetUrl, $user->email);

        return response()->json([
            'success' => true,
            'message' => 'Password reset link sent to your email!',
            'resetUrl' => $resetUrl,
        ], 200);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found!',
            ], 404);
        }

        if (!Hash::check($request->currentPassword, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect.',
            ], 400);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully!',
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $token = $request->query('token');
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Rest your password again!',
            ], 400);
        }

        $request->validate([
            'newPassword' => 'required|min:8',
        ]);

        $user = User::where('password_reset_token', $token)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'No user found, Invalid token!',
            ], 400);
        }

        if (now()->diffInHours(Carbon::parse($user->password_reset_sent_at)) > 1) {
            return response()->json([
                'success' => false,
                'message' => 'Rest your password again!',
            ], 400);
        }


        $user->password = Hash::make($request->newPassword);
        $user->password_reset_token = null;
        $user->password_reset_sent_at = null;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password reset successfully!',
        ], 200);
    }



}
