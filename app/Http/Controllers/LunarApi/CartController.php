<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lunar\Base\CartSessionInterface;
use Lunar\Facades\CartSession;
use Lunar\Models\Cart;
use Lunar\Models\CartLine;
use Lunar\Models\Channel;
use Lunar\Models\Currency;
use Lunar\Models\ProductVariant;


class CartController extends Controller
{
    private Cart $cart;

    public function __construct(
        protected CartSessionInterface $cartSession
    ) {
        //
    }

    /**
     * Get items from cart and simple details
     */
    public function cart(Request $request){
        $cartId = $request->cart_id;
        $this->findOrCreateCart($cartId);

        return CartSession::current();
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
    public function addItem(Request $request)
    {
        $cartId         = $request->cart_id;
        $this->findOrCreateCart($cartId);

        $item           = $request->item_id;
        $itemVariant    = $request->item_variant_id;
        $quantity       = $request->quantity;

        if($quantity < 1){
            return response()->json([
                'status' => 400,
                'message' => "Quantity requested is not correct",
            ]);
        }

        $productVariant = ProductVariant::find($itemVariant);

        $maxQuantity = $productVariant->stock;
        $purchasableLine = CartSession::manager()->lines->first(function(CartLine $line) use ($productVariant) {
            return $line->purchasable_id == $productVariant->id;
        });
        if($purchasableLine instanceof CartLine) {
            $maxQuantity -= $purchasableLine->quantity;
        }

        if($productVariant->purchasable == "in_stock" && $maxQuantity <= 0) {//$productVariant->stock < $maxQuantity) {
            return response()->json([
                'status' => 400,
                'message' => "Quantity requested is not available",
            ]);
        }

        $this->findOrCreateCart($cartId);

        CartSession::add($productVariant, $quantity);

        return CartSession::current();

        // TODO check if product is purchasable by other type (backorder)
        /*
            $cartLine = new CartLine([
                'cart_id' => ($cartId == 0 ? CartSession::manager()->id : $cartId),
                'purchasable_type' => ProductVariant::class,
                'purchasable_id' => $productVariant->id,
                'quantity' => $quantity,
                'meta' => [
                    'personalization' => 'Love you mum xxx',
                ]
            ]);
        */
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
        $cartId = $request->cart_id;
        if($this->findOrFailCart($cartId))
            return;

        $cartLine = $request->cart_line_id;
        CartSession::removeLine($cartLine);

        return CartSession::current();
    }

    /**
     * Clears all items from the cart
     */
    public function clearCart(Request $request){
        $cartId = $request->cart_id;
        if($this->findOrFailCart($cartId))
            return;

        CartSession::clear();
        return CartSession::current();
    }


    /**
     * POST to check if discount code is valid
     */
    public function discount(Request $request){
        $cartId = $request->cart_id;
        $this->findOrCreateCart($cartId);

        // TODO check if discount code is valid and apply to cart

    }


    /**
     * @param $cartId
     * @return mixed
     *
     * This will create a new cart if the cart is null
     */
    private function findOrCreateCart($cartId = 0, $create = true) {
        if ($cartId != 0) {
            $cart = Cart::find($cartId);
        } else {
            $cart = CartSession::current();
        }
        // needs to create a new Cart?
        if(!$cart && $create) {
            // TODO update logic with "StorefrontSession" from LUNAR
            $currency = session('currency_id');
            if (!$currency) {
                $currency = Currency::where('default', 1)->first()->id;
            }

            if (Auth::hasUser()) {
                $user_channel = Auth::user()->channel_id;
            } else {
                $user_channel = Channel::where('default', 1)->first()->id;
            }
            $cart = Cart::create([
                'currency_id' => $currency,
                'channel_id' => $user_channel,
                'user_id' => Auth::id(),
            ]);
        }
        $this->cart = $cart;
        CartSession::use($cart);

        return $cart;
    }


    /**
     * @param $cartId
     * @return mixed
     *
     * This will create a new cart if the cart is null
     */
    private function findOrFailCart($cartId = 0) {
        if ($cartId != 0) {
            $cart = Cart::find($cartId);
        } else {
            $cart = CartSession::current();
        }
        // needs to create a new Cart?
        if(!$cart) {
            return response()->json([
                'status' => 400,
                'message' => "Cart not found",
            ])->send();
        }
        $this->cart = $cart;
        CartSession::use($cart);

        return false;//$cart;
    }
}
