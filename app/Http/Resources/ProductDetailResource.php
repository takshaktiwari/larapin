<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
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
            'sku_code'      =>  $this->sku_code,
            'ship_charge'   =>  $this->ship_charge,
            'ship_time'     =>  $this->ship_time,
            'description'   =>  $this->description,
        ];
    }
}
