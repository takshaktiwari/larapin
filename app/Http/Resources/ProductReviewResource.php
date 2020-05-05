<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductReviewResource extends JsonResource
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
            'product_id'    =>  $this->product_id,
            'user_id'       =>  $this->user_id,
            'name'          =>  $this->user->name,
            'email'         =>  $this->user->email,
            'rating'        =>  $this->rating,
            'title'         =>  $this->title,
            'review'        =>  $this->review,
        ];
    }
}
