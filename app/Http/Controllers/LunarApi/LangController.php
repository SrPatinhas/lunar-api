<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use App\Http\Resources\LunarAPI\Language\LanguageResource;
use Illuminate\Http\Request;
use Lunar\Models\Language;

class LangController extends Controller
{
    /**
     * Returns a list of brands
     */
    public function list(Request $request)
    {
        return LanguageResource::collection(Language::all());
    }


    /**
     * Returns the brand detail, with the list of products associated
     */
    public function update(string $langCode)
    {
        $brands = Language::where('code', $langCode)->get();

        if($brands) {
            App::setLocale($brands->code);
        } else {
            $brands = Language::where('default', 1)->get();
            App::setLocale($brands->code);
        }
    }

}
