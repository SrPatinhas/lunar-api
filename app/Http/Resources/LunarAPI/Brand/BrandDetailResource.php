<?php

namespace App\Http\Resources\LunarAPI\Brand;

use App\Http\Resources\LunarAPI\Media\MediaThumbnailResource;
use App\Http\Resources\LunarAPI\Product\ProductsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"    => $this->id,
            "name"  => $this->name,
            "logo"  => $this->thumbnail ? new MediaThumbnailResource($this->thumbnail) : null,
            "products"  => ProductsResource::collection($this->products)
        ];
    }
}
