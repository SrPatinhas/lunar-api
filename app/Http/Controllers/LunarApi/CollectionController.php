<?php

namespace App\Http\Controllers\LunarApi;

use App\Http\Controllers\Controller;
use Lunar\Models\Collection;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        return Collection::all();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

}
