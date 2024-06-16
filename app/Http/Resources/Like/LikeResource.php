<?php
namespace App\Http\Resources\Like;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
 // LikeResource.php
public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'post_id' => $this->post_id,
        'user_id' => $this->user_id,
        'status' => 'A user Like your post',
        'reaction_date' => $this->created_at ? $this->created_at->format('jS-F-Y H:i:s') : null,
    ];
}

}

