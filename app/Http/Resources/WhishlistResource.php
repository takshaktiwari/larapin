<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\WhishlistProductResource;

class WhishlistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        =>  $this->id,
            'user_id'   =>  $this->user_id,
            'created_at'=>  $this->created_at,
            'product'   =>  new WhishlistProductResource($this->product),
        ];
    }
}
