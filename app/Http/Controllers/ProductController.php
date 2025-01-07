<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index()
    {
        $products = Product::with(['category', 'unit'])->get();
        $user = "Auth::user()->load('role')";
        $data = [
            'products' => $products,
        ];
        return view('portal.products', $data);
    }

    public function store()
    {
        $categories = Category::all();
        $units = Unit::all();

        return view('portal.createProducts', [
            'categories' => $categories,
            'units' => $units,
        ]);

        return view('portal.createProducts', $data);
    }

    public function createProduct(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('product-images', 'public');
        }

        $product = Product::where('item', $validatedData['title'])->first();

        if ($product) {
            $product->quantity += $validatedData['quantity'];
            $product->save();

            // Log the quantity change
            if ($validatedData['quantity'] > 0) {
                \App\Models\ProductQuantityLog::create([
                    'product_id' => $product->id,
                    'quantity_change' => $validatedData['quantity'],
                    'user_id' => auth()->id(),
                ]);
            }

            return redirect()->route('products')->with('success', 'Product quantity updated successfully!');
        } else {
            // Product does not exist, create a new product
            $productData = [
                'item' => $validatedData['title'],
                'purchase_price' => $validatedData['purchase_price'],
                'selling_price' => $validatedData['selling_price'],
                'category_id' => $validatedData['category_id'],
                'unit_id' => $validatedData['unit_id'],
                'quantity' => $validatedData['quantity'],
                'description' => $validatedData['description'] ?? null,
                'image' => $validatedData['image'] ?? null,
            ];

            $product = Product::create($productData);

            // Log the quantity change if applicable
            if ($product->quantity > 0) {
                \App\Models\ProductQuantityLog::create([
                    'product_id' => $product->id,
                    'quantity_change' => $product->quantity,
                    'user_id' => auth()->id(),
                ]);
            }

            return redirect()->route('products')->with('success', 'Product added successfully!');
        }
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('product-images', 'public');
        }

        $product->update($validatedData);

        if ($validatedData['quantity'] != $product->quantity) {
            \App\Models\ProductQuantityLog::create([
                'product_id' => $product->id,
                'quantity_change' => $validatedData['quantity'] - $product->quantity,
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()->route('products')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Optional: Log the deletion (if needed)
        \App\Models\ProductQuantityLog::create([
            'product_id' => $product->id,
            'quantity_change' => -$product->quantity,
            'user_id' => auth()->id(),
            // 'action' => 'deleted',
        ]);

        // Delete the product
        $product->delete();

        return redirect()->route('products')->with('success', 'Product deleted successfully!');
    }

}
