<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display the shop page with products and filters.
     */
    public function index(Request $request)
    {
        $query = Product::query()->with('categoryRel');

        // Search logic
        $search = trim((string) $request->query('q', ''));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('categoryRel', function($cq) use ($search) {
                        $cq->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Category filter (Single select)
        $categoryName = $request->query('category');
        if ($categoryName) {
            $query->whereHas('categoryRel', function($cq) use ($categoryName) {
                $cq->where('name', $categoryName);
            });
        }

        // Price Range filter
        $min = $request->query('min');
        if ($min !== null && $min !== '') {
            $query->where('regular_price', '>=', (float) $min);
        }

        $max = $request->query('max');
        if ($max !== null && $max !== '') {
            $query->where('regular_price', '<=', (float) $max);
        }

        // Sorting logic
        $sort = (string) $request->query('sort', 'newest');
        $sortMap = [
            'newest'     => ['id', 'desc'],
            'oldest'     => ['id', 'asc'],
            'price_asc'  => ['regular_price', 'asc'],
            'price_desc' => ['regular_price', 'desc'],
            'name_asc'   => ['name', 'asc'],
            'name_desc'  => ['name', 'desc'],
        ];
        [$sortField, $sortDir] = $sortMap[$sort] ?? $sortMap['newest'];
        $query->orderBy($sortField, $sortDir);

        // Fetch paginated products
        $products = $query->paginate(12)->withQueryString();

        // Fetch all categories for sidebar
        $availableCategories = Category::orderBy('name')->pluck('name');

        return view('shop', [
            'products' => $products,
            'availableCategories' => $availableCategories,
            'activeCategory' => $categoryName,
            'search' => $search,
            'min' => $min,
            'max' => $max,
            'sort' => $sort,
        ]);
    }
}
