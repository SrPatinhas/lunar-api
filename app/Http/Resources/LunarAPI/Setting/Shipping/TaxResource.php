<?php

namespace App\Http\Resources\LunarAPI\Setting\Shipping;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaxResource extends JsonResource
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
            "default"   => (bool)$this->default
        ];
    }
}
