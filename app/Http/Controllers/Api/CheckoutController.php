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
        $payment = $this->paystackService->payment($totalaftervat, $order->id);
        return $payment;
    }

    public function CallBack(Request $request)
    {
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
        return $this->paystackService->getUpdate($request);
    }
}
