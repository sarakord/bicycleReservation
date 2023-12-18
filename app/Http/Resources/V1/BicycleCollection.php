<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BicycleCollection extends ResourceCollection
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
            'data' => BicycleResource::collection($this->collection),
            'message' => $request->all()['message'] ?? '',
        ];
    }
}
