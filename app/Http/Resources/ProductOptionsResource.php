<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductOptionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);

        return [
            "id"        => $this->id,
            "name"      => $this->name->pt,
            "handle"    => $this->handle,
            "values"    => ProductOptionValuesResource::collection($this->values),
        ];
    }
}
