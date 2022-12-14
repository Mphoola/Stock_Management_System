<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'active' => '6 minutes ago',
            'created_at' => $this->created_at->toFormattedDateString(),
            'sales' => SaleResource::collection($this->whenLoaded('sales')),
            'expenses' => ExpenseResource::collection($this->whenLoaded('expenses')),
        ];
    }
}
