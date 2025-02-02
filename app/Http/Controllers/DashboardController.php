<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function dashboard()
    {
        $greeting = getGreeting();
        $message = '';

        if ($greeting == "Good Morning") {
            $message = "Welcome to a new day of smart inventory management! Remember, every item tracked and every
                        stock updated brings us one step closer to efficiency and success. Let’s make today productive!";
        } elseif ($greeting == "Good Afternoon") {
            $message = "Keep up the momentum! Every effort you make this afternoon brings us closer to achieving excellence.
                        Stay focused and keep going strong!";
        } elseif ($greeting == "Good Evening") {
            $message = "As the day winds down, let’s reflect on our progress and prepare for a fresh start tomorrow.
                        Great achievements are built one step at a time!";
        }

        $data = [
            'salute' => $greeting,
            'message' => $message
        ];
        return view('portal.pages.dashboard', $data);
    }
}
