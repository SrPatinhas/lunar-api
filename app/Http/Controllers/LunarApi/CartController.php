<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * Get items from cart
     */
    public function cart(Request $request){

    }

    /**
     * Get Checkout options
     * - User
     * - Shipping Options
     * - Payment Options
     * - Cart
     * - Totals
     */
    public function checkout(Request $request){

    }

    /**
     * POST to check if discount code is valid
     */
    public function discount(Request $request){

    }

    /**
     * POST to complete order
     * - Payment
     * - Shipping option
     * - User Data
     * - User Shipping Data
     * - Cart
     * - Discount
     */
    public function order(Request $request){

    }
}
