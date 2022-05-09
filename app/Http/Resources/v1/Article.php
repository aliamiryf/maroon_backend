<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       return [
           'id'=>$this->id,
           'title'=>$this->title,
           'primaryPic'=>$this->primaryPic,
           'readtime'=>$this->readTime,
           'slug'=>$this->slug,
           'shortLink'=>$this->shortLink,
           'status'=>$this->status,
           'author'=>new User($this->whenLoaded('authorInfo')),
       ];
    }
}
