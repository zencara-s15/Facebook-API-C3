<?php

namespace App\Http\Resources\accept;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AcceptFriendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $accept = $this->whenLoaded('accept');

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'accept' => new UserResource($accept),
            'status' => $accept ? 'accepted user id ' . $this->friend_request : 'No accept loaded',
            'status_message' => $accept ? 'accepted ' . $accept->name : 'No friend accept',
            'accept_date' => $accept ? $accept->created_at->format('jS-F-Y H:i:s') : null,
        ];
    }
}
