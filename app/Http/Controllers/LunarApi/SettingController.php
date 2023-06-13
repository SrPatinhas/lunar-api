<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\LunarAPI\Setting\Currency\CurrencyRequest;
use App\Http\Resources\LunarAPI\Setting\Language\LanguageResource;
use App\Http\Requests\LunarAPI\Setting\Language\LanguageRequest;
use App\Http\Resources\LunarAPI\Setting\Currency\CurrencyResource;
use App\Http\Resources\LunarAPI\Setting\Shipping\ShippingResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Lunar\Base\ShippingModifiers;
use Lunar\Facades\ShippingManifest;
use Lunar\Facades\CartSession;
use Lunar\Managers\CartSessionManager;
use Lunar\Models\Cart;
use Lunar\Models\Currency;
use Lunar\Models\Language;

class SettingController extends Controller
{
    /**
     * The Cart instance.
     */
    public ?Cart $cart;

    /**
     * Returns a list of brands
     */
    public function listLanguage(Request $request)
    {
        return LanguageResource::collection(Language::all());
    }


    /**
     * Returns the brand detail, with the list of products associated
     */
    public function updateLanguage(LanguageRequest $request)
    {
        $notFoundMessage = "";
        $lang = Language::where('code', $request->code)->first();
        // if language not found, default to the default language
        if(!$lang) {
            $lang = Language::where('default', 1)->first();
            $notFoundMessage = ", as requested language was not found on our system";
        }

        App::setLocale($lang->code);

        return response()->json([
            'status' => 200,
            'message' => "Language set to '$lang->code'$notFoundMessage",
        ]);
    }

    /**
     * Returns a list of brands
     */
    public function listCurrency(Request $request)
    {
        $currencies = Currency::where('enabled', 1)->get();
        return CurrencyResource::collection($currencies);
    }


    /**
     * Returns the brand detail, with the list of products associated
     */
    public function updateCurrency(CurrencyRequest $request)
    {
        // TODO update logic with "StorefrontSession" from LUNAR
        $notFoundMessage = "";
        $currency = Currency::where('code', $request->code)->first();

        // if currency not found, default to the default currency
        if(!$currency) {
            $currency = Currency::where('default', 1)->first();
            $notFoundMessage = ", as requested currency was not found on our system";
        }
        session(['currency'     => $currency->code  ]);
        session(['currency_id'  => $currency->id    ]);

        return response()->json([
            'status' => 200,
            'message' => "Currency set to '$currency->code'$notFoundMessage",
        ]);
    }


    /**
     * Returns a list of brands
     */
    public function listShipping(Request $request)
    {
        $cart = CartSession::current();
        if(!$cart) {
            $cart = Cart::create([
                'currency_id' => session('currency_id', 2),
                'channel_id' => 1,
            ]);
        }

        return ShippingResource::collection(ShippingManifest::getOptions($cart));
    }


    /**
     * Returns the brand detail, with the list of products associated
     */
    public function updateShipping(CurrencyRequest $request)
    {
        $notFoundMessage = "";
        $currency = Currency::where('code', $request->code)->first();

        // if currency not found, default to the default currency
        if(!$currency) {
            $currency = Currency::where('default', 1)->first();
            $notFoundMessage = ", as requested currency was not found on our system";
        }
        session(['currency' => $currency->code]);

        return response()->json([
            'status' => 200,
            'message' => "Currency set to '$currency->code'$notFoundMessage",
        ]);
    }
}
