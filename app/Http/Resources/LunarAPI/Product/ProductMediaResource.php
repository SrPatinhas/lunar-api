<?php

namespace App\Http\Resources\LunarAPI\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "url"           => $this->original_url,
            "mime_type"     => $this->mime_type,
            "label"         => $this->custom_properties["caption"] ?? "Thumbnail",
            "is_primary"    => $this->custom_properties["primary"] ?? false,
            "order"         => $this->custom_properties["position"] ?? 1,
        ];
    }
}
