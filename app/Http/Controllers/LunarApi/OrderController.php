<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Return list of orders by user
     */
    public function list()
    {
        //
    }

    /**
     * Return the detail of an order
     */
    public function detail(Request $request, string $id)
    {
        // TODO - check if the order belongs to the user
        // If anonymous, check with email
    }

    /**
     * Tracking view (need to check if possible)
     */
    public function tracking(Request $request, string $id)
    {
        //
    }
}
