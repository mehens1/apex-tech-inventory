<?php

namespace App\Http\Controllers;

use App\Mail\PasswordRest;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function resetpassword($url, $email)
    {
        $title = 'Password Reset';
        $url = $url;

        Mail::to($email)->send(new PasswordRest($title, $url));

        return "Email sent successfully!";
    }
}