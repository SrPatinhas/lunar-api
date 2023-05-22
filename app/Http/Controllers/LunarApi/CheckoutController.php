<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    /**
     * Get items from cart
     * Get user information if logged in
     */
    public function index(Request $request){

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
