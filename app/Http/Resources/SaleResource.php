<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SaleItemResource;

class SaleResource extends JsonResource
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
            'user' => $this->user->name,
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone,
            'total' => number_format($this->total, 0, '', ','),
            'sale_items_count' => $this->sale_items_count,
            'created_at' =>$this->created_at->format('d F Y, h:i:s A'),
            'sale_items' => SaleItemResource::collection($this->whenLoaded('saleItems')),
        ];
    }
}
