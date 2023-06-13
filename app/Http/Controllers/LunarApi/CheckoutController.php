<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lunar\Facades\CartSession;

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

        $cart = CartSession::current();

        $testArray = [
            'title' => 'testTitle',
            'first_name' => 'FIO',
            'last_name' => 'last_name',
            'company_name' => 'testCompanyNAme',
            'line_one' => 'testAdress',
            'line_two' => 'line_two',
            'line_three' => 'line_three',
            'city' => 'testCity',
            'state' => 'state',
            'postcode' => 'testPostcode',
            'delivery_instructions' => 'testDI',
            'contact_email' => 'testEmail',
            'contact_phone' => 'testPhone',
            'shipping_option' => 'BASDEL',
            'meta' => [],
            'country_id' => 183,
        ];

        $cart->setShippingAddress($testArray);
        $cart->setBillingAddress($testArray);


        $order = $cart->createOrder();

        return response()->json($order, 200);
    }
}
