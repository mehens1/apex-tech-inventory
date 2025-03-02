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
        $user = auth()->user();
        $customers = User::select('id', 'firstName', 'lastName', 'phone', 'email')
            ->where('is_customer', true)
            ->withCount('orders')
            ->withSum('orders', 'total_amount')
            ->get();


        return view('portal.pages.customers.customers', compact('customers', 'user'));
    }

    public function customerOrders()
    {
        $user = auth()->user();
        $orders = Order::select('id','first_name','last_name','email','reference_number', 'payment_method', 'total_amount', 'status', 'created_at')
            ->with('items')
            ->get();
        return view('portal.pages.customers.orders', compact('orders', 'user'));
    }

    public function customerOrderDetails(Order $order)
    {
        $user = auth()->user();
        $order->load('items.product');
        $orderItems = $order->items->map(function ($item) {
            return [
            'product' => $item->product,
            'quantity' => $item->quantity,
            ];
        });
        return view('portal.pages.customers.order', compact('order', 'orderItems', 'user'));
    }
}
