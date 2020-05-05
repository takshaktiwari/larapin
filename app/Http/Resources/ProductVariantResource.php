<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\AttrOptionResource;

class ProductVariantResource extends JsonResource
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
            'price'         =>  $this->price,
            'discount'      =>  $this->discount,
            'stock'         =>  $this->stock,
            'attribute_id'  =>  $this->attribute_id,
            'attr_option_id'=>  $this->attr_option_id,
            'attribute'     =>  new AttributeResource($this->attribute),
            'attr_option'   =>  new AttrOptionResource($this->attr_option),
        ];
    }
}
