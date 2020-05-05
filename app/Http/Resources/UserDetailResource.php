<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class UserDetailResource extends JsonResource
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
            'user_img'  =>  $this->user_img,
            'mobile'  =>  $this->mobile,
            'gender'  =>  $this->gender
        ];;
    }
}
