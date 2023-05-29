<?php

namespace App\Http\Resources\LunarAPI\Setting\Shipping;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "code"              => $this->code,
            "name"              => $this->name,
            "exchange_rate"     => $this->exchange_rate,
            "decimal_places"    => $this->decimal_places,
            "enabled"           => (bool)$this->enabled,
            "default"           => (bool)$this->default,
        ];
    }
}
