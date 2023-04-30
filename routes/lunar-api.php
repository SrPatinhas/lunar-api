<?php

use App\Http\Controllers\LunarApi\BrandController;
use App\Http\Controllers\LunarApi\CartController;
use App\Http\Controllers\LunarApi\CollectionController;
use App\Http\Controllers\LunarApi\OrderController;
use App\Http\Controllers\LunarApi\ProductController;
use App\Http\Controllers\LunarApi\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Connection to Lunar E-Commerce
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your store. These
| routes are added to the API file.
|
*/

Route::get('/brands', [BrandController::class, 'list']);

Route::controller(CollectionController::class)->group(function () {
    // return a list of collections
    Route::get('/collections',              'collections');
    // return the products associated to a collection
    Route::get('/collection/{id}/{slug}',   'collections');
});

Route::controller(ProductController::class)->group(function () {
    // return the list of products, based on search/filters terms
    Route::get('/products',             'list');
    // return the product detail information
    Route::get('/product/{id}/{slug}',  'detail');
    // return an object of possible filters for the products
    Route::get('/filters',              'filters');
    // return a list of "quick" search
    Route::get('/search',               'search');
    // return a list of featured products, based on some filter
    Route::get('/products-featured',    'featured');
});


Route::controller(CartController::class)->group(function () {
    Route::get('/cart',                 'cart');
    // get basic information for the checkout page
    Route::get('/checkout',             'checkout');
    // check if a certain discount is valid for the current cart
    Route::post('/checkout/discount',   'discount');
    // complete the order
    Route::post('/checkout/order',      'order');
    // return list of suggestions based on cart products
    Route::get('/cart-suggestions',     'associated');
});

Route::controller(OrderController::class)->group(function () {
    // return a list of orders made by the logged user
    Route::get('/orders',               'list');
    // return a order detail
    Route::get('/order/{id}',           'detail');
    // return a order detail, based on the order ID and the email of the order
    Route::post('/order/{id}',          'detail-anonymous');
    // return the information about an order, with tracking information if possible
    Route::get('/order/{id}/tracking',  'tracking');
});


Route::controller(UserController::class)->group(function () {
    // return the information about the user and customer
    Route::get('/account',                      'index');
    // return the whishlist of the user
    Route::get('/account/whishlist',            'whishlist');
    // update the user password
    Route::post('/account/security/password',   'security');
});
