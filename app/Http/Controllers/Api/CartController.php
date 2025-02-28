<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->with('product')->get();
        return response()->json([
            'data' => $cart,
            'message' => "Cart fetched successfully!",
            'status' => true,
            'status_code' => 200
        ]);
    }

    public function store(Request $request)
    {
        \Log::debug("request: ", [$request]);

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'nullable|numeric|min:0',
        ]);

        \Log::debug("product_id: ", [$validated['product_id']]);
        \Log::debug("quantity: ", [$validated['quantity']]);

        $user = auth()->id();

        // Check if the user already has this product in the cart
        $existingCartItem = Cart::where('user_id', $user)
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($existingCartItem) {
            return response()->json([
                'message' => 'This product is already in your cart.'
            ], 409);
        }

        $cartItem = Cart::create([
            'user_id' => $user,
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'] ?? null,
        ]);

        return response()->json([
            'message' => 'Cart item added!',
            'data' => $cartItem
        ]);
    }

    public function UpdateCart(Request $request, CartItem $cartItem)
    {

        if (auth()->user()->id !== $cartItem->cart->user_id) {
            return response()->json(['message' => 'Unauthorized action'], 403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        if ($validated['quantity'] === 0) {
            return $this->destroy($cartItem);
        }
        $cartItem->update(['quantity' => $validated['quantity']]);

        return response()->json([
            'message' => 'Cart item updated',
            'data' => $cartItem
        ]);
    }

    public function RemoveItemCart(CartItem $cartItem)
    {
        if (auth()->user()->id !== $cartItem->cart->user_id) {
            return response()->json(['message' => 'Unauthorized action'], 403);
        }
        try {
            $cartItem->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Item Not Found'], 404);
        }
    }

    public function ClearCart()
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if ($cart) {
            $cart->items()->delete();
            $cart->delete();
        }
        return response()->json(['message' => 'Cart cleared']);
    }
}
