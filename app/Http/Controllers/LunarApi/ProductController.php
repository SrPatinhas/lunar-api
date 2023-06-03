<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use App\Http\Resources\LunarAPI\Product\ProductDetailResource;
use App\Http\Resources\LunarAPI\Product\ProductsResource;
use Illuminate\Http\Request;
use Lunar\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        // Params from the URL Query
        // return all products or with pagination
        $allProducts = $request->query("all", false);
        $perPage = $request->query('per-page', 10);
        $onlyWithStock = $request->query("has-stock", true);

        // get the products with the thumbnail, variants, prices and tags
        $products = Product::with(['thumbnail', 'variants', 'variants.prices', 'tags'])->status('published');

        // return only brands with products
        if($onlyWithStock) {
            $products = $products->whereHas('variants', function ($q) {
                            $q->where('stock', '>', 0)->where('purchasable', 'in_stock');
                        });
        }

        // return all products or with pagination
        $products = $allProducts ? $products->get() : $products->paginate($perPage);

        //return $products;
        return ProductsResource::collection($products);
    }

    /**
     * Display a listing of the resource.
     */
    public function detail($id)
    {
        $product = Product::with(['images', 'associations', 'inverseAssociations', 'variants'])
                            ->status('published')
                            ->find($id);
        return new ProductDetailResource($product);
    }
}
