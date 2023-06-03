<?php

namespace App\Http\Resources\LunarAPI\Product\Attributes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductAttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        // TODO
        //dd($this->getValue()[App::getLocale()]->getValue()); // TODO -> check the current Store language or go to default
        return [
            "name" => [
                "en" => "White T-shirt Nike",
            ],
            "size" => "xl",
            "color" => "white",
            "style" => "new",
            "composition" => "100% cotton",
            "description" => [
                "en" => null,
                "pt" => "<p>This Nike Team items.</p>"
            ]
        ];
    }
}
