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
        $order = Order::where('user_id', auth()->id())
                    ->get();
        if (!$order) {
            return response()->json([
                'message' => 'No order found!',
                'status' => false,
                'status_code' => 404
            ]);
        }
        return response()->json([
            'message' => "Orders fetched successfully!",
            'status' => true,
            'status_code' => 200,
            'data' => $order
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Create($validated, $total, $user_id=null)
    {
        return DB::transaction(function () use ($validated, $user_id, $total) {
            $order = new Order();
            $order->user_id = $user_id;
            $order->discount_code = $validated['discount_code'] ?? null;
            $order->first_name = $validated['first_name'];
            $order->last_name = $validated['last_name'];
            $order->email = $validated['email'];
            $order->phone = $validated['phone'];
            $order->vat = $validated['vat'] ?? 0;
            $order->shipping_address = $validated['shipping_address'];
            $order->payment_method = $validated['payment_method'];
            $order->total_amount = $total;
            $order->reference_number = "ORD-" . Str::random(8);
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
    public function show(string $reference)
    {
        $userId = auth()->id();

        // Fetch the order with related items in one query
        $order = Order::where('reference_number', $reference)
                    ->with('items')
                    ->first();

        // Return 404 if the order is not found
        if (!$order) {
            return response()->json([
                'message' => 'Order not found!',
                'status' => false,
            ], 404);
        }

        // Check if the authenticated user is authorized to view the order
        if ($userId !== $order->user_id) {
            return response()->json([
                'message' => 'Unauthorized access!',
                'status' => false,
            ], 401);
        }

        // Return the order details
        return response()->json([
            'message' => 'Order fetched successfully!',
            'status' => true,
            'data' => $order
        ], 200);
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
