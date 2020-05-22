<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\OrderProductAttrsResource;

class OrderProductsResource extends JsonResource
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
            'order_id'          =>  $this->order_id,
            'product_id'        =>  $this->product_id,
            'product_name'      =>  $this->product_name,
            'image_sm'          =>  $this->image_sm,
            'slug'              =>  $this->slug,
            'quantity'          =>  $this->quantity,
            'product_price'     =>  $this->product_price,
            'attr_prices'       =>  $this->attr_prices,
            'product_options'   =>  OrderProductAttrsResource::collection($this->order_product_attrs),
        ];
    }
}
