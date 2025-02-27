<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;

class DiscountController extends Controller
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
    public function verify($discountCode)
    {
        $discount = Discount::where('code', $discountCode)->first();
        if ($discount) {
            return response()->json([
                'data' => [
                    'id' => $discount->id,
                    'code' => $discount->code,
                    'amount' => $discount->amount,
                    'type' => $discount->type,
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid discount code',
            ], 404);
        }
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
