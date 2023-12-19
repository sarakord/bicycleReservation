<?php

namespace App\Http\Resources\V1;

use App\Enums\ReservationStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            "bicycle" => $this->bicycle?->title,
            "quantity" => $this->quantity,
            "start" => $this->start,
            "end" => $this->end,
            "status" => ReservationStatusEnum::label($this->status),
            "created_at" => $this->created_at?->format('Y-m-d'),
        ];
    }
}
