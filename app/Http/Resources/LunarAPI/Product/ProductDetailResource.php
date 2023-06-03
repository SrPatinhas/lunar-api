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
            "brand"         => new BrandResource($this->whenLoaded('brand')),
            "attributes"    => $this->attribute_data, //ProductAttributeResource::collection($this->attribute_data),
            "images"        => ProductMediaResource::collection($this->whenLoaded('images')),
            "tags"          => $this->tags ? TagsResource::collection($this->whenLoaded('tags')) : [],

            // associated products
            "associations"          => ProductAssociationResource::collection($this->whenLoaded('associations')),
            "inverseAssociations"   => ProductInverseAssociationResource::collection($this->whenLoaded('inverseAssociations')),

            // Related to the logged user
            "is_whishlisted"    => false, // TODO
            "in_cart"           => false, // TODO
        ];
    }
}
