<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'location'      =>  $this->location,
            'slug'          =>  $this->slug,
            'state_id'      =>  $this->state_id,
            'pincode_id'    =>  $this->pincode_id,
            'district_id'   =>  $this->district_id,
            'country_id'    =>  $this->country_id,
        ];
    }
}
