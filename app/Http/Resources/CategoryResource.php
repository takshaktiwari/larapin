<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DiscountResource;

class CategoryResource extends JsonResource
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
            'category'  =>  $this->category,
            'slug'      =>  $this->slug,
            'image_sm'  =>  url('storage').$this->image_sm,
            'image_md'  =>  url('storage').$this->image_md,
            'image_lg'  =>  url('storage').$this->image_lg,
            'featured'  =>  $this->featured,
            'discount'  =>  new DiscountResource($this->discount_category),
            'child_categories'  =>  CategoryResource::collection($this->child_categories)
        ];
    }
}
