<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\UserCommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        $comment = $this->whenLoaded('comment');
        return [
            'id' => $this->id,
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
            'user'=>new UserCommentResource($comment),
            'text' => $this->text,
            'status' => $comment ? 'commented user id ' . $this->friend_request : 'No comment loaded',
            'status_message' => $comment ? 'commented ' . $comment->name : 'No friend comment',
            'comment_date' => $comment ? $comment->created_at->format('jS-F-Y H:i:s') : null,
        ];
    }
}
