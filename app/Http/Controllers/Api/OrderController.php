<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Support\Facades\DB;
use App\Models\Discount;
use Illuminate\Support\Str;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Create($validated, $total, $user_id=null)
    {
        return DB::transaction(function () use ($validated, $user_id, $total) {
            $order = new Order();
            $order->user_id = $user_id;
            $order->discount_code = $validated['discount_code'];
            $order->first_name = $validated['first_name'];
            $order->last_name = $validated['last_name'];
            $order->email = $validated['email'];
            $order->phone = $validated['phone'];
            $order->vat = $validated['vat'];
            $order->shipping_address = $validated['shipping_address'];
            $order->payment_method = $validated['payment_method'];
            $order->total_amount = $total;
            $order->reference_number = "ORD-" . Str::random(6);
            $order->save();

            foreach ($validated['items'] as $item) {
                $product = Product::find($item['id']);
                if (!$product) {
                    continue;
                }
                $price = $product->selling_price;
                $orderItem = new OrderItems();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item['id'];
                $orderItem->price = $price;
                $orderItem->quantity = $item['quantity'];
                $orderItem->save();
            }
            return $order;
        });

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
