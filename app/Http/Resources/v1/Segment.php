<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class Segment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status'=>$this->status,
            'conditions'=>SegmentConditions::collection($this->whenLoaded('conditions')),
            'users'=>User::collection($this->whenLoaded('users')),
            'users_count'=>$this->users_count,
        ];
    }
}
