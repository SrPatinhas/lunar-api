<?php

namespace App\Http\Resources\LunarAPI\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductOptionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);

        return [
            "id"        => $this->id,
            "name"      => $this->name->en, // TODO -> check the current Store language or go to default
            "handle"    => $this->handle,
            "values"    => ProductOptionValuesResource::collection($this->values),
        ];
    }
}
