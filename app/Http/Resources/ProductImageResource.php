<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
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
            'id'            =>  $this->id,
            'product_id'    =>  $this->product_id,
            'image_lg'      =>  url('storage').$this->image_lg,
            'image_md'      =>  url('storage').$this->image_md,
            'image_sm'      =>  url('storage').$this->image_sm,
            'title'         =>  $this->title,
            'primary_img'   =>  $this->primary_img,
        ];
    }
}
