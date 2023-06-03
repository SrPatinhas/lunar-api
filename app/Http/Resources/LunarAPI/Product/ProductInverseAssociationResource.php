<?php

namespace App\Http\Resources\LunarAPI\Product;

use App\Http\Resources\LunarAPI\Brand\BrandResource;
use App\Http\Resources\LunarAPI\Media\MediaThumbnailResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductInverseAssociationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "type"  => $this->type,
            "id"            => $this->parent->id,
            // TODO -> check the current Store language or go to default
            "slug"          => $this->parent->urls->first(fn ($slug) => $slug->default())->slug ?? $this->parent->urls->first()->slug,
            "brand"         => new BrandResource($this->parent->brand),
            "attributes"    => $this->parent->attribute_data,
            "thumbnail"     => $this->parent->thumbnail ? new MediaThumbnailResource($this->parent->thumbnail->first()) : "",
        ];
    }
}
