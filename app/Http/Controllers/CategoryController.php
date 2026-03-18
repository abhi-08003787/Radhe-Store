<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // Redirect to shop page with category filter for consistency
        return redirect()->route('shop.index', ['category' => $category->name]);
    }
}

