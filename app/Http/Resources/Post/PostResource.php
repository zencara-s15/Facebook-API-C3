<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\post\UserPostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'user_id' => $this->user_id,
            'post_by' => new UserPostResource($this->whenLoaded('user')),
            'title' => $this->title,
            'image'=>'http://localhost:8000/storage/'.$this->post_image,
            'status' => $this->user ? 'Post by user ID ' . $this->user_id : 'User did not post',
            'status_message' => $this->user ? 'Name ' . $this->user->name : 'Cannot find user',
            'post_date' => $this->created_at ? $this->created_at->format('jS-F-Y H:i:s') : null,
        ];
    }
}
