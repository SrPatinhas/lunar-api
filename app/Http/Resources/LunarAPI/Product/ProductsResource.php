<?php

namespace App\Http\Resources\LunarAPI\Product;

use App\Http\Resources\LunarAPI\Brand\BrandResource;
use App\Http\Resources\LunarAPI\Media\MediaThumbnailResource;
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
            // TODO -> check the current Store language or go to default
            "slug"          => $this->urls->first(fn ($slug) => $slug->default())->slug ?? $this->urls->first()->slug,
            "brand"         => new BrandResource($this->brand),
            "attributes"    => $this->attribute_data,
            "variant"       => $this->variants ? VariantResource::collection($this->variants) : [],
            "thumbnail"     => $this->thumbnail ? new MediaThumbnailResource($this->thumbnail) : null,
        ];
    }
}
