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
}
