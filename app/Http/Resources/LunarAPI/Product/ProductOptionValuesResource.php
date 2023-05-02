<?php

namespace App\Http\Resources\LunarAPI\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductOptionValuesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"            => $this->id,
            "option_id"     => $this->product_option_id,
            "name"          => $this->name->en,         // TODO -> check the current Store language or go to default
            "property"      => $this->name->en,         // TODO -> should this be another property/handle?
        ];
    }
}
