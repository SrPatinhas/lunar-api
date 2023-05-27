<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\LunarAPI\Setting\Language\LanguageRequest;
use App\Http\Resources\LunarAPI\Setting\Currency\CurrencyResource;
use App\Http\Resources\LunarAPI\Settings\Language\LanguageResource;
use Illuminate\Http\Request;
use Lunar\Models\Currency;
use Lunar\Models\Language;

class SettingController extends Controller
{
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
        $brands = Language::where('code', $request->code)->get();

        if($brands) {
            App::setLocale($brands->code);
        } else {
            $brands = Language::where('default', 1)->get();
            App::setLocale($brands->code);
        }
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
        $currency = Currency::where('code', $request->code)->get();

        if($currency) {
            // Via the global "session" helper...
            session(['currency' => $currency->code]);
        } else {
            $currency = Currency::where('default', 1)->get();
            session(['currency' => $currency->code]);
        }
    }
}
