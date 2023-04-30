<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaThumbnailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "url" => $this->original_url,
            "label" => $this->custom_properties["caption"] ?? "Thumbnail",
            "mime_type" => $this->mime_type,
        ];
    }
}
