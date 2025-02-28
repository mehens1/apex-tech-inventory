<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CustomerController extends Controller
{
    public function allCustomer()
    {
        $Customer = User::select('id', 'firstName', 'lastName', 'phone', 'email')
            ->where('is_customer', true)
            ->withCount('orders')
            ->withSum('orders', 'total_amount')
            ->get();

        
        return view('customers', compact('customers'));
    }

    public function customerOrders()
    {
        $orders = Order::select('order_referemce', 'payment_mode', 'total_amount', 'status', 'created_at')
            ->with('items')
            ->get();
        return view('customer-orders', compact('orders'));
    }
}
