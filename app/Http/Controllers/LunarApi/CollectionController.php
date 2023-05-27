<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Resources\LunarAPI\Collection\CollectionGroupResource;
use App\Http\Resources\LunarAPI\Collection\CollectionResource;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Lunar\Models\CollectionGroup;
use Lunar\Models\Collection;

class CollectionController extends Controller
{
    /**
     * Display a listing of the Groups of collections
     */
    public function list()
    {
        $collectionGroups = CollectionGroup::with('collections')
            ->whereHas('collections.products', function (Builder $query) {
                $query->where('status', '=', 'published');
            })->get();

        return CollectionGroupResource::collection($collectionGroups);
    }

    /**
     * Display the specified group of collections.
     */
    public function detailGroup(string $id)
    {
        $collectionGroup = CollectionGroup::with(["collections" => ["thumbnail", "products"]])
            ->where("id", $id)
            ->with(['collections' => function ($query) {
                $query->orderBy('_rgt');
            }])
            ->get();

        return CollectionGroupResource::collection($collectionGroup);
    }

    /**
     * Display the specified collection.
     */
    public function detailCollection(string $id)
    {
        $collectionDetail = Collection::where("id", $id)
            ->with(["thumbnail","products"])
            ->whereHas('products', function (Builder $query) {
                $query->where('status', '=', 'published');
            })
            ->get();

        return CollectionResource::collection($collectionDetail);
    }
}
