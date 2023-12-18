<?php

namespace App\Http\Resources\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    private string $token;
    private string $tokenType;

    public function __construct(User $resource, string $token, string $tokenType)
    {
        parent::__construct($resource);
        $this->token = $token;
        $this->tokenType = $tokenType;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
            ],
            'meta' => [
                'token' => $this->token,
                'token_type' => $this->tokenType,
            ]
        ];
    }
}
