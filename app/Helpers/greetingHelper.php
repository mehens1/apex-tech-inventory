<?php
use Carbon\Carbon;

function getGreeting()
{
    // $hour = Carbon::now()->hour + 1;
    $hour = Carbon::now()->addHour()->hour;

    if ($hour >= 0 && $hour < 12) {
        return 'Good Morning';
    } elseif ($hour >= 12 && $hour < 18) {
        return 'Good Afternoon';
    } else {
        return 'Good Evening';
    }
}
