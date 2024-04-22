<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $userId = auth()->id();

        return [
            'id' => $this->id,
            'user_id' => $this->user_id, // Assuming you want to include the user ID
            'total_price' => $this->total_price,
            'food' => FoodResource::collection($this->whenLoaded('food')), // Assuming you want to include the food items
        ];
    }
}
