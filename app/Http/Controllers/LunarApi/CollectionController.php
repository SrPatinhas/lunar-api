<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Lunar\Models\Collection;
use Lunar\Models\CollectionGroup;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        return CollectionGroup::with('collections')->whereHas('collections.products', function (Builder $query) {
            $query->where('status', '=', 'published');
        })->get();
       //with(["collections" => ["thumbnail"]])->get();
    }

    /**
     * Display the specified resource.
     */
    public function detailGroup(string $id)
    {
        return CollectionGroup::with(["collections" => ["thumbnail"]])->get();
    }

    /**
     * Display the specified resource.
     */
    public function detailCollection(string $id)
    {
        return Collection::where("id", $id)
            ->with(["thumbnail","products"])
            ->whereHas('products', function (Builder $query) {
                $query->where('status', '=', 'published');
            })
            ->get();
    }

}
