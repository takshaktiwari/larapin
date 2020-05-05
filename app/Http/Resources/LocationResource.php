<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\StateResource;

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
            'id'        =>  $this->id,
            'location'  =>  $this->location,
            'pincode'   =>  $this->pincode,
            'slug'      =>  $this->slug,
            'state'     =>  new StateResource($this->state)
        ];
    }
}
