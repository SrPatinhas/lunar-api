<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductAssociationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"            => $this->target->id,
            "slug"          => $this->target->urls->first(fn ($slug) => $slug->default())->slug ?? $this->target->urls->first()->slug,
            "brand"         => new BrandResource($this->target->brand),
            "attributes"    => $this->target->attribute_data,
            "thumbnail"     => $this->target->thumbnail ? new MediaThumbnailResource($this->target->thumbnail->first()) : "",
        ];
    }
}
