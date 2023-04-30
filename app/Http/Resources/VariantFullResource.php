<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantFullResource extends JsonResource
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
            "tax"       =>  new TaxResource($this->tax),
            //"tax_ref"          => "0",
            "sku"              => $this->sku,
            "gtin"             => $this->gtin,
            "mpn"              => $this->mpn,
            "ean"              => $this->ean,
            "measures"  => [
                "length_value"     => $this->length_value,
                "length_unit"      => $this->length_unit,
                "width_value"      => $this->width_value,
                "width_unit"       => $this->width_unit,
                "height_value"     => $this->height_value,
                "height_unit"      => $this->height_unit,
                "weight_value"     => $this->weight_value,
                "weight_unit"      => $this->weight_unit,
                "volume_value"     => $this->volume_value,
                "volume_unit"      => $this->volume_unit,
                "shippable"        => $this->shippable,
            ],
            "stock"     => $this->stock,
            "prices"    => PriceFullResource::collection($this->price)
        ];
    }
}
