<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WhishlistProductResource extends JsonResource
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
            'product_name'  =>  $this->product_name,
            'base_price'    =>  $this->base_price,
            'base_stock'    =>  $this->base_stock,
            'slug'          =>  $this->slug,
            'product_url'   =>  url('product/'.$this->slug),
            'product_image' =>  array(
                'image_sm'  =>  url('storage'.$this->primary_img->image_sm),
                'image_md'  =>  url('storage'.$this->primary_img->image_md),
                'image_lg'  =>  url('storage'.$this->primary_img->image_lg),
            )
        ];
    }
}
