<?php
namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestFriendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Get the requester resource
        $requester = $this->whenLoaded('requester');

        // Create the custom message
        $customMessage = $requester ? 'Padding to user ' . $this->friend_id : 'No requester loaded';

        // Determine status based on the message
        $statusMessage = $requester ? 'Padding to ' . $requester->name : 'No friend request';

        // Get the requester date
        $requester_date = $requester ? $requester->created_at : null;

        // Assuming $this->resource refers to an individual friend request model
        $requester = $this->resource->requester; // Accessing the relationship directly


        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'requester' => new UserResource($requester),
            'status' => $customMessage,
            'status_message' => $statusMessage,
            'requester_date' =>  $requester_date ? $requester_date->format('jS-F-Y H:i:s') : null
        ];
    }
}
