<?php

namespace App\Http\Resources\LunarAPI\Collection;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"        => $this->id,
            "name"      => $this->name,
            "handle"    => $this->handle,

            "collections"   => CollectionResource::collection($this->collections)
        ];
    }
}
