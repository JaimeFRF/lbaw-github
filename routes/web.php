<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;

use App\Http\Controllers\StaticController;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Auth\AdminLoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home
Route::get('/', function () {
    return redirect('/home');
});

//Purchase
Route::post('/purchase', [PurchaseController::class, 'createPurchase'])->name('add_purchase');
Route::get('/home', [HomeController::class, 'home'])->name('home');

//Admin
Route::get('/admin-home', [AdminController::class, 'viewHome'])->name('admin-home');
Route::get('/admin-add-item', [AdminController::class, 'addItem'])->name('addItem');
Route::get('/admin-view-users',[AdminController::class, 'viewUsers'])->name('view-users-admins');
Route::get('/stock', [AdminController::class, 'viewStock'])->name('stock');
Route::get('/items', [AdminController::class, 'viewItems'])->name('items');

//Statics
Route::get('/faq', [StaticController::class, 'faq'])->name('faq');
Route::get('/contacts', [StaticController::class, 'contacts'])->name('contacts');
Route::get('/about', [StaticController::class, 'about'])->name('about');


// Items on home-page
Route::get('/next-items/{offset}', [ItemController::class, 'nextItems']);
Route::post('/search', [ItemController::class, 'search'])->name('search');
Route::post('/search/filter', [ItemController::class, 'filter'])->name('filter');
Route::post('/search/clearFilters', [ItemController::class, 'clearFilters'])->name('clearFilters');



//Wishlist
Route::put('users/wishlist/product/{id_item}', [WishlistController::class, 'add']);
Route::delete('users/wishlist/product/{product_id}', [WishlistController::class, 'delete']);

// Cart
Route::controller(CartController::class)->group(function () {
    Route::get('/cards', 'list')->name('cards');
    Route::get('/cards/{id}', 'show');
    Route::put('/api/cards', 'create');
    Route::delete('/api/cards/{card_id}', 'delete');
    Route::get('/cart', 'list')->name('cart');
});

// Reviews
Route::post('/review', [ReviewController::class, 'createReview'])->name('add_review');
Route::post('/review/edit/{id}', [ReviewController::class, 'editReview'])->name('edit_review');
Route::delete('/review/delete/{id}', [ReviewController::class, 'deleteReview'])->name('delete_review');


// Cart Items
Route::controller(CartItemController::class)->group(function () {
    Route::post('/cart/add/{productId}', [CartItemController::class , 'addToCart'])->name('cart.add');
    Route::post('/cart/delete/{productId}', 'deleteFromCart')->name('cart.delete');
    Route::post('/cart/remove/{productId}', 'removeFromCart')->name('cart.remove');
    Route::get('/api/cart/count', 'countItemCart')->name('cart.count');
    Route::post('/update-cart-item', [CartItemController::class, 'addToCart']);
});

// Items
Route::controller(ItemController::class)->group(function () {
    Route::put('/api/cards/{card_id}', 'create');
    Route::post('/api/item/{id}', 'update');
    Route::delete('/api/item/{id}', 'delete');
    Route::get('/api/item/{id}', 'show');
    Route::get('/shop', 'shop')->name('shop');
    Route::post('/shop/{filter}', 'shopFilter')->name('shopFilter');
});


// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
});


// Login as admin
Route::controller(AdminLoginController::class)->group(function () {
    Route::post('/admin-login', 'authenticate')->name('admin-login');
    
});

// Register

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

// Profile

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'show')->name('profile');  
    Route::get('/edit-profile', 'showEditProfile')->name('edit_profile');
    Route::post('/edit-profile/username', 'changeUsername')->name('change_username');
    Route::post('/edit-profile/name', 'changeName')->name('change_name');
    Route::post('/edit-profile/password', 'changePassword')->name('change_password');
    Route::post('/edit-profile/remove', 'removeUser')->name('remove_user');
    Route::post('/edit-profile/picture', 'changePicture')->name('update_profile_pic');
});





