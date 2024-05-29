<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'barcode'     => $this->barcode,
            'category'    => $this->whenLoaded('category', function () {
                return [
                    'name' => $this->category->name,
                ];
            }),
            'cost price'    => $this->cost_price,
            'sale price'    => $this->sale_price,
            'unit'          => $this->unit,
            'Minimum stock' => $this->stock_min,
            'supplier'      => $this->whenLoaded('supplier', function () {
                return [
                    'name'    => $this->supplier->name,
                    'contact' => $this->supplier->contact,
                ];
            }),
        ];
    }
}
