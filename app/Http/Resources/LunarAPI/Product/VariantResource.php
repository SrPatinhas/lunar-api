<?php

namespace App\Http\Resources\LunarAPI\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"        => $this->id,
            "tax"       => new TaxResource($this->tax),
            "stock"     => $this->stock,
            "price"     => PriceResource::collection($this->prices)
        ];
    }
}
