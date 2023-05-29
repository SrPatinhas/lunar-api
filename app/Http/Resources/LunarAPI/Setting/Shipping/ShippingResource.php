<?php

namespace App\Http\Resources\LunarAPI\Setting\Shipping;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name"          => $this->name,
            "description"   => $this->description,
            "identifier"    => $this->identifier,

            "price"     => new PriceResource($this->price),
            "tax"       => new TaxResource($this->taxClass),

            "taxReference"  => $this->taxReference,
            "option"        => $this->option,
            "meta"          => $this->meta
        ];
    }
}
