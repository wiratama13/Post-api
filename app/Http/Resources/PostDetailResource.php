<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class PostDetailResource extends JsonResource
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
            'title' => $this->title,
            'news_content' => $this->news_content,
            'author' => $this->author,
            'created_at' => Carbon::parse($this->created_at)->format("Y-m-d"),
            'writer' => $this->whenLoaded('writer'),
            'categories_id' => $this->whenLoaded('categories'), 
            'comments' => $this->whenLoaded('comments' ,function(){
                return collect($this->comments)->each(function($comment){
                    $comment->userComment;
                    return $comment;
                  
                });
            }),
            'comments_total' => $this->whenLoaded('comments', function(){
                return count($this->comments);
            })
        ];  
    }
}
