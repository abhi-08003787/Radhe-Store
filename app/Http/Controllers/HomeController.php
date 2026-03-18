<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Remove auth middleware to allow all users to access homepage
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the shipping information page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function shippingInfo()
    {
        return view('shipping-info');
    }

    /**
     * Show the FAQ page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function faq()
    {
        return view('faq');
    }

    /**
     * Show a dynamic page by slug.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function page($slug)
    {
        $page = Page::where('slug', $slug)
                    ->where('is_active', true)
                    ->firstOrFail();
        
        return view('page', compact('page'));
    }
}
