<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PincodeResource extends JsonResource
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
            'id'            =>   $this->id,
            'pincode'       =>   $this->pincode,
            'district_id'   =>   $this->district_id,
            'state_id'      =>   $this->state_id,
            'country_id'    =>   $this->country_id,
        ];
    }
}
