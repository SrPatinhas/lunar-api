<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use App\Http\Resources\LunarAPI\Product\ProductDetailResource;
use App\Http\Resources\LunarAPI\Product\ProductOptionsResource;
use App\Http\Resources\LunarAPI\Product\ProductsResource;
use Illuminate\Http\Request;
use Lunar\Models\Product;
use Lunar\Models\ProductOption;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        $products = Product::with(['thumbnail', 'variants', 'variants.prices', 'tags'])
                            ->where('status', 'published')
                            ->whereHas('variants', function ($q) {
                                $q->where('stock', '>', 0)
                                ->where('purchasable', 'in_stock');
                            })
                            ->paginate(50);
        //return $products;
        return ProductsResource::collection($products);
    }

    /**
     * Display a listing of the resource.
     */
    public function detail($id, $slug)
    {
        $product = Product::with(['images', 'associations'])->find($id);
        //return $product->associations()->crossSell()->get();

        return new ProductDetailResource($product);
    }
}
