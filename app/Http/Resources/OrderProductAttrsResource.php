<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductAttrsResource extends JsonResource
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
            'id'                =>  $this->id,
            'attribute_id'      =>  $this->attribute_id,
            'attribute'         =>  $this->attribute,
            'attr_option_id'    =>  $this->attr_option_id,
            'attr_option'       =>  $this->attr_option,
            'attr_price'        =>  $this->attr_price
        ];
    }
}
