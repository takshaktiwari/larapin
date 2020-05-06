<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\ProductOptionResource;

class ProductAttrResource extends JsonResource
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
            'attribute_id'  =>  $this->attribute_id,
            'attribute'     =>  new AttributeResource($this->attribute),
            'options'       =>  ProductOptionResource::collection($this->product_options)
        ];
    }
}
