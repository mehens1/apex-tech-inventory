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

        $cart = Cart::firstOrCreate(['user_id' => auth()->id()])->load('items.product');
        // $cart = cart()->with(['items.product'])->firstOrCreate();

        return response()->json([
            'data' => [
                'items' => $cart->items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'name' => $item->product->item,
                        'price' => floatval($item->product->selling_price),
                        'quantity' => $item->quantity,
                        'subtotal' => $item->product->selling_price * $item->quantity,
                    ];
                }),
                'total' => $cart->items->sum(fn ($item) => $item->product->selling_price * $item->quantity),
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        return DB::transaction(function () use ($validated) {
            $cart = Cart::firstOrCreate(['user_id' => auth()->user()->id]);
            $product = Product::findOrFail($validated['product_id']);

            $cartItem = $cart->items()
                ->where('product_id', $product->id)
                ->lockForUpdate()
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $validated['quantity']);
            } else {
                $cartItem = $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $validated['quantity'],
                    'price' => $product->selling_price,
                ]);
            }

            return response()->json([
                'message' => 'Item added to cart',
                'data' => $cartItem
            ], 201);
        });
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
