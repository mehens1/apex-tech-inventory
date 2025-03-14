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
use App\Services\PaystackService;


class CheckoutController extends Controller
{

    public function __construct( PaystackService $paystackService)
    {
        $this->paystackService = $paystackService;
    }

    public function placeorder (Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'vat' => 'nullable|numeric',
            'discount_code' => 'nullable|string',
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
        if (isset($validated['discount_code']) && $validated['discount_code']) {
            $discount = Discount::where('code', $validated['discount_code'])->first();
            if ($discount) {
                if ($discount->type == 'fixed') {
                    $total -= $discount->value;
                } elseif ($discount->type == 'percentage') {
                    $total -= ($total * ($discount->value / 100));
                }
            }
        }

        if ($validated['vat']) {
            $total += $validated['vat'];
        }

        $userId = auth()->id();

        $orderController = new OrderController();
        $order = $orderController->Create($validated, $total, $userId);
        $payment = $this->paystackService->payment($total, $order->reference_number);

        return $payment;
    }

    public function CallBack(Request $request)
    {
        \Log::debug("mehens check here: CallBack");
        \Log::debug($request);

        try{
            $pay = $this->paystackService->CallBack($request);
            return $pay;

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }

    }

    public function verifyPayment(Request $request)
    {
        \Log::debug("mehens check here: verifyPayment");
        \Log::debug($request);
        return $this->paystackService->getUpdate($request);
    }

    // public function payNow(Request $request)
    // {
    //     $order = Order::find($request->order_id);
    //     $orderul = $order->order_url;
    //     //check if url is still valid or expired
    //     //if expired, generate new url
    //     //update url and update the order url and reference
    //     // $this->placeorder
    //     // return $this->paystackService->payment($request);
    // }
}
