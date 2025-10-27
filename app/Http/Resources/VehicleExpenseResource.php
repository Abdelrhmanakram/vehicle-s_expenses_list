<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
 public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->vehicle_id,
            'vehicle_name' => $this->vehicle_name,
            'plate_number' => $this->plate_number,
            'type' => $this->type,
            'cost' => (float) $this->cost,
            'created_at' => $this->created_at,
        ];
    }
}
