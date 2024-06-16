<?php

namespace App\Http\Resources\Like;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $like = $this->whenLoaded('like');
        return [
            'id' => $this->id,
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
            'status' => $like ? 'like user id ' . $this->friend_request : 'No like loaded',
            'status_message' => $like ? 'accepted ' . $like->name : 'No friend like',
            'accept_date' => $like ? $like->created_at->format('jS-F-Y H:i:s') : null,
        ];
    }
}
