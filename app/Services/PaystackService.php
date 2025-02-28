<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use Illuminate\Http\Request;

$url = env('PAYSTACK_PAYMENT_URL') . '/transaction/initialize';
$secretKey = env('PAYSTACK_SECRET_KEY');

class PaystackService
{
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
        $order = Order::where('reference_number', $reference)->first();
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
                if ($order->status === 'pending') {
                    $order->status = 'paid';
                    $order->save();
                    return response()->json([
                        'message' => 'Payment successful',
                        'details' => $data,
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Payment successful',
                        'Order Status' => $order->status,
                        'details' => $data,
                    ]);
                }
            }
        } else {
            return response()->json([
                'error' => 'Payment verification failed',
                'details' => $response->body(),
            ], $response->status());
        }
    }

    public function getUpdate(Request $request)
    {
        $payload = $request->all();
        $input = @file_get_contents("php://input");
        $signature = $request->header('HTTP_X_PAYSTACK_SIGNATURE');
        if (!$signature) {
            return response()->json([
                'error' => 'Signature not found',
            ], 400);
        }

        if ($signature !== hash_hmac('sha512', $input, $secretKey)){
            return response()->json([
                'error' => 'Invalid signature',
            ], 400);
        }

        if (!isset($payload['event']) || !isset($payload['data'])) {
            return response()->json([
                'error' => 'Invalid payload',
            ], 400);
        }
        $event = $payload['event'];
        $data = $payload['data'];

        if ($event === 'charge.success') {
            $order = Order::where('id', $data['reference'])->first();
            if ($order && $data['amount'] == $order->total_amount * 100) 
            {
                $order->status = 'paid';
                $order->save();
            }
        }
        return response()->json([
            'message' => 'Update received',
        ], 200);
    }
}