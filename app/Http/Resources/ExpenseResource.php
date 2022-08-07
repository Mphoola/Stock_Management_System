<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'expense_on' => $this->expense_on,
            'description' => $this->description,
            'total' => $this->tatal,
            'user' => $this->user->name,
            'created_at' => $this->created_at->format('d F Y, h:i:s A'),
        ];
    }
}
