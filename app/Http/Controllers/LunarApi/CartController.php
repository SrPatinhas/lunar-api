<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * Get items from cart and simple details
     */
    public function cart(Request $request){

    }

    /**
     * Get associated products for the cart
     */
    public function associated(Request $request){

    }

    /**
     * Add Item to the cart
     * - Item Id (or equivalent)
     */
    public function addItem(Request $request){

    }

    /**
     * Updates an item from the cart
     * Needs to send:
     * - Item Id (or equivalent)
     * - Quantity for the item
     */
    public function updateItem(Request $request){

    }

    /**
     * Removes item from the cart
     * - Item Id (or equivalent)
     */
    public function removeItem(Request $request){

    }

    /**
     * POST to check if discount code is valid
     */
    public function discount(Request $request){

    }
}
