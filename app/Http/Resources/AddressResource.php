<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\LocationResource;
use App\Http\Resources\PincodeResource;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\CountryResource;

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
            'pincode'       =>  new PincodeResource($this->pincode),
            'district'         =>  new DistrictResource($this->district),
            'state'         =>  new StateResource($this->state),
            'country'       =>  new CountryResource($this->country),
            'default_addr'  =>  $this->default_addr,
        ];
    }
}
