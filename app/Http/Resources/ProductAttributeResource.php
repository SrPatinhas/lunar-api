<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
        //dd($this);//->getValue()["en"]->getValue());
        return [
            "name" => [
                "en" => "White T-shirt Nike",
                "pt" => "T-shirt Branca Nike"
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
