<?php

namespace App\Http\Resources\reject;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RejectFriendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $reject = $this->whenLoaded('reject');

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'reject' => new UserResource($reject),
            'status' => $reject ? 'rejected user id ' . $this->reject_friends : 'No reject loaded',
            'status_message' => $reject ? 'rejected ' . $reject->name : 'No friend reject',
            'reject_date' => $reject ? $reject->created_at->format('jS-F-Y H:i:s') : null,
        ];
    }
}
