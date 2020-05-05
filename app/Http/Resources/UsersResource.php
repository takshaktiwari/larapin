<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\UserDetailResource as UserDetailResource;

class UsersResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        return [
            'id'        =>  $this->id,
            'name'      =>  $this->name,
            'email'     =>  $this->email,
            'api_token' =>  $this->api_token,
            'detail'    =>  new UserDetailResource($this->detail),
        ];
    }
}
