<?php

use App\Http\Controllers\LunarApi\BrandController;
use App\Http\Controllers\LunarApi\CartController;
use App\Http\Controllers\LunarApi\CheckoutController;
use App\Http\Controllers\LunarApi\CollectionController;
use App\Http\Controllers\LunarApi\OrderController;
use App\Http\Controllers\LunarApi\ProductController;
use App\Http\Controllers\LunarApi\UserController;
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
    Route::get('/collections',                      'list');
    // return the products associated to a collection
    Route::get('/collection-group/{id}/{slug?}',     'detailGroup');
    // return the products associated to a collection
    Route::get('/collection/{id}/{slug?}',           'detailCollection');
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
    // gets the list of items in the cart and the basic details
    Route::get('/cart',                 'cart');
    // add item to the cart list
    Route::post('/add',                 'addItem');
    // updates the cart number of a specific cart item
    Route::put('/update',               'updateItem');
    // removes item from the cart list
    Route::delete('/remove',            'removeItem');
    // check if a certain discount is valid for the current cart and applies it
    Route::post('/discount',            'discount');
    // return list of suggestions based on cart products
    Route::get('/suggestions',     'associated');
});


Route::controller(CheckoutController::class)->group(function () {
    // get basic information for the checkout page
    Route::get('/index',                'index');
    // check if a certain discount is valid for the current cart
    Route::post('/discount',            'discount');
    // complete the order
    Route::post('/order',               'order');
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
