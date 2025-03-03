<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;
use App\Http\Controllers\EmailController;

class ForgetPassword
{

    public function PasswordLink($email) 
    {

        $user = User::where('email', $email)->first();

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

}