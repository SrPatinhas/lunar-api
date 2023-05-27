<?php

use App\Http\Controllers\LunarApi\BrandController;
use App\Http\Controllers\LunarApi\CartController;
use App\Http\Controllers\LunarApi\CheckoutController;
use App\Http\Controllers\LunarApi\CollectionController;
use App\Http\Controllers\LunarApi\LangController;
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

Route::prefix('brands')->controller(BrandController::class)->group(function () {
    Route::get('/',             'list');
    // return the products associated to a collection
    Route::get('/{id}/{slug?}', 'detail');
});

Route::prefix('collections')->controller(CollectionController::class)->group(function () {
    // return a list of collections
    Route::get('/',                     'list');
    // return the products associated to a collection
    Route::get('/group/{id}/{slug?}',   'detailGroup');
    // return the products associated to a collection
    Route::get('/detail/{id}/{slug?}',  'detailCollection');
});

Route::prefix('products')->controller(ProductController::class)->group(function () {
    // return the list of products, based on search/filters terms
    Route::get('/',             'list');
    // return the product detail information
    Route::get('/{id}/{slug}',  'detail');
    // return a list of featured products, based on some filter
    Route::get('/featured',     'featured');
});


Route::controller(SearchController::class)->group(function () {
    // return an object of possible filters for the products
    Route::get('/filters',      'filters');
    // return a list of "quick" search
    Route::get('/mini-search',  'quickSearch');
    // return a list of all searched items
    Route::get('/search',       'search');
});


Route::prefix('cart')->controller(CartController::class)->group(function () {
    // gets the list of items in the cart and the basic details
    Route::get('/',                     'cart');
    // add item to the cart list
    Route::post('/add',                 'addItem');
    // updates the cart number of a specific cart item
    Route::put('/update',               'updateItem');
    // removes item from the cart list
    Route::delete('/remove',            'removeItem');
    // check if a certain discount is valid for the current cart and applies it
    Route::post('/discount',            'discount');
    // return list of suggestions based on cart products
    Route::get('/suggestions',          'associated');
});


Route::prefix('checkout')->controller(CheckoutController::class)->group(function () {
    // get basic information for the checkout page
    Route::get('/',                     'index');
    // check if a certain discount is valid for the current cart
    Route::post('/discount',            'discount');
    // complete the order
    Route::post('/order',               'order');
});


Route::prefix('orders')->controller(OrderController::class)->group(function () {
    // return a list of orders made by the logged user
    Route::get('/',               'list');
    // return a order detail
    Route::get('/{id}',           'detail');
    // return a order detail, based on the order ID and the email of the order
    Route::post('/{id}',          'detailAnonymous');
    // return the information about an order, with tracking information if possible
    Route::get('/{id}/tracking',  'tracking');
});


Route::prefix('account')->controller(UserController::class)->group(function () {
    // return the information about the user and customer
    Route::get('/',                      'index');
    // return the whishlist of the user
    Route::get('/whishlist',            'whishlist');
    // update the user password
    Route::post('/security/password',   'security');
});

Route::prefix('lang')->controller(LangController::class)->group(function () {
    // returns the list of languages available
    Route::get('/',         'list');
    // saves the language defined by the user on the website
    Route::post('/{lang}',  'update');
});
