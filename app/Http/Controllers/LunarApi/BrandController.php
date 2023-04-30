<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductsResource;
use Illuminate\Http\Request;
use Lunar\Models\Brand;
use Lunar\Models\Product;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {

        $brands = Brand::with('thumbnail')->paginate(10);

        return BrandResource::collection($brands);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

}
