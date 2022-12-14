<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => number_format($this->price, 0, '', '.'),
            'stock' => $this->stock,
            'size' => $this->size,
            'code' => $this->code,
            'created_at' => $this->created_at->toFormattedDateString(),
            'sales' => SaleItemResource::collection($this->whenLoaded('sales')),
        ];
    }
}
