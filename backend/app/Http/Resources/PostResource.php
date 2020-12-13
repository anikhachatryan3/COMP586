<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource as JsonJsonResource;

class PostResource extends JsonJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => $this->user->id,
            'user' => $this->user,
            'username' => $this->username,
            'comments' => $this->comments,
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}