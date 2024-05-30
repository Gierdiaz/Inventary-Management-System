<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property Product $product
 * @property float $quantity
 * @property string $type
 * @property \Carbon\Carbon $date
 * @property string $note
 */
class StockMovementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'product' => $this->whenLoaded('product', function () {
                return [
                    'id'         => $this->product->id,
                    'name'       => $this->product->name,
                    'barcode'    => $this->product->barcode,
                    'category'   => $this->product->category->name,
                    'supplier'   => $this->product->supplier->name,
                    'cost price' => $this->product->cost_price,
                    'sale price' => $this->product->sale_price,
                    'unit'       => $this->product->unit,
                ];
            }),
            'quantity'      => $this->quantity,
            'movement type' => $this->type,
            'movement_date' => $this->date->format('d-m-Y'),
            'note'          => $this->note,
        ];
    }
}
