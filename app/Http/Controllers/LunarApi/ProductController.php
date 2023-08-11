<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use App\Http\Resources\LunarAPI\Product\ProductDetailResource;
use App\Http\Resources\LunarAPI\Product\ProductsResource;
use Illuminate\Http\Request;
use Lunar\Models\Currency;
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
        $perPage = $request->query('limit', 10);
        $onlyWithStock = $request->query("has-stock", true);

        // get the products with the thumbnail, variants, prices and tags
        $products = Product::with(['thumbnail', 'variants', 'variants.prices', 'tags'])->status('published');

        // return only brands with products
        if($onlyWithStock) {
            $products = $products->whereHas('variants', function ($q) {
                            $q->where('stock', '>', 0)->where('purchasable', 'in_stock');
                        });
        }

        if($request->query("filter_price_min")) {
            $valueFloat = $request->query("filter_price_min");
            $valueCents = $valueFloat * 100;
            $products = $products->whereHas('variants', function ($q) use ($valueCents) {
                $q->where('price', '>=', $valueCents);
            });
        }
        if($request->query("filter_price_max")) {
            $valueFloat = $request->query("filter_price_max");
            $valueCents = $valueFloat * 100;
            $products = $products->whereHas('variants', function ($q) use ($valueCents) {
                $q->where('price', '<=', $valueCents);
            });
        }
        if ($request->query("filter_brand")) {
            $brand = $request->query("filter_brand");
            $products = $products->whereHas('brand', function ($q) use ($brand) {
                $q->where('id', $brand);
            });
        }

        //filter_color: "",
        //filter_size: "",

        if($request->query("sort")) {
            $orderField = match ($request->query("sort")) {
                "default" => "name",
                "price" => "price",
                "title" => "name",
                "date" => "created_at",
                "best-selling" => "sold",
                default => "name",
            };
            //$products = $products->orderBy($orderField, $request->query("order_asc") ? "asc" : "desc");
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
        $currency_id = session('currency_id', Currency::where('default', true)->first()->id);
        $product = Product::with(['images', 'associations', 'inverseAssociations', 'variants', 'brand', 'tags'])
                            ->with('prices', function ($q) use ($currency_id) {
                                $q->where('currency_id', $currency_id);
                            })
                            ->status('published')
                            ->find($id);
        //return $product;
        return new ProductDetailResource($product);
    }
}
