<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CountryResource;

class StateResource extends JsonResource
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
            'id'    =>  $this->id,
            'state' =>  $this->state,
            'country_id'    =>  $this->country_id,
            'slug'          =>  $this->slug,
            'country'       =>  new CountryResource($this->country)
        ];
    }
}
