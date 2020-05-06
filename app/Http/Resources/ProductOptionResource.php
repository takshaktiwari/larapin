<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AttrOptionResource;


class ProductOptionResource extends JsonResource
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
            'price'     =>  $this->price,
            'stock'     =>  $this->stock,
            'option'    =>  new AttrOptionResource($this->attr_option)
        ];
    }
}
