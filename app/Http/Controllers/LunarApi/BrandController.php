<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use App\Http\Resources\LunarAPI\Brand\BrandDetailResource;
use App\Http\Resources\LunarAPI\Brand\BrandResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Lunar\Models\Brand;

class BrandController extends Controller
{
    /**
     * Returns a list of brands
     */
    public function list(Request $request)
    {
        // Params from the URL Query
        // return all brands or with pagination
        $allBrands = $request->query("all", false);
        $perPage = $request->query('per-page', 10);
        $onlyWithProducts = $request->query("has-products", false);

        // get the brands with the thumbnail
        $brands = Brand::with('thumbnail');

        // return only brands with products
        if($onlyWithProducts) {
            $brands = $brands->whereHas('products', function (Builder $query) {
                $query->where('status', '=', 'published');
            });
        }

        // return all brands or with pagination
        $brands = $allBrands ? $brands->get() : $brands->paginate($perPage);

        return BrandResource::collection($brands);
    }


    /**
     * Returns the brand detail, with the list of products associated
     */
    public function detail(string $id, string $slug = "")
    {
        $brands = Brand::with(['thumbnail', 'products'])->where('id', $id)->get();
        return BrandDetailResource::collection($brands);
    }

}
