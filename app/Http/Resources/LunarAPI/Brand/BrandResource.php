<?php

namespace App\Http\Resources\LunarAPI\Brand;

use App\Http\Resources\LunarAPI\Media\MediaThumbnailResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //Make sure thumbnail is not null or it will throw an error (Call to a member function first() on null)
        $logo = ($this->thumbnail != null) ? new MediaThumbnailResource($this->thumbnail->first()) : "";

        return [
            "id"    => $this->id,
            "name"  => $this->name,
            "logo"  => $logo,
        ];
    }
}
