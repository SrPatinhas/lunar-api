<?php

namespace App\Http\Resources;

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
            "slug"          => $this->urls->first(fn ($slug) => $slug->default())->slug ?? $this->urls->first()->slug,
            "brand"         => new BrandResource($this->brand),
            "attributes"    => $this->attribute_data,
            "images"        => ProductMediaResource::collection($this->images),
            // esta como favorito
            // associated products
            "associations"  => ProductAssociationResource::collection($this->associations),
            "tags"          => $this->tags ? TagsResource::collection($this->tags) : [],
        ];
    }
}
