<?php

namespace App\Http\Resources\LunarAPI\Product;

use App\Http\Resources\LunarAPI\Brand\BrandResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"            => $this->id,
            // TODO -> check the current Store language or go to default
            "slug"          => $this->urls->first(fn ($slug) => $slug->default())->slug ?? $this->urls->first()->slug,
            "brand"         => new BrandResource($this->brand),
            "attributes"    => $this->attribute_data,
            "images"        => ProductMediaResource::collection($this->images),
            "tags"          => $this->tags ? TagsResource::collection($this->tags) : [],

            // associated products
            "associations"  => ProductAssociationResource::collection($this->associations),

            // Related to the logged user
            "is_whishlisted"    => false, // TODO
        ];
    }
}
