<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $data = [
            'categories' => $categories,
        ];
        return view('portal.categories', $data);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $category = Category::where('name', $validatedData['title'])->first();

        if ($category) {
            return back()->with('error', 'Category already exists!');
        }
        else {
            $categoryData = [
                'name' => $validatedData['title'],
            ];

            $category = Category::create($categoryData);
        }

        return redirect()->route('categories')->with('success', 'Category created successfully!');

    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate( [
            'title' => 'required|string|max:255',
        ]);

        $existingcategory = Category::where('name', $validatedData['title'])->first();

        if ($existingcategory) {
            return back()->with('error', 'Category already exists!');
        }
        else {
            $categoryData = [
                'name' => $validatedData['title'],
            ];

            $category->update($categoryData);
        }

        return redirect()->route('categories')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories')->with('success', 'Category deleted successfully!');
    }
}
