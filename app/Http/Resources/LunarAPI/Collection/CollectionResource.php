<?php

namespace App\Http\Resources\LunarAPI\Collection;

use App\Http\Resources\LunarAPI\Media\MediaThumbnailResource;
use App\Http\Resources\LunarAPI\Product\ProductsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // TODO > pass the right
        return [
            "id"    => $this->id,
            "name"  => $this->translateAttribute('name', App::getLocale()),
            "logo"  => $this->thumbnail ? new MediaThumbnailResource($this->thumbnail) : null,

            "attributes"    => $this->attribute_data,
            "products"      => ProductsResource::collection($this->products)
        ];
    }
}
