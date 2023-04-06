<?php

namespace App\Http\Resources;

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
        $user = new UserResource($this->user);
        $category = new CategoryResource($this->category);
        // $tags =  new TagsResource($this->tags);
        $comment = new CommentResource($this->comment);

        return [
            'id'=> $this->id,
            "user"=> $user,
            'title'=> $this->title,
            'short_content'=> $this->short_content,
            'content' => $this->content,
            'category' => $category,
            'tags' => $this->tags,
            'comment' => $comment,
        ];
    }
}
