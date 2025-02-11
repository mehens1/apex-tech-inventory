<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('page', 9);

        return response()->json([
            'success' => true,
            'data' => Product::orderBy('id', 'desc')->paginate(9),
        ], 200);
    }

    public function product($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product,
        ], 200);
    }
}

