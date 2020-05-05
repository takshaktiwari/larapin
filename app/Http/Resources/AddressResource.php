<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\StateResource;

class AddressResource extends JsonResource
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
            'name'          =>  $this->name,
            'email'         =>  $this->email,
            'mobile'        =>  $this->mobile,
            'landmark'      =>  $this->landmark,
            'line1'         =>  $this->line1,
            'line2'         =>  $this->line2,
            'location'      =>  new LocationResource($this->location),
            'pincode'       =>  $this->pincode,
            'default_addr'  =>  $this->default_addr,
            'shipping_billing'   =>  $this->shipping_billing,
        ];
    }
}
