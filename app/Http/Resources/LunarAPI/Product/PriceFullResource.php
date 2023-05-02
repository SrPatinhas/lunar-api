<?php

namespace App\Http\Resources\LunarAPI\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceFullResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            [
                "id"    => 2,
                "customer_group_id"=> null,
                "currency_id"=> 2,
                "priceable_type"=> "Lunar\\Models\\ProductVariant",
                "priceable_id"=> 1,
                "price"=> [
                    "value"=> 1500,
                    "currency"=> [
                        "id"=> 2,
                        "code"=> "eur",
                        "name"=> "Euro",
                        "exchange_rate"=> "1.0000",
                        "decimal_places"=> 2,
                        "enabled"=> 1,
                        "default"=> 1,
                        "created_at"=> "2023-03-30T21:45:10.000000Z",
                        "updated_at"=> "2023-03-30T21:45:18.000000Z"
                    ],
                    "unitQty"=> 1
                ],
                "compare_price"=> [
                    "value"=> 1500,
                    "currency"=> [
                        "id"=> 2,
                        "code"=> "eur",
                        "name"=> "Euro",
                        "exchange_rate"=> "1.0000",
                        "decimal_places"=> 2,
                        "enabled"=> 1,
                        "default"=> 1,
                        "created_at"=> "2023-03-30T21:45:10.000000Z",
                        "updated_at"=> "2023-03-30T21:45:18.000000Z"
                    ],
                    "unitQty"=> 1
                ],
                "tier"=> 1,
                "created_at"=> "2023-03-30T21:50:06.000000Z",
                "updated_at"=> "2023-03-30T21:50:06.000000Z",
                "currency"=> [
                    "id"=> 2,
                    "code"=> "eur",
                    "name"=> "Euro",
                    "exchange_rate"=> "1.0000",
                    "decimal_places"=> 2,
                    "enabled"=> 1,
                    "default"=> 1,
                    "created_at"=> "2023-03-30T21:45:10.000000Z",
                    "updated_at"=> "2023-03-30T21:45:18.000000Z"
                ],
                "priceable"=> [
                    "id"=> 1,
                    "product_id"=> 1,
                    "tax_class_id"=> 1,
                    "attribute_data"=> [],
                    "tax_ref"=> "0",
                    "unit_quantity"=> 1,
                    "sku"=> "qe3",
                    "gtin"=> "qwer",
                    "mpn"=> "qwer",
                    "ean"=> "1234",
                    "length_value"=> null,
                    "length_unit"=> null,
                    "width_value"=> null,
                    "width_unit"=> null,
                    "height_value"=> null,
                    "height_unit"=> null,
                    "weight_value"=> null,
                    "weight_unit"=> null,
                    "volume_value"=> null,
                    "volume_unit"=> null,
                    "shippable"=> 1,
                    "stock"=> 1,
                    "backorder"=> 0,
                    "purchasable"=> "in_stock",
                    "created_at"=> "2023-03-30T21:50:06.000000Z",
                    "updated_at"=> "2023-04-27T20:47:11.000000Z",
                    "deleted_at"=> null
                ]
            ]
        ];
    }
}
