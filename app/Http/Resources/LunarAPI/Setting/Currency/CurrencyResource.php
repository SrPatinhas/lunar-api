<?php

namespace App\Http\Resources\LunarAPI\Setting\Currency;

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
            "id"        => $this->id,
            "name"      => $this->name,
            "code"      => $this->code,
            "default"   => (bool) $this->default,
        ];
    }
}
