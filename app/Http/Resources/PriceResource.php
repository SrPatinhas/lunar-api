<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
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
            "currency"  => [
                "id"        => $this->currency->id,
                "code"      => $this->currency->code,
                "name"      => $this->currency->name,
            ],
            "price" => [
                "value" => $this->price->value,
                "label" => $this->price->value
            ]
        ];
    }
}
