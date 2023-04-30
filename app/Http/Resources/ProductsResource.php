<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //dd($this->thumbnail->first());
        return [
            "id"            => $this->id,
            "slug"          => $this->urls->first(fn ($slug) => $slug->default())->slug ?? $this->urls->first()->slug,
            "brand"         => new BrandResource($this->brand),
            "attributes"    => $this->attribute_data,
            "variant"       => $this->variants ? VariantResource::collection($this->variants) : [],
            "thumbnail"     => $this->thumbnail ? new MediaThumbnailResource($this->thumbnail->first()) : "",
        ];
    }
}
