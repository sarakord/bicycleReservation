<?php

namespace App\Http\Resources\V1;

use App\Enums\ReservationStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'status' => $request['status'] ?? true,
            'data' => [
                "bicycle" => $this->bicycle?->title,
                "quantity" => $this->quantity,
                "start" => $this->start,
                "end" => $this->end,
                "status" => ReservationStatusEnum::label($this->status),
                "created_at" => $this->created_at?->format('Y-m-d'),
            ],
            'message' => $request->all()['message'] ?? '',
        ];
    }
}
