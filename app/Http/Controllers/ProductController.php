<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Services\FileUploadService;

class ProductController extends BaseController
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        parent::__construct();
        $this->fileUploadService = $fileUploadService;
    }

    public function index()
    {
        $products = Product::with(['category', 'unit'])->get();
        $data = [
            'products' => $products,
        ];
        return view('portal.pages.products.products', $data);
    }

    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();

        return view('portal.pages.products.createProducts', [
            'categories' => $categories,
            'units' => $units,
        ]);
    }

    public function store(Request $request)
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

        $product = Product::where('item', $validatedData['title'])->first();

        if ($product) {
            $product->quantity += $validatedData['quantity'];
            $product->save();

            if ($validatedData['quantity'] > 0) {
                \App\Models\ProductQuantityLog::create([
                    'product_id' => $product->id,
                    'quantity_change' => $validatedData['quantity'],
                    'user_id' => auth()->id(),
                ]);
            }

            return redirect()->route('products')->with('success', 'Product quantity updated successfully!');
        } else {
            $product = Product::create([
                'item' => $validatedData['title'],
                'purchase_price' => $validatedData['purchase_price'],
                'selling_price' => $validatedData['selling_price'],
                'category_id' => $validatedData['category_id'],
                'unit_id' => $validatedData['unit_id'],
                'quantity' => $validatedData['quantity'],
                'description' => $validatedData['description'] ?? null,
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $folder = "images/products/{$product->id}";
                $uploadedFileUrl = $this->fileUploadService->uploadFile($file, $folder);
                $product->update(['image' => $uploadedFileUrl]);
            }

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
        $categories = Category::all();
        $units = Unit::all();

        return view('portal.pages.products.editProducts', [
            'categories' => $categories,
            'units' => $units,
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $product->item = $request->title;
            $product->purchase_price = $request->purchase_price;
            $product->selling_price = $request->selling_price;
            $product->category_id = $request->category_id;
            $product->unit_id = $request->unit_id;
            $product->quantity = $request->quantity;
            $product->description = $request->description;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $folder = "images/products/$product->id";
                $uploadedFileUrl = $this->fileUploadService->uploadFile($file, $folder);
                $product->image = $uploadedFileUrl;
            }

            $product->save();

            return redirect()->route('products.edit', $product->id)->with('success', 'Product updated successfully.');
        } catch (\Throwable $th) {
            \Log::error('Product update failed: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the product.');
        }

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
