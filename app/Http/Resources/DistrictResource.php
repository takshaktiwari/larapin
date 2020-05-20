<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
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
            'district'        =>  $this->district,
            'slug'        =>  $this->slug,
            'state_id'        =>  $this->state_id,
            'country_id'        =>  $this->country_id,
        ];
    }
}
