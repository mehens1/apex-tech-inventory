<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CustomerController extends Controller
{
    public function all()
    {
        $Customer = User::select('id', 'firstName', 'lastName', 'phone', 'email')
            ->where('is_customer', true)
            ->withCount('orders')
            ->withSum('orders', 'total_amount')
            ->get();

        
        return view('customers', compact('customers'));
    }
}
