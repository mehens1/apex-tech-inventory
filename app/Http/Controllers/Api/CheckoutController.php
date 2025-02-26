<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;

$url = env('PAYSTACK_PAYMENT_URL') . '/transaction/initialize';
$secretKey = env('PAYSTACK_SECRET_KEY');


class CheckoutController extends Controller
{
    public function placeorder (Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'discount_code' => 'nullable|string',
            'vat' => 'nullable|numeric',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'billing_address' => 'required|string',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $total = 0;

        foreach ($validated['items'] as $item) {
            $product = Product::find($item['id']);
            if ($product) {
                $total += $product->selling_price * $item['quantity'];
            }
        }
        if ($validated['discount_code']) {
            $discount = Discount::where('code', $validated['discount_code'])->first();
            if ($discount) {
                if ($discount->type == 'fixed') {
                    $total -= $discount->value;
                } elseif ($discount->type == 'percentage') {
                    $total -= ($total * ($discount->value / 100));
                }
            }
        }

        $totalaftervat = $total + $validated['vat'];

        $orderController = new OrderController();
        $order = $orderController->create($validated, $totalaftervat);
        $payment = $this->payment($totalaftervat, $order->id);
        return $payment;
    }

    public function payment($totalaftervat, $order_id)
    {
        $order = Order::find($order_id);
        if (!$order) {
            return response()->json([
                'error' => 'Order not found while creating payment',
            ], 404);
        }
        $url = env('PAYSTACK_PAYMENT_URL') . '/transaction/initialize';
        $secretKey = env('PAYSTACK_SECRET_KEY');
        $payAmount = floatval($totalaftervat * 100); // Amount should be in the smallest currency unit
        $urlcallback = url('/api/order/');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $secretKey,
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
        ])->post($url, [
            'email'  => $order->email,
            'amount' => $payAmount, // Amount should be in the smallest currency unit
            'reference' => $order_id,
            'currency' => "NGN",
            'callback_url' => $urlcallback,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            // Process the response data as needed
            return response()->json($data);
        } else {
            // Handle errors accordingly
            return response()->json([
                'error'   => 'Transaction initialization failed',
                'details' => $response->body(),
            ], $response->status());
        
               
        }
    }

    public function CallBack(Request $request)
    {
        $reference = $request->query('reference');
        if (!$reference) {
            return response()->json([
                'error' => 'Reference not found',
            ], 400);
        }
        $order = Order::where('id', $reference)->first();
        if (!$order) {
            return response()->json([
                'error' => 'Order not found',
            ], 404);
        }
        $url = env('PAYSTACK_PAYMENT_URL') . '/transaction/verify/' . $reference;
        $secretKey = env('PAYSTACK_SECRET_KEY');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $secretKey,
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
        ])->get($url);

        if ($response->successful()) {
            $data = $response->json();
            if ($data['data']['status'] === 'success' && $data['data']['amount'] == $order->total_amount * 100) {
                $order->status = 'paid';
                $order->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Payment successful',
                    'order' => $order,
                ]);
            } else {
                return response()->json([
                    'error' => 'Payment pending',
                    'details' => $data,
                ], 400);
            }
        } else {
            return response()->json([
                'error' => 'Payment verification failed',
                'details' => $response->body(),
            ], $response->status());
        }
    }
}
