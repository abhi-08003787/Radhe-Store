<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderTrackController;

Route::get('/', function () {
    $categories = Category::latest()->get();
    $products = Product::latest()->get(); // Fetch all products for continuous slider
    $banners = Slider::latest()->get(); // Fetch banners for main banner
    return view('welcome', compact('categories', 'products', 'banners'));
})->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::get('/order-success/{id}', [CheckoutController::class, 'success'])->name('order.success');
Route::get('/order-confirmation/{id}', [CheckoutController::class, 'receipt'])->name('order.confirmation');
Route::get('/order-receipt/{id}', [CheckoutController::class, 'receipt'])->name('order.receipt');
Route::get('/order/track', [OrderTrackController::class, 'index'])->name('order.track');
Route::get('/track-order', [OrderTrackController::class, 'showTrackForm'])->name('order.track.form');
Route::post('/track-order', [OrderTrackController::class, 'trackOrder'])->name('order.track.submit');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product/{slug}/details', [ProductController::class, 'show'])->name('product.details');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/return-policy', function () {
    return view('return-policy');
})->name('return.policy');

Route::get('/shipping-info', [App\Http\Controllers\HomeController::class, 'shippingInfo'])->name('shipping.info');

Route::get('/faqs', [App\Http\Controllers\HomeController::class, 'faq'])->name('faqs');

Route::get('/page/{slug}', [App\Http\Controllers\HomeController::class, 'page'])->name('page.show');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create-final-admin', function () {
    // આ કોડ નવો યુઝર બનાવશે
    $user = User::create([
        'name' => 'Radhe Admin',
        'email' => 'radhe0800@gmail.com',
        'password' => Hash::make('8724'),
        'role' => 'admin', 
    ]);
    
    return "Admin Account Created! Use Email: radhe0800@gmail.com and Password: 8724 to login.";
});

Route::post('/livewire/upload-file', [\Livewire\Controllers\FileUploadHandler::class, 'handle'])
    ->middleware(['web']);