<?php

namespace App\Http\Resources\LunarAPI\Setting\Shipping;

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
            "value"     => $this->value,
            "unitQty"   => $this->unitQty,
            "currency"  => new CurrencyResource($this->currency)
        ];
    }
}
